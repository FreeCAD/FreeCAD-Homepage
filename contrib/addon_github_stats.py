# SPDX-License-Identifier: LGPL-2.1-or-later
# ***************************************************************************
# *                                                                         *
# *   Copyright (c) 2023 Chris Hennes (chennes@pioneerlibrarysystem.org)    *
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
import requests
import os
from urllib.parse import urlparse
from typing import List, Dict, Tuple

# CONFIGURATION
addon_list_url = "https://raw.githubusercontent.com/FreeCAD/FreeCAD-addons/master/.gitmodules"
#gitlab_access_token = ""  # Read from the file specified by the environment variable GITLAB_ACCESS_TOKEN_FILE
github_access_token = ""  # Read from the file specified by the environment variable GITHUB_ACCESS_TOKEN_FILE


class StatsWriter:

    def __init__(self):
        self.setup_tokens()

    def write(self):
        addons = self.get_addon_url_list()
        stats = {}
        for addon in addons:
            stats[addon] = self.get_stats_for_repo(addon)
            if stats[addon] and "stargazers_count" in stats[addon]:
                stars = stats[addon]["stargazers_count"]
                print(f"{addon} has {stars} stars")
        with open("addon_stats.json", "w", encoding="utf-8") as f:
            f.write(json.dumps(stats, indent="  "))

    def setup_tokens(self):
        """Load the API access tokens from the files specified in the appropriate environment variables."""
        #global gitlab_access_token
        global github_access_token
        #gitlab_access_token = self.get_token("GITLAB_ACCESS_TOKEN_FILE")
        github_access_token = self.get_token("GITHUB_ACCESS_TOKEN_FILE")

    @staticmethod
    def get_token(name: str) -> str:
        """Load a token from a file and return it."""
        token_file = os.getenv(name)
        if not token_file:
            print(f"Could not load the environment variable {name}")
            return ""
        if not os.path.exists(token_file):
            print(f"Cannot load the file set by {name}, which was {token_file}")
            return ""
        with open(token_file, "r", encoding="utf-8") as f:
            return f.readline().strip()

    def get_addon_url_list(self) -> List[str]:
        """ Return a list of URLs to FreeCAD Addons found in the .gitmodules file of the FreeCAD-addons repo """
        r = requests.get(addon_list_url, timeout=5)
        if r.status_code != 200:
            print(f"Failed to access addons list: got HTTP{r.status_code} response")
            return []
        return self.parse_submodules_file(r.text)

    @staticmethod
    def parse_submodules_file(submodules: str) -> List[str]:
        """ Parse a .gitmodules file to obtain the individual urls. All other data is ignored. """
        lines = submodules.splitlines()
        urls = []
        for line in lines:
            if "url = http" in line:
                _, _, url = line.partition(" = ")
                if url:
                    urls.append(url)
        return urls

    def get_stats_for_repo(self, repo_url: str) -> Dict[str, int]:
        parsed_url = urlparse(repo_url)
        # Assume that the only repo types are GitHub and gitlab (which may be a self-hosted gitlab instance)
        if parsed_url.netloc == "github.com":
            return self.get_stats_for_github_repo(repo_url)
        #else:
        #    return self.get_stats_for_gitlab_repo(repo_url)
        return {}

    def get_stats_for_github_repo(self, repo_url: str) -> Dict[str, int]:
        community, project = self.get_community_and_project(repo_url)
        url = f"https://api.github.com/repos/{community}/{project}"
        headers = {
            "Authorization": f"token {github_access_token}",
        }
        result = requests.get(url, headers=headers, timeout=5)
        if result.status_code != 200:
            print(f"Failed to read GitHub data about {community}/{project}")
            return {}
        return self.process_github_stats(result.text)

    def get_stats_for_gitlab_repo(self, repo_url: str) -> Dict[str, int]:
        return {}
        gl = gitlab.Gitlab(private_token=gitlab_access_token)
        community, project = self.get_community_and_project(repo_url)
        try:
            gl_project = gl.projects.get(f"{community}/{project}")
            # TODO: Support gitlab projects...
        except gitlab.exceptions.GitlabGetError:
            print(f"Failed to load data from gitlab for {repo_url}")
            return {}

    @staticmethod
    def get_community_and_project(repo_url: str) -> Tuple[str, str]:
        parsed_url = urlparse(repo_url)
        split_path = parsed_url.path.split("/")
        project = split_path[-1]
        community = split_path[-2]
        if project.endswith(".git"):
            project = project[:-4]
        return community, project

    @staticmethod
    def process_github_stats(raw_stats_json: str) -> Dict[str, int]:
        processed_result = {}
        stats = json.loads(raw_stats_json)
        expected_fields = ["pushed_at",
                           "stargazers_count",
                           "forks_count",
                           "open_issues_count",
                           "network_count",
                           "subscribers_count", 
                           "created_at", ]
        for field in expected_fields:
            if field in stats:
                processed_result[field] = stats[field]
            else:
                processed_result[field] = ""
        # Try to pull the SPDX license ID -- it's not set for every project, though
        if "license" in stats:
            if stats["license"] is not None and "spdx_id" in stats["license"]:
                spdx = stats["license"]["spdx_id"]
                if spdx != "NOASSERTION":
                    processed_result["license"] = spdx
        return processed_result


# Other things that might be used in scoring:
#   PyLint score
#   Activity of forums discussions
#   Wiki page accesses
#   Presence or absense of CI
#   Translations
#   Presence or absense of automated tests
#   Presence or absense of documentation

if __name__ == "__main__":
    stats_writer = StatsWriter()
    stats_writer.write()
