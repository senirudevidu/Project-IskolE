<?php
// app/Controllers/LeaveRequestController.php
require_once __DIR__ . '/../Models/LeaveModel.php';

class LeaveRequestController
{
    protected LeaveModel $model;

    public function __construct()
    {
        $this->model = new LeaveModel();
    }

    public function checkConnection(): bool
    {
        return $this->model->checkConnection();
    }

    /* CREATE */
    public function createLeaveRequest(array $data): bool
    {
        return $this->model->createLeaveRequest($data);
    }

    /* READ: one */
    public function getLeaveRequestById(int $requestId): ?array
    {
        return $this->model->getLeaveRequestById($requestId);
    }

    /* READ: list (optionally by student) */
    public function listLeaveRequests(?int $studentId = null): array
    {
        return $this->model->listLeaveRequests($studentId);
    }

    /* UPDATE (generic fields) */
    public function updateLeaveRequest(int $requestId, array $data): bool
    {
        return $this->model->updateLeaveRequest($requestId, $data);
    }

    /* DELETE */
    public function deleteLeaveRequest(int $requestId): bool
    {
        return $this->model->deleteLeaveRequest($requestId);
    }

    /* OPTIONAL: only if you actually have a `status` column */
    public function updateLeaveRequestStatus(int $requestId, string $status): bool
    {
        return $this->model->updateLeaveRequestStatus($requestId, $status);
    }
}

/* ------------------------------------------------------------------
   OPTIONAL quick HTTP handler (so you can call this file directly)
   Example calls:
     POST /app/Controllers/LeaveRequestController.php?action=create
       form-data: from_date,to_date,reason,student_id?,student_name?
     POST /app/Controllers/LeaveRequestController.php?action=update&id=5
       form-data: any fields to change (from_date,to_date,reason,student_id,student_name)
     POST /app/Controllers/LeaveRequestController.php?action=delete&id=5
     GET  /app/Controllers/LeaveRequestController.php?action=list
     GET  /app/Controllers/LeaveRequestController.php?action=list&student_id=101
     GET  /app/Controllers/LeaveRequestController.php?action=show&id=5
   ------------------------------------------------------------------ */
if (php_sapi_name() !== 'cli') {
    $ctl    = new LeaveRequestController();
    $action = $_GET['action'] ?? '';

    $respondJson = function($payload, int $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($payload);
        exit;
    };

    try {
        switch ($action) {
 case 'create':
    session_start();

    // 1) build clean data array
    $data = [
        'from_date' => $_POST['from_date'] ?? null,
        'to_date'   => $_POST['to_date']   ?? null,
        'reason'    => $_POST['reason'] ?? ($_POST['reason_details'] ?? null),
    ];

    // 2) always send logged-in user id (VERY IMPORTANT)
    if (!empty($_SESSION['userID'])) {
        $data['user_id'] = (int)$_SESSION['userID'];
    }

    // 3) if Parent, try to fill from session (optional – model will still auto-fill via user_id)
    if (!empty($_POST['student_id']))   $data['student_id']   = (int)$_POST['student_id'];
    if (!empty($_POST['student_name'])) $data['student_name'] = $_POST['student_name'];

    // 4) call model with $data (NOT $_POST)
    $ok = $ctl->createLeaveRequest($data);
    $respondJson(['ok' => $ok, 'message' => $ok ? 'Created' : 'Create failed']);
    break;

            case 'update':
                $id = (int)($_GET['id'] ?? 0);
                if ($id <= 0) $respondJson(['ok' => false, 'message' => 'Missing id'], 400);
                $ok = $ctl->updateLeaveRequest($id, $_POST);
                $respondJson(['ok' => $ok, 'message' => $ok ? 'Updated' : 'Update failed']);
                break;

            case 'delete':
                $id = (int)($_GET['id'] ?? 0);
                if ($id <= 0) $respondJson(['ok' => false, 'message' => 'Missing id'], 400);
                $ok = $ctl->deleteLeaveRequest($id);
                $respondJson(['ok' => $ok, 'message' => $ok ? 'Deleted' : 'Delete failed']);
                break;

            case 'show':
                $id = (int)($_GET['id'] ?? 0);
                if ($id <= 0) $respondJson(['ok' => false, 'message' => 'Missing id'], 400);
                $row = $ctl->getLeaveRequestById($id);
                $respondJson(['ok' => (bool)$row, 'data' => $row]);
                break;

            case 'list':
                $studentId = isset($_GET['student_id']) ? (int)$_GET['student_id'] : null;
                $rows = $ctl->listLeaveRequests($studentId);
                $respondJson(['ok' => true, 'data' => $rows]);
                break;

            default:
                // No action – show a small hint
                header('Content-Type: text/plain');
                echo "LeaveRequestController is running.\nTry ?action=list, ?action=create, ?action=update&id=.., ?action=delete&id=.., ?action=show&id=..";
        }
    } catch (Throwable $e) {
        $respondJson(['ok' => false, 'message' => $e->getMessage()], 500);
    }
}