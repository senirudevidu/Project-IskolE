<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class Password
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public static function generateInitialPassword($fName, $userId)
    {
        return $fName . $userId;
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function generateAndHashInitialPassword($fName, $userId)
    {
        $password = self::generateInitialPassword($fName, $userId);
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function setPassword($userID, $hashedPassword)
    {
        $query = "UPDATE user SET password = ?, pwdChanged = 1 WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $userID);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
