<?php
session_start();

error_log("check_auth.php: Checking authentication..."); // Added log at start

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    error_log("check_auth.php: User is authenticated (User ID: " . $_SESSION['user_id'] . ", Role: " . $_SESSION['role'] . ")"); // Log if authenticated
    return true; // User is authenticated
} else {
    error_log("check_auth.php: User is NOT authenticated, but NOT redirecting to login.php (DEBUGGING)"); // Log if not authenticated
    // header('Location: /bolt/auth/login.php'); // Commented out redirect for debugging
    // exit; // Commented out exit for debugging
}
?>
