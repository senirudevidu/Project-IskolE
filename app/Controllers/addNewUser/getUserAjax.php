<?php
// filepath: /app/Controllers/addNewUser/getUserAjax.php
header('Content-Type: application/json');

require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../../../config/dbconfig.php';

$userId = isset($_GET['userID']) ? (int) $_GET['userID'] : 0;

try {
    if ($userId <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid userID']);
        exit;
    }

    $userModel = new User();
    $user = $userModel->viewUser($userId);
    if (!$user) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'User not found']);
        exit;
    }

    echo json_encode(['success' => true, 'data' => $user]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
exit;
