<?php
require_once 'user.php';
class Management extends User
{
    protected $mpTable = 'MP';
    protected $mpPrimaryKey = 'mpId';
    protected $mpAllowedFields = ['mpId', 'userID', 'nic'];

    public function addMP($data)
    {
        $userData = [
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dateOfBirth' => $data['dateOfBirth'],
            'gender' => $data['gender'],
            'password' => $data['password'],
            'role' => $data['role']
        ];

        $userId = $this->addUser($userData);

        if ($userId === false) {
            echo "Error adding user for user table(MP)" . $this->conn->error;
            return false;
        }
        if ($userId === true) {
            $userId = $this->conn->insert_id;
        }

        $mpData = [
            'mpId' => $data['mpId'],
            'userID' => $userId,
            'nic' => $data['nic']
        ];


        $mpData['userID'] = $userId;

        $sql = "INSERT INTO " . $this->mpTable . " (mpId, userID, nic) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $mpData['mpId'], $mpData['userID'], $mpData['nic']);
        return $stmt->execute();
    }
}