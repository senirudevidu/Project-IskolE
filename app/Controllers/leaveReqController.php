<?php

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../Models/leaveReqModel.php';

class LeaveReqController
{
    private $leaveModel;

    public function __construct()
    {
        $this->leaveModel = new LeaveReqModel();
    }

    public function submitLeaveRequest($fromDate, $toDate, $reason)
    {
        $userID = $_SESSION['userID'];
        $this->leaveModel->saveLeaveRequest($fromDate, $toDate, $reason, $userID);
    }

    public function getAllLeaveRequests($studentID)
    {
        return $this->leaveModel->getAllLeaveRequests($studentID);
    }
    public function getRecentLeaveRequests($studentID, $limit = 5)
    {
        return $this->leaveModel->getRecentLeaveRequests($studentID, $limit);
    }
    // Helper to fetch recent requests for the currently logged-in parent
    public function getRecentLeaveRequestsForCurrentUser($limit = 5)
    {
        $userID = $_SESSION['userID'] ?? null;
        if (!$userID) {
            return [];
        }
        $studentID = $this->leaveModel->getStudentID($userID);
        if (!$studentID) {
            return [];
        }
        return $this->leaveModel->getRecentLeaveRequests($studentID, $limit);
    }
    public function deleteLeaveRequestForCurrentUser($requestId)
    {
        $userID = $_SESSION['userID'] ?? null;
        if (!$userID) {
            return false;
        }
        $studentID = $this->leaveModel->getStudentID($userID);
        if (!$studentID) {
            return false;
        }
        return $this->leaveModel->deleteLeaveRequestByIdForStudent((int) $requestId, (int) $studentID);
    }
    public function editLeaveRequest($requestId, $fromDate, $toDate, $reason)
    {
        $userID = $_SESSION['userID'] ?? null;
        if (!$userID) {
            return false;
        }
        $studentID = $this->leaveModel->getStudentID($userID);
        if (!$studentID) {
            return false;
        }
        return $this->leaveModel->editLeaveRequestByIdForStudent((int) $requestId, (int) $studentID, $fromDate, $toDate, $reason);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leaveController = new LeaveReqController();

    // Edit existing leave request
    if (isset($_POST['edit_request_id']) && isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['reason'])) {
        $leaveController->editLeaveRequest($_POST['edit_request_id'], $_POST['fromDate'], $_POST['toDate'], $_POST['reason']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Delete a leave request
    if (isset($_POST['delete_request_id'])) {
        $leaveController->deleteLeaveRequestForCurrentUser($_POST['delete_request_id']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Create a new leave request
    if (isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['reason'])) {
        $leaveController->submitLeaveRequest($_POST['fromDate'], $_POST['toDate'], $_POST['reason']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
