<?php
// php/auth/register.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!isset($input['firstName'], $input['lastName'], $input['email'], $input['password'], $input['phoneNumber'])) {
        sendResponse(false, 'Missing required fields');
    }

    $firstName = $conn->real_escape_string($input['firstName']);
    $lastName = $conn->real_escape_string($input['lastName']);
    $email = $conn->real_escape_string($input['email']);
    $phoneNumber = $conn->real_escape_string($input['phoneNumber']);
    $password = password_hash($input['password'], PASSWORD_DEFAULT);
    $registrationNumber = 'PUTME' . time();

    // Check if student already exists
    $checkQuery = "SELECT id FROM students WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        sendResponse(false, 'Student already exists');
    }

    // Insert new student
    $query = "INSERT INTO students (firstName, lastName, email, phoneNumber, password, registrationNumber, registrationStatus, paymentStatus, examStatus, admissionStatus, createdAt) 
              VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$password', '$registrationNumber', 'pending', 'pending', 'not_taken', 'pending', NOW())";

    if ($conn->query($query) === TRUE) {
        $student_id = $conn->insert_id;
        $_SESSION['student_id'] = $student_id;

        $student = [
            'id' => $student_id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'registrationNumber' => $registrationNumber
        ];

        sendResponse(true, 'Registration successful', ['student' => $student, 'token' => session_id()]);
    } else {
        sendResponse(false, 'Registration failed: ' . $conn->error);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
