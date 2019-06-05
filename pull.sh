#!/bin/bash
WEB_PATH='/var/web/lnmpa.top'
WEB_USER='lx'
WEB_USERGROUP='lx'

echo "Start deployment"
cd $WEB_PATH
echo "pulling source code..."
git clean -f
git checkout -f
git pull origin master
echo "Finished."
