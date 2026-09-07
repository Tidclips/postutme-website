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
    <title>Dashboard | ElonMusk University</title>
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
                <a href="check_status.php">Check Status</a>
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        <div class="container dashboard-layout">
            <aside class="card sidebar">
                <h2>Applicant Menu</h2>
                <ul class="menu-list">
                    <li><a href="dashboard.php">Overview</a></li>
                    <li><a href="check_status.php">Status</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </aside>

            <section class="content-panel">
                <div class="card panel-header">
                    <div>
                        <p class="eyebrow">Dashboard</p>
                        <h1>Welcome, <?= htmlspecialchars($applicant['full_name']); ?></h1>
                    </div>
                    <span class="status-pill status-<?= htmlspecialchars(strtolower($applicant['status'])); ?>"><?= htmlspecialchars(ucfirst($applicant['status'])); ?></span>
                </div>

                <?php if ($flash): ?>
                    <div class="alert alert-<?= htmlspecialchars($flash['type']); ?>"><?= htmlspecialchars($flash['message']); ?></div>
                <?php endif; ?>

                <div class="info-grid">
                    <div class="card info-box">
                        <h3>Application Status</h3>
                        <p><?= htmlspecialchars(ucfirst($applicant['status'])); ?></p>
                    </div>
                    <div class="card info-box">
                        <h3>Email</h3>
                        <p><?= htmlspecialchars($applicant['email']); ?></p>
                    </div>
                    <div class="card info-box">
                        <h3>Programme</h3>
                        <p><?= htmlspecialchars($applicant['programme'] ?: 'Not set'); ?></p>
                    </div>
                    <div class="card info-box">
                        <h3>JAMB Reg. No</h3>
                        <p><?= htmlspecialchars($applicant['jamb_reg_number']); ?></p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-wrap">
            <p>© 2026 ElonMusk University.</p>
        </div>
    </footer>
</body>
</html>
