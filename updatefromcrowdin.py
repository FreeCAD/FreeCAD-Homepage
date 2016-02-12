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

You can also run the script without any language code, in which case all the
languages contained in the archive or directory will be added.
'''

import sys, os, shutil, tempfile, zipfile, getopt, StringIO, re, urllib2, Image

crowdinpath = "http://crowdin.net/download/project/freecad.zip"


default_languages = "af zh-CN zh-TW hr cs nl fi fr de hu ja no pl pt-PT ro ru sr es-ES sv-SE uk it pt-BR el sk tr sl"

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
    print "language:",lncode
    print "language file:",basefilepath
    print "target path:",langpath
    if not os.path.exists(langpath):
        print "creating folders"
        os.mkdir(langpath)
        os.mkdir(popath)
    print "copying translation file"
    shutil.copyfile(basefilepath,os.path.join(popath,"homepage.po"))
    print "compiling translation file"
    os.system("msgfmt -c -o "+os.path.join(popath,"homepage.mo")+" "+os.path.join(popath,"homepage.po"))
    if not os.path.exists(flagfile):
        if "_" in lncode:
            lflag = lncode.split("_")[0]
        else:
            lflag = lncode
        flagurl = "http://www.unilang.org/images/langicons/"+lflag+ ".png"
        print "downloading flag from ",flagurl
        im = Image.open(StringIO.StringIO(urllib2.urlopen(flagurl).read()))
        im = im.convert("RGB")
        print "saving flag to ",flagfile
        im.save(flagfile)
    lname = re.findall("<img.*?"+lncode.replace("_","-")+".png.*?Translate FreeCAD to (.*?) language",crowdinpage)[0]
    return "<li><a href=\"/?lang="+lncode+"\"><img src=\"lang/"+lncode+"/flag.jpg\"/> <?php echo '"+lname+"'; ?></a></li>\n"


if __name__ == "__main__":
    args = sys.argv[1:]
    if len(args) < 1:
        print __doc__
        sys.exit()
    try:
        opts, args = getopt.getopt(sys.argv[1:], "hd:z:", ["help", "directory=","zipfile="])
    except getopt.GetoptError:
        print __doc__
        sys.exit()
        
    # checking on the options
    inputdir = ""
    inputzip = ""
    for o, a in opts:
        if o in ("-h", "--help"):
            print __doc__
            sys.exit()
        if o in ("-d", "--directory"):
            inputdir = a
        if o in ("-z", "--zipfile"):
            inputzip = a

    global tempfolder
    global crowdinpage
    crowdinpage = urllib2.urlopen("https://crowdin.com/project/freecad").read()
    currentfolder = os.getcwd()
    if inputdir:
        tempfolder = os.path.realpath(inputdir)
        if not os.path.exists(tempfolder):
            print "ERROR: " + tempfolder + " not found"
            sys.exit()
    elif inputzip:
        tempfolder = tempfile.mkdtemp()
        print "creating temp folder " + tempfolder
        os.chdir(tempfolder)
        inputzip=os.path.realpath(inputzip)
        if not os.path.exists(inputzip):
            print "ERROR: " + inputzip + " not found"
            sys.exit()
        shutil.copy(inputzip,tempfolder)
        zfile=zipfile.ZipFile("freecad.zip")
        print "extracting freecad.zip..."
        zfile.extractall()
    else:
        tempfolder = tempfile.mkdtemp()
        print "creating temp folder " + tempfolder
        os.chdir(tempfolder)
        os.system("wget "+crowdinpath)
        if not os.path.exists("freecad.zip"):
            print "download failed!"
            sys.exit()
        zfile=zipfile.ZipFile("freecad.zip")
        print "extracting freecad.zip..."
        zfile.extractall()
    os.chdir(currentfolder)
    if not args:
        #args = [o for o in os.listdir(tempfolder) if o != "freecad.zip"]
        # do not treat all languages in the zip file. Some are not translated enough.
        args = default_languages.split()
    phpcode = ""
    for ln in args:
        if not os.path.exists(tempfolder + os.sep + ln):
            print "ERROR: language path for " + ln + " not found!"
        else:
            phpcode += doLanguage(ln)
    print "\n\nPHP CODE:\n\n"
    print phpcode

