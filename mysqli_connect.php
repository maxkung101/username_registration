<?php # mysqli_connect.php
// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER',     '     '); // Insert your database username between the empty ''.
DEFINE ('DB_PASSWORD', '     '); // Insert your database password between the empty ''.
DEFINE ('DB_HOST',     '     '); // Insert your database hostname between the empty ''.
DEFINE ('DB_NAME',     '     '); // Insert your database name between the empty ''.

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// If no connection could be made, trigger an error:
if (!$dbc) {
	trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error() );
} else { // Otherwise, set the encoding:
	mysqli_set_charset($dbc, 'utf8');
}
