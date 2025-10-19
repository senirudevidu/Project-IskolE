<?php

require_once 'user.php';

class Teacher extends User
{
    protected $teacherTable = 'teacher';

    public function addTeacher($data)
    {
        $this->conn->begin_transaction();
        try {
            $userId = $this->addUser($data);
            if (!$userId) {
                throw new Exception("Failed to add user");
            }

            $sql = "INSERT INTO " . $this->teacherTable . " (userID,  nic,  subjectID, classID) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Teacher): " . $this->conn->error);
            }

            $stmt->bind_param("iiii", $userId, $data['nic'], $data['subjectID'], $data['classID']);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Teacher): " . $stmt->error);
            }

            $this->conn->commit();
            return $userId;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo $e->getMessage() . "<br>";
            return false;
        }
    }
    public function deleteTeacher($userId)
    {
        $this->conn->begin_transaction();
        try {
            $sql = "DELETE FROM " . $this->teacherTable . " WHERE userID = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Delete Teacher): " . $this->conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Delete Teacher): " . $stmt->error);
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