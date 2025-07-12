<?PHP
    include $_SERVER['DOCUMENT_ROOT'] . "/projectIskole/config/dbconfig.php";

    // Additional code for login functionality can be added here
    if(isset($_POST['role'])) {
        $role = $_POST['role'];
        // For example, redirect to different pages based on role
        switch($role) {
            case 'student':
                header("Location: /projectIskole/app/Views/Student/studentDashboard.php");
                break;
            case 'teacher':
                header("Location: /SKOLE/app/Views/Teacher/teacherDashboard.php");
                break;
            case 'admin':
                header("Location: /projectIskole/app/Views/Admin/adminDashboard.php");
                break;
            case 'parent':
                header("Location: /projectIskole/app/Views/Parent/parentDashboard.php");
                break;
            case 'management-panel':
                header("Location: /projectIskole/app/Views/index.php");
                break;
            default:
                echo "Invalid role selected.";
        }
    }
?>
