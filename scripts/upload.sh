#!/bin/bash
filename=$(echo "$1" | sed 's/^\.\///')
url="ftp://${FTP_HOST}/public_html/$filename"
curl --user "${FTP_USER}:${FTP_PASSWORD}" --ftp-ssl --ftp-create-dirs \
    -T "$filename" "$url"
