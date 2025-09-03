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
}
