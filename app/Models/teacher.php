<?php

require_once 'user.php';

class Teacher extends User
{
    protected $teacherTable = 'teacher';

    public function addTeacher($data)
    {
        $userId = $this->addUser($data);
        if (!$userId) {
            return false;
        }

        $sql = "INSERT INTO " . $this->teacherTable . " (userID,  nic,  subjectID, classID) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed (Teacher): " . $this->conn->error . "<br>";
            return false;
        }

        $stmt->bind_param("iiii", $userId, $data['nic'], $data['subjectID'], $data['classID']);
        try {
            if (!$stmt->execute()) {
                throw new Exception("Execute failed (Teacher): " . $stmt->error);
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }
    }
}