#!/bin/bash
find .. -not -path '../.git*' -not -path '../scripts*' -not -path \
    '../.travis.yml' -exec curl --ftp-ssl --ftp-create-dirs -T {} \
    "ftp://${FTP_USER}:${FTP_PASSWORD}@${FTP_HOST}/public_html/" \;
