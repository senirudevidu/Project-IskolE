<?php
require_once 'user.php';

class Management extends User
{
    protected $mpTable = 'MP';

    public function addMP($data)
    {
        $userId = $this->addUser($data);
        if (!$userId) {
            return false;
        }

        $sql = "INSERT INTO " . $this->mpTable . " (userID,  nic) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed (MP): " . $this->conn->error . "<br>";
            return false;
        }

        $stmt->bind_param("is", $userId, $data['nic']);
        try {
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (MP): " . $stmt->error);
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }
    }


}