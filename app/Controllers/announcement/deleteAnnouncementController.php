<?php

include_once __DIR__ . '/../../Models/announcementModel.php';

if (!session_id()) {
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the announcement ID from POST data
        $data = json_decode(file_get_contents('php://input'), true);
        $announcementID = $data['announcementID'] ?? null;

        if (!$announcementID) {
            echo json_encode([
                'success' => false,
                'message' => 'Announcement ID is required'
            ]);
            exit;
        }

        // Verify the user owns this announcement
        $announcementModel = new AnnouncementModel();
        $announcement = $announcementModel->getAnnouncementById($announcementID);

        if (!$announcement) {
            echo json_encode([
                'success' => false,
                'message' => 'Announcement not found'
            ]);
            exit;
        }

        // Delete the announcement
        $result = $announcementModel->deleteAnnouncement($announcementID);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Announcement deleted successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete announcement'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
