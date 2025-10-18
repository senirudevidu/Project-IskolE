<?php
// Parent/parentleave.php
session_start();

require_once __DIR__ . '/../app/Controllers/LeaveRequestController.php';

$controller = new LeaveRequestController();

/** Identity: from session most of the time */
$studentID   = $_SESSION['student_id']   ?? (int)($_POST['student_id'] ?? 0);
$studentName = $_SESSION['student_name'] ?? (string)($_POST['student_name'] ?? '');

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index((int)$studentID);
        break;

    case 'create':
        $controller->create($studentID ?: null, $studentName ?: null);
        break;

    case 'store': // POST
        $controller->store((int)$studentID, (string)$studentName, $_POST);
        break;

    case 'edit':
        $id = (int)($_GET['id'] ?? 0);
        $controller->edit((int)$studentID, $id);
        break;

    case 'update': // POST
        $controller->update((int)$studentID, $_POST);
        break;

    case 'delete': // POST
        $id = (int)($_POST['request_id'] ?? 0);
        $controller->destroy((int)$studentID, $id);
        break;

    default:
        $controller->index((int)$studentID);
        break;
}
