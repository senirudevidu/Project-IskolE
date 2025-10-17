<?php
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../../config/dbconfig.php';

$user = new User();
$user->deactivateUser(1);
echo "User deactivated successfully";
