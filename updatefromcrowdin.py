#!/usr/bin/python

#***************************************************************************
#*                                                                         *
#*   Copyright (c) 2009 Yorik van Havre <yorik@uncreated.net>              *
#*                                                                         *
#*   This program is free software; you can redistribute it and/or modify  *
#*   it under the terms of the GNU Library General Public License (LGPL)   *
#*   as published by the Free Software Foundation; either version 2 of     *
#*   the License, or (at your option) any later version.                   *
#*   for detail see the LICENCE text file.                                 *
#*                                                                         *
#*   This program is distributed in the hope that it will be useful,       *
#*   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
#*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
#*   GNU Library General Public License for more details.                  *
#*                                                                         *
#*   You should have received a copy of the GNU Library General Public     *
#*   License along with this program; if not, write to the Free Software   *
#*   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  *
#*   USA                                                                   *
#*                                                                         *
#***************************************************************************


'''
Usage:

    updatefromcrowdin.py [options] [LANGCODE] [LANGCODE LANGCODE...]

Example:

    ./updatefromcrowdin.py [-d <directory>] fr nl pt_BR

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

To generate the .pot file to be uploaded on crowdin:

xgettext --from-code=UTF-8 -o lang/homepage.pot *.php

'''
from __future__ import print_function

import sys, os, shutil, tempfile, zipfile, getopt, re
from urllib.request import urlopen
from io import StringIO
try:
    import Image
except:
    from PIL import Image
from PySide2 import QtCore,QtGui
from functools import lru_cache
from urllib.request import Request
import json


crowdinpath = "http://crowdin.net/download/project/freecad.zip"

def doLanguage(lncode):


    " treats a single language"


    if lncode == "en":
        # never treat "english" translation... For now :)
        return
    basefilepath = tempfolder + os.sep + lncode + os.sep + "homepage.po"
    lncode = lncode.replace("-","_")
    langpath = os.path.join(os.path.abspath("lang"),lncode)
    popath = os.path.join(langpath,"LC_MESSAGES")
    flagfile = os.path.join(langpath,"flag.jpg")
    print("language:",lncode)
    print("language file:",basefilepath)
    print("target path:",langpath)
    if not os.path.exists(langpath):
        print("creating folders")
        os.mkdir(langpath)
        os.mkdir(popath)
    print("copying translation file")
    shutil.copyfile(basefilepath,os.path.join(popath,"homepage.po"))
    print("compiling translation file")
    os.system("msgfmt -c -o "+os.path.join(popath,"homepage.mo")+" "+os.path.join(popath,"homepage.po"))
    if not os.path.exists(flagfile):
        print("image not found:",flagfile)
        if "_" in lncode:
            lflag = lncode.split("_")[0]
        else:
            lflag = lncode
        flagurl = "http://www.unilang.org/images/langicons/"+lflag+ ".png"
        print("downloading flag from ",flagurl)
        try:
            im = Image.open(StringIO(urlopen(flagurl).read()))
        except:
            print("Unable to download image above. Please do it manually")
            sys.exit()
        im = im.convert("RGB")
        print("saving flag to ",flagfile)
        im.save(flagfile)
    return lncode



