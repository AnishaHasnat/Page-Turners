<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: sign_in.php');
    exit();
}
if (!isset($_SESSION['user_id'])) {
    error_log("Session user ID not set."); // Log for debugging
    $_SESSION['error_message'] = "Session expired. Please log in again.";
    header('Location: sign_in.php');
    exit();
}


error_log("Session User ID: " . $_SESSION['user_id']); // Log user ID for debugging
$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_username'];
$email = $_SESSION['user_email'];
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>User Dashboard - User Management</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" href="images/books.png" type="image/x-icon">
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <style>
        /* Dashboard table styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        #wrapper {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        header#header {
            background-color: rgb(91, 82, 38);
            color: #fff;
            padding: 20px 15px;
            text-align: center;
            border-bottom: 3px solid rgb(91, 82, 38);
        }

        header#header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #fff;
        }

        header#header .logo img {
            height: 40px;
            margin-right: 10px;
        }

        header#header .title {
            font-size: 1.5em;
            font-weight: bold;
        }

        #main {
            padding: 20px;
        }

        #main .inner h1 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: rgb(72, 80, 44);
            text-align: center;
        }

        form {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
        }

        form .fields {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form .field {
            display: flex;
            flex-direction: column;
        }

        form .field label {
            font-size: 1em;
            margin-bottom: 5px;
            color: rgb(91, 82, 38);
        }

        form .field input {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            outline: none;
            transition: border-color 0.3s ease;
        }

        form .field input:focus {
            border-color: rgb(91, 82, 38);
        }

        form .actions {
            text-align: center;
            margin-top: 20px;
        }

        form .actions .primary {
            background: rgb(91, 82, 38);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form .actions .primary:hover {
            background: #34495e;
        }

        #footer {
            background: rgb(91, 82, 38);
            color: #fff;
            padding: 10px 15px;
            text-align: center;
            border-top: 3px solid rgb(91, 82, 38);
        }

        #footer p {
            margin: 0;
            font-size: 0.9em;
            line-height: 1.5;
        }

        @media (max-width: 600px) {
            #wrapper {
                margin: 20px;
            }

            form .fields {
                gap: 10px;
            }

            form .actions .primary {
                width: 100%;
            }
        }
    </style>
</head>
<body class="is-preload">
    <div id="wrapper">
        <header id="header">
            <div class="inner">
                <a href="index.php" class="logo">
                    <span class="symbol"><img src="images/page_turners.png" alt="Logo" /></span>
                    <span class="title">Page Turners</span>
                </a>
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>
                <header>
                    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
                    <h4>Update your Profile</h4>
                </header>
            </div>
        </header>

        <nav id="menu">
            <h2>Menu</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="author.html">Author</a></li>
                <li><a href="generic.html">Genre</a></li>
                <li><a href="elements.html">Download</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="admin_panel.html">Admin Panel</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div id="main">
            <div class="inner">
                <header>
                    <h1>Welcome to User Dashboard!</h1><br>
                    <h4>Update your Username, Email & Password</h4>
                </header>
                <?php
                if (isset($_SESSION['update_errors'])) {
                    echo '<div class="form-errors">';
                    foreach ($_SESSION['update_errors'] as $error) {
                        echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
                    }
                    echo '</div>';
                    unset($_SESSION['update_errors']);
                }

                if (isset($_SESSION['update_success'])) {
                    echo '<div class="form-success">';
                    echo '<p>' . htmlspecialchars($_SESSION['update_success'], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '</div>';
                    unset($_SESSION['update_success']);
                }
                ?>
                <form method="POST" action="update_profile2.php">
                    <div class="fields">
                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required />
                        </div>
                        <div class="field">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <div class="field">
                            <label for="password">New Password (leave blank to keep current):</label>
                            <input type="password" name="password" id="password">
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Update Profile" class="primary" /></li>
                    </ul>
                </form>

            </div>
        </div>

        <footer id="footer">
            <div class="inner">
                <section>
                    <h2>Get in touch</h2>
                    <form method="post" action="#">
                        <div class="fields">
                            <div class="field half">
                                <input type="text" name="name" id="name" placeholder="Name" />
                            </div>
                            <div class="field half">
                                <input type="email" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="field">
                                <textarea name="message" id="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="Send" class="primary" /></li>
                        </ul>
                    </form>
                </section>
            </div>
        </footer>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>
