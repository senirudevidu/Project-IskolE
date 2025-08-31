<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class Material
{
    public $conn;
    public $teacherID;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->teacherID = $_SESSION['teacherID'] ?? 2;
    }

    public function addMaterial($grade, $class, $subject, $title, $description, $filePath)
    {
        $stmt = $this->conn->prepare("INSERT INTO material (grade, class, subjectID, title, description, file, teacherID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $grade, $class, $subject, $title, $description, $filePath, $this->teacherID);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error adding material: " . $stmt->error;
            return false;
        }
    }

    public function showMaterials()
    {
        $stmt = $this->conn->prepare("SELECT * FROM material JOIN subject ON material.subjectID = subject.subjectID WHERE teacherID = ? AND visibility = 1 ORDER BY date DESC");
        $stmt->bind_param("i", $this->teacherID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
