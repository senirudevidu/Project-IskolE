<?php
// Database configuration file for ProjectIskole
$host = "mysql-iskole.alwaysdata.net";
$dbname = "iskole_db";
$username = "iskole_admin";
$password = "iskole+123";

// connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully" . "</br>";
}
?>