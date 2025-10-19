<?php
require_once 'user.php';

class ParentRole extends User
{
    protected $parentTable = 'parent';

    public function addParent($data)
    {
        $this->conn->begin_transaction();
        try {
            $userId = $this->addUser($data);
            if (!$userId) {
                throw new Exception("Failed to add user");
            }

            $sql = "INSERT INTO " . $this->parentTable . " (userID, nic, relationshipType, studentID) VALUES (?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Parent): " . $this->conn->error);
            }


            // need chck whether Student in the system
            $stmt->bind_param("iisi", $userId, $data['nic'], $data['relationship'], $data['studentIndex']);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Parent): " . $stmt->error);
            }

            $this->conn->commit();
            return $userId;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo $e->getMessage() . "<br>";
            return false;
        }
    }
    public function deleteParent($userId)
    {
        $this->conn->begin_transaction();
        try {
            $sql = "DELETE FROM " . $this->parentTable . " WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Delete Parent): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Delete Parent): " . $stmt->error);
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