<?php

require_once __DIR__ . '/../../config/dbconfig.php';
class LeaveReqModel
{
    public $conn;
    protected $ParentTable = "Leave_Request";
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function saveLeaveRequest($fromDate, $toDate, $reason, $userID)
    {
        $studentID = $this->getStudentID($userID);
        $query = "INSERT INTO Leave_Request (from_date, to_date, reason, student_id) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $fromDate, $toDate, $reason, $studentID);
        $stmt->execute();
        $stmt->close();
    }

    public function getStudentID($userID)
    {
        $query = "SELECT studentID FROM parent WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($studentID);
        $stmt->fetch();
        $stmt->close();
        return $studentID;
    }
    public function deleteStudent($userID)
    {
        $query = "DELETE FROM " . $this->ParentTable . " WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
    }
    public function getAllLeaveRequests($studentID)
    {
        $query = "SELECT * FROM Leave_Request WHERE student_id = ? AND status = 'approved' LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $leaveRequests = [];
        while ($row = $result->fetch_assoc()) {
            $leaveRequests[] = $row;
        }
        return $leaveRequests;
    }
    public function getRecentLeaveRequests($studentID, $limit = 5)
    {
        $query = "SELECT * FROM Leave_Request WHERE student_id = ? ORDER BY request_id DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $studentID, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $leaveRequests = [];
        while ($row = $result->fetch_assoc()) {
            $leaveRequests[] = $row;
        }
        return $leaveRequests;
    }
}

