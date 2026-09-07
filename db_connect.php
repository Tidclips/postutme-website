<?php
session_start();

const DB_HOST = 'localhost';
const DB_PORT = 3307;
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'elonmusk_postutme_db';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

if ($conn && $conn->connect_error) {
    $_SESSION['db_error'] = 'Database connection failed: ' . $conn->connect_error;
    $conn = null;
}

function set_flash($type, $message)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash()
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function require_login()
{
    if (!isset($_SESSION['applicant_id'])) {
        set_flash('error', 'Please log in to access your dashboard.');
        redirect('login.php');
    }
}
