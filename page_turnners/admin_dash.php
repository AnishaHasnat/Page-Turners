<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to login if not logged in
    exit;
}

// Include the dashboard code (use the code from the review table dashboard here)
include 'admin_review_panel.php';
?>
