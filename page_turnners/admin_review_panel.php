<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = ''; // Use your DB password
$dbname = 'page_turners';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion of reviews
if (isset($_POST['delete'])) {
    $user_id = intval($_POST['user_id']);
    $delete_query = "DELETE FROM review WHERE user_id = ?";

    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Review deleted successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error deleting review: " . $conn->error . "</p>";
    }
    $stmt->close();
}

// Fetch reviews
$query = "SELECT user_id, admin_id, Comment, user_rating, book_link, status FROM review ORDER BY user_id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Reviews</title>
    <a href="index.html" class="logo-link">
        <img src="images/page_turners.png" alt="Logo" class="form-logo">
        <p class="logo-text"> Back to Where It All Begins  </p>
    </a>
    <link rel="stylesheet" href="assets\css\review.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - Reviews</h1>
    
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Admin ID</th>
                <th>Comment</th>
                <th>User Rating</th>
                <th>Book Link</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['admin_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['Comment']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_rating']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['book_link']); ?>" target="_blank">View</a></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No reviews found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</body>
</html>
