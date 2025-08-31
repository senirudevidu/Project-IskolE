<?php
class Database
{
    // Database configuration file for ProjectIskole
    private $host = "mysql-iskole.alwaysdata.net";
    private $dbname = "iskole_db";
    private $username = "iskole_admin";
    private $password = "iskole+123";

    public function getConnection()
    {
        $conn = null;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable exceptions
        try {
            $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            // Connection successful, no need to echo
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            // Optionally handle error
        }
        return $conn;
    }
}
