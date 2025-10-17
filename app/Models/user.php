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
        try {
            $data['role'] = $this->roleList[$data['role']];
            // Insert into user table
            $sql = "INSERT INTO " . $this->userTable . " (fName, lName, email, phone, dateOfBirth, gender, role, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (User): " . $this->conn->error);
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

            if (!$stmt->execute()) {
                throw new Exception("Error adding user to user table: " . $stmt->error);
            }

            $userId = $this->conn->insert_id;
            $data['password'] = Password::hashPassword($data['fName'], $userId);

            // Update password in user table
            $sqlUpdate = "UPDATE " . $this->userTable . " SET password = ? WHERE userID = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            if (!$stmtUpdate) {
                throw new Exception("Prepare failed (User Password Update): " . $this->conn->error);
            }
            $stmtUpdate->bind_param("si", $data['password'], $userId);
            if (!$stmtUpdate->execute()) {
                throw new Exception("Error updating user password: " . $stmtUpdate->error);
            }

            // Insert into address table
            $sql = "INSERT INTO " . $this->addressTable . " (userID, address_line1, address_line2, address_line3) VALUES (?, ?, ?, ?)";
            $stmtAddress = $this->conn->prepare($sql);
            if (!$stmtAddress) {
                throw new Exception("Prepare failed (User Address): " . $this->conn->error);
            }
            $stmtAddress->bind_param("isss", $userId, $data['addressLine1'], $data['addressLine2'], $data['addressLine3']);
            if (!$stmtAddress->execute()) {
                throw new Exception("Execute failed (User Address): " . $stmtAddress->error);
            }

            return $userId;
        } catch (Exception $e) {
            // Let caller handle rollback to ensure atomic multi-table operations
            throw $e;
        }
    }
    public function deleteUser($userId)
    {
        $this->conn->begin_transaction();
        try {
            // Delete from address table
            $sqlAddress = "DELETE FROM " . $this->addressTable . " WHERE userID = ?";
            $stmtAddress = $this->conn->prepare($sqlAddress);
            if (!$stmtAddress) {
                throw new Exception("Prepare failed (Delete User Address): " . $this->conn->error);
            }
            $stmtAddress->bind_param("i", $userId);
            if (!$stmtAddress->execute()) {
                throw new Exception("Execute failed (Delete User Address): " . $stmtAddress->error);
            }

            // Delete from user table
            $sql = "DELETE FROM " . $this->userTable . " WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Delete User): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Delete User): " . $stmt->error);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

}