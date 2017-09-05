#!/bin/bash
echo "Preparing Deploy"
echo "Attempting to Update Langs File"

export $(cat .env | xargs)
$(which php) util/update_langs.php
