<?php
// php/exams/get_exams.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, title, description, subject, duration, totalQuestions, passingScore, totalMarks, examDate, startTime, endTime, venue, status, instructions, maxAttempts FROM exams ORDER BY examDate ASC";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $exams = [];
        while ($row = $result->fetch_assoc()) {
            $exams[] = $row;
        }
        sendResponse(true, 'Exams retrieved', ['exams' => $exams, 'count' => count($exams)]);
    } else {
        sendResponse(true, 'No exams found', ['exams' => [], 'count' => 0]);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
