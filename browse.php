<?php require_once('inc/connection.php'); ?>
<?php

	session_start();

	// Display the Errors and Success messages when Sign In

	if (isset($_GET['error'])) {

	  if ($_GET['error'] == 'empty') {

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Fill in the fields!</p></div>';

	  } else if ($_GET['error'] == 'nouser') {

	    if (isset($_GET['email'])) {
	      $noemail = $_GET['email'];
	      $message = '<div class="alert error"><span class="closebtn">&times;</span><p>There is not \''.$noemail.'\' email address in registed users!</p></div>';
	    }

	  } else if ($_GET['error'] == 'passwordsign') {

	    if (isset($_GET['replaceemail'])) {
	      $replaceemail = $_GET['replaceemail'];
	    }

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Password does not match with \''.$replaceemail.'\' email address!</p></div>';

	  }

	}

	// Display the Errors and Success messages when Register
	if (isset($_GET['register'])) {

	  if ($_GET['register'] == 'success') {

	    $message = '<div class="alert"><span class="closebtn">&times;</span><p>You have successfully registed.</p></div>';

	  }

	} else if (isset($_GET['error']) && isset($_GET['invalidemail'])) {

	  if ($_GET['error'] == 'usertaken') {

	    $takenemail = $_GET['invalidemail'];
	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>\''.$takenemail.'\' is already taken. Please enter another email address.</p></div>';

	  }

	} else if (isset($_GET['error'])) {

	  if ($_GET['error'] == 'emptyreg') {

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Fill in the fields!</p></div>';

	  } else if ($_GET['error'] == 'invalid') {

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Invalid name! The name does not allowed symbols.</p></div>';

	  } else if ($_GET['error'] == 'email') {

	    if (isset($_GET['fname']) && isset($_GET['lname'])) {
	      $refname = $_GET['fname'];
	      $relname = $_GET['lname'];
	    }

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Invalid E-mail address! Please enter valid E-mail address.</p></div>';

	  } else if ($_GET['error'] == 'passwordreg') {

	    if (isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['replaceemail'])) {

	      $refname = $_GET['fname'];
	      $relname = $_GET['lname'];
	      $reemail = $_GET['replaceemail'];

	    }

	    $message = '<div class="alert error"><span class="closebtn">&times;</span><p>Password is not match! Please enter same password both places.</p></div>';

	  }

	}

