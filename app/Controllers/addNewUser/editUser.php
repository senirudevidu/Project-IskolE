<?php
// filepath: /app/Controllers/addNewUser/editUser.php
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

    $payload = [
        'fName' => $_POST['fName'] ?? null,
        'lName' => $_POST['lName'] ?? null,
        'email' => $_POST['email'] ?? null,
        'phone' => $_POST['phone'] ?? null,
        'dateOfBirth' => $_POST['dateOfBirth'] ?? null,
        'gender' => $_POST['gender'] ?? null,
    ];

    $userModel = new User();
    $ok = $userModel->editUser($userId, $payload);

    if (!$ok) {
        throw new Exception('Update failed');
    }

    echo json_encode(['success' => true]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
exit;