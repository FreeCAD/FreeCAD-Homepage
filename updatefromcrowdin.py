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

from collections import Counter
from functools import lru_cache
from typing import List
from urllib.request import Request
from urllib.request import urlopen
import urllib.error

import argparse
import dataclasses
import json
import os
import polib
import shutil
import sys
import tempfile
import zipfile

try:
    import Image # type: ignore
except ImportError:
    from PIL import Image

@dataclasses.dataclass
class Language: id:str; locale:str; progress:int

def poPath(lang:Language):
    return os.path.abspath(os.path.join("lang", lang.locale, "LC_MESSAGES", "homepage.po"))

def compilePo(popath:str):
    pofile = polib.pofile(popath)
    if type(pofile) is not polib.POFile:
        print("Unable to load po-file")
        sys.exit()
    pofile.save_as_mofile(os.path.join(os.path.splitext(popath)[0] + ".mo"))

def downloadFlag(lang:Language):
    flagfile = os.path.abspath(os.path.join("lang", lang.locale, "flag.jpg"))
    if not os.path.exists(flagfile):
        flagfileOld = os.path.abspath(os.path.join("lang", lang.id.replace("-", "_"), "flag.jpg"))
        if os.path.exists(flagfileOld):
            print("copying old image:", flagfileOld)
            shutil.copyfile(flagfileOld, flagfile)
            return
        print("image not found:", flagfile)
        flagurl = "https://flagcdn.com/w40/" + lang.locale.split("_")[-1].lower() + ".png"
        print("downloading flag from ", flagurl)
        try:
            with urlopen(flagurl) as f:
                im = Image.open(f)
        except Exception as ex:
            print(ex)
            print("Unable to download image above. Please do it manually")
            sys.exit()
        im = im.convert("RGB")
        w, h = im.size
        im = im.resize((25, int(h * (25 / w))), Image.Resampling.LANCZOS)
        print("saving flag to ", flagfile)
        im.save(flagfile)

def doLanguage(tempfolder:str, lang:Language):
    " treats a single language"

    basefilepath = os.path.join(tempfolder, lang.id, "homepage.po")
    popath = poPath(lang)
    print("language:", lang.id)
    print("language file:", basefilepath)
    print("target path:", popath)
    if not os.path.exists(os.path.dirname(popath)):
        print("creating folders")
        os.makedirs(os.path.dirname(popath), exist_ok=True)
    print("copying translation file")
    shutil.copyfile(basefilepath, popath)
    print("compiling translation file: " + popath)
    compilePo(popath)
    downloadFlag(lang)


def generate_locale_map_json(languages:List[Language], output_file:str= "localeMap.json"):
    """
    Generate a JSON file mapping language codes to full locale names.
    """
    langCodeCount = Counter(lang.locale.split('_')[0] for lang in languages)
    # Use empty string to indicate than none of the locales should be shorted to the lang code
    alias = {'es': 'es_ES', 'pt':'pt_PT', 'zh': ''}

    locale_map:dict[str, str] = {}
    for lang in languages:
        langCode = lang.locale.split("_")[0]
        if langCodeCount[langCode] > 1 and langCode not in alias:
            print(f'Multiple locales with language-code "{langCode}" exists.')
            print(f'Manually add alias in "generate_locale_map_json" to disambiguate.')
            exit()
        key = langCode if alias.get(langCode) == lang.locale or langCodeCount[langCode] == 1 and not alias.get(langCode) else lang.locale
        locale_map[key] = lang.locale

    with open(output_file, "w", encoding="utf-8") as f:
        json.dump(locale_map, f, indent=2)

class CrowdinUpdater:
    BASE_URL = "https://api.crowdin.com/api/v2"
    homepage_id = 27908

    def __init__(self, token:str, project_identifier:str):
        self.token = token
        self.project_identifier = project_identifier

    def _make_api_req(self, url, extra_headers=None, method="GET", data=None):
        headers = {"Authorization": "Bearer " + self.token, **(extra_headers or {})}

        if type(data) is dict:
            headers["Content-Type"] = "application/json"
            data = json.dumps(data).encode("utf-8")

        request = Request(url, headers=headers, method=method, data=data)
        return json.loads(urlopen(request).read())["data"]

    @lru_cache()
    def _get_project_id(self):
        response = self._make_api_req(f"{self.BASE_URL}/projects/")
        for project in [p["data"] for p in response]:
            if project["identifier"] == self.project_identifier:
                return project["id"]

        raise Exception("No project identifier found!")

    def _make_project_api_req(self, project_path, *args, **kwargs):
        url = f"{self.BASE_URL}/projects/{self._get_project_id()}{project_path}"
        return self._make_api_req(url=url, *args, **kwargs)

    def languages(self):
        languages = self._make_project_api_req(f"/files/{self.homepage_id}/languages/progress?limit=100")
        def fixLocale(s:str):
            return {'sr-CS': 'sr-RS'}.get(s, s).replace("-", "_")
        return [Language(lang["languageId"], fixLocale(lang["language"]["locale"]), lang["translationProgress"])
                for lang in [lang["data"] for lang in languages] if lang["language"]["locale"] != "sr-SP"]

    def fetch_translation(self, language_id:str, path:str):
        params = {"targetLanguageId": language_id, "fileIds": [self.homepage_id]}
        res = self._make_project_api_req("/translations/exports", method="POST", data=params)
        os.makedirs(os.path.dirname(path), exist_ok=True)
        with urlopen(res["url"], ) as f, open(path, 'wb') as fout:
            shutil.copyfileobj(f, fout)


