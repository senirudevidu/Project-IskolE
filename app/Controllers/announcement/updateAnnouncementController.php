<?php


if (!session_id()) {
    session_start();
}

include_once __DIR__ . '/../../Models/announcementModel.php';

class UpdateAnnouncementController
{
    private $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    public function updateAnnouncement($announcement_id, $data)
    {
        return $this->announcementModel->updateAnnouncement($announcement_id, $data);
    }
}

if (isset($_POST['announcement_id']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['published_by']) && isset($_POST['role']) && isset($_POST['audienceID'])) {
    $announcement_id = (int) $_POST['announcement_id'];
    $data = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'published_by' => $_POST['published_by'],
        'role' => $_POST['role'],
        'audienceID' => (int) $_POST['audienceID']
    ];

    $controller = new UpdateAnnouncementController();
    $success = $controller->updateAnnouncement($announcement_id, $data);

    if ($success) {
        $_SESSION['message'] = "Announcement updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update announcement.";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
