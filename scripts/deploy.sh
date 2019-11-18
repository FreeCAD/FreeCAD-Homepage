#!/bin/bash
find . -not -path './.git*' -not -path './scripts*' -not -path \
'./.travis.yml' -exec bash scripts/upload.sh {} \;
