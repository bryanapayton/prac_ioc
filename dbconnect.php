<?php
/*
* This file used to maintain centricity when moving to different database environments
* All changes made here should adjust all queries appropriately to fit the DB environment.
* The config.ini file needs to be configured appropriately with the following
--servername
--username
--password
--dbname
* config.ini will be hidden from the root level to deter peering eyes
*/

function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once 
    static $connection;

        // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
       
             // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('private/config.ini.php'); 
              $connection = pg_connect("host=$config[servername] user=$config[username] password=$config[password] dbname=$config[dbname]");

    }

        // If connection was not successful, handle the error
    if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
        return pg_last_error(); 
    }
    return $connection;
}

// Connect to the database
$connection = db_connect();

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function db_query($query){
	$result=pg_query($query);
	return $result;
	}

function db_num_rows($query){
	$result=pg_num_rows($query);
	return $result;
	}

function db_fetch_assoc($query){
	$result=pg_fetch_assoc($query);
	return $result;
	}

function db_fetch_row($query){
	$result=pg_fetch_row($query);
	return $result;
	}
function db_fetch_array($query){
	$result=pg_fetch_array($query);
	return $result;
	}	
function db_error(){
	return pg_last_error();
	}
function db_close($conn){
	pg_close($conn);
	}
	
	

