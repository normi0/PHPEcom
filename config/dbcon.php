<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpcom";
//create data base connection
$con = mysqli_connect($host, $username, $password, $database);
//check database connection
if (!$con) {
    die("connection failed: " . mysqli_connect_error());
}

?>