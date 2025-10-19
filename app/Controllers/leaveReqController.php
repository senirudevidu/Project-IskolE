<?php

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../Models/leaveReqModel.php';

class LeaveReqController
{
    public function submitLeaveRequest($fromDate, $toDate, $reason)
    {
        $leaveModel = new LeaveReqModel();
        $userID = $_SESSION['userID'];
        $leaveModel->saveLeaveRequest($fromDate, $toDate, $reason, $userID);
    }
    public function deleteStudentRecord($userID)
    {
        $leaveModel = new LeaveReqModel();
        $leaveModel->deleteStudent($userID);
    }

    public function getAllLeaveRequests($studentID)
    {
        $leaveModel = new LeaveReqModel();
        return $leaveModel->getAllLeaveRequests($studentID);
    }
    public function getRecentLeaveRequests($studentID, $limit = 5)
    {
        $leaveModel = new LeaveReqModel();
        return $leaveModel->getRecentLeaveRequests($studentID, $limit);
    }

    // Helper to fetch recent requests for the currently logged-in parent
    public function getRecentLeaveRequestsForCurrentUser($limit = 5)
    {
        $leaveModel = new LeaveReqModel();
        $userID = $_SESSION['userID'] ?? null;
        if (!$userID) {
            return [];
        }
        $studentID = $leaveModel->getStudentID($userID);
        if (!$studentID) {
            return [];
        }
        return $leaveModel->getRecentLeaveRequests($studentID, $limit);
    }

    public function deleteLeaveRequestForCurrentUser($requestId)
    {
        $leaveModel = new LeaveReqModel();
        $userID = $_SESSION['userID'] ?? null;
        if (!$userID) {
            return false;
        }
        $studentID = $leaveModel->getStudentID($userID);
        if (!$studentID) {
            return false;
        }
        return $leaveModel->deleteLeaveRequestByIdForStudent((int) $requestId, (int) $studentID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leaveController = new LeaveReqController();
    if (isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['reason'])) {
        $leaveController->submitLeaveRequest($_POST['fromDate'], $_POST['toDate'], $_POST['reason']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (isset($_POST['delete_request_id'])) {
        $leaveController->deleteLeaveRequestForCurrentUser($_POST['delete_request_id']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
