<?php
require_once 'user.php';

class Management extends User
{
    protected $mpTable = 'MP';

    public function addMP($data)
    {
        $this->conn->begin_transaction();
        try {
            $userId = $this->addUser($data);
            if (!$userId) {
                throw new Exception("Failed to add user");
            }

            $sql = "INSERT INTO " . $this->mpTable . " (userID, nic) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (MP): " . $this->conn->error);
            }

            $stmt->bind_param("is", $userId, $data['nic']);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (MP): " . $stmt->error);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

    public function deleteMP($userId)
    {
        $this->conn->begin_transaction();
        try {
            $sql = "DELETE FROM " . $this->mpTable . " WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Delete MP): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Delete MP): " . $stmt->error);
            }

            if (!$this->deleteUser($userId)) {
                throw new Exception("Failed to delete user");
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