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
    <style>
        /* Inline tweaks specific to this page */
        .form .field {
            margin-bottom: 14px;
            text-align: left;
        }

        .form label {
            display: block;
            font-size: 0.95rem;
            margin-bottom: 6px;
            color: #2b2b2b;
        }

        .form .input-wrap {
            position: relative;
        }

        .form input[type="password"],
        .form input[type="email"] {
            width: 100%;
            padding: 10px 36px 10px 12px;
            border: 1px solid #d7d7d7;
            border-radius: 8px;
            outline: none;
        }

        .toggle-visibility {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.85rem;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .error-message {
            color: #c62828;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .strength {
            margin: 8px 0 4px;
            height: 8px;
            background: #eee;
            border-radius: 999px;
            overflow: hidden;
        }

        .strength>span {
            display: block;
            height: 100%;
            width: 0%;
            background: #e53935;
            transition: width .25s ease, background .25s ease;
        }

        .criteria {
            list-style: none;
            padding: 0;
            margin: 6px 0 0;
            font-size: 0.85rem;
            color: #666;
        }

        .criteria li {
            margin: 4px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .criteria .ok {
            color: #2e7d32;
        }

        .criteria .bad {
            color: #c62828;
        }

        .muted {
            color: #777;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .notice {
            background: #fff5e6;
            border: 1px solid #ffd8a8;
            color: #8a5a00;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 14px;
            text-align: left;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
        }
    </style>
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

    <script>
        (function () {
            const form = document.getElementById('setPasswordForm');
            const pw = document.getElementById('password');
            const cpw = document.getElementById('confirmPassword');
            const pwErr = document.getElementById('passwordError');
            const cpwErr = document.getElementById('confirmError');
            const strengthBar = document.getElementById('strengthBar');

            const C = {
                len: document.getElementById('c_len'),
                low: document.getElementById('c_low'),
                up: document.getElementById('c_up'),
                num: document.getElementById('c_num'),
                sp: document.getElementById('c_sp'),
            };

            function updateCriterion(el, ok) {
                el.classList.toggle('ok', ok);
                el.classList.toggle('bad', !ok);
            }

            function evaluate(p) {
                const rules = {
                    len: p.length >= 8,
                    low: /[a-z]/.test(p),
                    up: /[A-Z]/.test(p),
                    num: /\d/.test(p),
                    sp: /[!@#$%^&*(),.?":{}|<>\-_[\\/+=]/.test(p),
                };
                const score = Object.values(rules).filter(Boolean).length;
                return { score, rules };
            }

            function paintStrength(score) {
                const pct = (score / 5) * 100;
                strengthBar.style.width = pct + '%';
                let color = '#e53935';
                if (score >= 4) color = '#2e7d32';
                else if (score === 3) color = '#f9a825';
                else if (score === 2) color = '#fb8c00';
                strengthBar.style.background = color;
            }

            function validatePasswordField() {
                const p = pw.value.trim();
                const { score, rules } = evaluate(p);
                updateCriterion(C.len, rules.len);
                updateCriterion(C.low, rules.low);
                updateCriterion(C.up, rules.up);
                updateCriterion(C.num, rules.num);
                updateCriterion(C.sp, rules.sp);
                paintStrength(score);
                pwErr.textContent = '';
                if (!rules.len) pwErr.textContent = 'Password must be at least 8 characters.';
                return score === 5; // require all criteria
            }

            function validateConfirmField() {
                const match = cpw.value === pw.value && cpw.value.trim() !== '';
                cpwErr.textContent = match ? '' : 'Passwords do not match.';
                return match;
            }

            function toggleVis(e) {
                const targetId = e.target.getAttribute('data-target');
                const input = document.getElementById(targetId);
                if (!input) return;
                input.type = input.type === 'password' ? 'text' : 'password';
                e.target.textContent = input.type === 'password' ? 'Show' : 'Hide';
            }

            document.querySelectorAll('.toggle-visibility').forEach((t) => t.addEventListener('click', toggleVis));
            pw.addEventListener('input', () => { validatePasswordField(); validateConfirmField(); });
            cpw.addEventListener('input', validateConfirmField);

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const ok1 = validatePasswordField();
                const ok2 = validateConfirmField();
                if (ok1 && ok2) {
                    form.submit();
                }
            });

            // Initialize view
            paintStrength(0);
        })();
    </script>
</body>

</html>