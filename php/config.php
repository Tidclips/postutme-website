<?php
// config.php - Database Connection Configuration

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); // Default XAMPP password is empty
define('DB_NAME', 'postutme_db');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    die();
}

// Set charset to UTF-8
$conn->set_charset("utf8");

// Set headers for JSON responses
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    die();
}

// Helper function to send JSON response
function sendResponse($success, $message, $data = null) {
    $response = ['success' => $success, 'message' => $message];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit();
}

// Helper function to validate token
function verifyToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        sendResponse(false, 'No token provided');
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    
    // Decode JWT (simplified - in production use proper JWT library)
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        sendResponse(false, 'Invalid token');
    }

    // For now, we'll store session data in session
    if (!isset($_SESSION['student_id'])) {
        sendResponse(false, 'Invalid token');
    }

    return $_SESSION['student_id'];
}

session_start();
?>
