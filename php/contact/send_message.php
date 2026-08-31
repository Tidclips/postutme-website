<?php
// php/contact/send_message.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $name = $conn->real_escape_string($input['name'] ?? '');
    $email = $conn->real_escape_string($input['email'] ?? '');
    $subject = $conn->real_escape_string($input['subject'] ?? '');
    $message = $conn->real_escape_string($input['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        sendResponse(false, 'Missing required fields');
    }

    // Insert contact message
    $query = "INSERT INTO contact_messages (name, email, subject, message, createdAt) 
              VALUES ('$name', '$email', '$subject', '$message', NOW())";

    if ($conn->query($query) === TRUE) {
        // In a real scenario, you would send emails here
        sendResponse(true, 'Your message has been sent successfully. We will respond shortly.');
    } else {
        sendResponse(false, 'Error sending message: ' . $conn->error);
    }
} else {
    http_response_code(405);
    sendResponse(false, 'Method not allowed');
}
?>
