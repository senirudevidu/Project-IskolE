<?php
session_start();
require_once __DIR__ . '/../../../config/dbconfig.php';
require_once __DIR__ . '/../../Controllers/loginController.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $conn = $database->getConnection();
    $loginController = new LoginController($conn);

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$loginController->login($username, $password)) {
        $error_message = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/login.css">
    <title>LogIn - Iskole</title>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="../../../public/assests/logo.png" alt="Iskole Logo" height="100" width="100">
        </div>
        <h1>Login</h1>
        <?php if ($error_message): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <div class="form">
            <form action="#" method="post">
                <input type="email" placeholder="E-Mail" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>