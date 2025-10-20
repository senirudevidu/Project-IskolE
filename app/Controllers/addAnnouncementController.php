<?php
require_once __DIR__ . '/../Models/announcementModel.php';
class AddAnnouncementController
{
    public function addAnnouncement($title, $content, $published_by, $role, $target_audience)
    {
        $announcementModel = new AnnouncementModel();
        return $announcementModel->addAnnouncement([
            'title' => $title,
            'content' => $content,
            'published_by' => $published_by,
            'role' => $role,
            'target_audience' => $target_audience
        ]);
    }
}

//$addAnnouncementController = new AddAnnouncementController();
// $addAnnouncementController->addAnnouncement('Meeting Reminder', 'Don\'t forget about the meeting tomorrow at 10 AM.', 'Admin', 'Administrator');

//$addAnnouncementController->addAnnouncement($_POST['title'], $_POST['message'], 'MP', $_POST['group']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title'], $_POST['message'], $_POST['group'])) {
        $title = $_POST['title'];
        $content = $_POST['message'];
        $published_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown';
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'MP';
        $target_audience = $_POST['group'];

        $controller = new AddAnnouncementController();
        $result = $controller->addAnnouncement($title, $content, $published_by, $role, $target_audience);

        if ($result) {
            //header("Location: ../Views/MP/announcementSection.php?added=1");
            header("Location: ../Views/MP/mpDashboard.php?added=1");
            exit;
        } else {
            echo "Error: Unable to add announcement.";
        }
    } else {
        echo "Error: Missing required form data.";
    }
}