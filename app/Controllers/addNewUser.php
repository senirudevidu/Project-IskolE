<?php
require_once __DIR__ . '/../Models/mp.php';
require_once __DIR__ . '/../../config/dbconfig.php';


$connfig = new Database();
$conn = $connfig->getConnection();

if (isset($_POST['submitUser'])) {
    echo 'Form submitted successfully' . "<br>";

    echo $conn ? 'Connection established' . "<br>" : 'Connection failed' . "<br>";

    $mpModel = new Management($conn);
    $mpModel->testConnection();

    $result = $mpModel->addMP($_POST);
    if ($result) {
        echo "New MP added successfully." . "<br>";
    } else {
        echo "Failed to add new MP." . "<br>";
    }

    echo "hello";
}