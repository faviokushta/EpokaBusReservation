<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bus_reservation";

// Create database connection object
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>