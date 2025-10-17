<?php
require_once __DIR__ . '/../Models/mp.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/teacher.php';
require_once __DIR__ . '/../Models/parent.php';
require_once __DIR__ . '/../../config/dbconfig.php';


$connfig = new Database();
$conn = $connfig->getConnection();

if (isset($_POST['submitUser'])) {
    echo 'Form submitted successfully' . "<br>";

    switch ($_POST['role']) {
        case 'admin':
        case 'teacher':
            echo 'Adding teacher' . "<br>";
            $teacherModel = new Teacher($conn);
            $teacherModel->addTeacher($_POST);
            break;
        case 'student':
        case 'parent':
            echo 'Adding parent' . "<br>";
            $parentModel = new ParentRole($conn);
            $parentModel->addParent($_POST);
            break;
        case 'mp':
            echo 'Adding MP' . "<br>";
            $mpModel = new Management($conn);
            $mpModel->addMP($_POST);
            break;
        default:
            echo "Invalid role specified." . "<br>";
            exit;
    }
}