<?php
require __DIR__ . '/db_connect.php';
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ElonMusk University</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <div class="brand">
                <span class="brand-mark">ElonMusk</span>
                <span class="brand-sub">University</span>
            </div>
            <nav class="main-nav" aria-label="Primary navigation">
                <a href="index.php">Home</a>
                <a href="register.php" class="active">Register</a>
                <a href="check_status.php">Check Status</a>
                <a href="login.php">Login</a>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        <div class="container form-layout">
            <div class="card form-card">
                <p class="eyebrow">Create account</p>
                <h1>Post-UTME Registration</h1>

                <?php if ($flash): ?>
                    <div class="alert alert-<?= htmlspecialchars($flash['type']); ?>">
                        <?= htmlspecialchars($flash['message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['db_error'])): ?>
                    <div class="alert alert-error"><?= htmlspecialchars($_SESSION['db_error']); ?></div>
                    <?php unset($_SESSION['db_error']); ?>
                <?php endif; ?>

                <form action="register_process.php" method="post" novalidate>
                    <div class="field-row two-up">
                        <div class="field-group">
                            <label for="full_name">Full name</label>
                            <input id="full_name" name="full_name" type="text" required>
                        </div>
                        <div class="field-group">
                            <label for="programme">Preferred programme</label>
                            <input id="programme" name="programme" type="text" required>
                        </div>
                    </div>

                    <div class="field-row two-up">
                        <div class="field-group">
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email" required>
                        </div>
                        <div class="field-group">
                            <label for="phone">Phone number</label>
                            <input id="phone" name="phone" type="tel" required>
                        </div>
                    </div>

                    <div class="field-row two-up">
                        <div class="field-group">
                            <label for="jamb_reg_number">JAMB registration number</label>
                            <input id="jamb_reg_number" name="jamb_reg_number" type="text" required>
                        </div>
                        <div class="field-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="confirm_password">Confirm password</label>
                        <input id="confirm_password" name="confirm_password" type="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary full-width">Register</button>
                </form>

                <p class="meta-link">Already registered? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
