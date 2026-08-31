<?php
// php/payments/payment.php

require '../config.php';

if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    sendResponse(false, 'Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $student_id = $_SESSION['student_id'];
    $amount = $input['amount'] ?? 5000;
    $paymentReference = 'PAY' . time();

    $query = "SELECT email, firstName, lastName FROM students WHERE id = $student_id";
    $result = $conn->query($query);
    $student = $result->fetch_assoc();

    $response = [
        'paymentReference' => $paymentReference,
        'amount' => $amount,
        'studentEmail' => $student['email'],
        'studentName' => $student['firstName'] . ' ' . $student['lastName']
    ];

    sendResponse(true, 'Payment initiated', $response);
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
