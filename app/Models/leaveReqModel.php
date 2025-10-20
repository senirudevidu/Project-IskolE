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
    public function deleteLeaveRequestByIdForStudent($requestId, $studentID)
    {
        $query = "DELETE FROM Leave_Request WHERE (request_id = ?) AND student_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $requestId, $studentID);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function editLeaveRequestByIdForStudent($requestId, $studentID, $fromDate, $toDate, $reason)
    {
        $query = "UPDATE Leave_Request SET from_date = ?, to_date = ?, reason = ? WHERE request_id = ? AND student_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $fromDate, $toDate, $reason, $requestId, $studentID);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function getAbsenceRequestsForTeacher($teacherUserID, $status = null, $limit = 20)
    {
        $sql = "SELECT lr.request_id, lr.from_date, lr.to_date, lr.reason,
                       std.studentID, std.userID AS student_user_id,
                       u.fName, u.lName,
                       c.grade, c.class
                FROM Leave_Request lr
                JOIN student std ON std.studentID = lr.student_id
                JOIN user u ON u.userID = std.userID
                JOIN class c ON c.classID = std.classID
                JOIN teacher t ON t.classID = c.classID
                WHERE t.userID = ?
                ORDER BY lr.request_id DESC
                LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $teacherUserID = (int) $teacherUserID;
        $limit = (int) $limit;
        $stmt->bind_param("ii", $teacherUserID, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }

    public function getAllAbsenceRequests($limit = 20)
    {
        $sql = "SELECT lr.request_id, lr.from_date, lr.to_date, lr.reason,
                       std.studentID, std.userID AS student_user_id,
                       u.fName, u.lName,
                       c.grade, c.class
                FROM Leave_Request lr
                JOIN student std ON std.studentID = lr.student_id
                JOIN user u ON u.userID = std.userID
                JOIN class c ON c.classID = std.classID
                ORDER BY lr.request_id DESC
                LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $limit = (int) $limit;
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
}

