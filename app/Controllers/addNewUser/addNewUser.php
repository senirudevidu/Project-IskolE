<?php
ob_start(); // Start output buffering
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../config/dbconfig.php';


$connfig = new Database();
$conn = $connfig->getConnection();

if (isset($_POST['submitUser'])) {

    switch ($_POST['role']) {
        case 'admin':

        case 'teacher':
            // echo 'Adding teacher' . "<br>";
            $teacherModel = new Teacher($conn);
            $teacherModel->addTeacher($_POST);
            break;
        case 'student':
            // echo 'Adding student' . "<br>";
            $studentModel = new Student($conn);
            $studentModel->addStudent($_POST);
            break;
        case 'parent':
            // echo 'Adding parent' . "<br>";
            $parentModel = new ParentRole($conn);
            $parentModel->addParent($_POST);
            break;
        case 'mp':
            // echo 'Adding MP' . "<br>";
            $mpModel = new Management($conn);
            $mpModel->addMP($_POST);
            break;
        default:
            exit;
            ob_end_flush(); // Flush the output buffer
            exit;
    }



    // header("Location: " . $_SERVER['HTTP_REFERER']);
    // exit;
}
