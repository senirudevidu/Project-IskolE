<?php

// require_once __DIR__ . '/../Models/MP/mp.php';
// require_once __DIR__ . '/../../config/dbconfig.php';

// echo isset($_POST['submitUser']);
// if (isset($_POST['submit'])) {

//     echo 'Form submitted successfully' . "<br>";
// }
// echo 'addnewUserFormController outside of the loop' . "<br>";

echo "addNewUser controller file" . "<br>";
echo "<br>";

require_once __DIR__ . './../../Models/MP/mp.php';
require_once __DIR__ . './../../../config/dbconfig.php';


if (isset($_POST['submitUser'])) {
    echo "Form submitted successfully" . "<br>";

    $data = [
        'fName' => $_POST['fName'],
        'lName' => $_POST['lName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'dateOfBirth' => $_POST['dateOfBirth'],
        'addressLine1' => $_POST['addressLine1'],
        'addressLine2' => $_POST['addressLine2'],
        'addressLine3' => $_POST['addressLine3'],
        'gender' => $_POST['gender'],
        'role' => $_POST['role'],
        'nic' => $_POST['nic'],
        'grade' => $_POST['grade'],
        'class' => $_POST['class'],
        'subject' => $_POST['subject'],
        'studentIndex' => $_POST['studentIndex'],
        'relationship' => $_POST['relationship']
    ];

    // foreach ($data as $key => $value) {
    //     echo $key . " : " . $value . "<br>";
    // }
    $mpModel = new ManagementPanel($conn, $data);
    $result = $mpModel->addMP();
    echo $result;
    if ($result) {
        echo "New MP added successfully." . "<br>";
    } else {
        echo "Error adding MP." . "<br>";
    }
}