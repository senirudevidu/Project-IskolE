<?php
require_once __DIR__ . '/../../Models/user.php';

class SearchUser
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function search($keyword)
    {
        return $this->userModel->searchUsers($keyword);
    }
}
