<?php 
    $isbn = (isset($_GET['isbn']) ? $_GET['isbn'] : '');
    require_once ('db_connect.php');
    $sql = "SELECT * FROM book WHERE ISBN = '$isbn'";
$result = mysqli_query($conn, $sql)->fetch_assoc();

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
    // Handle review submission
	
	
	
?>


<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $result['Book_Name']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="shortcut icon" href="images/books.png" type="image/x-icon">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.php" class="logo">
									<span class="symbol"><img src="images\page_turners.png" alt="" /></span><span class="title">Page Turners</span>
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
							<li><a href="generic.html">Genre</a></li>
							<!-- <li><a href="elements.html">Download</a></li> -->
							<li><a href="index_reg&signin.php">Register</a></li>
							<li><a href="admin_login.php">Admin Panel</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<!-- Book Content -->
							<div class="book-content">
								<span><img src="<?php echo $result['Cover_url']; ?>" alt="img" class="img-size"/></span>
								<div class="title-icon">
									<h2><?php echo $result['Book_Name']; ?></h2>
									<!-- <p>By <?php echo get_author($isbn); ?></p> -->
									
									<div>
											<span style="cursor: pointer;" class="mouse-in"><i class="bi bi-suit-heart-fill"></i></span>
											<span>Add to Wishlist</span>
									</div>
									
									<a href="<?php echo $result['book_url']; ?>" target="_blank"><button class="star-rate">Read</button></a><br>

									
	
									<p><?php echo $result['Book_Desc']; ?></p>
								</div>
							</div>
                            <!--wishlist and starts gulo rating er upore thakbe jeta parchi na neha thik koro-->
							
							<!-- Rating and Review Section -->
							<div class="rating-review">
								<br><h2>Ratings & Reviews</h2>
								<h3>What do you think?</h3>
								
								<form method="post" action="includes\submit_review.php">
									<textarea name="review" placeholder="Write your review here..." rows="4" required></textarea>
									<label for="rating">Rating (1-5):</label>
									<select name="rating" id="rating">
										<option value="">Select</option>
										<option value="1">1 - Poor</option>
										<option value="2">2 - Fair</option>
										<option value="3">3 - Good</option>
										<option value="4">4 - Very Good</option>
										<option value="5">5 - Excellent</option>
									</select>
									<label for="book">Select book:</label>
									<select name="book" id="book">
                                    <option value="">Select</option>
										<option value="Harry Potter and the Chamber of Secrets">Harry Potter and the Chamber of Secrets</option>
										<option value="Love Hypothesis">Love Hypothesis</option>
										<option value="Ikigai"> Ikigai</option>
										<option value="Dr. Strange">Dr. Strange</option>
										<option value="Narnia">Narnia</option>
										<option value="pride and prejudice">Pride and Prejudice</option>
										<option value="Twisted love">Twisted love</option>
										<option value="The Amazing Spiderman">The Amazing Spiderman</option>
										<option value="Journey to Star Wars">Journey to Star Wars</option>
										<option value="48 Laws of Power">48 Laws of Power</option>
										<option value="The Hobbit">The Hobbit</option>
										<option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
										<option value="Harry Potter and the Goblet of Fire">Harry Potter and the Goblet of Fire</option>
										<option value="1984">1984</option>
										<option value="Atomic Habits">Atomic Habits</option>
										<option value="Harry Potter and the Philosopher's Stone">Harry Potter and the Philosopher's Stone</option>
										<option value="The Lightning Thief">The Lightning Thief</option>
										<option value="Confess">Confess</option>
									</select>
									<div class="actions">
										<button type="submit" class="primary" >Write a Review</button>
									</div>
								</form>
							</div>
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
