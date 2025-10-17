<?php
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../../config/dbconfig.php';

$connfig = new Database();
$conn = $connfig->getConnection();

// $studentModel = new Student();
// $studentModel->deleteStudent(30);
// echo "User deleted successfully";

// $teacherModel = new Teacher();
// $teacherModel->deleteTeacher(51);


// $parentModel = new ParentRole();
// $parentModel->deleteParent(113);


$mpModel = new Management();
$mpModel->deleteMP(80);
echo "User deleted successfully";