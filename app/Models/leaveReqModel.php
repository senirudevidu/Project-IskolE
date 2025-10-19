<?php

class LeaveReqModel
{
    public $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function saveLeaveRequest($fromDate, $toDate, $reason, $userID)
    {
        $studentID = $this->getStudentID($userID);
        $query = "INSERT INTO leave_requests (from_date, to_date, reason, student_id) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $fromDate, $toDate, $reason, $studentID);
        $stmt->execute();
    }

    public function getStudentID($userID)
    {
        $query = "SELECT studentID FROM parent WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($studentID);
        $stmt->fetch();
        return $studentID;
    }
}
