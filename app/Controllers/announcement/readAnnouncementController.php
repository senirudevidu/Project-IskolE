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
        $role = $_SESSION['role'];
        if ($role === 'admin') {
            // Admin can see all announcements
            return $this->announcementModel->getAllAnnouncements();
        } else if ($role === 'ManagementPanel') {
            // Management Panel can see all announcements
            return $this->announcementModel->getAllAnnouncements();
        } else if ($role === 'Teacher') {
            // audienceID == 0,1,2,4,8
            return $this->announcementModel->getAnnouncementsByAudienceIDs([0, 1, 2, 4, 8]);
        } else if ($role === 'Parent') {
            // audienceID == 0,5,7,8
            return $this->announcementModel->getAnnouncementsByAudienceIDs([0, 5, 7, 8]);
        } else if ($role === 'Student') {
            // audienceID == 0,6,7,2,8
            return $this->announcementModel->getAnnouncementsByAudienceIDs([0, 6, 7, 2, 8]);
        } else {
            // Other roles see no announcements
            return [];
        }
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
