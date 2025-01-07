<?php
declare(strict_types=1);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        die("User not logged in."); // Ensure the user is logged in
    }

    if (!isset($_SESSION['user_id'])) {
        die("Session user ID not set."); // Check if user_id exists
    }
    $user_id = $_SESSION['user_id'];

    require_once 'includes/dbh.inc.php'; // Database connection

    if (!$pdo) {
        die("Database connection failed."); // Confirm connection works
    }

    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = $_POST['password'] ?? '';

    // Log input data
    error_log("Username: $new_username, Email: $new_email, Password: " . (!empty($new_password) ? "Provided" : "Not Provided"));

    $errors = [];

    if (empty($new_username) || empty($new_email)) {
        $errors[] = 'Username and email are required.';
    }
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if ($errors) {
        $_SESSION['update_errors'] = $errors;
        header('Location: user_dashboard.php');
        exit();
    }

    try {
        // Construct query
        $query = 'UPDATE user SET user_name = :username, email = :email';
        if (!empty($new_password)) {
            $query .= ', password = :password';
        }
        $query .= ' WHERE user_id = :id';

        $stmt = $pdo->prepare($query);

        // Log the query and parameters
        error_log("SQL Query: $query");
        error_log("Parameters: username = $new_username, email = $new_email, user_id = $user_id");
        if (!empty($new_password)) {
            error_log("Password is being updated.");
        }

        $stmt->bindValue(':username', $new_username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $new_email, PDO::PARAM_STR);
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        }
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

        // Check affected rows
        $affectedRows = $stmt->rowCount();
        error_log("Rows affected: " . $affectedRows);

        if ($affectedRows === 0) {
            error_log("No rows updated. Either the ID doesn't match or data is identical.");
            $_SESSION['update_errors'] = ['No changes made. Ensure the new values differ from the current ones.'];
            header('Location: user_dashboard.php');
            exit();
        }

        $_SESSION['user_username'] = htmlspecialchars($new_username, ENT_QUOTES, 'UTF-8');
        $_SESSION['user_email'] = htmlspecialchars($new_email, ENT_QUOTES, 'UTF-8');
        $_SESSION['update_success'] = 'Profile updated successfully!';
        header('Location: user_dashboard.php');
        exit();

    } catch (PDOException $e) {
        error_log("Database update error: " . $e->getMessage());
        $_SESSION['update_errors'] = ['Failed to update profile. Please try again.'];
        header('Location: user_dashboard.php');
        exit();
    }
}
