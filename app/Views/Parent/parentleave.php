<?php
session_start();
require_once __DIR__ . '/../app/Controllers/LeaveRequestController.php';

$controller  = new LeaveRequestController();
$studentID   = $_SESSION['student_id']   ?? (int)($_POST['student_id'] ?? 0);
$studentName = $_SESSION['student_name'] ?? (string)($_POST['student_name'] ?? '');
$action      = $_GET['action'] ?? 'index';
$isAjax      = isset($_GET['ajax']);   // <-- key

switch ($action) {
  case 'store': {
    // Do create, but ask the controller to just return a bool/message
    $ok = $controller->storeRaw($studentID, $studentName, $_POST); // implement storeRaw below
    if ($isAjax) {
      header('Content-Type: application/json');
      echo json_encode(['ok' => $ok, 'message' => $ok ? 'Saved.' : 'Save failed.']);
      exit;
    }
    header('Location: ?action=index'); exit;
  }

  case 'update': {
    $ok = $controller->updateRaw($studentID, $_POST); // implement updateRaw
    if ($isAjax) {
      header('Content-Type: application/json');
      echo json_encode(['ok' => $ok, 'message' => $ok ? 'Updated.' : 'Update failed.']);
      exit;
    }
    header('Location: ?action=index'); exit;
  }

  case 'delete': {
    $rid = (int)($_POST['request_id'] ?? 0);
    $ok  = $controller->destroyRaw($studentID, $rid); // implement destroyRaw
    if ($isAjax) {
      header('Content-Type: application/json');
      echo json_encode(['ok' => $ok, 'message' => $ok ? 'Deleted.' : 'Delete failed.']);
      exit;
    }
    header('Location: ?action=index'); exit;
  }

  // ... keep create/index/edit routes as before
}
