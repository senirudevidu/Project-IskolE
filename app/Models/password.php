<?php
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
    public static function hashPassword($fName, $userId)
    {
        $password = self::generateInitialPassword($fName, $userId);
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function setPassword($userID, $newPassword)
    {
        $query = "UPDATE user SET password = ?, pwdChanged = 1 WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $userID);
        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
