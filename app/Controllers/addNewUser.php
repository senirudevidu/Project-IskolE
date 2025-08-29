<?php

require_once __DIR__ . '/../Models/mp.php';
require_once __DIR__ . '/../../config/dbconfig.php';
echo 'addnewUserFormController connected successfully' . "<br>";

echo isset($_POST['submitUser']);
if (isset($_POST['submit'])) {

    echo 'Form submitted successfully' . "<br>";
}
echo 'addnewUserFormController outside of the loop' . "<br>";