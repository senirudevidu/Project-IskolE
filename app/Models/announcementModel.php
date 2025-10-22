<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class AnnouncementModel
{
    private $conn;
    private $table = "announcement";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();

        if ($this->conn === null) {
            throw new Exception("Database connection could not be established.");
        }
    }

    public function getConnectionStatus()
    {
        return $this->conn !== null;
    }

    public function addAnnouncement($data)
    {
        $sql = "INSERT INTO " . $this->table . " (title, content, published_by, role, audienceID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $data['audienceID'] = isset($data['audienceID']) ? $data['audienceID'] : 0;
        $stmt->bind_param("ssssi", $data['title'], $data['content'], $data['published_by'], $data['role'], $data['audienceID']);
        return $stmt->execute();
    }

    public function getAllAnnouncements()
    {
        // $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $query = "SELECT a.*, t.audienceName 
                  FROM announcement a
                  JOIN target_audience t 
                  ON a.audienceID = t.audienceID
                  ORDER BY a.created_at DESC LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnouncementById($announcement_id)
    {
        $sql = "SELECT a.*, t.audienceName 
                FROM announcement a
                JOIN target_audience t 
                ON a.audienceID = t.audienceID
                WHERE a.announcement_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $announcement_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $announcement = $result->fetch_assoc();
        $stmt->close();
        return $announcement;
    }

    public function updateAnnouncement($announcement_id, $data)
    {
        $query = "UPDATE " . $this->table . " SET title = ?, content = ?, published_by = ?, role = ?, audienceID = ? WHERE announcement_id = ?";
        $stmt = $this->conn->prepare($query);
        $audienceID = isset($data['audienceID']) ? $data['audienceID'] : 0;
        $stmt->bind_param("sssiii", $data['title'], $data['content'], $data['published_by'], $data['role'], $audienceID, $announcement_id);
        return $stmt->execute();
    }

    public function deleteAnnouncement($announcement_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE announcement_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $announcement_id);
        return $stmt->execute();
    }

    public function getAnnouncementByUserID($user_id)
    {
        $sql = "SELECT a.announcement_id,a.title, a.content, a.created_at, t.audienceName
                FROM announcement a
                JOIN target_audience t 
                ON a.audienceID = t.audienceID
                WHERE a.published_by = ?
                ORDER BY a.created_at DESC LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $announcements = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $announcements;
    }

    public function getAnnouncementsByAudienceIDs($audienceIDs)
    {
        if (empty($audienceIDs)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($audienceIDs), '?'));
        $sql = "SELECT a.*, t.audienceName 
                FROM announcement a
                JOIN target_audience t 
                ON a.audienceID = t.audienceID
                WHERE a.audienceID IN ($placeholders)
                ORDER BY a.created_at DESC LIMIT 5";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $types = str_repeat('i', count($audienceIDs));
        $stmt->bind_param($types, ...$audienceIDs);
        $stmt->execute();
        $result = $stmt->get_result();
        $announcements = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $announcements;
    }
}
