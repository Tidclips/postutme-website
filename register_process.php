<?php
require __DIR__ . '/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Invalid request.');
    redirect('register.php');
}

$requiredFields = ['full_name', 'email', 'jamb_reg_number', 'phone', 'programme', 'password', 'confirm_password'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        set_flash('error', 'Please complete all required fields.');
        redirect('register.php');
    }
}

$fullName = trim($_POST['full_name']);
$email = strtolower(trim($_POST['email']));
$jambRegNumber = strtoupper(trim($_POST['jamb_reg_number']));
$phone = trim($_POST['phone']);
$programme = trim($_POST['programme']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (strlen($password) < 6) {
    set_flash('error', 'Password must be at least 6 characters long.');
    redirect('register.php');
}

if ($password !== $confirmPassword) {
    set_flash('error', 'Passwords do not match.');
    redirect('register.php');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_flash('error', 'Please enter a valid email address.');
    redirect('register.php');
}

if (!$conn) {
    set_flash('error', 'The database is currently unavailable. Please try again later.');
    redirect('register.php');
}

$stmt = $conn->prepare('SELECT id FROM applicants WHERE email = ? OR jamb_reg_number = ? LIMIT 1');
$stmt->bind_param('ss', $email, $jambRegNumber);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    set_flash('error', 'An applicant with that email or JAMB registration number already exists.');
    redirect('register.php');
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$insert = $conn->prepare('INSERT INTO applicants (full_name, email, jamb_reg_number, phone, programme, password_hash, status, created_at) VALUES (?, ?, ?, ?, ?, ?, "pending", NOW())');
$insert->bind_param('ssssss', $fullName, $email, $jambRegNumber, $phone, $programme, $passwordHash);

if ($insert->execute()) {
    set_flash('success', 'Registration successful. Please log in to continue.');
    redirect('login.php');
}

set_flash('error', 'Registration failed: ' . $conn->error);
redirect('register.php');
