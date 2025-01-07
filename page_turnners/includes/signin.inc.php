<?php

ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];
        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = 'Fill in all fields!';
        }
        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors['login_incorrect'] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($password, $result["password"])) {
            $errors['login_incorrect'] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header('Location: ../sign_in.php');
            die();
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result['user_id'];
        $_SESSION["user_username"] = htmlspecialchars($result['username']);
        $_SESSION["user_email"] = htmlspecialchars($result['email']);
        $_SESSION["last_regeneration"] = time();
        $_SESSION['logged_in'] = true;

        header('Location: ../user_dashboard.php');
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../sign_in.php'); // Redirect to login page if accessed directly
    die();
}
