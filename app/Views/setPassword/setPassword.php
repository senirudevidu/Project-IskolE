<?php
// filepath: /home/snake/UCSC/UCSC/Year 2/Project/projectIskole/app/Views/setPassword/setPassword.php
$token = htmlspecialchars($_GET['token'] ?? '', ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_GET['email'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Set Password - Iskole</title>
    <link rel="stylesheet" href="../../../public/css/login.css" />
    <link rel="stylesheet" href="../../../public/css/setPassword.css" />
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="../../../public/assests/logo.png" alt="Iskole Logo" height="100" width="100" />
        </div>
        <h1>Set Password</h1>

        <!-- Test password notice at the top -->
        <div class="notice">Test password: <strong>Test@1234</strong></div>

        <?php if ($email): ?>
            <div class="notice">Setting password for: <strong><?php echo $email; ?></strong></div>
        <?php endif; ?>

        <div class="form">
            <form id="setPasswordForm" action="#" method="post" novalidate>
                <?php if ($token): ?>
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <?php endif; ?>
                <?php if ($email): ?>
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                <?php endif; ?>

                <div class="field">
                    <label for="password">New Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" autocomplete="new-password" required />
                        <span class="toggle-visibility" data-target="password">Show</span>
                    </div>
                    <div class="strength" aria-hidden="true"><span id="strengthBar"></span></div>
                    <ul class="criteria" aria-live="polite" aria-atomic="true">
                        <li id="c_len" class="bad">• At least 8 characters</li>
                        <li id="c_low" class="bad">• Lowercase letter</li>
                        <li id="c_up" class="bad">• Uppercase letter</li>
                        <li id="c_num" class="bad">• Number</li>
                        <li id="c_sp" class="bad">• Special character (!@#$%^&*)</li>
                    </ul>
                    <div id="passwordError" class="error-message"></div>
                </div>

                <div class="field">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-wrap">
                        <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="new-password"
                            required />
                        <span class="toggle-visibility" data-target="confirmPassword">Show</span>
                    </div>
                    <div id="confirmError" class="error-message"></div>
                </div>

                <button type="submit">Set Password</button>
            </form>
            <a class="back-link" href="../login/login.php">Back to Login</a>
            <p class="muted">Use a strong password you haven’t used elsewhere.</p>
        </div>
    </div>


    <script src="../../../public/js/setPassword.js"></script>
</body>

</html>