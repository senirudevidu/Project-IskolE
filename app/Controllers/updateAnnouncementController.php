<?php
require_once __DIR__ . '/../Models/announcementModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class updateAnnouncementController
{
    private $model;

    public function __construct()
    {
        $this->model = new AnnouncementModel();
    }

    public function updateAnnouncement($id, $data)
    {
        return $this->model->updateAnnouncement($id, $data);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['title'], $_POST['message'], $_POST['group'])) {
        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $content = trim($_POST['message']);
        // derive published_by from session (username or fullname or role)
        if (!empty($_SESSION['username'])) {
            $published_by = $_SESSION['username'];
        } elseif (!empty($_SESSION['fName']) || !empty($_SESSION['lName'])) {
            $published_by = trim(($_SESSION['fName'] ?? '') . ' ' . ($_SESSION['lName'] ?? ''));
        } else {
            $published_by = $_SESSION['role'] ?? 'System';
        }
        $role = $_SESSION['role'] ?? 'Management';

        // audienceID handled earlier (could be array or scalar)
        $audienceID = $_POST['group'];

        $data = [
            'title' => $title,
            'content' => $content,
            'published_by' => $published_by,
            'role' => $role,
            'audienceID' => $audienceID
        ];

        $controller = new UpdateAnnouncementController();
        $result = $controller->updateAnnouncement($id, $data);

        if ($result) {
            header("Location: ../Views/MP/mpDashboard.php?updated=1");
            exit;
        } else {
            echo "Error: Unable to update announcement.";
        }
    } else {
        echo "Error: Missing required form data.";
    }
} else {
    header("Location: ../Views/MP/mpDashboard.php");
    exit;
}
?>