<?php
require __DIR__ . '/db_connect.php';
$flash = get_flash();
$loggedIn = isset($_SESSION['applicant_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElonMusk University | Post-UTME Portal</title>
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
                <a href="index.php" class="active">Home</a>
                <a href="register.php">Register</a>
                <a href="check_status.php">Check Status</a>
                <?php if ($loggedIn): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-grid">
                <div>
                    <p class="eyebrow">Admissions Portal</p>
                    <h1>Apply to ElonMusk University with confidence.</h1>
                    <p class="lead">
                        Start your Post-UTME registration, monitor your application, and stay updated on your screening progress in one secure portal.
                    </p>
                    <div class="cta-row">
                        <a class="btn btn-primary" href="register.php">Register Now</a>
                        <a class="btn btn-secondary" href="login.php">Login</a>
                    </div>
                </div>

                <div class="card highlight">
                    <h2>Admission Snapshot</h2>
                    <ul class="status-list">
                        <li><span>Registration</span><strong>Open</strong></li>
                        <li><span>Application Review</span><strong>Ongoing</strong></li>
                        <li><span>Screening</span><strong>Scheduled</strong></li>
                        <li><span>Results</span><strong>Published</strong></li>
                    </ul>
                </div>
            </div>
        </section>

        <?php if ($flash): ?>
            <div class="container">
                <div class="alert alert-<?= htmlspecialchars($flash['type']); ?>">
                    <?= htmlspecialchars($flash['message']); ?>
                </div>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="container">
                <div class="section-heading">
                    <p class="eyebrow">Why choose us</p>
                    <h2>Simple steps to your future.</h2>
                </div>
                <div class="feature-grid">
                    <article class="card feature">
                        <span class="feature-number">01</span>
                        <h3>Register</h3>
                        <p>Create your account and complete your registration details.</p>
                    </article>
                    <article class="card feature">
                        <span class="feature-number">02</span>
                        <h3>Login</h3>
                        <p>Access your personalized dashboard and application status.</p>
                    </article>
                    <article class="card feature">
                        <span class="feature-number">03</span>
                        <h3>Check Status</h3>
                        <p>Track your screening, payment, and admission updates in real time.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section dark">
            <div class="container contact-grid">
                <div>
                    <p class="eyebrow">Need support?</p>
                    <h2>Contact the admissions office.</h2>
                    <p>We are available to help with registration, payment, and screening support.</p>
                </div>

                <div class="card contact-card">
                    <p>Email: admissions@elonmuskuniversity.edu</p>
                    <p>Phone: +234 800 000 0000</p>
                    <p>Office Hours: Mon - Fri, 8:00 AM - 4:00 PM</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-wrap">
            <p>© 2026 ElonMusk University. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
