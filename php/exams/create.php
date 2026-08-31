<?php
// php/exams/create.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $title = $conn->real_escape_string($input['title'] ?? '');
    $description = $conn->real_escape_string($input['description'] ?? '');
    $subject = $conn->real_escape_string($input['subject'] ?? '');
    $duration = intval($input['duration'] ?? 60);
    $totalQuestions = intval($input['totalQuestions'] ?? 0);
    $passingScore = intval($input['passingScore'] ?? 0);
    $totalMarks = intval($input['totalMarks'] ?? 0);
    $examDate = $conn->real_escape_string($input['examDate'] ?? '');
    $startTime = $conn->real_escape_string($input['startTime'] ?? '');
    $endTime = $conn->real_escape_string($input['endTime'] ?? '');
    $venue = $conn->real_escape_string($input['venue'] ?? '');
    $status = $conn->real_escape_string($input['status'] ?? 'scheduled');
    $instructions = $conn->real_escape_string($input['instructions'] ?? '');
    $maxAttempts = intval($input['maxAttempts'] ?? 1);

    $query = "INSERT INTO exams (title, description, subject, duration, totalQuestions, passingScore, totalMarks, examDate, startTime, endTime, venue, status, instructions, maxAttempts) 
              VALUES ('$title', '$description', '$subject', $duration, $totalQuestions, $passingScore, $totalMarks, '$examDate', '$startTime', '$endTime', '$venue', '$status', '$instructions', $maxAttempts)";

    if ($conn->query($query) === TRUE) {
        $exam_id = $conn->insert_id;
        sendResponse(true, 'Exam created successfully', ['exam_id' => $exam_id]);
    } else {
        sendResponse(false, 'Exam creation failed: ' . $conn->error);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
