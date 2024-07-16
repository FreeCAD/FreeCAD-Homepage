#!/usr/bin/env python

# SPDX-License-Identifier: LGPL-2.1-or-later
# ***************************************************************************
# *                                                                         *
# *   Copyright (c) 2024 The FreeCAD Project Association AISBL              *
# *                                                                         *
# *   This file is part of FreeCAD.                                         *
# *                                                                         *
# *   FreeCAD is free software: you can redistribute it and/or modify it    *
# *   under the terms of the GNU Lesser General Public License as           *
# *   published by the Free Software Foundation, either version 2.1 of the  *
# *   License, or (at your option) any later version.                       *
# *                                                                         *
# *   FreeCAD is distributed in the hope that it will be useful, but        *
# *   WITHOUT ANY WARRANTY; without even the implied warranty of            *
# *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      *
# *   Lesser General Public License for more details.                       *
# *                                                                         *
# *   You should have received a copy of the GNU Lesser General Public      *
# *   License along with FreeCAD. If not, see                               *
# *   <https://www.gnu.org/licenses/>.                                      *
# *                                                                         *
# ***************************************************************************

import json
import re
import requests
import subprocess
import sys
import os
from typing import List, Dict, Optional

# CONFIGURATION
ADDON_LIST_URL = "https://raw.githubusercontent.com/FreeCAD/FreeCAD-addons/master/.gitmodules"
BASE_DIRECTORY = "./"
MAX_COUNT = 1000  # Do at most this many repos, for testing purposes

# Repos that are too large, or that should for some reason not be cloned here
EXCLUDED_REPOS = ["parts_library"]


# This script creates a single output file: addon_cache.json, which contains various metadata files related
# to each addon


class CacheWriter:

    def __init__(self):
        pass

    def write(self):
        addons = self.get_addon_url_list()
        metadata = CacheWriter.read_metadata_files(addons)
        with open("addon_cache.json", "w", encoding="utf-8") as f:
            f.write(json.dumps(metadata, indent="  "))

    @staticmethod
    def get_addon_url_list() -> List[str]:
        """ Return a list of URLs to FreeCAD Addons found in the .gitmodules file of the FreeCAD-addons repo """
        r = requests.get(ADDON_LIST_URL, timeout=5)
        if r.status_code != 200:
            print(f"Failed to access addons list: got HTTP{r.status_code} response")
            return []
        return CacheWriter.update_submodules(r.text)

    @staticmethod
    def update_submodules(gitmodules_content: str) -> List[str]:
        """Loop over the contents of the .gitmodules file and either clone or fetch
        each repo. NOTE: Does NOT use the standard git submodule init and fetch."""

        # The FreeCAD Addon Manager does not follow normal git submodule rules, so
        # to be consistent, neither does this script. Instead of using git to
        # initialize the submodules, manually parse the .gitmodules file and clone
        # copies of each repo (excluding those listed in the exclusions list).

        parse_results = re.findall(
            (
                r'(?m)\[submodule\s*"(?P<name>.*)"]\s*'
                r"path\s*=\s*(?P<path>.+)\s*"
                r"url\s*=\s*(?P<url>https?://.*)\s*"
                r"(branch\s*=\s*(?P<branch>\S*)\s*)?"
            ),
            gitmodules_content,
        )
        counter = 0
        submodules = []
        for name, path, url, _, branch in parse_results:
            if name not in EXCLUDED_REPOS:
                counter += 1
                try:
                    if not branch:
                        branch = "master"
                    CacheWriter.clone_or_update(name, url, branch)
                    submodules.append(name)
                except RuntimeError as e:
                    print(f"Failed to update {name}. Continuing...", file=sys.stderr)
                if counter >= MAX_COUNT:
                    break
        return submodules

    @staticmethod
    def clone_or_update(name: str, url: str, branch: str) -> None:
        """If a directory called "name" exists, and it contains a subdirectory called .git,
        then 'git fetch' is called, otherwise we use 'git clone' to make a bare, shallow
        copy of the repo (in the normal case where minimal is True), or a normal clone,
        if minimal is set to False."""

        if not os.path.exists(os.path.join(os.getcwd(), name, ".git")):
            print(f"Cloning {url} to {name}", flush=True)
            # Shallow, but do include the last commit on each branch and tag
            command = [
                "git",
                "clone",
                "--depth",
                "1",
                "--branch",
                branch,
                url,
                name,
            ]
            completed_process = subprocess.run(command)
            if completed_process.returncode != 0:
                raise RuntimeError(f"Clone failed for {url}")
        else:
            print(f"Updating {name}", flush=True)
            old_dir = os.getcwd()
            os.chdir(os.path.join(old_dir, name))
            command = ["git", "fetch"]
            completed_process = subprocess.run(command)
            if completed_process.returncode != 0:
                raise RuntimeError(f"git fetch failed for {name}")
            command = ["git", "checkout", branch, "--quiet"]
            completed_process = subprocess.run(command)
            os.chdir(old_dir)
            if completed_process.returncode != 0:
                raise RuntimeError(f"git checkout failed for {name} branch {branch}")

    @staticmethod
    def read_metadata_files(submodules: List[str]) -> Dict[str, Dict[str, str]]:
        metadata = {}
        for submodule in submodules:
            metadata[submodule] = {}
            cwd = os.getcwd()
            files = ["package.xml", "metadata.txt", "requirements.txt"]
            for file in files:
                file_contents = CacheWriter.load_file(os.path.join(cwd, submodule, file))
                if file_contents:
                    metadata[submodule][file] = file_contents
        return metadata

    @staticmethod
    def load_file(file: str) -> Optional[str]:
        if os.path.exists(file):
            try:
                with open(file, "r", encoding="utf-8") as f:
                    return f.read()
            except RuntimeError:
                pass
        return None


if __name__ == "__main__":
    cache_writer = CacheWriter()
    cache_writer.write()
