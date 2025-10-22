<?php include_once __DIR__ . '/../../Models/announcementModel.php';

if (!session_id()) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['title']) && isset($_POST['message']) && isset($_POST['group'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['message']);
        $audienceGroup = trim($_POST['group']);

        if (empty($title) || empty($content) || $audienceGroup === "null") {
            // Handle validation error
            echo "All fields are required.";
            exit;
        }
    } else {
        // Handle missing fields
        echo "Form data is incomplete.";
        exit;
    }


    // additional data from session
    $published_by = $_SESSION['userID'];
    $role = $_SESSION['role'];

    $announcementModel = new AnnouncementModel();
    try {
        $result = $announcementModel->addAnnouncement([
            'title' => $title,
            'content' => $content,
            'published_by' => $published_by,
            'role' => $role,
            'audienceID' => $audienceGroup
        ]);

        if ($result) {
            // Redirect to a success page or display a success message
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            // Handle insertion failure
            echo "Failed to add announcement.";
            exit;
        }
    } catch (Exception $e) {
        // Handle exception
        echo "Error: " . $e->getMessage();
        exit;
    }
}
