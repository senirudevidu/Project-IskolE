<?php
require_once 'password.php';

class User
{
    protected $conn;
    protected $userTable = 'user';
    protected $addressTable = 'user_address';
    protected $roleList = ['admin' => 0, 'mp' => 1, 'teacher' => 2, 'student' => 3, 'parent' => 4];

    public function __construct()
    {

        $connfig = new Database();
        $this->conn = $connfig->getConnection();

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // echo "Database connected successfully" . "<br>";
        }
    }

    public function addUser($data)
    {
        try {
            $data['role'] = $this->roleList[$data['role']];
            $data['active'] = 1;

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
            $data['password'] = Password::hashPassword($data['phone']);

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

    public function activateUser($userId)
    {
        try {
            $sql = "UPDATE " . $this->userTable . " SET active = 1 WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Activate User): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Activate User): " . $stmt->error);
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

    public function deactivateUser($userId)
    {
        try {
            $sql = "UPDATE " . $this->userTable . " SET active = 0 WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Deactivate User): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Deactivate User): " . $stmt->error);
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

    public function editUser($userId, $data)
    {
        $this->conn->begin_transaction();
        try {

            // Fetch existing user data if $data is null or empty
            $sqlFetch = "SELECT fName, lName, email, phone, dateOfBirth, gender FROM " . $this->userTable . " WHERE userID = ?";
            $stmtFetch = $this->conn->prepare($sqlFetch);
            if (!$stmtFetch) {
                throw new Exception("Prepare failed (Fetch User Data): " . $this->conn->error);
            }
            $stmtFetch->bind_param("i", $userId);
            if (!$stmtFetch->execute()) {
                throw new Exception("Execute failed (Fetch User Data): " . $stmtFetch->error);
            }
            $result = $stmtFetch->get_result();
            if ($result->num_rows === 0) {
                throw new Exception("User not found with userID: " . $userId);
            }
            $existingData = $result->fetch_assoc();

            // Merge existing data with new data
            $data['fName'] = $data['fName'] ?? $existingData['fName'];
            $data['lName'] = $data['lName'] ?? $existingData['lName'];
            $data['email'] = $data['email'] ?? $existingData['email'];
            $data['phone'] = $data['phone'] ?? $existingData['phone'];
            $data['dateOfBirth'] = $data['dateOfBirth'] ?? $existingData['dateOfBirth'];
            $data['gender'] = $data['gender'] ?? $existingData['gender'];

            $sql = "UPDATE " . $this->userTable . " SET fName = ?, lName = ?, email = ?, phone = ?, dateOfBirth = ?, gender = ? WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Edit User): " . $this->conn->error);
            }
            $stmt->bind_param("ssssssi", $data['fName'], $data['lName'], $data['email'], $data['phone'], $data['dateOfBirth'], $data['gender'], $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Edit User): " . $stmt->error);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

    public function viewUser($userId)
    {
        try {
            $sql = "SELECT * FROM " . $this->userTable . " WHERE userID = ? AND active = 1";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (View User): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (View User): " . $stmt->error);
            }
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                throw new Exception("User not found with userID: " . $userId);
            }
            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return null;
        }
    }
    public function viewAllUsers()
    {
        try {
            $sql = "SELECT * FROM " . $this->userTable . " WHERE active = 1 AND LIMIT 5";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (View All Users): " . $this->conn->error);
            }
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (View All Users): " . $stmt->error);
            }
            $result = $stmt->get_result();
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return [];
        }
    }

    public function searchUsers($keyword)
    {
        try {
            $likeKeyword = "%" . $keyword . "%";
            $sql = "SELECT * FROM " . $this->userTable . " WHERE (fName LIKE ? OR lName LIKE ? OR email LIKE ?) AND active = 1 LIMIT 10";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Search Users): " . $this->conn->error);
            }
            $stmt->bind_param("sss", $likeKeyword, $likeKeyword, $likeKeyword);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Search Users): " . $stmt->error);
            }
            $result = $stmt->get_result();
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return [];
        }
    }

    public function viewRecentUsers(int $limit = 5): array
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            // Order by newest users; adjust column if needed
            $sql = "SELECT userID, fName, lName, email, role FROM user WHERE active = 1 ORDER BY userID DESC LIMIT ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception('Prepare failed (View Recent Users): ' . $conn->error);
            }
            $stmt->bind_param('i', $limit);
            if (!$stmt->execute()) {
                throw new Exception('Execute failed (View Recent Users): ' . $stmt->error);
            }
            $result = $stmt->get_result();
            $rows = [];
            $roleMap = [0 => 'admin', 1 => 'mp', 2 => 'teacher', 3 => 'student', 4 => 'parent'];
            while ($row = $result->fetch_assoc()) {
                // map numeric role to name for display
                $row['role'] = $roleMap[$row['role']] ?? (string) $row['role'];
                $rows[] = $row;
            }
            return $rows;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return [];
        }
    }
}