<?php
   require_once 'includes\\config_session.inc.php';
   require_once 'includes\\register_view.inc.php';
   require_once 'includes\login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Turners</title>
    <link rel="shortcut icon" href="images/books.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/sign2.css">
</head>
<body>
    <div class="form-container">
        <a href="index1.php" class="logo-link">
            <img src="images/page_turners.png" alt="Logo" class="form-logo">
            <p class="logo-text">Back to Where It All Begins</p>
        </a>

        <!-- Register Form -->
        <form action="includes\register.inc.php" method="post" class="register-page">
            <h2>Register</h2>
            <?php
            signup_inputs();
            ?>
            <button class="box" type="submit">REGISTER</button><br>
            <p class = "form-error"></p>
            <p class="form-success"></p>
            <p><a href="sign_in.php">Already have an account? Sign in here.</a></p>
            
    
 
        </form>
        
    </div>

    <?php
    check_signup_errors();
    ?>
</body>
</html>
