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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="icon" href="img/favicon.png" sizes="32x32" type="image/png">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/upcoming.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="js/jquery-3.4.1.js"></script>
	<title>Upcoming - Infinity Movies</title>
</head>
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
			<li><a href="browse.php">Browse</a></li>
			<li><a href="genres.php">Genres</a></li>
			<li><a href="upcoming.php" class="active">Upcoming</a></li>
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
		<div class="upcoming-area">
			<div class="sec-name">
				<h1>Upcoming Movies</h1>
				<a href="#">View All</a>
			</div>
			<div class="mov-list">
				<?php

					$query = "SELECT * FROM upcoming ORDER BY release_date, name";

					$result_set = mysqli_query($connection, $query);
					$month_list = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

					while ($row = mysqli_fetch_assoc($result_set)) {
						$name = $row['name'];
						$imdb_rating = $row['imdb_rating'];
						$release_date = $row['release_date'];
						$trailer = $row['trailer'];
						$poster_name = str_replace(': ', ' - ', $row['name']);
						$date = explode('-', $release_date);
						$year = $date[0];
						$month_num = $date[1];
						$day = $date[2];

						for ($i = 0; $i <= 11; $i++) {
							if ($month_num - 1 == $i) {
								$month = $month_list[$i];
							}
						}

						echo '<div class="mov-data"><a href="'.$trailer.'" target="_blank"><div class="mov-cover"><img src="upcoming/'.$poster_name.' ('.$year.').jpg" title="'.$name.' ('.$year.')" alt="'.$name.'"><div class="cover-overlay"><div class="view-imdb"><img src="img/imdb.png" alt="imdb"><h3>'.$imdb_rating.'</h3></div></div></div><h3>'.$name.'</h3><p>'.$day.' '.$month.' '.$year.'</p></a></div>';

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