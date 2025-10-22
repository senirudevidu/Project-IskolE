<?php
include_once __DIR__ . '/../../Models/announcementModel.php';

if (!session_id()) {
    session_start();
}


class ReadAnnouncementController
{
    private $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    public function getAllAnnouncements()
    {
        return $this->announcementModel->getAllAnnouncements();
    }

    public function getAnnouncementById($id)
    {
        return $this->announcementModel->getAnnouncementById($id);
    }

    public function getMyAnnouncements()
    {
        // Read announcements published by user ID
        $published_by = $_SESSION['userID'];
        return $this->announcementModel->getAnnouncementByUserID($published_by);
    }
}
