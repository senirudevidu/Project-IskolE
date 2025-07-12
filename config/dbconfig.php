<?php 
    // Database configuration file for ProjectIskole
    $host = "mysql-kalana.alwaysdata.net";
    $dbname = "kalana_skole";
    $username = "kalana_seniru";
    $password = "pass+123";

    // connection
    $conn = new mysqli($host, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully";
    }
?>