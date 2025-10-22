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
        if ($role === 'Admin') {
            // Admin can see all announcements
            return $this->announcementModel->getAllAnnouncements();
        } else if ($role === 'ManagementPanel') {
            // Management Panel can see all announcements
            return $this->announcementModel->getAllAnnouncements();
        } else if ($role === 'Teacher') {
            // audienceID == 1,2,4,7
            return $this->announcementModel->getAnnouncementsByAudienceIDs([1, 2, 4, 7]);
        } else if ($role === 'Parent') {
            // audienceID == 1,4,5,8
            return $this->announcementModel->getAnnouncementsByAudienceIDs([1, 4, 5, 8]);
        } else if ($role === 'Student') {
            // audienceID == 1,3,5,9
            return $this->announcementModel->getAnnouncementsByAudienceIDs([1, 3, 5, 9]);
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
