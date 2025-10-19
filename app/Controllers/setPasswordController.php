<?php
require_once __DIR__ . '/../Models/password.php';

class SetPasswordController
{
    public function setPassword($userID, $newPassword)
    {
        $hashedPassword = Password::hashPassword($newPassword);
        $passwordModel = new Password();
        return $passwordModel->setPassword($userID, $hashedPassword);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validate passwords match
    if (empty($newPassword) || empty($confirmPassword)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Validate password strength
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $newPassword)) {
        $_SESSION['error'] = "Password does not meet requirements.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];

        $controller = new SetPasswordController();
        if ($controller->setPassword($userID, $newPassword)) {
            // Password updated successfully, redirect to login
            $_SESSION['success'] = "Password updated successfully. Please login.";
            session_destroy();
            header("Location: ../../Views/login/login.php");
            exit();
        } else {
            // Handle error
            $_SESSION['error'] = "Failed to update password. Please try again.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        // User is not logged in, redirect to login page
        header("Location: ../../Views/login/login.php");
        exit();
    }
}
