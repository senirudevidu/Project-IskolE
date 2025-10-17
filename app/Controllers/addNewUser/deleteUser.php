<?php
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../../config/dbconfig.php';

$connfig = new Database();
$conn = $connfig->getConnection();

$studentModel = new Student($conn);
$studentModel->deleteStudent(30);
echo "User deleted successfully";