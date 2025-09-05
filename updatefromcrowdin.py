#!/usr/bin/python

# SPDX-License-Identifier: LGPL-2.1-or-later
# ***************************************************************************
# *                                                                         *
# *   Copyright (c) 2025 The FreeCAD project association AISBL              *
# *   Copyright (c) 2009 Yorik van Havre <yorik@uncreated.net>              *
# *                                                                         *
# *   This file is part of FreeCAD project.                                 *
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


'''
Usage:

    updatefromcrowdin.py [-d path | -z file] [LANGCODE] [LANGCODE LANGCODE...]

Example:

    ./updatefromcrowdin.py -z freecad.zip fr nl pt_BR

Options:

    -h or --help : prints this help text
    -d or --directory : specifies a directory containing unzipped translation folders
    -z or --zipfile : specifies a path to the freecad.zip file

This script will update the translation files of the FreeCAD homepage.

This command must be run from its current source tree location
so it can find the correct places to put the translation files.  If run with
no arguments, the latest translations from crowdin will be downloaded, unzipped
and put to the correct locations.

NOTE! The crowdin site only allows to download "builds" (zipped archives)
which must be built prior to downloading. This means a build might not
reflect the latest state of the translations. Better always make a build before
using this script!

You can specify a directory with the -d option if you already downloaded
and extracted the build, or you can specify a single module to update with -m.

You can also run the script without any language code, in which case a query
will be run against crowdin to get a list of all languages for which the
homepage is translated to 50% of more.

For that to work, you need a ~/.crowdin-freecad-token file in your
user's folder, that contains the API V2 access token that gives access to the
crowdin FreeCAD project. The API token can also be specified in the
CROWDIN_TOKEN environment variable.

To generate the .po file to be uploaded on CrowdIn use the xgettext tool on
any UNIX-like OS.

xgettext --from-code=UTF-8 -o lang/homepage.po *.php

'''

from PySide6 import QtCore
from functools import lru_cache
from io import StringIO
from typing import List, Dict
from urllib.request import Request
from urllib.request import urlopen

import getopt
import json
import os
import shutil
import sys
import tempfile
import zipfile

try:
    import Image
except ImportError:
    from PIL import Image


def doLanguage(lncode):
    " treats a single language"

    if lncode == "en":
        # never treat "english" translation... For now :)
        return
    basefilepath = tempfolder + os.sep + lncode + os.sep + "homepage.po"
    lncode = lncode.replace("-", "_")
    langpath = os.path.join(os.path.abspath("lang"), lncode)
    popath = os.path.join(langpath, "LC_MESSAGES")
    flagfile = os.path.join(langpath, "flag.jpg")
    print("language:", lncode)
    print("language file:", basefilepath)
    print("target path:", langpath)
    if not os.path.exists(langpath):
        print("creating folders")
        os.mkdir(langpath)
        os.mkdir(popath)
    print("copying translation file")
    shutil.copyfile(basefilepath, os.path.join(popath, "homepage.po"))
    print("compiling translation file")
    os.system("msgfmt -c -o " + os.path.join(popath, "homepage.mo") + " " + os.path.join(popath,
                                                                                         "homepage.po"))
    if not os.path.exists(flagfile):
        print("image not found:", flagfile)
        if "_" in lncode:
            lflag = lncode.split("_")[0]
        else:
            lflag = lncode
        flagurl = "http://www.unilang.org/images/langicons/" + lflag + ".png"
        print("downloading flag from ", flagurl)
        try:
            im = Image.open(StringIO(urlopen(flagurl).read()))
        except:
            print("Unable to download image above. Please do it manually")
            sys.exit()
        im = im.convert("RGB")
        print("saving flag to ", flagfile)
        im.save(flagfile)
    return lncode


def generate_locale_map_json(lang_codes:List[str], output_file:str= "localeMap.json") -> Dict[str, str]:
    """
    Generate a JSON file mapping language codes to full locale names.

    :param lang_codes: A list of locale codes (e.g., ["en", "de", "zh_CN"])
    :param output_file: The filename where the JSON data will be saved
    """
    locale_map = {}

    for language_code in lang_codes:
        if not language_code:
            continue

        ql = QtCore.QLocale(language_code)
        language_name = ql.name()
        short_code = language_code.split("_")[0]
        if short_code in locale_map:
            short_code = language_name

        locale_map[short_code] = language_name

    with open(output_file, "w", encoding="utf-8") as f:
        json.dump(locale_map, f, indent=2)

    return locale_map


