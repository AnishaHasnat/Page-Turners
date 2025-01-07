
<?php
include 'db_connect.php';

$sql = "SELECT * FROM book";
$result = mysqli_query($conn, $sql);

function get_author($isbn) {
	include 'db_connect.php';
	$sql_author= "SELECT a.Author_Name FROM author a JOIN writes w ON a.Author_id = w.Author_id WHERE w.ISBN = '$isbn';";
	$result = mysqli_query($conn, $sql_author);

	// Check if the query was successful and if a result was returned
	if ($result && $row = $result->fetch_assoc()) {
		$authorName = $row['Author_Name'];
	} else {
		// Handle error or empty result
		$authorName = null; // or some default value
		error_log("Query failed or no result found: " . mysqli_error($conn));
	}
	
	// Return or use the $authorName variable
	return $authorName;
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
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	</head>
	<body class="is-preload">


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.php" class="logo">
									<span class="symbol"><img src="images\page_turners.png" alt="img" /></span><span class="title">Page Turners</span>
								</a>
                            <!-- Search Bar -->
								<div class = 'search-wrapper'>
									<input type="text" name="search" placeholder="Search books..."  />
								</div>

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
								<a class="dropdown-toggle">Genre</a>
									<ul class="dropdown-menu">
										<li><a href="fantasy.html">Fantasy</a></li>
										<li><a href="self-help.html">Self-Help</a></li>
										<li><a href="romance.html">Romance</a></li>
										<li><a href="thriller.html">Thriller</a></li>
										<li><a href="horror.html">Horror</a></li>
										<li><a href="genre_action.html">Action</a></li>
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
								<h1>Discover the Top-Rated Book Collection</h1>
								<p>Beneath the soft glow of a flickering lamp, the pages whispered their secrets, each word unraveling a world unknown, where ink became magic and stories wove themselves into the fabric of the soul</p>
							</header><section class="tiles">
                
							<?php
// Display pending events
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<article class="style1">
                    <span class="image">
                        <img src="' . $row['Cover_url'] . '" alt="img" />
                    </span>
                    <a href="book_info.php?isbn=' . $row['ISBN'] . '">
                        <h2>'. $row['Book_Name']. '</h2>
                    </a>
                </article>
              ';
    }
}
?></section>

							<!-- <section class="tiles">
								<article class="style1" >
									<span class="image">
										<img src="images\harry.jpg" alt="img" />
									</span>
									<a href="harry_potter.html">
										<h2>Harry Potter</h2>
											<p>By J.K. Rowling</p>
									
									</a>
								</article>
							</section> -->
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
								<!-- <li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li> -->
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

