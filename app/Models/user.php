<?php

// require_once 'password.php';

// class User
// {
//     protected $conn;
//     protected $userTable = 'user';
//     protected $addressTable = 'user_address';

//     private $nullCounter = 0;

//     protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role', 'addressLine1', 'addressLine2', 'addressLine3'];
//     // protected $userID, $fName, $lName, $email, $phone, $dateOfBirth, $gender, $password, $role, $addressLine1, $addressLine2, $addressLine3;

//     protected $roleList = ['admin' => 0, 'mp' => 1, 'teacher' => 2, 'student' => 3, 'parent' => 4];
//     public function __construct($conn)
//     {
//         $this->conn = $conn;
//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         } else {
//             echo "Database connected successfully" . "<br>";
//         }
//     }

//     public function addUser($data)
//     {
//         $data['role'] = $this->roleList[$data['role']];
//         $data['password'] = Password::hashPassword($data['password']);

//         foreach ($data as $key => $value) {
//             if ($value === null || $value === '') {
//                 echo "Warning: $key is null or empty<br>";
//                 $this->nullCounter++;
//             }
//         }
//         if ($this->nullCounter > 0) {
//             echo "Error: Cannot proceed with null or empty values in user data.<br>";
//             return false;
//         }

//         $sql = "INSERT INTO `user`(fName, lName, email, phone, dateOfBirth, gender, password, role, active)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? )";

//         $stmt = $this->conn->prepare($sql);
//         if (!$stmt) {
//             echo "Prepare failed (User): " . $this->conn->error . "<br>";
//             return false;
//         }

//         // Assign to local variables to satisfy bind_param's pass-by-reference requirement
//         $fName = $data['fName'];
//         $lName = $data['lName'];
//         $email = $data['email'];
//         $phone = $data['phone'];
//         $dateOfBirth = $data['dateOfBirth'];
//         $gender = $data['gender'];
//         $password = $data['password'];
//         $role = (int) $data['role'];
//         $active = 1;

//         $stmt->bind_param(
//             "sssssssii",
//             $fName,
//             $lName,
//             $email,
//             $phone,
//             $dateOfBirth,
//             $gender,
//             $password,
//             $role,
//             $active
//         );

//         if (!$stmt->execute()) {
//             echo "Execute failed: " . $stmt->error . "<br>";
//         } else {
//             echo "User insertion executed successfully in user table.<br>";
//         }

//         // Capture the user ID from the first insert BEFORE any other inserts
//         $userId = $this->conn->insert_id;

//         // Prepare address insert
//         // $address1 = $data['addressLine1'];
//         // $address2 = $data['addressLine2'];
//         // $address3 = $data['addressLine3'];

//         // $sql = "INSERT INTO " . $this->addressTable . " (userID, addressLine1, addressLine2, addressLine3) VALUES (?, ?, ?, ?)";
//         // $stmt = $this->conn->prepare($sql);
//         // if (!$stmt) {
//         //     echo "Prepare failed (User Address): " . $this->conn->error . "<br>";
//         //     return false;
//         // }
//         // $stmt->bind_param("isss", $userId, $address1, $address2, $address3);
//         // $result = $stmt->execute();

//         // if ($result === false) {
//         //     echo "Execute failed (User Address): " . $stmt->error . "<br>";
//         //     return false;
//         // }

//         // Return the created user ID so callers can use it reliably
//         return $userId;
//     }
// }


require_once 'password.php';

class User
{
    protected $conn;
    protected $userTable = 'user';
    protected $addressTable = 'user_address';
    protected $roleList = ['admin' => 0, 'mp' => 1, 'teacher' => 2, 'student' => 3, 'parent' => 4];

    public function __construct($conn)
    {
        $this->conn = $conn;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "Database connected successfully" . "<br>";
        }
    }

    public function addUser($data)
    {
        $data['role'] = $this->roleList[$data['role']];


        // user add for user table
        $sql = "INSERT INTO " . $this->userTable . " (fName, lName, email, phone, dateOfBirth, gender, role, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed (User): " . $this->conn->error . "<br>";
            return false;
        }

        $stmt->bind_param(
            "ssssssii",
            $data['fName'],
            $data['lName'],
            $data['email'],
            $data['phone'],
            $data['dateOfBirth'],
            $data['gender'],
            $data['role'],
            $data['active']
        );


        try {
            $result = $stmt->execute();
            if ($result === false) {
                throw new Exception("Error adding user to user table: " . $stmt->error);
            }
            // echo "User insertion executed successfully in user table" . "<br>";
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>";
            return false;
        }

        $userId = $this->conn->insert_id;
        $data['password'] = Password::hashPassword($data['fName'], $userId);

        $sqlUpdate = "UPDATE " . $this->userTable . " SET password = ? WHERE userID = ?";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        if (!$stmtUpdate) {
            echo "Prepare failed (User Password Update): " . $this->conn->error . "<br>";
            return false;
        }

        return $userId;
    }

}