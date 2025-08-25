<?php
require_once("./user.php");
class Material extends User
{
    public $conn;
    public $teacherID;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->teacherID = $_SESSION['teacherID'] ?? 2;
    }

    public function addMaterial($grade, $class, $subject, $title, $description, $filePath)
    {
        $stmt = $this->conn->prepare("INSERT INTO material (grade, class, subject, title, description, file, teacherID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $grade, $class, $subject, $title, $description, $filePath, $this->teacherID);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error adding material: " . $stmt->error;
            return false;
        }
    }
}
?>