<?php
require_once 'user.php';
class ManagementPanel extends User
{
    protected $mpTable = 'MP';

    protected $mpPrimaryKey = 'mpId';
    protected $mpAllowedFields = ['mpId', 'userID', 'nic'];
    protected $fName, $lName, $email, $phone, $dateOfBirth, $gender, $password, $role, $nic, $addressLine1, $addressLine2, $addressLine3;

    public function __construct($conn, $data)
    {
        parent::__construct($conn);
        $this->fName = $data['fName'] ?? null;
        $this->lName = $data['lName'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->dateOfBirth = $data['dateOfBirth'] ?? null;
        $this->addressLine1 = $data['addressLine1'] ?? null;
        $this->addressLine2 = $data['addressLine2'] ?? null;
        $this->addressLine3 = $data['addressLine3'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->role = $data['role'] ?? null;
        $this->nic = $data['nic'] ?? null;
    }
    public function addMP()
    {
        $userData = [
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

        foreach ($userData as $key => $value) {
            if ($value === null) {
                echo "Warning: $key is null<br>";
            }
        }

        foreach ($userData as $key => $value) {
            echo $key . " : " . $value . "<br>";
        }

        $userId = $this->addUser($userData);

        if ($userId === false) {
            echo "Error adding user for user table role (MP)" . $this->conn->error;
            return false;
        }
        if ($userId === true) {
            $userId = $this->conn->insert_id;
            echo "New user added successfully with ID: " . $userId . "<br>";
            return true;
        }

        // $mpData = [
        //     'mpId' => $data['mpId'],
        //     'userID' => $userId,
        //     'nic' => $data['nic']
        // ];


        //     $mpData['userID'] = $userId;

        //     $sql = "INSERT INTO " . $this->mpTable . " (mpId, userID, nic) VALUES (?, ?, ?)";
        //     $stmt = $this->conn->prepare($sql);
        //     $stmt->bind_param("iis", $mpData['mpId'], $mpData['userID'], $mpData['nic']);
        //     return $stmt->execute();
    }
}