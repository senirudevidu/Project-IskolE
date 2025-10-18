<?php
require_once __DIR__ . '/../Models/announcementModel.php';
require_once __DIR__ . '/../../config/dbconfig.php';

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AnnouncementController {
    private $db;
    private $announcementModel;

    public function __construct() {
        global $conn;
        $this->db = $conn;
        $this->announcementModel = new Announcement($this->db);
    }

    // Show all announcements
    public function index() {
        $this->checkAuth();
        
        $role = $_SESSION['role'];
        $user_id = $_SESSION['user_id'];
        
        // Get announcements based on role
        if (in_array($role, ['admin', 'management', 'teacher'])) {
            $announcements = $this->announcementModel->getAll();
            $myAnnouncements = $this->announcementModel->getByUserId($user_id);
        } else {
            // Students and parents see filtered announcements
            $roleId = $_SESSION['role_id'];
            $announcements = $this->announcementModel->getByRole($roleId);
            $myAnnouncements = null;
        }
        
        include __DIR__ . "/../Views/MP/announcementSection.php";
    }

    // Show create form
    public function create() {
        $this->checkAccess(['admin', 'management', 'teacher']);
        include __DIR__ . "/../Views/MP/announcementSection.php";
    }

    // Handle creation
    public function store() {
        $this->checkAccess(['admin', 'management', 'teacher']);

        // Validate request method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithError('Invalid request method');
            return;
        }

        // Validate and sanitize input
        $title = $this->validateInput($_POST['title'] ?? '');
        $content = $this->validateInput($_POST['content'] ?? '');
        $target_audience = $this->validateInput($_POST['group'] ?? null);

        if (empty($title)) {
            $this->redirectWithError('Title is required');
            return;
        }

        if (empty($content)) {
            $this->redirectWithError('Content is required');
            return;
        }

        $user_id = $_SESSION['user_id'];
        $role_id = $_SESSION['role_id'];

        $result = $this->announcementModel->create($title, $content, $user_id, $role_id, $target_audience);

        if ($result) {
            $this->redirectWithSuccess('Announcement published successfully');
        } else {
            $this->redirectWithError('Failed to publish announcement');
        }
    }

    // Show edit form
    public function edit($id) {
        $this->checkAccess(['admin', 'management', 'teacher']);
        
        $id = intval($id);
        $user_id = $_SESSION['user_id'];
        
        // Check ownership
        if (!$this->announcementModel->isOwner($id, $user_id)) {
            $this->redirectWithError('You can only edit your own announcements');
            return;
        }
        
        $announcement = $this->announcementModel->getById($id);
        
        if (!$announcement) {
            $this->redirectWithError('Announcement not found');
            return;
        }
        
        include __DIR__ . "/../Views/MP/editAnnouncement.php";
    }

    // Handle update
    public function update($id) {
        $this->checkAccess(['admin', 'management', 'teacher']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithError('Invalid request method');
            return;
        }

        $id = intval($id);
        $user_id = $_SESSION['user_id'];

        // Check ownership
        if (!$this->announcementModel->isOwner($id, $user_id)) {
            $this->redirectWithError('You can only update your own announcements');
            return;
        }

        $title = $this->validateInput($_POST['title'] ?? '');
        $content = $this->validateInput($_POST['content'] ?? '');
        $target_audience = $this->validateInput($_POST['group'] ?? null);

        if (empty($title) || empty($content)) {
            $this->redirectWithError('Title and content are required');
            return;
        }

        $result = $this->announcementModel->update($id, $title, $content, $user_id, $target_audience);

        if ($result) {
            $this->redirectWithSuccess('Announcement updated successfully');
        } else {
            $this->redirectWithError('Failed to update announcement');
        }
    }

    // Handle delete
    public function destroy($id) {
        $this->checkAccess(['admin', 'management', 'teacher']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithError('Invalid request method');
            return;
        }

        $id = intval($id);
        $user_id = $_SESSION['user_id'];

        // Check ownership
        if (!$this->announcementModel->isOwner($id, $user_id)) {
            $this->redirectWithError('You can only delete your own announcements');
            return;
        }

        $result = $this->announcementModel->delete($id, $user_id);

        if ($result) {
            $this->redirectWithSuccess('Announcement deleted successfully');
        } else {
            $this->redirectWithError('Failed to delete announcement');
        }
    }

    // Helper to check if user is authenticated
    private function checkAuth() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            header("Location: /login.php");
            exit();
        }
    }

    // Helper to restrict who can publish
    private function checkAccess($allowedRoles) {
        $this->checkAuth();
        
        if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
            $this->redirectWithError('Access Denied');
            exit();
        }
    }

    // Helper to validate and sanitize input
    private function validateInput($input) {
        if ($input === null) {
            return null;
        }
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Helper to redirect with error message
    private function redirectWithError($message) {
        $_SESSION['error'] = $message;
        header("Location: /announcements");
        exit();
    }

    // Helper to redirect with success message
    private function redirectWithSuccess($message) {
        $_SESSION['success'] = $message;
        header("Location: /announcements");
        exit();
    }
}

// Handle direct requests to this file
if (basename($_SERVER['PHP_SELF']) === 'announcementController.php') {
    $controller = new AnnouncementController();
    
    $action = $_GET['action'] ?? 'index';
    $id = $_GET['id'] ?? null;
    
    switch ($action) {
        case 'create':
            $controller->create();
            break;
        case 'store':
            $controller->store();
            break;
        case 'edit':
            if ($id) $controller->edit($id);
            break;
        case 'update':
            if ($id) $controller->update($id);
            break;
        case 'delete':
            if ($id) $controller->destroy($id);
            break;
        default:
            $controller->index();
            break;
    }
}
?>