<?php
require_once __DIR__ . '/../Models/mp.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../../config/dbconfig.php';


$connfig = new Database();
$conn = $connfig->getConnection();

if (isset($_POST['submitUser'])) {
    echo 'Form submitted successfully' . "<br>";

    $userModel = new User($conn);
    $userModel->addUser($_POST);
}