<?php
require_once __DIR__ . '/../../Models/announcementModel.php';

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
}
