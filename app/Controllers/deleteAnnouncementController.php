<?php
require_once __DIR__ . '/../Models/announcementModel.php';

class DeleteAnnouncementController
{
    private $model;

    public function __construct()
    {
        $this->model = new AnnouncementModel();
    }

    public function deleteAnnouncement($id)
    {
        return $this->model->deleteAnnouncement($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);

        $controller = new DeleteAnnouncementController();
        $result = $controller->deleteAnnouncement($id);

        if ($result) {
            header("Location: ../Views/MP/mpDashboard.php?deleted=1");
            exit;
        } else {
            echo "Error: Unable to delete announcement.";
        }
    } else {
        echo "Error: Missing announcement ID.";
    }
} else {
    header("Location: ../Views/MP/mpDashboard.php");
    exit;
}
?>