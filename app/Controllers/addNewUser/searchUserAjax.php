<?php
// filepath: /app/Controllers/addNewUser/searchUserAjax.php
header('Content-Type: application/json');

require_once __DIR__ . '/searchUser.php';
require_once __DIR__ . '/viewUser.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

try {
    if ($q !== '') {
        $service = new SearchUser();
        $users = $service->search($q); // already limited to 10
    } else {
        $service = new ViewUser();
        $users = $service->viewRecentUsers(5); // show 5 when no query
    }

    // Normalize role to friendly string if it's numeric
    $roleMap = [0 => 'admin', 1 => 'mp', 2 => 'teacher', 3 => 'student', 4 => 'parent'];
    foreach ($users as &$u) {
        if (isset($u['role']) && is_numeric($u['role'])) {
            $u['role'] = $roleMap[(int) $u['role']] ?? (string) $u['role'];
        }
    }

    echo json_encode(['success' => true, 'data' => $users]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
exit;
