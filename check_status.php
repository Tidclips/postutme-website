<?php
require __DIR__ . '/db_connect.php';
require_login();

$applicantId = (int) $_SESSION['applicant_id'];
$stmt = $conn->prepare('SELECT * FROM applicants WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $applicantId);
$stmt->execute();
$applicant = $stmt->get_result()->fetch_assoc();

if (!$applicant) {
    session_destroy();
    set_flash('error', 'Your session is invalid. Please log in again.');
    redirect('login.php');
}

$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Status | ElonMusk University</title>
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
                <a href="check_status.php" class="active">Check Status</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        <div class="container form-layout">
            <div class="card form-card">
                <p class="eyebrow">Application tracking</p>
                <h1>Check Your Status</h1>

                <?php if ($flash): ?>
                    <div class="alert alert-<?= htmlspecialchars($flash['type']); ?>"><?= htmlspecialchars($flash['message']); ?></div>
                <?php endif; ?>

                <div class="status-summary">
                    <p><strong>Full name:</strong> <?= htmlspecialchars($applicant['full_name']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($applicant['email']); ?></p>
                    <p><strong>Programme:</strong> <?= htmlspecialchars($applicant['programme'] ?: 'Not provided'); ?></p>
                    <p><strong>JAMB Reg. No:</strong> <?= htmlspecialchars($applicant['jamb_reg_number']); ?></p>
                    <p><strong>Application Status:</strong> <span class="status-pill status-<?= htmlspecialchars(strtolower($applicant['status'])); ?>"><?= htmlspecialchars(ucfirst($applicant['status'])); ?></span></p>
                    <p><strong>Created:</strong> <?= htmlspecialchars($applicant['created_at']); ?></p>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-wrap">
            <p>© 2026 ElonMusk University.</p>
        </div>
    </footer>
</body>
</html>
