<?php
require_once __DIR__ . '/../Models/materialModel.php';
require_once __DIR__ . '/../../config/dbconfig.php';
echo 'materialController connected successfully' . "<br>";

if(isset($_POST['submit'])){
    echo 'Form submitted successfully' . "<br>";
    // Form variables
    $grade = $_POST['grade'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $title = $_POST['material-title'];
    $description = $_POST['material-description'];
    $file = $_FILES['file-upload'];


    // Empty value
    if(empty($grade) || empty($class) || empty($subject) || empty($title) || empty($description) || empty($file['name'])){
        echo "Please fill in all fields.";
        exit;
    }

    // Handle file upload
    $target_dir = "../../storage/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $material = new Material($conn);
        $material->addMaterial($grade, $class, $subject, $title, $description, $target_file);
    } else {
        echo "Error uploading file.";
    }
}
?>