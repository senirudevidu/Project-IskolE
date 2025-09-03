<?php

class User
{
    protected $conn;
    protected $table = 'user';
    protected $id = 'userID';

    private $nullCounter = 0;

    protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role'];
    protected $userID, $fName, $lName, $email, $phone, $dateOfBirth, $gender, $password, $role, $addressLine1, $addressLine2, $addressLine3;
    public function __construct($conn, $data)
    {
        $this->conn = $conn;

        $this->fName = $data['fName'] ?? null;
        $this->lName = $data['lName'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->dateOfBirth = $data['dateOfBirth'] ?? null;
        $this->addressLine1 = $data['addressLine1'] ?? null;
        $this->addressLine2 = $data['addressLine2'] ?? null;
        $this->addressLine3 = $data['addressLine3'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->role = $data['role'] ?? null;

    }
    public function addUser($data)
    {

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

        echo "User insertion executed successfully in user table" . "<br>";
        return $result;
    }


}
