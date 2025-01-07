<?php

declare(strict_types=1);

function signup_inputs(){

    if(isset($_SESSION["signup_data"]['username']) && !isset($_SESSION['errors_signup']['username_taken'])) {
       echo '<input type="text" name="username" placeholder="Enter Username"  value = "'.$_SESSION["signup_data"]['username'].'"><br>';
    
    }else {
       echo '<input type="text" name="username" placeholder="Enter Username"><br>';
     
    }
    
    if(isset($_SESSION["signup_data"]['email']) && !isset($_SESSION['errors_signup']['email_used'])&& !isset($_SESSION['errors_signup']['invalid_email'])) {
        echo ' <input type="email" name="email" placeholder="Enter Email" value = "'.$_SESSION["signup_data"]['email'].'"><br>';
     }else {
        echo ' <input type="email" name="email" placeholder="Enter Email"><br>';
     }
    echo '<input type="password" name="password" placeholder="Enter Password"><br>';
    
}

function check_signup_errors(){
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup']; // Correct variable name
        
        echo "<br>";
        
        foreach ($errors as $error){ // Corrected $errors variable
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
   
        }
        
        unset($_SESSION['errors_signup']);
    }else if(isset($_GET['signup']) && $_GET['signup'] === "success" ){
        echo '<br>';
        echo '<p class="form-success">Signup success!</p>';

    }
}
