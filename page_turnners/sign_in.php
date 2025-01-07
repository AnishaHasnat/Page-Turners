<?php
require_once 'includes\config_session.inc.php';
require_once 'includes\register_view.inc.php';
require_once 'includes\login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Turners</title>
</head>
<link rel="shortcut icon" href="images/books.png" type="image/x-icon">

<link rel="stylesheet" href="assets/css/sign2.css">
<body>
   <!-- Logo -->
   <div class="form-container">
    <a href="index.php" class="logo-link">
        <img src="images/page_turners.png" alt="Logo" class="form-logo">
        <p class="logo-text"> Back to Where It All Begins  </p>
    </a>
    
    <form method = "post" action="includes\signin.inc.php">
        <h2>Sign in</h2>
        
        <input type="text" name="username" placeholder="Enter username">
        
        <input type="password" name="password" placeholder="Enter password">
       
        <button class="box">SIGN IN</button>
        <p class = "form-error"></p>
        <p class = "form-success"></p>

    </form>
    
    <?php
    check_login_errors();

    ?>
</body>
</html>