?>
<?php

	$errors = array();

	if (isset($_POST['search-movie'])) {
		if (!isset($_POST['sort-by']) || strlen(trim($_POST['sort-by'])) <1) {
			$errors[] = 'Movie Sort by is missing or invalid';
		}
		if (!isset($_POST['by-rating']) || strlen(trim($_POST['by-rating'])) <1) {
			$errors[] = 'Sort by rating is missing or invalid';
		}
		if (!isset($_POST['by-genres']) || strlen(trim($_POST['by-genres'])) <1) {
			$errors[] = 'Sort by genres is missing or invalid';
		}
		if (!isset($_POST['by-rt-rating']) || strlen(trim($_POST['by-rt-rating'])) <1) {
			$errors[] = 'Sort by rotten tomatoes is missing or invalid';
		}

		if (empty($errors)) {
			$search_str = mysqli_real_escape_string($connection, $_POST['main-search']);
			$sort_by = mysqli_real_escape_string($connection, $_POST['sort-by']);
			$by_rating = mysqli_real_escape_string($connection, $_POST['by-rating']);
			$by_genres = mysqli_real_escape_string($connection, $_POST['by-genres']);
			$by_rt_rating = mysqli_real_escape_string($connection, $_POST['by-rt-rating']);

			if (!empty($search_str)) {

				$search_word = "name LIKE '%{$search_str}%' OR directors LIKE '%{$search_str}%' OR keywords LIKE '%{$search_str}%' AND";

			} else {
				$search_word = "";
			}

			if (isset($sort_by)) {

				if ($sort_by == 'latest') {
					$order_by = "ORDER BY release_date DESC, name";
				} else if ($sort_by == 'oldest') {
					$order_by = "ORDER BY release_date, name";
				} else if ($sort_by == 'rotten') {
					$order_by = "ORDER BY rotten_tomatoes DESC, rotten_rating_count DESC";
				} else if ($sort_by == 'rating') {
					$order_by = "ORDER BY imdb_rating DESC, imdb_rating_count DESC";
				} else if ($sort_by == 'alphabetical') {
					$order_by = "ORDER BY name";
				} else if ($sort_by == 'box-office') {
					$order_by = "ORDER BY box_office DESC, name";
				} else {
					$order_by = "ORDER BY download_count DESC, name";
				}

			}

			if (isset($by_rating)) {

				if ($by_rating == 'All') {
					$filter_by_rating = "0";
				} else if ($by_rating == '9+') {
					$filter_by_rating = "9";
				} else if ($by_rating == '8+') {
					$filter_by_rating = "8";
				} else if ($by_rating == '7+') {
					$filter_by_rating = "7";
				} else if ($by_rating == '6+') {
					$filter_by_rating = "6";
				} else if ($by_rating == '5+') {
					$filter_by_rating = "5";
				} else if ($by_rating == '4+') {
					$filter_by_rating = "4";
				} else if ($by_rating == '3+') {
					$filter_by_rating = "3";
				} else if ($by_rating == '2+') {
					$filter_by_rating = "2";
				} else {
					$filter_by_rating = "1";
				}

			}

			if (isset($by_genres)) {

				if ($by_genres == 'All') {
					$filter_by_genres = "%%";
				} else if ($by_genres == 'Action') {
					$filter_by_genres = "%Action%";
				} else if ($by_genres == 'Adventure') {
					$filter_by_genres = "%Adventure%";
				} else if ($by_genres == 'Animation') {
					$filter_by_genres = "%Animation%";
				} else if ($by_genres == 'Biography') {
					$filter_by_genres = "%Biography%";
				} else if ($by_genres == 'Comedy') {
					$filter_by_genres = "%Comedy%";
				} else if ($by_genres == 'Crime') {
					$filter_by_genres = "%Crime%";
				} else if ($by_genres == 'Drama') {
					$filter_by_genres = "%Drama%";
				} else if ($by_genres == 'Family') {
					$filter_by_genres = "%Family%";
				} else if ($by_genres == 'Fantasy') {
					$filter_by_genres = "%Fantasy%";
				} else if ($by_genres == 'Film-Noir') {
					$filter_by_genres = "%Film-Noir%";
				} else if ($by_genres == 'History') {
					$filter_by_genres = "%History%";
				} else if ($by_genres == 'Horror') {
					$filter_by_genres = "%Horror%";
				} else if ($by_genres == 'Music') {
					$filter_by_genres = "%Music%";
				} else if ($by_genres == 'Musical') {
					$filter_by_genres = "%Musical%";
				} else if ($by_genres == 'Mystery') {
					$filter_by_genres = "%Mystery%";
				} else if ($by_genres == 'Romance') {
					$filter_by_genres = "%Romance%";
				} else if ($by_genres == 'Sci-Fi') {
					$filter_by_genres = "%Sci-Fi%";
				} else if ($by_genres == 'Sport') {
					$filter_by_genres = "%Sport%";
				} else if ($by_genres == 'Thriller') {
					$filter_by_genres = "%Thriller%";
				} else if ($by_genres == 'War') {
					$filter_by_genres = "%War%";
				} else {
					$filter_by_genres = "%Western%";
				}

			}

			if (isset($by_rt_rating)) {

				if ($by_rt_rating == 'All') {
					$filter_by_rt_rating = ">= 0";
				} else if ($by_rt_rating == '75%+') {
					$filter_by_rt_rating = ">= 75";
				} else if ($by_rt_rating == '60%+') {
					$filter_by_rt_rating = ">= 60";
				} else if ($by_rt_rating == '50%+') {
					$filter_by_rt_rating = ">= 50";
				} else if ($by_rt_rating == '40%+') {
					$filter_by_rt_rating = ">= 40";
				} else if ($by_rt_rating == '30%+') {
					$filter_by_rt_rating = ">= 30";
				} else if ($by_rt_rating == '20%+') {
					$filter_by_rt_rating = ">= 20";
				} else {
					$filter_by_rt_rating = "< 20";
				}

			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="icon" href="img/favicon.png" sizes="32x32" type="image/png">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/browse.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="js/jquery-3.4.1.js"></script>
	<title>Browse Movie - Infinity Movies</title>
</head>
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>
<body>
	<?php if (isset($_GET['error']) || isset($_GET['register'])) { echo $message; } ?>
	<nav>
		<div class="search-bar">
			<a href="#" class="search-icon"><img src="img/search.png" alt="search icon"></a>
			<div class="search-field">
				<form action="index.php" method="post"><input type="search" name="search" id="search" placeholder="Search for..." onkeyup="searchq(this.value)" autocomplete="off"></form>
				<div class="search-result"></div>
			</div>
		</div>
		<div class="logo">
			<a href="index.php"><img src="img/logo.png" alt="logo" title="Infinity Movies"></a>
		</div>
		<div class="menu-icon">
			<div class="line"></div>
			<div class="line"></div>
			<div class="line"></div>
		</div>
		<ul class="nav-links">
			<li><a href="index.php">Home</a></li>
			<li><a href="browse.php" class="active">Browse</a></li>
			<li><a href="genres.php">Genres</a></li>
			<li><a href="upcoming.php">Upcoming</a></li>
			<li><a href="requests.php">Requests</a></li>
			<li class="signin-panel"><?php if (isset($_SESSION['id'])) { echo '<form action="inc/sign-out.php" method="post"><button type="submit" name="signout_submit">Sign Out</button></form>'; } else { echo '<a href="#" class="signin-btn-desktop">Sign In</a>'; } ?></li>
		</ul>
	</nav>
	<div class="signin-btn"><?php if (isset($_SESSION['id'])) { echo '<form action="inc/sign-out.php" method="post"><button type="submit" name="signout_submit"><img src="img/logout.png" alt="logout icon"></button></form>'; } else { echo '<a href="#" class="sign-in-link"><img src="img/login.png" alt="login icon"></a>'; } ?></div>
	<div class="user-panel">
		<div class="user-center">
			<div class="change-btns">
				<a href="#" class="sign-in-btn active">Sign In</a>
				<a href="#" class="register-btn">Register</a>
				<span class="close-btn">&times;</span>
			</div>
			<div class="sign-in-form">
				<form action="inc/sign-in.php" method="post">
					<fieldset>
						<legend>Sign In</legend>
						<input type="text" name="email" placeholder="E-mail" value="<?php if (isset($replaceemail)) { echo $replaceemail; } ?>">
						<input type="password" name="password" placeholder="Password">
						<button type="submit" name="signin_submit">Sign In</button>
					</fieldset>
				</form>
				<blockquote>If you have forgotten your password <a href="#">Reset password</a> here.</blockquote>
			</div>
			<div class="register-form">
				<form action="inc/register.php" method="post">
					<fieldset>
						<legend>Register</legend>
						<input type="text" name="first_name" placeholder="First Name" value="<?php if (isset($refname)) { echo $refname; } ?>">
						<input type="text" name="last_name" placeholder="Last Name" value="<?php if (isset($relname)) { echo $relname; } ?>">
						<input type="text" name="email" placeholder="E-mail" value="<?php if (isset($reemail)) { echo $reemail; } ?>">
						<input type="password" name="password" placeholder="Password">
						<input type="password" name="confirm_password" placeholder="Confirm Password">
	        			<button type="submit" name="register_submit">Register</button>
					</fieldset>
				</form>
				<blockquote><input type="checkbox" name="" id=""> I agree to the <a href="#">terms</a> and <a href="#">privacy policy</a></blockquote>
			</div>
		</div>
	</div>
	<section class="landing">
		<div class="banner"></div>
			<div class="main-search-field">
				<div class="search-heading">
					<h1>Browse Movies</h1>
				</div>
				<div class="search-area">
					<form action="browse.php" method="post">
						<div class="main-search-box">
							<input type="search" name="main-search" id="main-search" placeholder="Search for movies..." value="<?php if (isset($_POST['search-movie']) && empty($errors)) { if (!empty($search_str)) { echo $search_str; } } ?>">
							<button type="submit" name="search-movie">Search</button>
						</div>
						<div class="search-filters">
							<div class="filters">
								<label>Sort By: </label>
								<select name="sort-by" id="sort-by">
									<option value="latest" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'latest') { echo 'selected'; } } ?>>Latest</option>
									<option value="oldest" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'oldest') { echo 'selected'; } } ?>>Oldest</option>
									<option value="rotten" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'rotten') { echo 'selected'; } } ?>>Rotten Tomatoes</option>
									<option value="rating" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'rating') { echo 'selected'; } } ?>>IMDb Rating</option>
									<option value="alphabetical" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'alphabetical') { echo 'selected'; } } ?>>Alphabetical</option>
									<option value="box-office" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'box-office') { echo 'selected'; } } ?>>Box Office</option>
									<option value="downloads" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($sort_by == 'downloads') { echo 'selected'; } } ?>>Downloads</option>
								</select>
							</div>
							<div class="filters">
								<label>Rating: </label>
								<select name="by-rating" id="by-rating">
									<option value="All" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == 'All') { echo 'selected'; } } ?>>All</option>
									<option value="9+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '9+') { echo 'selected'; } } ?>>9+</option>
									<option value="8+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '8+') { echo 'selected'; } } ?>>8+</option>
									<option value="7+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '7+') { echo 'selected'; } } ?>>7+</option>
									<option value="6+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '6+') { echo 'selected'; } } ?>>6+</option>
									<option value="5+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '5+') { echo 'selected'; } } ?>>5+</option>
									<option value="4+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '4+') { echo 'selected'; } } ?>>4+</option>
									<option value="3+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '3+') { echo 'selected'; } } ?>>3+</option>
									<option value="2+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '2+') { echo 'selected'; } } ?>>2+</option>
									<option value="1+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rating == '1+') { echo 'selected'; } } ?>>1+</option>
								</select>
							</div>
							<div class="filters">
								<label>Genres: </label>
								<select name="by-genres" id="by-genres">
									<option value="All" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'All') { echo 'selected'; } } ?>>All</option>
									<option value="Action" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Action') { echo 'selected'; } } ?>>Action</option>
									<option value="Adventure" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Adventure') { echo 'selected'; } } ?>>Adventure</option>
									<option value="Animation" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Animation') { echo 'selected'; } } ?>>Animation</option>
									<option value="Biography" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Biography') { echo 'selected'; } } ?>>Biography</option>
									<option value="Comedy" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Comedy') { echo 'selected'; } } ?>>Comedy</option>
									<option value="Crime" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Crime') { echo 'selected'; } } ?>>Crime</option>
									<option value="Drama" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Drama') { echo 'selected'; } } ?>>Drama</option>
									<option value="Family" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Family') { echo 'selected'; } } ?>>Family</option>
									<option value="Fantasy" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Fantasy') { echo 'selected'; } } ?>>Fantasy</option>
									<option value="Film-Noir" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Film-Noir') { echo 'selected'; } } ?>>Film-Noir</option>
									<option value="History" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'History') { echo 'selected'; } } ?>>History</option>
									<option value="Horror" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Horror') { echo 'selected'; } } ?>>Horror</option>
									<option value="Music" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Music') { echo 'selected'; } } ?>>Music</option>
									<option value="Musical" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Musical') { echo 'selected'; } } ?>>Musical</option>
									<option value="Mystery" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Mystery') { echo 'selected'; } } ?>>Mystery</option>
									<option value="Romance" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Romance') { echo 'selected'; } } ?>>Romance</option>
									<option value="Sci-Fi" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Sci-Fi') { echo 'selected'; } } ?>>Sci-Fi</option>
									<option value="Sport" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Sport') { echo 'selected'; } } ?>>Sport</option>
									<option value="Thriller" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Thriller') { echo 'selected'; } } ?>>Thriller</option>
									<option value="War" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'War') { echo 'selected'; } } ?>>War</option>
									<option value="Western" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_genres == 'Western') { echo 'selected'; } } ?>>Western</option>
								</select>
							</div>
							<div class="filters">
								<label>Rotton Tomatoes: </label>
								<select name="by-rt-rating" id="by-rt-rating">
									<option value="All" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == 'All') { echo 'selected'; } } ?>>All</option>
									<option value="75%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '75%+') { echo 'selected'; } } ?>>75%+</option>
									<option value="60%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '60%+') { echo 'selected'; } } ?>>60%+</option>
									<option value="50%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '50%+') { echo 'selected'; } } ?>>50%+</option>
									<option value="40%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '40%+') { echo 'selected'; } } ?>>40%+</option>
									<option value="30%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '30%+') { echo 'selected'; } } ?>>30%+</option>
									<option value="20%+" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '20%+') { echo 'selected'; } } ?>>20%+</option>
									<option value="20%-" <?php if (isset($_POST['search-movie']) && empty($errors)) { if ($by_rt_rating == '20%-') { echo 'selected'; } } ?>>20%-</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="search-mov-result">
					<?php

					if (isset($_POST['search-movie'])) {
						if (empty($errors)) {
							$query = "SELECT * FROM movies WHERE {$search_word} genres LIKE '%{$filter_by_genres}%' AND imdb_rating >= {$filter_by_rating} AND rotten_tomatoes {$filter_by_rt_rating} {$order_by} LIMIT 20";

							$result_set = mysqli_query($connection, $query);
							$count = mysqli_num_rows($result_set);
							
							if ($count == 0) {
								echo '<pre style="color: red;">There was no search result!</pre>';
							} else {
								while ($row = mysqli_fetch_assoc($result_set)) {
									$id = $row['id'];
									$name = $row['name'];
									$imdb_rating = $row['imdb_rating'];
									$folder_name = str_replace(': ', ' - ', $row['name']);
									$release_date = $row['release_date'];
									$date = explode('-', $release_date);
									$year = $date[0];

									echo '<div class="mov-data"><a href="view.php?id=' . $id . '"><div class="mov-cover"><img src="movies/' . $folder_name . ' (' . $year . ')/poster.jpg" title="' . $name . ' (' . $year . ')" alt="' . $name . '"><div class="cover-overlay"><div class="mov-rating"><img src="img/rating.png" alt="rating"><h3>' . $imdb_rating . '</h3></div></div></div><h3>' . $name . '</h3><p>' . $year . '</p></a></div>';
								}
							}
						}
					} else {
						$get_default = "SELECT id, name, imdb_rating, release_date FROM movies ORDER BY release_date DESC, name LIMIT 20";

						$get_default_result_set = mysqli_query($connection, $get_default);

						while ($default = mysqli_fetch_assoc($get_default_result_set)) {
							$id = $default['id'];
							$name = $default['name'];
							$imdb_rating = $default['imdb_rating'];
							$folder_name = str_replace(': ', ' - ', $default['name']);
							$release_date = $default['release_date'];
							$date = explode('-', $release_date);
							$year = $date[0];

							echo '<div class="mov-data"><a href="view.php?id=' . $id . '"><div class="mov-cover"><img src="movies/' . $folder_name . ' (' . $year . ')/poster.jpg" title="' . $name . ' (' . $year . ')" alt="' . $name . '"><div class="cover-overlay"><div class="mov-rating"><img src="img/rating.png" alt="rating"><h3>' . $imdb_rating . '</h3></div></div></div><h3>' . $name . '</h3><p>' . $year . '</p></a></div>';
						}
					}

					?>
				</div>
			</div>
		</div>
		<footer>
			<p>By using this site you agree to and accept our <a href="#">User Agreement</a>, which can be read <a href="#">here</a>.</p>
			<blockquote><a href="ctrl/index.php">Go to Admin Panel »</a></blockquote>
			<ul class="foot-cont">
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Disclaimer</a></li>
				<li><a href="#">DMCA Policy</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			<span>Copyright © 2019 Infinity Movies. All Rights Reserved.</span>
		</footer>
	</section>
	<script>
		$(document).ready(function(){
			$(".search-bar a").click(function(e){
				e.preventDefault();
				$(".search-bar .search-field").toggleClass("input-sh");
				$(".logo a").toggleClass("logo-sh");
			});
			$(".register-btn").click(function(){
				$(".sign-in-form").css("display", "none");
				$(".sign-in-btn").removeClass("active");
				$(".register-form").css("display", "block");
				$(this).addClass("active");
			});
			$(".sign-in-btn").click(function(){
				$(".register-form").css("display", "none");
				$(".register-btn").removeClass("active");
				$(".sign-in-form").css("display", "block");
				$(this).addClass("active");
			});
			$(document).click(function(){
				if ($("#search").is(':focus')) {
					$(".search-result").css("display", "block");
				} else {
					$(".search-result").css("display", "none");
				}
			});
		});

		function searchq() {
			var search_txt = $("input[name='search']").val();
			var search_txt_len = $("input[name='search']").val().length;
			if (search_txt_len == 0) {
				$(".search-result").html('');
			} else {
				$.post("inc/search.php", {searchVal: search_txt}, function(output) {
					$(".search-result").html(output);
				});
			}
		}
	</script>
	<script src="js/main.js"></script>
</body>
</html>