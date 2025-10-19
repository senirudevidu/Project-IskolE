<?php
// filepath: /app/Controllers/addNewUser/deactivateUser.php
header('Content-Type: application/json');

require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../../../config/dbconfig.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'error' => 'Method not allowed']);
        exit;
    }

    $userId = isset($_POST['userID']) ? (int) $_POST['userID'] : 0;
    if ($userId <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid userID']);
        exit;
    }

    $userModel = new User();
    $ok = $userModel->deactivateUser($userId);

    if (!$ok) {
        throw new Exception('Deactivation failed');
    }

    echo json_encode(['success' => true]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
exit;

