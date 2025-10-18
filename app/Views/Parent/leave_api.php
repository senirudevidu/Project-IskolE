<?php
// Parent/leave_api.php
header('Content-Type: application/json; charset=UTF-8');
session_start();

require_once __DIR__ . '/../app/Controllers/LeaveRequestController.php';

$controller = new LeaveRequestController();

/* Get identity from session if available, otherwise from POST (hidden fields) */
$studentID   = isset($_SESSION['student_id'])   ? (int)$_SESSION['student_id']   : (int)($_POST['student_id'] ?? 0);
$studentName = isset($_SESSION['student_name']) ? (string)$_SESSION['student_name'] : (string)($_POST['student_name'] ?? '');

/* Route */
$action = $_POST['action'] ?? 'store';
try {
    switch ($action) {
        case 'store':
            $ok = $controller->storeRaw($studentID, $studentName, $_POST);
            echo json_encode(['ok' => $ok, 'message' => $ok ? 'Saved.' : ($controller->getLastError() ?? 'Save failed.')]);
            break;

        case 'update':
            $ok = $controller->updateRaw($studentID, $_POST);
            echo json_encode(['ok' => $ok, 'message' => $ok ? 'Updated.' : ($controller->getLastError() ?? 'Update failed.')]);
            break;

        case 'delete':
            $rid = (int)($_POST['request_id'] ?? 0);
            $ok  = $controller->destroyRaw($studentID, $rid);
            echo json_encode(['ok' => $ok, 'message' => $ok ? 'Deleted.' : ($controller->getLastError() ?? 'Delete failed.')]);
            break;

        default:
            echo json_encode(['ok' => false, 'message' => 'Unknown action.']);
    }
} catch (Throwable $e) {
    echo json_encode(['ok' => false, 'message' => 'Server error.']);
}
