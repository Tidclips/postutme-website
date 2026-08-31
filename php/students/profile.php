<?php
// php/students/profile.php

require '../config.php';

if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    sendResponse(false, 'Unauthorized');
}

$student_id = $_SESSION['student_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get student profile
    $query = "SELECT id, firstName, lastName, email, phoneNumber, dateOfBirth, gender, jamb_score, waec_score, neco_score, utme_score, o_level_results, programme, registrationNumber, registrationDate, registrationStatus, paymentStatus, paymentAmount, examStatus, examScore, admissionStatus, state, lga, address FROM students WHERE id = $student_id";
    
    $result = $conn->query($query);
    
    if ($result->num_rows === 0) {
        http_response_code(404);
        sendResponse(false, 'Student not found');
    }

    $student = $result->fetch_assoc();
    sendResponse(true, 'Profile retrieved', ['student' => $student]);

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Update student profile
    $input = json_decode(file_get_contents('php://input'), true);

    $firstName = $conn->real_escape_string($input['firstName'] ?? '');
    $lastName = $conn->real_escape_string($input['lastName'] ?? '');
    $phoneNumber = $conn->real_escape_string($input['phoneNumber'] ?? '');
    $dateOfBirth = $conn->real_escape_string($input['dateOfBirth'] ?? '');
    $gender = $conn->real_escape_string($input['gender'] ?? '');
    $state = $conn->real_escape_string($input['state'] ?? '');
    $lga = $conn->real_escape_string($input['lga'] ?? '');
    $address = $conn->real_escape_string($input['address'] ?? '');

    $query = "UPDATE students SET firstName='$firstName', lastName='$lastName', phoneNumber='$phoneNumber', dateOfBirth='$dateOfBirth', gender='$gender', state='$state', lga='$lga', address='$address', updatedAt=NOW() WHERE id=$student_id";

    if ($conn->query($query) === TRUE) {
        // Fetch updated student
        $selectQuery = "SELECT * FROM students WHERE id = $student_id";
        $result = $conn->query($selectQuery);
        $student = $result->fetch_assoc();
        
        sendResponse(true, 'Profile updated successfully', ['student' => $student]);
    } else {
        sendResponse(false, 'Update failed: ' . $conn->error);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
