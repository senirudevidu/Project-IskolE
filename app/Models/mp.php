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


}