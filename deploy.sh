#!/bin/bash
echo "Preparing Deploy"
export $(cat .env | xargs)

echo "Fetching and updating from $GIT_REMOTE/$GIT_HEAD"
git fetch $GIT_REMOTE
git checkout --force ${GIT_REMOTE}/${GIT_HEAD}
git reset --hard ${GIT_REMOTE}/${GIT_HEAD}

echo "Attempting to Update Langs File"
$(which php) util/update_langs.php
