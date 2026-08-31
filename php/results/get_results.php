<?php
// php/results/get_results.php

require '../config.php';

if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    sendResponse(false, 'Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $student_id = $_SESSION['student_id'];
    
    $query = "SELECT r.id, r.studentId, r.examId, r.score, r.totalMarks, r.percentage, r.grade, r.status, r.completedAt, e.title as examTitle, e.subject 
              FROM results r 
              LEFT JOIN exams e ON r.examId = e.id 
              WHERE r.studentId = $student_id";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        sendResponse(true, 'Results retrieved', ['results' => $results, 'count' => count($results)]);
    } else {
        sendResponse(true, 'No results found', ['results' => [], 'count' => 0]);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
