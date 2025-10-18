<?php
require_once __DIR__ . '/../../Models/mp.php';
require_once __DIR__ . '/../../Models/teacher.php';
require_once __DIR__ . '/../../Models/parent.php';
require_once __DIR__ . '/../../Models/student.php';
require_once __DIR__ . '/../../../config/dbconfig.php';


class ViewUser
{
    private $mpModel;
    private $teacherModel;
    private $parentModel;
    private $studentModel;

    public function __construct()
    {
        $this->mpModel = new Management();
        $this->teacherModel = new Teacher();
        $this->parentModel = new ParentRole();
        $this->studentModel = new Student();
    }

    public function viewUser($userId)
    {
        $user = null;
        // Check each model for the user
        $user = $this->mpModel->viewUser($userId);
        if ($user)
            return $user;

        $user = $this->teacherModel->viewUser($userId);
        if ($user)
            return $user;

        $user = $this->parentModel->viewUser($userId);
        if ($user)
            return $user;

        $user = $this->studentModel->viewUser($userId);
        return $user;
    }

    public function viewAllUsers()
    {
        $users = [];
        $users = array_merge($users, $this->mpModel->viewAllUsers());
        $users = array_merge($users, $this->teacherModel->viewAllUsers());
        $users = array_merge($users, $this->parentModel->viewAllUsers());
        $users = array_merge($users, $this->studentModel->viewAllUsers());
        return $users;
    }

    // Return the most recent users limited by $limit from the base user table
    public function viewRecentUsers(int $limit = 5): array
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            // Order by newest users; adjust column if needed
            $sql = "SELECT userID, fName, lName, email, role FROM user ORDER BY userID DESC LIMIT ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception('Prepare failed (View Recent Users): ' . $conn->error);
            }
            $stmt->bind_param('i', $limit);
            if (!$stmt->execute()) {
                throw new Exception('Execute failed (View Recent Users): ' . $stmt->error);
            }
            $result = $stmt->get_result();
            $rows = [];
            $roleMap = [0 => 'admin', 1 => 'mp', 2 => 'teacher', 3 => 'student', 4 => 'parent'];
            while ($row = $result->fetch_assoc()) {
                // map numeric role to name for display
                $row['role'] = $roleMap[$row['role']] ?? (string) $row['role'];
                $rows[] = $row;
            }
            return $rows;
        } catch (Exception $e) {
            // You can log the error if needed
            return [];
        }
    }
}

