<?php
ob_start(); // Start output buffering
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../../../config/dbconfig.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['submitUser']) || isset($_SERVER['HTTP_X_REQUESTED_WITH']))) {

    try {
        // Ensure defaults/mappings
        if (!isset($_POST['active'])) {
            $_POST['active'] = 1; // default active
        }

        // Normalize teacher-specific field names coming from the form
        if (isset($_POST['role']) && $_POST['role'] === 'teacher') {
            if (isset($_POST['subject']) && !isset($_POST['subjectID'])) {
                $_POST['subjectID'] = $_POST['subject'];
            }
            if (isset($_POST['class']) && !isset($_POST['classID'])) {
                $_POST['classID'] = $_POST['class'];
            }
        }

        $newUserId = null;
        $rolePosted = $_POST['role'] ?? '';
        switch ($_POST['role']) {
            case 'admin':

            case 'teacher':
                // echo 'Adding teacher' . "<br>";
                $teacherModel = new Teacher();
                $newUserId = $teacherModel->addTeacher($_POST);
                break;
            case 'student':
                // echo 'Adding student' . "<br>";
                $studentModel = new Student();
                $newUserId = $studentModel->addStudent(data: $_POST);
                break;
            case 'parent':
                // echo 'Adding parent' . "<br>";
                $parentModel = new ParentRole();
                $newUserId = $parentModel->addParent($_POST);
                break;
            case 'mp':
                // echo 'Adding MP' . "<br>";
                $mpModel = new Management();
                $newUserId = $mpModel->addMP($_POST);
                break;
            default:
                throw new UnexpectedValueException('Invalid role: ' . ($_POST['role'] ?? ''));
        }
    } catch (Throwable $e) {

        echo "<script>console.log('PHP: " . error_log('addNewUser error: ' . $e->getMessage()) . "');</script>";
        // If this was an AJAX request, respond with JSON error without redirect
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Server error']);
            exit;
        }
    }

    // Build a robust view URL to return to Management section
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    // Relative fallback from this controller to the MP dashboard
    $defaultView = '../../Views/MP/mpDashboard.php#management';

    // If referer is missing or is this controller, use default view
    if (!$referer || strpos($referer, 'addNewUser/addNewUser.php') !== false) {
        $viewUrl = $defaultView;
    } else {
        // Strip any existing hash and append our desired one
        $baseUrl = preg_replace('/#.*/', '', $referer);
        $viewUrl = $baseUrl . '#management';
    }

    // If this was an AJAX request, respond with JSON and do not redirect
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        header('Content-Type: application/json');
        if (!$newUserId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Create failed', 'redirect' => $viewUrl]);
            exit;
        }

        try {
            $userModel = new User();
            $user = $userModel->viewUser((int) $newUserId);
            // Prepare minimal payload for UI
            $payload = [
                'userID' => (int) ($user['userID'] ?? $newUserId),
                'fName' => $user['fName'] ?? ($_POST['fName'] ?? ''),
                'lName' => $user['lName'] ?? ($_POST['lName'] ?? ''),
                'email' => $user['email'] ?? ($_POST['email'] ?? ''),
                // Use posted role string for friendly display
                'role' => $rolePosted,
            ];
            echo json_encode([
                'success' => true,
                'data' => $payload,
                // Provide a redirect hint so frontend can navigate back to view page if desired
                'redirect' => $viewUrl,
            ]);
        } catch (Throwable $e) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => [
                    'userID' => (int) $newUserId,
                    'fName' => $_POST['fName'] ?? '',
                    'lName' => $_POST['lName'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'role' => $rolePosted,
                ],
                'redirect' => $viewUrl,
            ]);
        }
        exit;
    }



    // For non-AJAX form submissions, redirect back to view (Management) page
    header("Location: " . $viewUrl);
    exit;
}
