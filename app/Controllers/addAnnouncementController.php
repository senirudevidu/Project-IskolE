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

$addAnnouncementController = new AddAnnouncementController();
// $addAnnouncementController->addAnnouncement('Meeting Reminder', 'Don\'t forget about the meeting tomorrow at 10 AM.', 'Admin', 'Administrator');

$addAnnouncementController->addAnnouncement($_POST['title'], $_POST['message'], 'MP', $_POST['group']);