def generatePHP(lcodes):


    "generates translation.php file"

    lcodes = lcodes.sorted()
    phpfile = open("translation.php","w")
    phpfile.write("<?php\n\n$localeMap = array(\n")
    phpfile.write("    'en' => 'en_US',\n")
    for lncode in lcodes:
        if lncode:
            ql = QtCore.QLocale(lncode)
            lname = ql.name()
            if lncode == "val_ES":
                lname = "val_ES" # fix qt bug
            phpfile.write("    '"+lncode.split("_")[0]+"' => '"+lname+"',\n")

    phpfile.write(");\n\n$lang = \"en\";\nif (isSet($_GET[\"lang\"])) $lang = $_GET[\"lang\"];\n")
    phpfile.write("$locale = isset($localeMap[$lang]) ? $localeMap[$lang] : $lang;\nputenv(\"LC_ALL=$locale\");\n")
    phpfile.write("setlocale(LC_ALL, $locale);\nbindtextdomain(\"homepage\", \"lang\");\n")
    phpfile.write("textdomain(\"homepage\");\nbind_textdomain_codeset(\"homepage\", 'UTF-8');\n\n")
    phpfile.write("$flagcode = $lang;\n\nif (!file_exists('lang/'.$flagcode.\"/flag.jpg\")) {\n")
    phpfile.write("if (strpos($flagcode, '_') !== false) {\n$flagcode = explode(\"_\", $flagcode)[0];\n}\n}\n")
    phpfile.write("$langattrib = \"\";\n$langStr = \"\";\nif ($_GET[\"lang\"] != \"\") {")
    phpfile.write("$langStr = \"?lang=\".$_GET[\"lang\"];\n    $langattrib = \"&lang=\".$_GET[\"lang\"];\n}")
    phpfile.write("function getFlags($href='/') {\n")

    phpfile.write("    echo('						<a class=\"dropdown-item\" href=\"'.$href.'\"><img src=\"lang/en/flag.jpg\" alt=\"\" />'._('English').'</a>');\n")
    for lncode in lcodes:
        if lncode:
            ql = QtCore.QLocale(lncode)
            lname = ql.languageToString(ql.language())
            if lncode == "val_ES": lname = "Valencian" # fix qt bug
            phpfile.write("    echo('						<a class=\"dropdown-item\" href=\"'.$href.'?lang="+lncode+"\"><img src=\"lang/"+lncode+"/flag.jpg\" alt=\"\" />'._('"+lname+"').'</a>');\n")

    phpfile.write("}\n\nfunction getTranslatedDownloadLink() {\n")
    phpfile.write("    $tr = \"\";\n")
    phpfile.write("    if (isSet($_GET[\"lang\"])) {\n")
    phpfile.write("        $tr = \"?lang=\".$_GET[\"lang\"];\n    }\n")
    phpfile.write("    echo(\"downloads.php\".$tr);\n")
    phpfile.write("}\n?>")



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

    def _make_api_req(self, url, extra_headers={}, method="GET", data=None):
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
    print("languages above 50%:",languages)
    return languages


if __name__ == "__main__":

    args = sys.argv[1:]
    if len(args) < 1:
        print(__doc__)
        sys.exit()
    try:
        opts, args = getopt.getopt(sys.argv[1:], "hd:z:", ["help", "directory=","zipfile="])
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

    global tempfolder
    global crowdinpage
    crowdinpage = urlopen("https://crowdin.com/project/freecad").read()
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
        inputzip=os.path.realpath(inputzip)
        if not os.path.exists(inputzip):
            print("ERROR: " + inputzip + " not found")
            sys.exit()
        shutil.copy(inputzip,tempfolder)
        zfile=zipfile.ZipFile("freecad.zip")
        print("extracting freecad.zip...")
        zfile.extractall()
    else:
        tempfolder = tempfile.mkdtemp()
        print("creating temp folder " + tempfolder)
        os.chdir(tempfolder)
        os.system("wget "+crowdinpath)
        if not os.path.exists("freecad.zip"):
            print("download failed!")
            sys.exit()
        zfile=zipfile.ZipFile("freecad.zip")
        print("extracting freecad.zip...")
        zfile.extractall()
    os.chdir(currentfolder)
    if not args:
        #args = [o for o in os.listdir(tempfolder) if o != "freecad.zip"]
        # do not treat all languages in the zip file. Some are not translated enough.
        args = get_default_languages(updater)
    lcodes = []
    for ln in args:
        if not os.path.exists(tempfolder + os.sep + ln):
            print("ERROR: language path for " + ln + " not found!")
        else:
            lcodes.append(doLanguage(ln))
    generatePHP(lcodes)
