<?php
require_once 'user.php';

class Student extends User
{
    protected $studentTable = 'student';

    public function addStudent($data)
    {
        $this->conn->begin_transaction();
        try {
            $userId = $this->addUser($data);
            if (!$userId) {
                throw new Exception("Failed to add user");
            }

            $sql = "INSERT INTO " . $this->studentTable . " (userID, grade, classID) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed (Student): " . $this->conn->error);
            }

            $stmt->bind_param("iii", $userId, $data['grade'], $data['class']);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Student): " . $stmt->error);
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