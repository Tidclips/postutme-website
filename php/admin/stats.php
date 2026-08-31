<?php
// php/admin/stats.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $totalStudents = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'];
    $totalExams = $conn->query("SELECT COUNT(*) as count FROM exams")->fetch_assoc()['count'];
    $totalResults = $conn->query("SELECT COUNT(*) as count FROM results")->fetch_assoc()['count'];
    $registeredStudents = $conn->query("SELECT COUNT(*) as count FROM students WHERE registrationStatus = 'completed'")->fetch_assoc()['count'];
    $paidStudents = $conn->query("SELECT COUNT(*) as count FROM students WHERE paymentStatus = 'completed'")->fetch_assoc()['count'];
    $admittedStudents = $conn->query("SELECT COUNT(*) as count FROM students WHERE admissionStatus = 'admitted'")->fetch_assoc()['count'];

    $stats = [
        'totalStudents' => intval($totalStudents),
        'totalExams' => intval($totalExams),
        'totalResults' => intval($totalResults),
        'registeredStudents' => intval($registeredStudents),
        'paidStudents' => intval($paidStudents),
        'admittedStudents' => intval($admittedStudents)
    ];

    sendResponse(true, 'Stats retrieved', ['stats' => $stats]);
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
