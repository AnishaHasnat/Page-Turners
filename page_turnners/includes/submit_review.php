<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "page_turners";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the latest user_id and increment it
    $result = $conn->query("SELECT MAX(user_id) AS max_user_id FROM user");
    $row = $result->fetch_assoc();
    $user_id = $row['max_user_id'] ? $row['max_user_id'] + 1 : 1; // Start with 1 if no records exist

    // Ensure the new user_id exists in the user table
    $conn->query("INSERT INTO user (user_id) VALUES ($user_id)");

    $admin_id = 1; // Replace with relevant admin ID
    $comment = trim($_POST['review']);
    $user_rating = isset($_POST['rating']) ? intval($_POST['rating']) : NULL; // Optional rating input
    $book_link = isset($_POST['book']) ? intval($_POST['book']) : NULL; // Optional book input

    // Validate input
    if (!empty($comment)) {
        // Insert review into database
        $stmt = $conn->prepare("INSERT INTO review (user_id, admin_id, Comment, user_rating, book_link) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisii", $user_id, $admin_id, $comment, $user_rating, $book_link);

        if ($stmt->execute()) {
            echo "Review submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please write a review before submitting.";
    }
}

$conn->close();
?>
