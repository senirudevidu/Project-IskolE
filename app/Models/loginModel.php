<?php

class LoginModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $query = "SELECT userID, fName, lName, role, password FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // TODO: Implement password verification (e.g., using password_hash)
            if ($user['password'] === $password) {
                unset($user['password']);
                return $user;
            }
        }
        return false;
    }





    public function getParentIDByUserID(int $userID): ?int {
        $sql = "SELECT parentID FROM parent WHERE userID = ? LIMIT 1";
        $st  = $this->conn->prepare($sql);
        $st->bind_param("i", $userID);
        $st->execute();
        $id = $st->get_result()->fetch_column();
        return $id ? (int)$id : null;
    }

    // (B) parentID → children list (studentID + full name)
    public function getChildrenOfParent(int $parentID): array {
        $sql = "SELECT s.studentID,
                       CONCAT(u.fName,' ',u.lName) AS full_name
                FROM parent p
                JOIN student s ON s.studentID = p.studentID
                JOIN user u    ON u.userID    = s.userID
                WHERE p.parentID = ?
                ORDER BY u.fName";
        $st = $this->conn->prepare($sql);
        $st->bind_param("i", $parentID);
        $st->execute();
        return $st->get_result()->fetch_all(MYSQLI_ASSOC);
    }
















    public function getTeacherID($userID)
    {
        $query = "SELECT teacherID FROM teacher WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();
            return $teacher['teacherID'];
        }
        return null;
    }

    public function getStudentGradeAndClass($userID)
    {
        $query = "SELECT c.grade , c.class FROM user as u 
        JOIN student as s ON u.userID = s.userID 
        JOIN class as c ON s.classID = c.classID
        WHERE u.userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return [];
    }

}