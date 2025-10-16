<?php
class Database
{
    // Database configuration file for ProjectIskole
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct()
    {
        // Use environment variables if available, otherwise fallback to defaults
        $this->host = $_ENV['CLOUD_DB_HOST'] ?? 'mysql-iskole.alwaysdata.net';
        $this->dbname = $_ENV['CLOUD_DB_NAME'] ?? 'iskole_db';
        $this->username = $_ENV['CLOUD_DB_USER'] ?? 'iskole_admin';
        $this->password = $_ENV['CLOUD_DB_PASS'] ?? 'iskole+123';

    }


    public function getConnection()
    {

        $conn = null;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable exceptions

        try {
            // Set connection timeout
            ini_set('default_socket_timeout', 30);

            // Test if host is reachable
            $hostCheck = gethostbyname($this->host);
            if ($hostCheck === $this->host && !filter_var($this->host, FILTER_VALIDATE_IP)) {
                throw new Exception("Cannot resolve hostname: {$this->host}");
            }

            $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            $conn->set_charset("utf8");
            // echo "Database connection successful!";

        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            //echo "Database connection failed: " . $e->getMessage();
            return null;
        }

        return $conn;
    }
}
