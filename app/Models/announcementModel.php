<?php
require_once './../../config/dbconfig.php';

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
        $sql = "INSERT INTO " . $this->table . " (title, content, published_by, role, target_audience) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $data['title'], $data['content'], $data['published_by'], $data['role'],$data['target_audience']);
        return $stmt->execute();
    }

    public function getAllAnnouncements()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnouncementById($announcement_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE announcement_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $announcement_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateAnnouncement($announcement_id, $data)
    {
        $query = "UPDATE " . $this->table . " SET title = ?, content = ?, published_by = ?, role = ? WHERE announcement_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $data['title'], $data['content'], $data['published_by'], $data['role'], $data['target_audience'], $announcement_id);
        return $stmt->execute();
    }

    public function deleteAnnouncement($announcement_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE announcement_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $announcement_id);
        return $stmt->execute();
    }
}
?>