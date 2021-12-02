<?php
//connection of database

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

$dbconfigure = mysqli_select_db($con, $database);

// Check connection
if (!$con)
{
	die("Connection failed: " . mysqli_connect_error());
}

?>