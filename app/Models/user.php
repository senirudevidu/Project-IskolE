<?php

require_once 'password.php';

class User
{
    protected $conn;
    protected $table = 'user';

    private $nullCounter = 0;

    protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role', 'addressLine1', 'addressLine2', 'addressLine3'];
    // protected $userID, $fName, $lName, $email, $phone, $dateOfBirth, $gender, $password, $role, $addressLine1, $addressLine2, $addressLine3;

    protected $roleList = ['admin' => 0, 'mp' => 1, 'teacher' => 2, 'student' => 3, 'parent' => 4];
    public function __construct($conn)
    {
        $this->conn = $conn;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "Database connected successfully" . "<br>";
        }
    }

    public function testConnection()
    {
        echo 'Inside testConnection method<br>';
        $testSql = "SHOW TABLES LIKE 'user'";
        $result = $this->conn->query($testSql);

        if ($result) {
            echo "Test query executed successfully" . "<br>";
        } else {
            echo "Test query failed: " . $this->conn->error . "<br>";
        }
    }

    public function addUser($data)
    {



        $data['role'] = $this->roleList[$data['role']];
        $data['password'] = Password::hashPassword($data['password']);

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                echo "Warning: $key is null or empty<br>";
                $this->nullCounter++;
            }
        }
        if ($this->nullCounter > 0) {
            echo "Error: Cannot proceed with null or empty values in user data.<br>";
            return false;
        }


        echo 'test case<br> start';
        $sql = "INSERT INTO `user` (fName, lName, email, active) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            echo "Simple prepare also failed: " . $this->conn->error . "<br>";
            return false;
        }

        echo 'test case<br> end';

        $sql = "INSERT INTO `user`(fName, lName, email, phone, dateOfBirth, gender, password, role, addressLine1, addressLine2, addressLine3, active)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        echo 'hello before prepare<br>';

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            $error = $this->conn->error;
            echo "Prepare failed: " . $error . "<br>";
            echo "SQL: " . $sql . "<br>";
            return false;
        }

        echo 'hello after prepare<br>';
        flush();


        $stmt->bind_param(
            "sssssssisssi",
            $data['fName'],
            $data['lName'],
            $data['email'],
            $data['phone'],
            $data['dateOfBirth'],
            $data['gender'],
            $data['password'],
            $data['role'],
            $data['addressLine1'],
            $data['addressLine2'],
            $data['addressLine3'],
            1
        );

        if (!$stmt->execute()) {
            echo "Execute failed: " . $stmt->error . "<br>";
            return false;
        } else {
            echo "User insertion executed successfully in user table.<br>";
            return true;
        }


        // return $result;
    }


}
