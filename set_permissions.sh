#!/bin/bash

#create directory and move config file to hide creds



#Set permissions for files and directories
#echo `find ./* -type f -exec chmod 604 {} + -o -type d -exec chmod 745 {} +`
echo `find /var/www/html -type d -exec chmod 755 {} \;`
echo `find /var/www/html -type f -exec chmod 644 {} \;`  
echo `chmod 775 set_permissions.sh`
echo Permissions have been successfully set for all files and directories.
