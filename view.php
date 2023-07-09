<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php

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

	$check = "SELECT COUNT(id) AS count FROM movies";
	$get_count = mysqli_query($connection, $check);
	$count = mysqli_fetch_assoc($get_count);
	$mov_count = $count['count'];

	if (isset($_GET['id']) and !empty($_GET['id']) and $_GET['id'] >= 1 and $_GET['id'] <= $mov_count) {

		$movie_id = $_GET['id'];

		$query = "SELECT name, age_rating, runtime, imdb_rating, release_date, genres, rotten_tomatoes, audience_score, size, quality, directors, description, color, trailer, download_link, download_count, sub_download_link, sub_download_count, keywords FROM movies WHERE id = '{$movie_id}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if (isset($result_set)) {

			$result = mysqli_fetch_assoc($result_set);

			$name = $result['name'];
			$age_rating = $result['age_rating'];
			$runtime = $result['runtime'];
			$imdb_rating = $result['imdb_rating'];
			$release_date = $result['release_date'];
			$genre = $result['genres'];
			$rotten_tomatoes = $result['rotten_tomatoes'];
			$audience_score = $result['audience_score'];
			$size = $result['size'];
			$quality = $result['quality'];
			$directors = $result['directors'];
			$description = $result['description'];
			$color = $result['color'];
			$trailer = $result['trailer'];
			$download_link = $result['download_link'];
			$download_count = $result['download_count'];
			$sub_download_link = $result['sub_download_link'];
			$sub_download_count = $result['sub_download_count'];
			$keywords = $result['keywords'];

			$mov_folder_name = str_replace(': ', ' - ', $name);

			// Check length movie name

			if (isset($name)) {

				if (isset($release_date)) {

					$get_release_date = explode("-", $release_date);
					$display_date = $get_release_date[0];

					$display_title = $name . ' (' . $display_date . ')';

				}

			}

			if (isset($release_date)) {

				$month_list = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$date = explode('-', $release_date);
				$year = $date[0];
				$month_num = $date[1];
				$day = $date[2];

				for ($i = 0; $i <= 11; $i++) {

					if ($month_num - 1 == $i) {
						$month = $month_list[$i];
					}

				}

				if (!empty($month)) {

					$display_release_date = $day . " " . $month . " " . $year;

				}

			}

			if (isset($rotten_tomatoes)) {

				if ($rotten_tomatoes >= 75) {
					$tomatometer = 'img/tomatometer75.png';
				} else if ($rotten_tomatoes >= 60) {
					$tomatometer = 'img/tomatometer60.png';
				} else {
					$tomatometer = 'img/tomatometer59.png';
				}

			}

			if (isset($audience_score)) {

				if ($audience_score >= 60) {
					$popcornbucket = 'img/fullpopcorn.png';
				} else {
					$popcornbucket = 'img/tippedpopcorn.png';
				}

			}

			if (isset($description)) {

				$search_movie = "SELECT name FROM movies";
				$result_search = mysqli_query($connection, $search_movie);

				while ($search = mysqli_fetch_assoc($result_search)) {

					if ($search_word = strpos($description, $search['name']) !== false) {

						$found_movie = $search['name'];

						$date_query = "SELECT id, release_date, color FROM movies WHERE name = '{$found_movie}' LIMIT 1";
						$result_date = mysqli_query($connection, $date_query);

						if (isset($result_date)) {

							$result_two = mysqli_fetch_assoc($result_date);

							$explode_date = explode('-', $result_two['release_date']);
							$new_release_date = $explode_date[0];
							$search_movie_id = $result_two['id'];
							$search_color = $result_two['color'];

							$replace_word = $found_movie . ' (' . $new_release_date . ')';

							$new_description = str_replace($replace_word, '<a href="view.php?id=' . $search_movie_id . '" target="_blank">' . $replace_word . '</a>', $description);

						}

					}

				}

				if (isset($new_description) and isset($search_color)) {

					$display_description = $new_description;
					$link_color = $search_color;

				} else {

					$display_description = $description;
					$link_color = $color;

				}

			}

			if (isset($trailer)) {

				$get_yt_mov_id = substr($trailer, -11);
				$new_trailer_link = 'https://www.youtube.com/watch?v=' . $get_yt_mov_id;

			}

			if (isset($keywords)) {
				$keyword_arr = explode(', ', $keywords);
			}

			if (isset($_POST['mov-download'])) {
				$user_id = $_SESSION['id'];
				$get_current_downloaded = "SELECT downloaded FROM users WHERE id = '{$user_id}' LIMIT 1";
				$result_set_downloaded = mysqli_query($connection, $get_current_downloaded);
				while ($result_downloaded = mysqli_fetch_assoc($result_set_downloaded)) {
					if ($result_downloaded['downloaded'] == NULL) {
						$append_mov_id = "UPDATE users SET downloaded = '{$movie_id},' WHERE id = '{$user_id}'";
						mysqli_query($connection, $append_mov_id);
						$update_mov_download_count = "UPDATE movies SET download_count = download_count + 1 WHERE id = '{$movie_id}'";
						mysqli_query($connection, $update_mov_download_count);
						header('Location: '. $download_link);
					} else {
						$explode_downloaded = explode(',', $result_downloaded['downloaded']);
						foreach ($explode_downloaded as $downloaded_mov_id) {
							if ($downloaded_mov_id == $movie_id) {
								$downloaded_before = true;
							}
						}
						if ($downloaded_before === true) {
							header('Location: '. $download_link);
						} else {
							$append_mov_id = "UPDATE users SET downloaded = CONCAT(downloaded, '{$movie_id},') WHERE id = '{$user_id}'";
							mysqli_query($connection, $append_mov_id);
							$update_mov_download_count = "UPDATE movies SET download_count = download_count + 1 WHERE id = '{$movie_id}'";
							mysqli_query($connection, $update_mov_download_count);
							header('Location: '. $download_link);
						}
					}
				}
			}
			if (isset($_POST['sub-download'])) {
				$update_sub_download_count = "UPDATE movies SET sub_download_count = sub_download_count + 1 WHERE id = '{$movie_id}'";
				mysqli_query($connection, $update_sub_download_count);
				header('Location: '. $sub_download_link);
			}

		}

	} else {

		header('Location: index.php');
		exit();

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
	<link rel="stylesheet" href="css/view.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="js/jquery-3.4.1.js"></script>
	<title><?php echo $name . ' (' . $display_date; ?>) - Infinity Movies</title>
