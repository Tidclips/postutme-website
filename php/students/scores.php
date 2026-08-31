<?php
// php/students/scores.php

require '../config.php';

if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    sendResponse(false, 'Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $student_id = $_SESSION['student_id'];

    $jamb_score = $input['jamb_score'] ?? null;
    $waec_score = $input['waec_score'] ?? null;
    $neco_score = $input['neco_score'] ?? null;
    $utme_score = $input['utme_score'] ?? null;
    $o_level_results = $conn->real_escape_string($input['o_level_results'] ?? '');

    $query = "UPDATE students SET jamb_score=$jamb_score, waec_score=$waec_score, neco_score=$neco_score, utme_score=$utme_score, o_level_results='$o_level_results', updatedAt=NOW() WHERE id=$student_id";

    if ($conn->query($query) === TRUE) {
        $selectQuery = "SELECT * FROM students WHERE id = $student_id";
        $result = $conn->query($selectQuery);
        $student = $result->fetch_assoc();
        
        sendResponse(true, 'Scores updated successfully', ['student' => $student]);
    } else {
        sendResponse(false, 'Update failed: ' . $conn->error);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
