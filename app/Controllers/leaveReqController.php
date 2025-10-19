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
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['reason'])) {
        $leaveController = new LeaveReqController();
        $leaveController->submitLeaveRequest($_POST['fromDate'], $_POST['toDate'], $_POST['reason']);


        // Redirect back to the requests page after submission
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
