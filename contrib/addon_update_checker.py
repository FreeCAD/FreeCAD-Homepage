#!/usr/bin/env python
# -*- coding: utf-8 -*-

# ***************************************************************************
# *                                                                         *
# *   Copyright (c) 2022 Chris Hennes <chennes@pioneerlibrarysystem.org>    *
# *                                                                         *
# *   This library is free software; you can redistribute it and/or         *
# *   modify it under the terms of the GNU Lesser General Public            *
# *   License as published by the Free Software Foundation; either          *
# *   version 2.1 of the License, or (at your option) any later version.    *
# *                                                                         *
# *   This library is distributed in the hope that it will be useful,       *
# *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
# *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU     *
# *   Lesser General Public License for more details.                       *
# *                                                                         *
# *   You should have received a copy of the GNU Lesser General Public      *
# *   License along with this library; if not, write to the Free Software   *
# *   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA         *
# *   02110-1301  USA                                                       *
# *                                                                         *
# ***************************************************************************


# CONFIGURATION:
BASE_DIRECTORY = "./"
MAX_COUNT = 1000  # Do at most this many repos, for testing purposes


# This script creates a single JSON-formatted output file called:
#   addon_update_stats.json
#
# This file contains a listing of the last-updated date of all of the branches
# of all of the "official" FreeCAD Addons (that is, those listed as submodules
# in https://github.com/FreeCAD/FreeCAD-Addons/.gitmodules). It is designed to
# be run as a cron job on a central server, providing regularly-updated access
# to the git update stats without requiring every copy of FreeCAD to clone
# every repository. Only the single sub-100kb download of this JSON file is
# required in order for the Addon Manager to display relatively up-to-date
# last-updated information for all official Addons, limited only by how often
# the cron job is run.
#
# The first time this job is run it must clone all existing submodules listed
# in the FreeCAD-Addons .gitmodule file. On subsequent calls, only newly-added
# repos must be cloned: all others are fetched. If a full re-clone is desired,
# simply delete the FreeCAD-Addons directory, and on the next run of this
# script the Addons repo will be re-cloned along with all of its submodules.
# Note that a full re-clone takes about 50 times longer than a fetch, so
# this option should be exercised sparingly.


import os
import subprocess
import re
import sys
import json

from typing import List

if not os.path.exists(BASE_DIRECTORY):
    os.makedirs(BASE_DIRECTORY)

# Repos that are too large, or that should for some reason not be cloned here
excluded_repos = ["parts_library"]


def update_submodules() -> None:
    """Loop over the contents of the .gitmodules file and either clone or fetch
    each repo. NOTE: Does NOT use the standard git submodule init and fetch."""

    # The FreeCAD Addon Manager does not follow normal git submodule rules, so
    # to be consistent, neither does this script. Instead of using git to
    # initialize the submodules, manually parse the .gitmodules file and clone
    # copies of each repo (excluding those listed in the exclusions list).
    if not os.path.exists(".gitmodules"):
        print("Could not locate .gitmodules file... exiting", file=sys.stderr)
        exit(1)
    with open(".gitmodules", "r") as f:
        # Use identical parse logic to the Addon Manager
        p = f.read()
        p = re.findall(
            (
                r'(?m)\[submodule\s*"(?P<name>.*)"\]\s*'
                r"path\s*=\s*(?P<path>.+)\s*"
                r"url\s*=\s*(?P<url>https?://.*)\s*"
                r"(branch\s*=\s*(?P<branch>[^\s]*)\s*)?"
            ),
            p,
        )
        counter = 0
        for name, _, url, _, _ in p:
            if name not in excluded_repos:
                counter += 1
                try:
                    clone_or_update(name, url)
                except Exception as e:
                    print(f"Failed to update {name}. Continuing...", file=sys.stderr)
                if counter >= MAX_COUNT:
                    break


def clone_or_update(name: str, url: os.PathLike, minimal=True) -> None:
    """If a directory called "name" exists, and it contains a subdirectory called .git,
    then 'git fetch' is called, otherwise we use 'git clone' to make a bare, shallow
    copy of the repo (in the normal case where minimal is True), or a normal clone,
    if minimal is set to False."""

    if not os.path.exists(os.path.join(os.getcwd(), name, ".git")):
        print(f"Cloning {url} to {name}", flush=True)
        if minimal:
            # Bare, shallow, but do include the last commit on each branch and tag
            command = [
                "git",
                "clone",
                "--no-checkout",
                "--depth",
                "1",
                "--no-single-branch",
                url,
                name,
            ]
        else:
            command = ["git", "clone", url, name]
        completed_process = subprocess.run(command)
        if completed_process.returncode != 0:
            raise Exception(f"Clone failed for {url}")
    else:
        print(f"Updating {name}", flush=True)
        old_dir = os.getcwd()
        os.chdir(os.path.join(old_dir, name))
        command = ["git", "fetch"]
        completed_process = subprocess.run(command)
        os.chdir(old_dir)
        if completed_process.returncode != 0:
            raise Exception(f"git fetch failed for {name}")


def create_last_updated_json() -> str:
    update_info = {}
    for dirname in os.listdir(os.getcwd()):
        if os.path.isdir(dirname) and os.path.isdir(os.path.join(dirname, ".git")):
            curdir = os.getcwd()
            update_info[dirname] = get_update_info(dirname)
            os.chdir(curdir)
    data_as_json = json.dumps(update_info)
    return data_as_json


def get_update_info(name: str) -> List[List[str]]:
    """Update info is a list of lists of strings, where each inner list is HASH,REF,DATE,
    with date formatted according to ISO 8601. Only remote origin branches and tags
    are included."""

    os.chdir(os.path.abspath(name))
    print(f"Getting last update for {name}", flush=True)
    command = ["git", "show-ref"]
    completed_process = subprocess.run(command, capture_output=True)
    refs = []
    for line in completed_process.stdout.decode("utf8").splitlines():
        entry = line.split()
        if len(entry) != 2:
            print(
                f"Warning: unexpected line format from git show-ref: {line}",
                file=sys.stderr,
            )
            continue
        # We only care about remote refs and tags:
        if entry[1].startswith("refs/remotes/origin") or entry[1].startswith(
            "refs/tags"
        ):

            # Get the date of the commit
            hash = entry[0]
            command = ["git", "log", "-1", "--format=format:%cI", hash]
            commit_date = subprocess.run(command, capture_output=True)
            date = commit_date.stdout.decode("utf8")
            entry.append(date)

            refs.append(entry)

    return refs


if __name__ == "__main__":
    working_dir = os.path.abspath(BASE_DIRECTORY)
    os.chdir(working_dir)
    try:
        clone_or_update(
            "FreeCAD-Addons", "https://github.com/FreeCAD/FreeCAD-Addons", minimal=False
        )
    except Exception as e:
        print(f"Failed to clone main addons repo:\n{e}", file=sys.stderr)
        exit(1)
    os.chdir(os.path.join(working_dir, "FreeCAD-Addons"))
    update_submodules()
    os.chdir(os.path.join(working_dir, "FreeCAD-Addons"))
    data = create_last_updated_json()
    os.chdir(os.path.join(working_dir))
    with open("addon_update_stats.json", "w") as f:
        f.write(data)
