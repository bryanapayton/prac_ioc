Install Process

test

Ensure changes are committed and controlled through GIT

ssh into respective environment

if you are unable to to ssh check the following:
        Ensure your public IP is whitelisted on the server(Contact Ed Kane to have this done)
        Make sure your id_rsa.pub key has been added to authorized keys

    * Run command: ssh-keygen -t rsa -b 2048 -C to generate ssh key and send id_rsa.pub key to Ed to be added to authorized keys on the server
    * once added you should be able to ssh to the 4 instances as well as hit the servers from the browser


Prepare the environment
* For postgres — need to allow db connections on centOS
    * run: sudo setsebool -P httpd_can_network_connect_db on
* install mbstring
    * run php -m to see if mbstring is installed
    * if not installed run: yum install php-mbstring
    * sudo service httpd restart

Untar code base to /var/www/html

run the permissions script
        ./set_permissions.sh


Set up DB

POSTGRES
Create and populate postgres database

Create a database
Log into postgres
* psql -h dcinstance.cxeendpdk5dq.us-east-1.rds.amazonaws.com -d dcdb -U dcadmin

Create a new db
CREATE DATABASE (database_name);

run postgresql script to populate postgres db
psql -h dcinstance.cxeendpdk5dq.us-east-1.rds.amazonaws.com -d <dbname> -U dcadmin -d <database_name> -a -f <db-script>

Modify private/config.ini.php
set:
host
user
password
dbname



The config file located in private/ holds the database creds.  This is securely kept
by naming the file config.ini.php
At the beginning of the script a die(); is called immediately which automatically kills
any further processing of the script.  The ini portion still allows the file to be parsed with the
parse_ini functions.


