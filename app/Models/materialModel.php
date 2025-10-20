<?php
require_once __DIR__ . '/../../config/dbconfig.php';
require_once __DIR__ . '/../Models/teacher.php';
class Material
{
    public $conn;
    public $teacherID;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $database = new Database();
        $this->conn = $database->getConnection();

        // Check if user is logged in
        if (!isset($_SESSION['userID'])) {
            throw new Exception("User is not logged in. Please log in to access materials.");
        }

        if ($_SESSION['role'] == 'Teacher') {
            // Get teacher record
            $teacher = new Teacher();
            $teacherData = $teacher->getTeacherById($_SESSION['userID']);

            if ($teacherData === NULL || empty($teacherData) || !isset($teacherData['teacherID'])) {
                throw new Exception("No teacher record found for userID: " . $_SESSION['userID'] . ". Please contact the administrator.");
            }
            $this->teacherID = $teacherData['teacherID'];
        }
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
        $stmt = $this->conn->prepare("SELECT * FROM material LEFT JOIN subject ON material.subjectID = subject.subjectID LEFT JOIN teacher ON material.teacherID = teacher.teacherID JOIN user ON teacher.userID = user.userID WHERE material.teacherID = ? AND material.deleted = 0 ORDER BY date DESC");
        $stmt->bind_param("i", $this->teacherID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hideVisibility($materialID)
    {
        $stmt = $this->conn->prepare("UPDATE material SET visibility = 0 WHERE materialID = ? AND teacherID = ?");
        $stmt->bind_param("ii", $materialID, $this->teacherID);
        return $stmt->execute();
    }

    public function deleteMaterial($materialID)
    {
        $stmt = $this->conn->prepare("UPDATE material SET deleted = 1 WHERE materialID = ? AND teacherID = ?");
        $stmt->bind_param("ii", $materialID, $this->teacherID);
        return $stmt->execute();
    }

    public function unhideMaterial($materialID)
    {
        $stmt = $this->conn->prepare("UPDATE material SET visibility = 1 WHERE materialID = ? AND teacherID = ?");
        $stmt->bind_param("ii", $materialID, $this->teacherID);
        return $stmt->execute();
    }

    public function getMaterial($grade, $class)
    {
        $stmt = $this->conn->prepare("SELECT * FROM material 
        JOIN subject ON material.subjectID = subject.subjectID
        JOIN teacher ON material.teacherID = teacher.teacherID
        JOIN user ON teacher.userID = user.userID
         WHERE material.grade = ? AND material.class = ? AND material.visibility = 1 AND material.deleted = 0
         ORDER BY date DESC");
        $stmt->bind_param("ss", $grade, $class);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchFileName($materialID)
    {
        $stmt = $this->conn->prepare("SELECT file FROM material WHERE materialID = ?");
        $stmt->bind_param("i", $materialID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function editMaterial($materialID, $grade, $class, $subjectID, $title, $description, $file, $teacherID)
    {
        $query = "UPDATE material SET grade = ?, class = ?, subjectID = ?, title = ?, description = ?, file = ? WHERE materialID = ? AND teacherID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisssii", $grade, $class, $subjectID, $title, $description, $file, $materialID, $teacherID);
        return $stmt->execute();
    }
}
