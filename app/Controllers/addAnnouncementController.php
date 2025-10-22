<?php
// Start session at the beginning
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../Models/announcementModel.php';

class AddAnnouncementController
{
    public function addAnnouncement($title, $content, $published_by, $role, $audienceID)
    {
        $announcementModel = new AnnouncementModel();
        return $announcementModel->addAnnouncement([
            'title' => $title,
            'content' => $content,
            'published_by' => $published_by,
            'role' => $role,
            'audienceID' => $audienceID
        ]);
    }
}

// Helper function to get redirect URL based on role
function getRedirectUrl($role) {
    $redirectUrl = '../Views/';
    
    switch ($role) {
        case 'Admin':
        case 'Administrator':
            $redirectUrl .= 'Admin/adminDashboard.php';
            break;
        case 'MP':
        case 'Management':
        case 'Management Panel':
            $redirectUrl .= 'MP/mpDashboard.php';
            break;
        case 'Teacher':
            $redirectUrl .= 'Teacher/teacherDashboard.php';
            break;
        case 'Parent':
            $redirectUrl .= 'Parent/parentDashboard.php';
            break;
        case 'Student':
            $redirectUrl .= 'Student/studentDashboard.php';
            break;
        default:
            $redirectUrl .= 'MP/mpDashboard.php';
    }
    
    return $redirectUrl;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title'], $_POST['message'], $_POST['group'])) {
        $title = $_POST['title'];
        $content = $_POST['message'];
        $published_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown';
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'MP';
        $audienceID = $_POST['group'];

        $controller = new AddAnnouncementController();
        $result = $controller->addAnnouncement($title, $content, $published_by, $role, $audienceID);

        if ($result) {
            // Redirect based on user role
            $redirectUrl = getRedirectUrl($role);
            header("Location: $redirectUrl?added=1");
            exit;
        } else {
            echo "Error: Unable to add announcement.";
        }
    } else {
        echo "Error: Missing required form data.";
    }
} else {
    // Redirect if accessed via GET
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'MP';
    $redirectUrl = getRedirectUrl($role);
    header("Location: $redirectUrl");
    exit;
}
?>