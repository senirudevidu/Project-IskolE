<?php

require_once __DIR__ . '/../Models/mp.php';
require_once __DIR__ . '/../../config/dbconfig.php';
echo 'addnewUserFormController connected successfully' . "<br>";

if (isset($_POST['submit'])) {
    echo 'Form submitted successfully' . "<br>";
    // Form variables
    $mpId = $_POST['mpId'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
}