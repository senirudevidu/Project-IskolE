<?php

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
    }
}