def load_token():
    # load API token stored in ~/.crowdin-freecad-token
    config_file = os.path.join(os.path.expanduser("~"), ".crowdin-freecad-token")
    if os.path.exists(config_file):
        with open(config_file) as file:
            return file.read().strip()
    return None


def get_default_languages(updater:CrowdinUpdater):
    """Retrieve language codes from crowdin for which
    homepage.po is translated to more than 50%"""

    print("retrieving list of languages...")
    languages = updater.languages()
    languages = sorted(languages, key=lambda item: item.progress, reverse=True)
    languages = list(filter(lambda x: x.progress > 50,  languages))
    print("languages above 50%:", [lang.id for lang in languages])
    return languages


def doLanguages(tempfolder:str, languages:list[Language]):
    exists = {lang.id: lang for lang in languages if os.path.exists(os.path.join(tempfolder, lang.id))}
    for lang in languages:
        if lang.id not in exists:
            print("ERROR: language path for " + lang.id + " not found!")
    generate_locale_map_json(list(exists.values()))
    for lang in exists.values():
        doLanguage(tempfolder, lang)


def main():
    parser = argparse.ArgumentParser()
    group = parser.add_mutually_exclusive_group(required=True)
    group.add_argument("-a", "--api", action='store_true', help="Read translations from api")
    group.add_argument("-d", "--directory", help="Read translations files from this directory")
    group.add_argument("-z", "--zipfile", help="Read translations files from zip file")
    parser.add_argument("locale", nargs='*', help="Update only translations for these locales")
    args = parser.parse_args()

    token = os.environ.get("CROWDIN_TOKEN", load_token())
    if not token:
        print("Token not found")
        sys.exit()

    project_identifier = os.environ.get("CROWDIN_PROJECT_ID")
    if not project_identifier:
        project_identifier = "freecad"

    updater = CrowdinUpdater(token, project_identifier)

    languages = get_default_languages(updater)
    if args.locale:
        languages = list(filter(lambda x: x.id in args.locale or x.locale in args.locale, languages))
    languages = list(filter(lambda x: x.id != "en", languages))

    if args.api:
        dirs = [f.name for f in os.scandir(os.path.abspath("lang")) if f.is_dir() and f.name != "en"]
        languageLocales = set(lang.locale for lang in languages)
        remove = [name for name in dirs if name != "en" and not name in languageLocales] \
                 if len(args.locale) == 0 and len(languageLocales) != 0 else []
        if remove:
            print(f"Will remove {remove}")
        try:
            generate_locale_map_json(languages)
            for lang in languages:
                print(f'Processing "{lang.id}"...')
                path = poPath(lang)
                updater.fetch_translation(lang.id, path)
                compilePo(path)
                downloadFlag(lang)
            for name in remove:
                print(f"Removing {name}")
                shutil.rmtree(os.path.abspath(os.path.join("lang", name)))
        except urllib.error.HTTPError as ex:
            print(ex)
            print(ex.read())
    elif args.directory:
        tempfolder = os.path.realpath(args.directory)
        if not os.path.exists(tempfolder):
            print("ERROR: " + tempfolder + " not found")
            sys.exit()
        doLanguages(tempfolder, languages)
    elif args.zipfile:
        inputzip = os.path.realpath(args.zipfile)
        if not os.path.exists(inputzip):
            print("ERROR: " + inputzip + " not found")
            sys.exit()
        with tempfile.TemporaryDirectory() as tempfolder:
            print(f"Extracting {inputzip} to {tempfolder}")
            with zipfile.ZipFile(inputzip) as zfile:
                zfile.extractall(tempfolder)
            doLanguages(tempfolder, languages)

if __name__ == "__main__":
    main()
