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

    public function viewRecentUsers(int $limit = 5): array
    {
        $userModel = new User();
        return $userModel->viewRecentUsers($limit);
    }
}

