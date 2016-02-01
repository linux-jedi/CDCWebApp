#!/bin/bash

# clear the screen
clear

# copy and replace the file contents of the application source to the webserver directory
# don't replace config.php file
tmpdir=`mktemp -d`

# purge index.html in media directory
rm /var/www/media/index.html

# backup media directory and config.php file
cp -a -n /var/www/media/. $tmpdir/
cp -a -n /var/www/config.php $tmpdir/

# purge www 
rm -rf /var/www/*

# copy update application files to www
cp -a -n Application/. /var/www/

# restore config file
mv $tmpdir/config.php /var/www/config.php

# restore media directory contents
cp -a -n $tmpdir/. /var/www/media/

# reset check permissions
chmod -R 0755 /var/www/
chown -R www-data:www-data /var/www/

# all done
printf "\nFinished.\n"
