<?php

declare(strict_types=1);

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        unset($_SESSION['errors_login']);
    } else if (isset($_GET['login']) && $_GET['login'] === 'success') {
        echo '<br>';
        echo '<p class = "form-success">Signin success!</p>';
    }
}
