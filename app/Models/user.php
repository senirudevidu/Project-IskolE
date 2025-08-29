<?php

class User
{
    protected $conn;
    protected $table = 'user';
    protected $id = 'userID';

    protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role'];

    public function addUser($data)
    {
        $sql = "INSERT INTO " . $this->table . " (fName, lName, email, phone, dateOfBirth, gender, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $data['fName'], $data['lName'], $data['email'], $data['phone'], $data['dateOfBirth'], $data['gender'], $data['password'], $data['role']);
        return $stmt->execute();
    }

}
