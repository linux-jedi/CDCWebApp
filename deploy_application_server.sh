#!/bin/bash

# clear the screen
clear

# set the application server host name in the configuration template file
printf "\nType the domain name of this website server (ex: team1.cdc.com) followed by [ENTER]:\n"

read WEBSITE_DOMAIN_NAME

sed -i "s/WEBSITE_DOMAIN_NAME/\$WEBSITE_DOMAIN_NAME = \"$WEBSITE_DOMAIN_NAME\";/g" config_template

# set the application server host name in the configuration template file
printf "\nType the host name of this application server (ex: video1, video2, etc.) followed by [ENTER]:\n"

read APPLICATION_HOSTNAME

sed -i "s/APPLICATION_HOSTNAME/\$APPLICATION_HOSTNAME = \"$APPLICATION_HOSTNAME\";/g" config_template

# set the database host name in the configuration template file
printf "\nType the IP address of the database server (ex: 127.0.0.1 or 192.168.1.105) followed by [ENTER]:\n"

read DATABASE_IP

sed -i "s/DATABASE_IP/\$DATABASE_IP = \"$DATABASE_IP\";/g" config_template

# set the database name in the configuration template file
printf "\nType the name of the application database to connect to on the server (ex: application) followed by [ENTER]:\n"

read DATABASE_NAME

sed -i "s/DATABASE_NAME/\$DATABASE_NAME = \"$DATABASE_NAME\";/g" config_template

# set the read database username in the configuration template file
printf "\nType the username of the database SQL account to connect the application server to (ex: root) followed by [ENTER]:\n"

read DATABASE_RUSERNAME

sed -i "s/DATABASE_RUSERNAME/\$DATABASE_RUSERNAME = \"$DATABASE_RUSERNAME\";/g" config_template

# set the read database password in the configuration template file
printf "\nType the password of the database account to connect the application server to (ex: cdc) followed by [ENTER]:\n"

read DATABASE_RPASSWORD

sed -i "s/DATABASE_RPASSWORD/\$DATABASE_RPASSWORD = \"$DATABASE_RPASSWORD\";/g" config_template

# set the write database username in the configuration template file
printf "\nType the username of the database SQL account to connect the application server to (ex: root) followed by [ENTER]:\n"

read DATABASE_WUSERNAME

sed -i "s/DATABASE_WUSERNAME/\$DATABASE_WUSERNAME = \"$DATABASE_WUSERNAME\";/g" config_template

# set the write database password in the configuration template file
printf "\nType the password of the database account to connect the application server to (ex: cdc) followed by [ENTER]:\n"

read DATABASE_WPASSWORD

sed -i "s/DATABASE_WPASSWORD/\$DATABASE_WPASSWORD = \"$DATABASE_WPASSWORD\";/g" config_template

# replace the config.php with the generated config.php file
rm Application/config.php
mv config_template Application/config.php

# copy and replace the file contents of the application source to the webserver directory
rm -rf /var/www/*
cp -a Application/. /var/www/

chmod -R 0755 /var/www/media
chown www-data:www-data /var/www/media

# all done
printf "\nFinished.\n"
