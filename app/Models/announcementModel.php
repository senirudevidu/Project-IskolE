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

        } else {
            echo "Database connection established in AnnouncementModel.";
        }

    }
    public function getConnectionStatus()
    {
        return $this->conn !== null;
    }

    public function addAnnouncement($data)
    {
        $sql = "INSERT INTO " . $this->table . " (title, content, datePosted) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $data['title'], $data['content'], $data['datePosted']);
        return $stmt->execute();
    }

    public function getAllAnnouncements()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY datePosted DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnouncementById($announcementID)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE announcementID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $announcementID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function deleteAnnouncement($announcementID)
    {
        $query = "DELETE FROM " . $this->table . " WHERE announcementID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $announcementID);
        return $stmt->execute();
    }
}



