<?php
    $author = (isset($_GET['author']) ? $_GET['author'] : '');
    require_once ('db_connect.php');
    $sql = "SELECT * FROM author a JOIN biography b ON a.Author_id = b.Author_id WHERE b.Author_id = '$author';";
    $result = mysqli_query($conn, $sql)->fetch_assoc();
function get_author($Author_id) {
    include 'db_connect.php';
    $sql_author = "SELECT a.Author_Name FROM author a JOIN biography b ON a.Author_id = b.Author_id WHERE b.Author_id = '$Author_id';";
    $result = mysqli_query($conn, $sql_author);

    // Check if the query was successful and if a result was returned
    if ($result && $row = $result->fetch_assoc()) {
        $authorInfo = [
            'name' => $row['Author_Name'],
            'image' => $row['author_img']
        ];
    } else {
        // Handle error or empty result
        $authorInfo = null; // or some default value
        error_log("Query failed or no result found: " . mysqli_error($conn));
    }
    
    // Return or use the $authorInfo array
    return $authorInfo;
}
?>

<!DOCTYPE HTML>

<!--
    Phantom by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Page Turners</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets\css\author.css" />

        <link rel="shortcut icon" href="images/books.png" type="image/x-icon">

        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <!-- <style>
            .author-content .img-size{
                width: 400px;
            }
        </style> -->
    </head>
    <body class="is-preload">
        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Header -->
                    <header id="header">
                        <div class="inner">

                            <!-- Logo -->
                                <a href="index.php" class="logo">
                                    <span class="symbol"><img src="images/page_turners.png" alt="" /></span><span class="title">Page Turners</span>
                                </a>

                            <!-- Nav -->
                                <nav>
                                    <ul>
                                        <li><a href="#menu">Menu</a></li>
                                        <li>
                                            <img src="images/moon_icon.png" id='theme-toggle' alt='Toggle Theme'>
                                        </li>                               
                                    </ul>
                                </nav>

                        </div>
                    </header>

                <!-- Menu -->
                    <nav id="menu">
                        <h2>Menu</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="author_f.php">Author</a></li>
                            <li><a href="generic.html">Genre</a></li>
                            <!-- <li><a href="elements.html">Download</a></li> -->
                            <li><a href="index_reg&signin.php">Register</a></li>
                            <li><a href="admin_login.php">Admin Panel</a></li>
                        </ul>
                    </nav>
                <!-- Main -->
                    <div id="main">
                        <div class="inner">
                            <!-- Author Content -->

                             <div class="author-content">
                                <span ><img src="<?php echo $result['author_img']; ?>" alt="img" style="width: 260px;height: 260px;border-radius: 50%;margin-bottom: 15px;object-fit: cover;border: 2px solid #585858;"/></span>
                                <div class="author-details">
                                    <h2><?php echo $result['Author_Name']; ?></h2>
                                    <p><strong>Birth Date:</strong><?php echo $result['Date_of_Birth']; ?></p>
                                    <p><strong>Description:</strong><?php echo $result['description']; ?> </p>
                                    <p><strong>Famous Works:</strong> <?php echo $result['Famous_Work']; ?></p>
                                    <p><strong>Awards Won:</strong> <?php echo $result['Award']; ?></p>
                                </div>
                            </div>
                            
    

                            <!-- Rating and Review Section -->
                            <!-- <div class="rating-review">
                                <br><h2>Ratings & Reviews</h2>
                                <h3>What do you think?</h3>
                                
                                <form method="post" action="#">
                                    <textarea name="review" placeholder="Write your review here..." rows="4"></textarea>
                                    <div class="actions">
                                        <button type="submit" class="primary" >Write a Review</button>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                    </div>

                <!-- Footer -->
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
                            <section>
                                <h2>Follow</h2>
                                <ul class="icons">
                                    <li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
                                    <li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
                                    <li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
                                    <li><a href="#" class="icon brands style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
                                    <li><a href="#" class="icon brands style2 fa-github"><span class="label">GitHub</span></a></li>
                                    <li><a href="#" class="icon brands style2 fa-500px"><span class="label">500px</span></a></li>
                                    <li><a href="#" class="icon solid style2 fa-phone"><span class="label">Phone</span></a></li>
                                    <li><a href="#" class="icon solid style2 fa-envelope"><span class="label">Email</span></a></li>
                                </ul>
                            </section>
                        </div>
                    </footer>

            </div>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/browser.min.js"></script>
            <script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
            <script src="assets/js/theme.js"></script>

    </body>
</html>
