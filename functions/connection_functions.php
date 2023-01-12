<?php
//connect to old database
function connect_to_maindb()
{
  	$hostname_mycon = "127.0.0.1";
  	$database_mycon = "xeralite_db";
  	$username_mycon = "root";
  	$password_mycon = "";
  	$mycon = mysqli_connect($hostname_mycon, $username_mycon, $password_mycon, $database_mycon) or die ("could not connect to mysql");
  	$db_connect = mysqli_select_db($mycon, $database_mycon) or die ("no database");
  	return $mycon;
}