class CrowdinUpdater:
    BASE_URL = "https://api.crowdin.com/api/v2"

    def __init__(self, token, project_identifier, multithread=True):
        self.token = token
        self.project_identifier = project_identifier
        self.multithread = multithread

    @lru_cache()
    def _get_project_id(self):
        url = f"{self.BASE_URL}/projects/"
        response = self._make_api_req(url)

        for project in [p["data"] for p in response]:
            if project["identifier"] == project_identifier:
                return project["id"]

        raise Exception("No project identifier found!")

    def _make_project_api_req(self, project_path, *args, **kwargs):
        url = f"{self.BASE_URL}/projects/{self._get_project_id()}{project_path}"
        return self._make_api_req(url=url, *args, **kwargs)

    @staticmethod
    def _make_api_req(url, extra_headers=None, method="GET", data=None):
        if extra_headers is None:
            extra_headers = {}
        headers = {"Authorization": "Bearer " + load_token(), **extra_headers}

        if type(data) is dict:
            headers["Content-Type"] = "application/json"
            data = json.dumps(data).encode("utf-8")

        request = Request(url, headers=headers, method=method, data=data)
        return json.loads(urlopen(request).read())["data"]

    def _get_files_info(self):
        files = self._make_project_api_req("/files?limit=250")
        return {f["data"]["path"].strip("/"): str(f["data"]["id"]) for f in files}

    def _add_storage(self, filename, fp):
        response = self._make_api_req(
            f"{self.BASE_URL}/storages",
            data=fp,
            method="POST",
            extra_headers={
                "Crowdin-API-FileName": filename,
                "Content-Type": "application/octet-stream",
            },
        )
        return response["id"]

    def status(self):

        # {protocol}://{host}/api/v2/projects/{projectId}/files/{fileId}/languages/progress
        # fileid = 27908
        response = self._make_project_api_req("/files/27908/languages/progress?limit=100")
        return [item["data"] for item in response]


def load_token():
    # load API token stored in ~/.crowdin-freecad-token
    config_file = os.path.expanduser("~") + os.sep + ".crowdin-freecad-token"
    if os.path.exists(config_file):
        with open(config_file) as file:
            return file.read().strip()
    return None


def get_default_languages(updater):
    """Retrieve language codes from crowdin for which
    homepage.po is translated to more than 50%"""

    print("retrieving list of languages...")
    status = updater.status()
    status = sorted(status, key=lambda item: item["translationProgress"], reverse=True)
    languages = [
        item["languageId"] for item in status if item["translationProgress"] > 50
    ]
    print("languages above 50%:", languages)
    return languages


if __name__ == "__main__":

    try:
        opts, args = getopt.getopt(sys.argv[1:], "hd:z:", ["help", "directory=", "zipfile="])
    except getopt.GetoptError:
        print(__doc__)
        sys.exit()



    token = os.environ.get("CROWDIN_TOKEN", load_token())
    if not token:
        print("Token not found")
        sys.exit()

    project_identifier = os.environ.get("CROWDIN_PROJECT_ID")
    if not project_identifier:
        project_identifier = "freecad"

    updater = CrowdinUpdater(token, project_identifier)

    # checking on the options
    inputdir = ""
    inputzip = ""
    for o, a in opts:
        if o in ("-h", "--help"):
            print(__doc__)
            sys.exit()
        if o in ("-d", "--directory"):
            inputdir = a
        if o in ("-z", "--zipfile"):
            inputzip = a

    if inputdir and inputzip:
        print("ERROR: only one of -d or -z can be specified")
        sys.exit()

    if not inputdir and not inputzip:
        print("ERROR: one of -d or -z must be specified")
        sys.exit()

    global tempfolder
    currentfolder = os.getcwd()
    if inputdir:
        tempfolder = os.path.realpath(inputdir)
        if not os.path.exists(tempfolder):
            print("ERROR: " + tempfolder + " not found")
            sys.exit()
    elif inputzip:
        tempfolder = tempfile.mkdtemp()
        print("creating temp folder " + tempfolder)
        os.chdir(tempfolder)
        inputzip = os.path.realpath(inputzip)
        if not os.path.exists(inputzip):
            print("ERROR: " + inputzip + " not found")
            sys.exit()
        zfile = zipfile.ZipFile(inputzip)
        print(f"Extracting {inputzip} to {tempfolder}")
        zfile.extractall()
    os.chdir(currentfolder)
    if not args:
        # args = [o for o in os.listdir(tempfolder) if o != "freecad.zip"]
        # do not treat all languages in the zip file. Some are not translated enough.
        args = get_default_languages(updater)
    lcodes = []
    for ln in args:
        if not os.path.exists(tempfolder + os.sep + ln):
            print("ERROR: language path for " + ln + " not found!")
        else:
            lcodes.append(doLanguage(ln))
    generate_locale_map_json(lcodes)
