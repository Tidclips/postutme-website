<?php
require __DIR__ . '/db_connect.php';
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ElonMusk University</title>
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
                <a href="register.php">Register</a>
                <a href="check_status.php">Check Status</a>
                <a href="login.php" class="active">Login</a>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        <div class="container form-layout">
            <div class="card form-card">
                <p class="eyebrow">Welcome back</p>
                <h1>Applicant Login</h1>

                <?php if ($flash): ?>
                    <div class="alert alert-<?= htmlspecialchars($flash['type']); ?>"><?= htmlspecialchars($flash['message']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['db_error'])): ?>
                    <div class="alert alert-error"><?= htmlspecialchars($_SESSION['db_error']); ?></div>
                    <?php unset($_SESSION['db_error']); ?>
                <?php endif; ?>

                <form action="login_process.php" method="post">
                    <div class="field-group">
                        <label for="email">Email address</label>
                        <input id="email" name="email" type="email" required>
                    </div>

                    <div class="field-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary full-width">Login</button>
                </form>

                <p class="meta-link">New student? <a href="register.php">Create an account</a></p>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
