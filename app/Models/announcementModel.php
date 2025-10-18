<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class Announcement {
    private $conn;
    private $table = "announcement";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all announcements with publisher name and role
    public function getAll() {
        $query = "SELECT a.*, 
                         CONCAT(u.fName, ' ', u.lName) AS username, 
                         r.roleName AS role_name
                  FROM {$this->table} a
                  JOIN user u ON a.published_by = u.userID
                  JOIN user_roles r ON a.role = r.roleID
                  ORDER BY a.created_at DESC";
        
        try {
            $result = $this->conn->query($query);
            return $result;
        } catch (Exception $e) {
            error_log("Error fetching announcements: " . $e->getMessage());
            return false;
        }
    }

    // Get announcements by user ID (for viewing published announcements)
    public function getByUserId($user_id) {
        $query = "SELECT a.*, 
                         CONCAT(u.fName, ' ', u.lName) AS username, 
                         r.roleName AS role_name
                  FROM {$this->table} a
                  JOIN user u ON a.published_by = u.userID
                  JOIN user_roles r ON a.role = r.roleID
                  WHERE a.published_by = ?
                  ORDER BY a.created_at DESC";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $e) {
            error_log("Error fetching user announcements: " . $e->getMessage());
            return false;
        }
    }

    // Get announcements visible to a specific role
    public function getByRole($roleId) {
        $query = "SELECT a.*, 
                         CONCAT(u.fName, ' ', u.lName) AS username, 
                         r.roleName AS role_name
                  FROM {$this->table} a
                  JOIN user u ON a.published_by = u.userID
                  JOIN user_roles r ON a.role = r.roleID
                  WHERE a.role = ? OR a.role = 1
                  ORDER BY a.created_at DESC";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $roleId);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $e) {
            error_log("Error fetching role announcements: " . $e->getMessage());
            return false;
        }
    }

    // Create a new announcement
    public function create($title, $content, $user_id, $role_id, $target_audience = null) {
        $query = "INSERT INTO {$this->table} (title, content, published_by, role, target_audience, created_at) 
                  VALUES (?, ?, ?, ?, ?, NOW())";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssiis", $title, $content, $user_id, $role_id, $target_audience);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error creating announcement: " . $e->getMessage());
            return false;
        }
    }

    // Get announcement by ID
    public function getById($id) {
        $query = "SELECT a.*, 
                         CONCAT(u.fName, ' ', u.lName) AS username, 
                         r.roleName AS role_name
                  FROM {$this->table} a
                  JOIN user u ON a.published_by = u.userID
                  JOIN user_roles r ON a.role = r.roleID
                  WHERE a.announcement_id = ?";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error fetching announcement: " . $e->getMessage());
            return false;
        }
    }

    // Update announcement (only owner can update)
    public function update($id, $title, $content, $user_id, $target_audience = null) {
        $query = "UPDATE {$this->table} 
                  SET title = ?, content = ?, target_audience = ?
                  WHERE announcement_id = ? AND published_by = ?";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssii", $title, $content, $target_audience, $id, $user_id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error updating announcement: " . $e->getMessage());
            return false;
        }
    }

    // Delete announcement (only owner can delete)
    public function delete($id, $user_id) {
        $query = "DELETE FROM {$this->table} 
                  WHERE announcement_id = ? AND published_by = ?";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $id, $user_id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error deleting announcement: " . $e->getMessage());
            return false;
        }
    }

    // Check if user owns the announcement
    public function isOwner($announcement_id, $user_id) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                  WHERE announcement_id = ? AND published_by = ?";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $announcement_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['count'] > 0;
        } catch (Exception $e) {
            error_log("Error checking ownership: " . $e->getMessage());
            return false;
        }
    }
}
?>