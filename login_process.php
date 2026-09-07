<?php
require __DIR__ . '/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Invalid request.');
    redirect('login.php');
}

if (!isset($_POST['email'], $_POST['password']) || trim($_POST['email']) === '' || trim($_POST['password']) === '') {
    set_flash('error', 'Email and password are required.');
    redirect('login.php');
}

$email = strtolower(trim($_POST['email']));
$password = $_POST['password'];

if (!$conn) {
    set_flash('error', 'The database is currently unavailable.');
    redirect('login.php');
}

$stmt = $conn->prepare('SELECT id, full_name, email, password_hash, status FROM applicants WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    set_flash('error', 'Invalid email or password.');
    redirect('login.php');
}

$applicant = $result->fetch_assoc();

if (!password_verify($password, $applicant['password_hash'])) {
    set_flash('error', 'Invalid email or password.');
    redirect('login.php');
}

$_SESSION['applicant_id'] = (int) $applicant['id'];
$_SESSION['applicant_name'] = $applicant['full_name'];
$_SESSION['applicant_email'] = $applicant['email'];

set_flash('success', 'Login successful. Welcome back!');
redirect('dashboard.php');
