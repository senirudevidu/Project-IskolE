<?php
include_once __DIR__ . '/../../Models/announcementModel.php';

// Read announcements published by user ID
if (!session_id()) {
    session_start();
}

$published_by = $_SESSION['userID'];
$announcementModel = new AnnouncementModel();
$myAnnouncements = $announcementModel->getAnnouncementByUserID($published_by);
