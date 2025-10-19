<?php

require_once __DIR__ . '/../Models/announcementModel.php';
require_once __DIR__ . '/../../config/dbconfig.php';

class AnnouncementController
{
    private $model;

    public function __construct()
    {
        $this->model = new AnnouncementModel();
    }

    public function getConnectionStatus()
    {
        return $this->model->getConnectionStatus();
    }

    public function addAnnouncement($data)
    {
        return $this->model->addAnnouncement($data);
    }

    public function getAllAnnouncements()
    {
        return $this->model->getAllAnnouncements();
    }

    public function getAnnouncementById($announcementID)
    {
        return $this->model->getAnnouncementById($announcementID);
    }

    public function deleteAnnouncement($announcementID)
    {
        return $this->model->deleteAnnouncement($announcementID);
    }
}

$announcementController = new AnnouncementController();
if ($announcementController->getConnectionStatus()) {
    echo "Database connection is active in AnnouncementController.";
} else {
    echo "Database connection failed in AnnouncementController.";
}

$announcementController->addAnnouncement([
    'title' => 'Sample Announcement from Controller',
    'content' => 'This is a sample announcement content.',
    'published_by' => 'Admin',
    'role' => 'Administrator'
]);


?>