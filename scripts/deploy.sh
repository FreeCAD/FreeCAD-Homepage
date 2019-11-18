#!/bin/bash
find . -type f -not -path './.git*' -not -path './scripts*' -not -path \
'./.travis.yml' -exec bash scripts/upload.sh {} \;