</head>
<style>
.mov-banner {
	background-image: url("movies/<?php echo $mov_folder_name . ' (' . $display_date; ?>)/background.jpg");
}
.mov-banner::after {
	background-image: linear-gradient(45deg, <?php echo $color; ?>59, <?php echo $color; ?>8c, <?php echo $color; ?>bf);
}
.mov-details .details .about-mov p a {
	color: <?php echo $link_color; ?>;
}
@media screen and (min-width: 1024px) {
	.mov-details .details .about-mov p a:hover {
		color: <?php echo $color; ?>;
	}
}
</style>
<body>
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
			<li><a href="browse.php">Browse</a></li>
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
				<form action="inc/sign-in.php?id=<?php echo $movie_id; ?>" method="post">
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
		<div class="mov-banner"></div>
		<div class="cover-photo">
			<h1><?php echo $display_title; ?> <span><?php echo $age_rating; ?></span></h1>
			<h2><?php echo $genre; ?></h2>
			<h3><?php echo $display_release_date; ?></h3>
		</div>
		<div class="mov-details">
			<div class="poster-rating">
				<div class="poster">
					<img src="movies/<?php echo $mov_folder_name . ' (' . $display_date; ?>)/poster.jpg" title="<?php echo $display_title; ?>" alt="<?php echo $name; ?>">
				</div>
				<div class="ratings">
					<div class="list-rating">
						<img src="img/imdb.png" alt="imdb" title="IMDb Rating">
						<div class="rating-txt">
							<h4><?php echo $imdb_rating; ?></h4>
						</div>
					</div>
					<div class="list-rating">
						<img src="<?php echo $tomatometer; ?>" alt="tomatometer" title="Tomatometer">
						<div class="rating-txt">
							<h4><?php echo $rotten_tomatoes; ?>%</h4>
						</div>
					</div>
					<div class="list-rating">
						<img src="<?php echo $popcornbucket; ?>" alt="popcornbucket" title="Audience Score">
						<div class="rating-txt">
							<h4><?php echo $audience_score; ?>%</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="details">
				<div class="about-mov">
					<h4>Runtime: <?php echo $runtime; ?></h4>
					<h4>Director(s): <?php echo $directors; ?></h4>
					<p><?php echo $display_description; ?></p>
					<a href="<?php echo $new_trailer_link; ?>">Watch Trailer</a>
				</div>
				<div class="downloads">
					<div class="mov-download">
						<p>Downloads: <?php echo $download_count; ?></p>
						<?php
							if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
								echo '<form action="view.php?id=' . $movie_id . '" method="post"><button type="submit" name="mov-download">'. $quality . ' ' . $size .'</button></form>';
							} else {
								echo '<button class="allow-sign-in">'. $quality . ' ' . $size .'</button>';
							}
						?>
					</div>
					<div class="sub-download">
						<p>Downloads: <?php echo $sub_download_count; ?></p>
						<?php
							if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
								echo '<form action="view.php?id=' . $movie_id . '" method="post"><button type="submit" name="sub-download">Subtitle [ENG]</button></form>';
							} else {
								echo '<button class="allow-sign-in">Subtitle [ENG]</button>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="similar-movies">
			<div class="sec-name">
				<h1>Similar Movies</h1>
			</div>
			<div class="mov-list">
				<?php

					$repeated_mov = "";

					foreach ($keyword_arr as $word) {
						$found_mov_word = str_replace("'", "\'", $word);
			
						$get_similar_mov = "SELECT id, name, release_date FROM movies WHERE keywords LIKE '%{$found_mov_word}%' AND id != '{$movie_id}' " . $repeated_mov . "ORDER BY release_date DESC, name";
						$get_similar_mov_result_set = mysqli_query($connection, $get_similar_mov);
						$count = mysqli_num_rows($get_similar_mov_result_set);

						if ($count == 0) {
							echo '';
						} else {

							while ($show_similar_mov_result = mysqli_fetch_assoc($get_similar_mov_result_set)) {

								$sim_id = $show_similar_mov_result['id'];
								$sim_name = $show_similar_mov_result['name'];
								$folder_name = str_replace(': ', ' - ', $show_similar_mov_result['name']);
								$sim_release_date = $show_similar_mov_result['release_date'];
								$date = explode('-', $sim_release_date);
								$year = $date[0];

								$repeated_mov .= "AND id != '{$sim_id}' ";

								echo '<div class="mov-data"><a href="view.php?id=' . $sim_id . '"><img src="movies/' . $folder_name . ' (' . $year . ')/poster.jpg" title="' . $sim_name . ' (' . $year . ')" alt="' . $sim_name . '"><h3>' . $sim_name . '</h3><p>' . $year . '</p></a></div>';


							}

						}

					}

				?>
			</div>
		</div>
		<div class="most-download-view">
			<div class="sec-name">
				<h1>Most Downloads</h1>
				<a href="#">View All</a>
			</div>
			<div class="mov-list">
				<?php

					$get_most_download_mov = "SELECT id, name, imdb_rating, release_date FROM movies ORDER BY download_count DESC, rotten_tomatoes DESC, audience_score DESC, rotten_rating_count DESC LIMIT 20";

					$get_most_download_mov_result_set = mysqli_query($connection, $get_most_download_mov);

					while ($show_most_download_mov = mysqli_fetch_assoc($get_most_download_mov_result_set)) {
						$id = $show_most_download_mov['id'];
						$name = $show_most_download_mov['name'];
						$imdb_rating = $show_most_download_mov['imdb_rating'];
						$folder_name = str_replace(': ', ' - ', $show_most_download_mov['name']);
						$release_date = $show_most_download_mov['release_date'];
						$date = explode('-', $release_date);
						$year = $date[0];

						echo '<div class="mov-data"><a href="view.php?id=' . $id . '"><div class="mov-cover"><img src="movies/' . $folder_name . ' (' . $year . ')/poster.jpg" title="' . $name . ' (' . $year . ')" alt="' . $name . '"><div class="cover-overlay"><div class="mov-rating"><img src="img/rating.png" alt="rating"><h3>' . $imdb_rating . '</h3></div></div></div><div class="mov-details"><h3>' . $name . '</h3><div class="rating"><img src="img/rating.png" alt="rating"><span>' . $imdb_rating . '</span></div><p>' . $year . '</p></div></a></div>';
					}

				?>
			</div>
			<div class="view-more">
				<a href="#">View All</a>
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
	<?php if (isset($_GET['error']) || isset($_GET['register'])) { echo $message; } ?>
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