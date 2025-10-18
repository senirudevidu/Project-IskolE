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
    public function updateAnnouncement($announcementID, $data)
    {
        return $this->model->updateAnnouncement($announcementID, $data);
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //session_start();
    
    $announcementController = new AnnouncementController();
    
    // Validate inputs
    //if (empty($_POST['group']) || empty($_POST['title']) || empty($_POST['message'])) {
      //  header('Location: ../../views/MP/announcementSection.php?error=empty_fields');
        //exit();
    //}
    
    $data = [
        'title' => htmlspecialchars(trim($_POST['title'])),
        'content' => htmlspecialchars(trim($_POST['message'])),
        'published_by' => $_SESSION['user_id'] ?? 'Unknown', // Adjust based on your session
        'role' => $_POST['group']
    ];
    
    if ($announcementController->addAnnouncement($data)) {
        header('Location: ../../views/MP/announcementSection.php?success=created');
    } else {
        header('Location: ../../views/MP/announcementSection.php?error=failed');
    }
    exit();
}


?>