<!-- this is the sign up page -->

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    try {
        require_once "dbh.inc.php";
        require_once "register_model.inc.php";
        require_once "register_contr.inc.php";
        require_once "register_view.inc.php";
        //ERROR HANDLERS
         $errors = [];
         if (is_input_empty($username,$password,$email)){
            $errors["empty_input"] = 'Fill in all fields!';
         }
         if (is_email_invalid($email)){
            $errors['invalid_email'] = "Invalid email used!";
         }
         if (is_username_taken($pdo, $username)){
            $errors['username_taken'] = "Username already taken!";
         }
         if (is_email_registered( $pdo,  $email)){
            $errors['email_used'] = "Email already registered!";
         }
         require_once 'config_session.inc.php';

         if ($errors){
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
               "username" => $username,
               "email" => $email

            ];
            $_SESSION['signup_data'] = $signupData;
            header("includes\signin.inc.php"); //signin er location
            die();
         }
         create_user($pdo, $email, $password, $username);

         header("location: ../index_reg&signin.php");
         $pdo = null;
         $stmt = null;
         die();
         

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    // echo htmlspecialchars($username);# outputing in the browser
} else {
    header("location: ../index_reg&signin.php");
    die();
}