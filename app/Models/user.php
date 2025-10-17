<?php
require_once 'password.php';

class User
{
    protected $conn;
    protected $userTable = 'user';
    protected $addressTable = 'user_address';
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

    public function addUser($data)
    {
        $data['role'] = $this->roleList[$data['role']];
        // user add for user table
        $sql = "INSERT INTO " . $this->userTable . " (fName, lName, email, phone, dateOfBirth, gender, role, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed (User): " . $this->conn->error . "<br>";
            return false;
        }

        $stmt->bind_param(
            "ssssssii",
            $data['fName'],
            $data['lName'],
            $data['email'],
            $data['phone'],
            $data['dateOfBirth'],
            $data['gender'],
            $data['role'],
            $data['active']
        );


        try {
            $result = $stmt->execute();
            if ($result === false) {
                throw new Exception("Error adding user to user table: " . $stmt->error);
            }
            // echo "User insertion executed successfully in user table" . "<br>";
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }

        $userId = $this->conn->insert_id;
        $data['password'] = Password::hashPassword($data['fName'], $userId);

        $sqlUpdate = "UPDATE " . $this->userTable . " SET password = ? WHERE userID = ?";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        if (!$stmtUpdate) {
            echo "Prepare failed (User Password Update): " . $this->conn->error . "<br>";
            return false;
        }
        $stmtUpdate->bind_param("si", $data['password'], $userId);
        try {
            $resultUpdate = $stmtUpdate->execute();
            if ($resultUpdate === false) {
                throw new Exception("Error updating user password: " . $stmtUpdate->error);
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }

        // add data to address table
        $sql = "INSERT INTO " . $this->addressTable . " (userID, address_line1, address_line2, address_line3) VALUES (?, ?, ?, ?)";
        $stmtAddress = $this->conn->prepare($sql);
        if (!$stmtAddress) {
            echo "Prepare failed (User Address): " . $this->conn->error . "<br>";
            return false;
        }
        $stmtAddress->bind_param("isss", $userId, $data['addressLine1'], $data['addressLine2'], $data['addressLine3']);
        try {
            $resultAddress = $stmtAddress->execute();
            if ($resultAddress === false) {
                throw new Exception("Execute failed (User Address): " . $stmtAddress->error);
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }
        return $userId;
    }
    public function deleteUser($userId)
    {
        $sqlAddress = "DELETE FROM " . $this->addressTable . " WHERE userID = ?";
        $stmtAddress = $this->conn->prepare($sqlAddress);
        if (!$stmtAddress) {
            echo "Prepare failed (Delete User Address): " . $this->conn->error . "<br>";
            return false;
        }

        $stmtAddress->bind_param("i", $userId);
        try {
            if (!$stmtAddress->execute()) {
                throw new Exception("Execute failed (Delete User Address): " . $stmtAddress->error);
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }

        $sql = "DELETE FROM " . $this->userTable . " WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed (Delete User): " . $this->conn->error . "<br>";
            return false;
        }

        $stmt->bind_param("i", $userId);
        try {
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Delete User): " . $stmt->error);
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }

        return true;
    }

}