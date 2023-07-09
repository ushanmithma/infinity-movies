<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php

	$check = "SELECT COUNT(id) AS count FROM movies";
	$get_count = mysqli_query($connection, $check);
	$count = mysqli_fetch_assoc($get_count);
	$mov_count = $count['count'];

	if (isset($_GET['id']) and !empty($_GET['id']) and $_GET['id'] >= 1 and $_GET['id'] <= $mov_count) {

		$movie_id = $_GET['id'];

		$query = "SELECT name, age_rating, runtime, imdb_rating, release_date, genres, size, quality, directors, description, color, trailer FROM movies WHERE id = '{$movie_id}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if (isset($result_set)) {

			$result = mysqli_fetch_assoc($result_set);

			$name = $result['name'];
			$age_rating = $result['age_rating'];
			$runtime = $result['runtime'];
			$imdb_rating = $result['imdb_rating'];
			$release_date = $result['release_date'];
			$genre = $result['genres'];
			$size = $result['size'];
			$quality = $result['quality'];
			$directors = $result['directors'];
			$description = $result['description'];
			$color = $result['color'];
			$trailer = $result['trailer'];

			$mov_folder_name = str_replace(': ', ' - ', $name);

			// Check length movie name

			if (isset($name)) {

				if (isset($release_date)) {

					$get_release_date = explode("-", $release_date);
					$display_date = $get_release_date[0];

				}

				if (($sub_char = strpos($name, ": ")) !== false) {

					$explode_name = explode(': ', $name);
					$display_title = $explode_name[0] . ': ';
					    
				    $get_sub_title = substr($name, $sub_char + 1);
				    $sub_title_bar = $get_sub_title . ' (' . $display_date . ')';

				    if (strlen($get_sub_title) > 20) {

				    	$sub_title = '<span class="subtitle">' . $get_sub_title . ' (' . $display_date . ')</span>';

				    } else {

				    	$sub_title = $get_sub_title . ' (' . $display_date . ')';

				    }

				} else {

					$display_title = $name . ' (' . $display_date . ')';
					$sub_title = '';
					$sub_title_bar = '';

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

		}

	} else {

		header('Location: panel.php');
		exit();

	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="../js/jquery-3.4.1.js"></script>
	<title><?php echo $display_title . $sub_title_bar; ?></title>
</head>
<style>
* {margin: 0;padding: 0;box-sizing: border-box;}
@import url('https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap');
body {font-family: 'Roboto', sans-serif; overflow: auto; transition: all 0.3s ease;}
.toogle-btn {
	position: fixed;
	bottom: 0;
	right: 0;
	width: 30px;
	height: 60px;
	margin-bottom: 10px;
	margin-right: 10px;
	z-index: 1;
}
.toogle-btn input {
	width: 0;
	height: 0;
	opacity: 0;
}
.toogle-btn .slider {
	position: absolute;
	cursor: pointer;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background-color: #ccc;
	transition: all 0.4s ease;
	-webkit-transition: all 0.4s ease;
	border-radius: 30px;
}
.toogle-btn .slider::before {
	position: absolute;
	content: '';
	width: calc(30px - 10px);
	height: calc(60px - 50% - 10px);
	border-radius: 50%;
	left:5px;
	right: 5px;
	top: 5px;
	background-color: white;
	transition: all 0.4s ease;
	-webkit-transition: all 0.4s ease;
}
.toogle-btn input:checked + .slider {
	background-color: orange;
}
.toogle-btn input:checked + .slider::before {
	transform: translateY(30px);
	-webkit-transform: translateY(30px);
	-ms-transform: translateY(30px);
	background-color: #1b1b1b;
}
.container {
	width: 960px;
	margin: 0 auto;
	display: flex;
	flex-direction: row;
	justify-content: space-around;
	position: absolute;
	top: 50%;
	left: 50%;
	right: 0;
	background-size: cover;
	transform: translate(-50%, -50%);
	background-position: -100% 10%;
	background-blend-mode: multiply;
	border-radius: 10px;
	background-image: linear-gradient(-135deg, <?php echo $color . 'b3'; ?> 20%, transparent 80%);
	box-shadow: 0 0 25px -10px rgba(0,0,0, 0.5);
	z-index: 1;
	overflow-y: hidden;
}

.img-background {
	background: rgba(0,0,0, 0.5);
	position: fixed;
	top: 0; right: 0; bottom: 0; left: 0;
	z-index: -99;
	background-image: url("../movies/<?php echo $mov_folder_name . ' (' . $display_date .')/background.jpg'; ?>");
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
	object-fit: cover;
	width: 100%;
	height: 100%;
	-webkit-filter: blur(2px);
    -moz-filter: blur(2px);
    -o-filter: blur(2px);
    -ms-filter: blur(2px);
    filter: blur(2px);
}

.background-overlay {
	background-color: <?php echo $color . '4d'; ?>; /*rgba(255,255,255, 0.7);*/
	width: 100%;
	height: 100vh;
	position: fixed;
	top: 0;
	left: 0;
}

.update-link {
	position: fixed;
	width: 70px;
	top: 0; left: calc(100% - 70px);
	float: right;
	z-index: 100;
	pointer-events: auto;
	padding: 10px;
}

.update-link a {
	color: #fff;
	text-decoration: none;
	text-align: center;
}

.back {
	position: fixed;
	bottom: 0; left: 0;
	float: right;
	z-index: 100;
	pointer-events: auto;
	padding: 10px;
}

.back a {
	color: #fff;
	text-decoration: none;
	text-align: center;
}

.cover {
	display: flex;
	align-items: center;
	margin-right: 20px;
}

.cover img {
	border-radius: 10px 0 0 10px;
}

.side {
	width: calc(960px - 250px);
}

.side h1 {
	margin: 10px 0 0 0;
}

.side h1 .subtitle {
	padding: 0;
	background: none !important;
	margin: 0;
	font-size: 80%;
}

.side h1 .agerating {
	font-size: 20px;
	padding: 5px 10px;
	background-color: #c4af3d;
	border-radius: 5px;
	margin: 0 10px 0 0;
	color: #000 !important;
	clear: both;
}

.side ul {
	list-style: none;
	margin: 20px 0;
	display: flex;
	flex-direction: row;
}

.side ul li {
	font-weight: bold;
	margin: 0 20px;
}

.side ul li span {
	padding: 5px 10px;
	background-color: #ff3300b3;
	border-radius: 5px;
	color: #000 !important;
}

.side ul + p, .side ul + p + p {
	display: inline;
}

.side ul + p {
	font-size: 110%;
	font-weight: bold;
}

.side ul + p + p {
	padding: 5px;
	border-radius: 5px;
	background-color: #ffffffb3;
	color: #000 !important;
}

.side ul + p + p span {
	font-weight: bold;
}

.side h4 {
	margin: 20px 0;
}

.side h4 + p {
	font-size: 90%;
	margin: 0 20px 20px 0;
}

.side h4 + p a {
	text-decoration: none;
	color: <?php echo $link_color; ?>;
	transition: all 0.3s ease;
}

.side h4 + p a:hover {
	color: <?php echo $color; ?>;
}

.side h5 a {
	text-decoration: none;
	padding: 4px 8px;
	border: 2px solid <?php echo $color; ?>;
	color: <?php echo $color; ?>;
	transition: all 0.3s ease;
}

.side h5 a:hover {
	border-color: #c4302b !important;
	color: #c4302b !important;
}

@media screen and (max-width: 768px) {
	.container {
		display: block;
		width: 460px;
		margin: 50% auto;
		padding: 60px 30px;
		border-radius: 10px;
		background-image: linear-gradient(-135deg, <?php echo $color . 'b3'; ?> 20%, transparent 80%);
		box-shadow: 0 0 25px -10px rgba(0,0,0, 0.5);
		z-index: 1;
		overflow: visible;
	}
	.cover {
		display: flex;
		align-items: center;
	}

	.cover img {
		margin: 0 auto;
		box-shadow: 0 0 20px -10px rgba(255,255,255, 0.5);
		margin-top: -120px;
		border-radius: 10px;
	}

	.side {
		width: calc(460px - 60px);
	}

	.side h1 {
		text-align: center;
		font-size: 250%;
	}

	.side h1 .agerating {
		font-size: 16px;
		padding: 4px 8px;
		border-radius: 4px;
		margin: 10px 0;
		color: #000 !important;
		clear: both;
	}

	.side ul {
		display: flex;
		justify-content: space-around;
	}

	.side ul li {
		font-size: 125%;
		font-weight: bold;
		margin: 0 20px;
	}

	.side ul li span {
		padding: 4px 8px;
		background-color: #ff3300b3;
		border-radius: 4px;
		color: #000 !important;
	}

	.side ul + p, .side ul + p + p, h4 {
		font-size: 125%;
	}

	.side h4 + p {
		font-size: 100%;
		text-align: justify;
		width: calc(460px - 60px);
	}

	.side h5 a {
		display: block;
		width: 100%;
		padding: 20px 0;
		text-align: center;
		margin: 0 auto;
		font-size: 150%;
		border: 5px solid <?php echo $color; ?>;
		color: <?php echo $color; ?>;
	}
}
</style>
<body>
<div class="img-background"></div><div class="background-overlay"></div>
	<label class="toogle-btn">
		<input type="checkbox" id="dark-mode">
		<span class="slider"></span>
	</label>
	<div class="update-link"><a href="update.php?id=<?php echo $movie_id; ?>">Update</a></div>
	<div class="container">
		<div class="cover"><img src="../movies/<?php echo $mov_folder_name . ' (' . $display_date . ')/poster'; ?>.jpg" alt=""></div>
		<div class="side">
			<h1><?php echo $display_title . $sub_title . ' '; ?><span class="agerating"><?php echo $age_rating; ?></span></h1>
			<ul>
				<li><?php echo $runtime; ?></li>
				<li><?php echo $genre; ?></li>
				<li><?php echo $display_release_date; ?></li>
				<li><span><?php echo $imdb_rating; ?></span></li>
			</ul>
			<p>Available: </p><p><?php echo $quality . ' '; ?><span><?php echo '[' . $size . ']'; ?></span></p>
			<h4><?php echo 'Director(s): ' . $directors; ?></h4>
			<p><?php echo $display_description; ?></p>
			<h5><a href="<?php echo $new_trailer_link; ?>" target="_blank">Watch Trailer</a></h5>
		</div>
	</div>
	<div class="back"><a href="panel.php">&#8678; Go Back</a></div>
	<script>

		var darkModeToggleBtn = document.querySelector("#dark-mode");
		var containerDiv = document.querySelector(".container");
		var trailerLink = document.querySelector(".side h5 a");
		darkModeToggleBtn.addEventListener('change', function() {
			if (this.checked) {
				document.body.style.backgroundColor = "#1b1b1b";
				document.body.style.color = "white";
				containerDiv.style.boxShadow = "0 0 25px -10px rgba(255,255,255, 0.5)";
				trailerLink.style.color = "white";
				trailerLink.style.borderColor = "white";
				localStorage.setItem('dark-mode-enabled', 'true');
			} else {
				document.body.style.backgroundColor = "white";
				document.body.style.color = "black";
				containerDiv.style.boxShadow = "0 0 25px -10px rgba(0,0,0, 0.5)";
				trailerLink.style.color = "<?php echo $color; ?>";
				trailerLink.style.borderColor = "<?php echo $color; ?>";
				localStorage.clear();
			}
		});

		if (localStorage.getItem('dark-mode-enabled') == 'true') {
			document.body.style.backgroundColor = "#1b1b1b";
			document.body.style.color = "white";
			containerDiv.style.boxShadow = "0 0 25px -10px rgba(255,255,255, 0.5)";
			trailerLink.style.color = "white";
			trailerLink.style.borderColor = "white";
			darkModeToggleBtn.checked = true;
		}

	</script>
</body>
</html>