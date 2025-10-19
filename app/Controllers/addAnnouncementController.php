<?php
require_once __DIR__ . '/../Models/announcementModel.php';
class AddAnnouncementController
{
    public function addAnnouncement($title, $content, $published_by, $role)
    {
        $announcementModel = new AnnouncementModel();
        return $announcementModel->addAnnouncement([
            'title' => $title,
            'content' => $content,
            'published_by' => $published_by,
            'role' => $role
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
        $published_by = $_SESSION['username'];
        $target_audience = $_POST['group'];

        $controller = new AddAnnouncementController();
        $result = $controller->addAnnouncement($title, $content, $published_by, $role);

        if ($result) {
            // Redirect or success message
            header("Location: ../Views/MP/announcementSection.php?added=1");
            exit;
        } else {
            echo "Error: Unable to add announcement.";
        }
    } else {
        echo "Error: Missing required form data.";
    }
}