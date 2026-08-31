<?php
// php/students/list.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, firstName, lastName, email, registrationNumber, registrationStatus, paymentStatus, admissionStatus FROM students";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        sendResponse(true, 'Students retrieved', ['students' => $students, 'count' => count($students)]);
    } else {
        sendResponse(true, 'No students found', ['students' => [], 'count' => 0]);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
