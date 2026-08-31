<?php
// php/auth/login.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!isset($input['email'], $input['password'])) {
        sendResponse(false, 'Missing required fields');
    }

    $email = $conn->real_escape_string($input['email']);
    $password = $input['password'];

    // Find student
    $query = "SELECT id, firstName, lastName, email, password, registrationNumber FROM students WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows === 0) {
        sendResponse(false, 'Invalid credentials');
    }

    $student = $result->fetch_assoc();

    // Verify password
    if (!password_verify($password, $student['password'])) {
        sendResponse(false, 'Invalid credentials');
    }

    // Set session
    $_SESSION['student_id'] = $student['id'];

    $response = [
        'student' => [
            'id' => $student['id'],
            'firstName' => $student['firstName'],
            'lastName' => $student['lastName'],
            'email' => $student['email'],
            'registrationNumber' => $student['registrationNumber']
        ],
        'token' => session_id()
    ];

    sendResponse(true, 'Login successful', $response);
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
