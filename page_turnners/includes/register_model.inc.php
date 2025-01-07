<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {
    $query = 'SELECT user_name FROM user WHERE user_name = :username;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email) {
    $query = 'SELECT email FROM user WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $email, string $pwd, string $username) {
    // Validate password
    if (empty($pwd)) {
        throw new InvalidArgumentException("Password cannot be empty");
    }

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT); // Fixed issue with null

    $query = 'INSERT INTO user (email, password, user_name) VALUES (:email, :password, :username);';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPwd);
    $stmt->bindParam(":username", $username);

    $stmt->execute();
}
