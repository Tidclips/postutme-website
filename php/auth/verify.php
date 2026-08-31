<?php
// php/auth/verify.php

require '../config.php';

// Check if user has session
if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    sendResponse(false, 'No token provided');
}

$student_id = $_SESSION['student_id'];
sendResponse(true, 'Token verified', ['studentId' => $student_id]);
?>
