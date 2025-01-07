<?php
include 'db_connect.php';
$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);

function get_author($Author_id) {
    include 'db_connect.php';
    $sql_author = "SELECT Author_Name, author_img FROM author;";
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
		<link rel="stylesheet" href="assets\css\author.css" />
		<link rel="shortcut icon" href="images/books.png" type="image/x-icon">

		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.html" class="logo">
									<span class="symbol"><img src="images\page_turners.png" alt="img" /></span><span class="title">Page Turners</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
										<li>
											<img src="images\moon_icon.png" id = 'theme-toggle' alt = 'Toggle Theme'>

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
					 
						<li class = 'dropdown'>
							<a href="#" class="dropdown-toggle">Genre</a>
							<ul class="dropdown-menu">
								<li><a href="Genre\fantasy.html">Fantasy</a></li>
								<li><a href="Genre\fantasy.html">Self-Help</a></li>
								<li><a href="Genre\fantasy.html">Romance</a></li>
								<li><a href="Genre\fantasy.html">Thriller</a></li>
								<li><a href="Genre\fantasy.html">Horror</a></li>
								<li><a href="action.html">Action</a></li>
							</ul>
						</li>
							
						</li>
							
						<!-- <li><a href="elements.html">Download</a></li> -->
						<li><a href="index_reg&signin.php">Register</a></li>
						<li><a href="admin_login.php">Admin Panel</a></li>						
					</ul>
				</nav>


				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header><br><br>
								<h1>Discover the storyteller who brings words to life</h1>
							</header>
							<section id="authors">
								<h2>Bestselling Authors</h2>
								<div class="row">
								  <?php
// Display pending events
if ($result->num_rows > 0) { 
	while($row = $result->fetch_assoc()) { 
		echo '<article class="author"> 
                <a href="ind_author.php?author=' . $row['Author_id'] . '">
					<img src="' . $row['author_img'] . '" alt="Author"> 
				</a> 
				<h3>' . $row['Author_Name'] . '</h3> 
			  </article>'; }
	}
?>									
								</div>
							</section>	
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
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
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