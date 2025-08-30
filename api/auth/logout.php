
<?php
require_once '../../inc/bootstrap.php';

header('Content-Type: application/json');

session_start();

// Clear session
session_destroy();

// Clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
