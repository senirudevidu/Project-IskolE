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
    }
    public function addUser($data)
    {
        $sql = "INSERT INTO {$this->table} (fName, lName, email, phone, dateOfBirth, gender, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("sssssssi", $data['fName'], $data['lName'], $data['email'], $data['phone'], $data['dateOfBirth'], $data['gender'], $data['password'], $data['role']);
        $result = $stmt->execute();
        if ($result === false) {
            echo "Execute failed: " . $stmt->error . "<br>";
        }

        return $result;
    }


}
