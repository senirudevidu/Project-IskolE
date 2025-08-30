<?php
require_once 'user.php';
class ManagementPanel extends User
{
    protected $mpTable = 'MP';
    protected $mpPrimaryKey = 'mpId';
    protected $mpAllowedFields = ['mpId', 'userID', 'nic'];
    protected $nic, $mpId, $userData;

    public function __construct($conn, $data)
    {
        parent::__construct($conn, $data);
        $this->nic = $data['nic'] ?? null;
        $this->userID = null;
        $this->role = 1;


        $this->userData = [
            'fName' => $this->fName,
            'lName' => $this->lName,
            'email' => $this->email,
            'phone' => $this->phone,
            'dateOfBirth' => $this->dateOfBirth,
            'gender' => $this->gender,

            // 'role' => $this->role,
            'role' => 3, // Assuming '2' is the role ID for MP
            'password' => $this->nic,
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'addressLine3' => $this->addressLine3
        ];

    }
    public function addMP()
    {




        $userId = $this->addUser($this->userData);

        if ($userId === false) {
            echo "Error adding user for user table role (MP)" . $this->conn->error;
            return false;
        }
        if ($userId === true) {
            $userId = $this->conn->insert_id;
            echo "New user added successfully with ID: " . $userId . "<br>";
            return true;
        }

        $mpData = [
            'userID' => $this->userID,
            'nic' => $this->nic
        ];


    }
}