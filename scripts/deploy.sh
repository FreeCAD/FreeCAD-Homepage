#!/bin/bash
wput .htaccess * "ftp://${FTP_USER}:${FTP_PASSWORD}@${FTP_HOST}/public_html/"
