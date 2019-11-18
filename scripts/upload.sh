#!/bin/bash
filename=$(echo "$1" | sed 's/^\.\///')
url="ftp://${FTP_USER}:${FTP_PASSWORD}@${FTP_HOST}/public_html/$filename"
curl --disable-eprt -P --ftp-ssl --ftp-create-dirs -T "$filename" "$url"
