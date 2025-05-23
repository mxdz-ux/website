<?php
session_start();

// Check if the session variable name is provided
if (isset($_GET['var']) && !empty($_GET['var'])) {
    $var = $_GET['var'];
      // Clear the specified session variable
    if (isset($_SESSION[$var])) {
        unset($_SESSION[$var]);
        // Also clear category when clearing borrowed status
        if ($var === 'borrowed') {
            unset($_SESSION['borrowed_category']);
        }
    }
    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} else {
    // Return error response
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No session variable specified']);
}
?>