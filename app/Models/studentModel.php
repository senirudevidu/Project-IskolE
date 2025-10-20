<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class Student
{
    public $conn;
    public $RoleIDOfStudent = 3;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllStudents()
    {
        $query = "SELECT * FROM user as u JOIN student as std ON u.userIDd = std.userID JOIN class as c ON std.classID = c.classID WHERE u.role = $this->RoleIDOfStudent";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function stdOnSpecificClass($grade, $class)
    {
        $query = "SELECT * FROM user as u JOIN student as std ON u.userID = std.userID JOIN class as c ON std.classID = c.classID WHERE u.role = $this->RoleIDOfStudent AND c.grade = ? AND c.class = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $grade, $class);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
