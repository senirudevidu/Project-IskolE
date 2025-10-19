<?php
require_once __DIR__ . '/../Models/loginModel.php';

class LoginController
{
    private $Loginmodel;
    private $role;

    public function __construct($conn)
    {
        $this->Loginmodel = new LoginModel($conn);
    }

    public function login($username, $password)
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $result = $this->Loginmodel->login($username, $password);

        try {
            if ($result && is_array($result)) {
                // Handle successful login
                $this->role = $result['role'] ?? null;

                $_SESSION['userID'] = $result['userID'] ?? null;
                $_SESSION['fName'] = $result['fName'] ?? '';
                $_SESSION['lName'] = $result['lName'] ?? '';
                $_SESSION['email'] = $result['email'] ?? $username;
                $_SESSION['role_id'] = $this->role;

                switch ($this->role) {
                    case 1:
                        $_SESSION['role'] = 'Admin';
                        header("Location: app/Views/Admin/adminDashboard.php");
                        exit(); // Add exit to prevent further execution
                        break;
                    case 2:
                        $_SESSION['role'] = 'ManagementPanel';
                        header("Location: app/Views/MP/mpDashboard.php");
                        exit();
                        break;
                    case 3:
                        $_SESSION['role'] = 'Teacher';
                        header("Location: app/Views/Teacher/teacherDashboard.php");
                        $_SESSION['teacherID'] = $this->Loginmodel->getTeacherID($result['userID']);
                        exit();
                        break;
                    case 4:
                       case 4: // Parent
                        $_SESSION['role'] = 'Parent';
                        $_SESSION['parentID'] = $this->Loginmodel->getParentIDByUserID($_SESSION['userID']); // <-- parentID ONLY
                        header("Location: app/Views/Parent/parentDashboard.php");
                        exit(); 
                        
// 1) parentID
    $parentID = $this->Loginmodel->getParentIDByUserID($_SESSION['userID']);
    $_SESSION['parentID'] = $parentID;

    // 2) children list (studentID + full_name) — parent ↔ student ↔ user join
    $_SESSION['children'] = $parentID ? $this->Loginmodel->getChildrenOfParent($parentID) : [];

    // (වෙලාවක single child නම් auto-pick කරන්න)
    if (!empty($_SESSION['children']) && count($_SESSION['children']) === 1) {
        $_SESSION['studentID']       = (int)$_SESSION['children'][0]['studentID'];
        $_SESSION['studentFullName'] = $_SESSION['children'][0]['full_name'];
    }

                    header("Location: app/Views/Parent/parentDashboard.php");
                        exit();
                        break;
                    case 5:
                        $_SESSION['role'] = 'Student';

                        try {
                            $studentClass = $this->Loginmodel->getStudentGradeAndClass($_SESSION['userID']);
                            $_SESSION['grade'] = $studentClass['grade'] ?? null;
                            $_SESSION['class'] = $studentClass['class'] ?? null;
                        } catch (Exception $e) {
                            error_log("Error fetching student class: " . $e->getMessage());
                        }
                        header("Location: app/Views/Student/studentDashboard.php");
                        exit();
                        break;
                    default:
                        return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }
}