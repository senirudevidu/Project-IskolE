<?php

class User
{
    protected $conn;
    protected $table = 'user';
    protected $id = 'userID';

    protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role'];

    public function __construct($conn)
    {
        $this->conn = $conn;
        echo "User constructor called" . "<br>";
    }
    public function addUser($data)
    {
        echo "Inside addUser function" . "<br>";
        $sql = "INSERT INTO " . $this->table . " (fName, lName, email, phone, dateOfBirth, gender, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        echo $sql . "<br>";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssi", $data['fName'], $data['lName'], $data['email'], $data['phone'], $data['dateOfBirth'], $data['gender'], $data['password'], $data['role']);
        echo "after bind param<br>";
        $result = $stmt->execute();
        echo $result;
        if ($result === false) {
            echo "Error: " . $stmt->error . "<br>";
        }
        echo "after execute<br>";

        return $result;
    }


}
