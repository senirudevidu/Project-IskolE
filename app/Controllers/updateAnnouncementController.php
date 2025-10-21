<?php
require_once __DIR__ . '/../Models/announcementModel.php';

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
        $published_by = $_SESSION['username'] ?? 'Unknown';
        $role = $_SESSION['role'] ?? 'Management';
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