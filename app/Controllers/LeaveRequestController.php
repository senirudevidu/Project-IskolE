<?php
require_once __DIR__ . '/../Models/LeaveModel.php';
echo "LeaveRequestController.php works!";

class LeaveRequestController
{
  protected LeaveModel $model;
  public function __construct()
  {
    $this->model = new LeaveModel();
  }
  public function checkConnection()
  {
    return $this->model->checkConnection();
  }

  public function createLeaveRequest(array $data): bool
  {
    return $this->model->createLeaveRequest($data);
  }
  public function updateLeaveRequestStatus(int $requestId, string $status): bool
  {
    return $this->model->updateLeaveRequestStatus($requestId, $status);
  }
  public function getLeaveRequestById(int $requestId): ?array
  {
    return $this->model->getLeaveRequestById($requestId);
  }
}
$leaveRequestController = new LeaveRequestController();
if ($leaveRequestController->checkConnection()) {
  echo "Database connection is active in LeaveRequestController.";
} else {
  echo "Database connection failed in LeaveRequestController.";
}