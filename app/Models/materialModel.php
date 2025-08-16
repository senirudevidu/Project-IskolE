<?php
echo 'materialModel connected successfully' ."<br>";
class Material
{
    public $conn;
    public $teacherID;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->teacherID = $_SESSION['teacherID'] ?? 0;
        echo "Material model initialized.";
    }

    public function addMaterial($grade, $class, $subject, $title, $description, $filePath)
    {
        echo 'Adding material...';
        $stmt = $this->conn->prepare("INSERT INTO material (grade, class, subject, title, description, file, teacherID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $grade, $class, $subject, $title, $description, $filePath, $this->teacherID);
        if ($stmt->execute()) {
            echo "Material added successfully.";
            return true;
        } else {
            echo "Error adding material: " . $stmt->error;
            return false;
        }
    }
}
?>