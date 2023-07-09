<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php

	$errors = array();

	if (isset($_POST['save'])) {

		if (!isset($_POST['name']) || strlen(trim($_POST['name'])) <1) {
			$errors[] = 'Movie Name is missing or invalid';
		}

		if (!isset($_POST['age-rating']) || strlen(trim($_POST['age-rating'])) <1) {
			$errors[] = 'Movie Age Rating is missing or invalid';
		}

		if (!isset($_POST['hours']) || strlen(trim($_POST['hours'])) <1) {
			$errors[] = 'Movie Hours is missing or invalid';
		}

		if (!isset($_POST['minutes']) || strlen(trim($_POST['minutes'])) <1) {
			$errors[] = 'Movie Minutes is missing or invalid';
		}

		if (!isset($_POST['imdb-rating']) || strlen(trim($_POST['imdb-rating'])) <1) {
			$errors[] = 'Movie IMDb Rating is missing or invalid';
		}

		if (!isset($_POST['imdb-rating-count']) || strlen(trim($_POST['imdb-rating-count'])) <1) {
			$errors[] = 'Movie IMDb Rating Count is missing or invalid';
		}

		if (!isset($_POST['release-date']) || strlen(trim($_POST['release-date'])) <1) {
			$errors[] = 'Movie Release Date is missing or invalid';
		}

		if (!isset($_POST['rotten-tomatoes']) || strlen(trim($_POST['rotten-tomatoes'])) <1) {
			$errors[] = 'Movie Rotten Tomatoes rating is missing or invalid';
		}

		if (!isset($_POST['audience-score']) || strlen(trim($_POST['audience-score'])) <1) {
			$errors[] = 'Movie Rotten Tomatoes audience-score is missing or invalid';
		}

		if (!isset($_POST['rotten-rating-count']) || strlen(trim($_POST['rotten-rating-count'])) <1) {
			$errors[] = 'Movie Rotten Tomatoes user rating count is missing or invalid';
		}

		if (!isset($_POST['genre'])) {
			$errors[] = 'Movie Genre is missing or invalid';
		}

		if (!isset($_POST['size']) || strlen(trim($_POST['size'])) <1) {
			$errors[] = 'Movie Size is missing or invalid';
		}

		if (!isset($_POST['box-office']) || strlen(trim($_POST['box-office'])) <1) {
			$errors[] = 'Movie Box Office is missing or invalid';
		}

		if (!isset($_POST['quality']) || strlen(trim($_POST['quality'])) <1) {
			$errors[] = 'Movie Quality is missing or invalid';
		}

		if (!isset($_POST['resolution']) || strlen(trim($_POST['resolution'])) <1) {
			$errors[] = 'Movie Resolution is missing or invalid';
		}

		if (!isset($_POST['directors']) || strlen(trim($_POST['directors'])) <1) {
			$errors[] = 'Movie Directors is missing or invalid';
		}

		if (!isset($_POST['description'])) {
			$errors[] = 'Movie Description is missing or invalid';
		}

		if (!isset($_POST['color']) || strlen(trim($_POST['color'])) <1) {
			$errors[] = 'Movie Colour is missing or invalid';
		}

		if (!isset($_FILES['poster-image']) || empty($_FILES['poster-image'])) {
			$errors[] = 'Movie Poster image is missing or invalid';
		}

		if (!isset($_FILES['background-image']) || empty($_FILES['background-image'])) {
			$errors[] = 'Movie Poster image is missing or invalid';
		}

		if (!isset($_POST['trailer']) || strlen(trim($_POST['trailer'])) <1) {
			$errors[] = 'Movie Trailer link is missing or invalid';
		}

		if (!isset($_POST['download-link']) || strlen(trim($_POST['download-link'])) <1) {
			$errors[] = 'Movie Download link is missing or invalid';
		}

		if (!isset($_POST['sub-download-link']) || strlen(trim($_POST['sub-download-link'])) <1) {
			$errors[] = 'Movie Subtitle Download link is missing or invalid';
		}

		if (!isset($_POST['keywords'])) {
			$errors[] = 'Movie Keywords is missing or invalid';
		}

		if (empty($errors)) {

			$name = mysqli_real_escape_string($connection, $_POST['name']);
			$age_rating = mysqli_real_escape_string($connection, $_POST['age-rating']);
			$hours = mysqli_real_escape_string($connection, $_POST['hours']);
			$minutes = mysqli_real_escape_string($connection, $_POST['minutes']);
			$imdb_rating = mysqli_real_escape_string($connection, $_POST['imdb-rating']);
			$imdb_rating_count = mysqli_real_escape_string($connection, $_POST['imdb-rating-count']);
			$release_date = mysqli_real_escape_string($connection, $_POST['release-date']);
			$genre = $_POST['genre'];
			$rotten_tomatoes = mysqli_real_escape_string($connection, $_POST['rotten-tomatoes']);
			$audience_score = mysqli_real_escape_string($connection, $_POST['audience-score']);
			$rotten_rating_count = mysqli_real_escape_string($connection, $_POST['rotten-rating-count']);
			$size = mysqli_real_escape_string($connection, $_POST['size']);
			$box_office = mysqli_real_escape_string($connection, $_POST['box-office']);
			$quality = mysqli_real_escape_string($connection, $_POST['quality']);
			$resolution = mysqli_real_escape_string($connection, $_POST['resolution']);
			$directors = mysqli_real_escape_string($connection, $_POST['directors']);
			$description = mysqli_real_escape_string($connection, $_POST['description']);
			$color = mysqli_real_escape_string($connection, $_POST['color']);
			$poster_image = $_FILES['poster-image'];
			$background_image = $_FILES['background-image'];
			$trailer = mysqli_real_escape_string($connection, $_POST['trailer']);
			$download_link = mysqli_real_escape_string($connection, $_POST['download-link']);
			$sub_download_link = mysqli_real_escape_string($connection, $_POST['sub-download-link']);
			$keywords = mysqli_real_escape_string($connection, $_POST['keywords']);

			$query = "SELECT * FROM movies WHERE name = '{$name}' LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			if (mysqli_num_rows($result_set) == 1) {

				$errors[] = 'This movie is already exists';

			} else {

				// Validate Name

				if (isset($name)) {

					if (strlen($name) < 1000) {

						$new_name = trim($name);

					}

				}

				// Validate Age Rating

				if (isset($age_rating)) {

					if ($age_rating == "PG-13") {
						$new_age_rating = $age_rating;
					} else if ($age_rating == "G") {
						$new_age_rating = $age_rating;
					} else if ($age_rating == "PG") {
						$new_age_rating = $age_rating;
					} else if ($age_rating == "R") {
						$new_age_rating = $age_rating;
					} else {
						$new_age_rating = $age_rating;
					}

				}

				// Validate Runtime

				if (isset($hours) && isset($minutes)) {

					if ($hours < 12 && $minutes < 60) {

						$new_runtime = $hours . "hr " . $minutes . "min";

					} else {

						$errors[] = 'Invalid time';

					}

				}

				// Validate Release Date

				if (isset($release_date)) {

					$date = explode('-', $release_date);
					if (count($date) == 3) {

						if (checkdate($date[1], $date[2], $date[0])) {
							$new_release_date = $date[0] . '-' . $date[1] . '-' . $date[2];
						} else {
							$errors[] = 'Invalid date';
						}

					} else {

						$errors[] = 'Invalid date';

					}

				}

				// Validate IMDb Rating

				if (isset($imdb_rating)) {

					if (strpos($imdb_rating, '.') !== false) {

						if (strlen($imdb_rating) < 5) {

							if ($imdb_rating >= 1.0 && $imdb_rating <= 10.0) {
								$new_imdb_rating = $imdb_rating;
							} else {
								$errors[] = 'IMDb rating is less than 1 or grater than 10.0';
							}

						}

					} else {

						$new_imdb_rating = $imdb_rating;

					}

				}

				// Validate IMDb Rating Count

				if (isset($imdb_rating_count)) {

					if (strlen($imdb_rating_count) < 12) {

						if ($imdb_rating_count >= 1 && $imdb_rating_count <= 99999999999) {
							$replace_imdb_rating_count = str_replace(',', '', $imdb_rating_count);
							$new_imdb_rating_count = $replace_imdb_rating_count;
						} else {
							$errors[] = 'IMDb rating count is less than 1 or grater than 99999999999';
						}

					} else {

						$errors[] = 'IMDb Rating count is much longer';

					}

				}

				// Validate Genres

				if (isset($genre)) {

					$genres_set = '';

					foreach ($genre as $name => $value) {
						
						$genres_set .= $value . ", ";

					}

					$new_genres = rtrim($genres_set, ", ");

				}

				// Validate Rotten Tomatoes Rating

				if (isset($rotten_tomatoes)) {

					if (strlen($rotten_tomatoes) < 4) {

						if ($rotten_tomatoes >= 1 && $rotten_tomatoes <= 100) {
							$new_rotten_tomatoes = $rotten_tomatoes;
						} else {
							$errors[] = 'Rotten Tomatoes rating is less than 1 or grater than 100';
						}

					} else {

						$errors[] = 'Rotten Tomatoes Rating is much longer';

					}

				}

				// Validate Rotten Tomatoes Audience Score Rating

				if (isset($audience_score)) {

					if (strlen($audience_score) < 4) {

						if ($audience_score >= 1 && $audience_score <= 100) {
							$new_audience_score = $audience_score;
						} else {
							$errors[] = 'Rotten Tomatoes User Audience Score is less than 1 or grater than 100';
						}

					} else {

						$errors[] = 'Rotten Tomatoes Rating is much longer';

					}

				}

				// Validate Rotten Tomatoes User Rating Count

				if (isset($rotten_rating_count)) {

					if (strlen($rotten_rating_count) < 12) {

						if ($rotten_rating_count >= 1 && $rotten_rating_count <= 99999999999) {
							$replace_rotten_rating_count = str_replace(',', '', $rotten_rating_count);
							$new_rotten_rating_count = $replace_rotten_rating_count;
						} else {
							$errors[] = 'Rotten Tomatoes User Rating count is less than 1 or grater than 99999999999';
						}

					} else {

						$errors[] = 'Rotten Tomatoes User Rating count is much longer';

					}

				}

				// Validate Size

				if (isset($size)) {

					// Check whether it is MB or GB

					if ($size < 1024 && $size > 0) {

						if (strpos($size, '.') !== false) {
							if ($size < 10) {
								$new_size = $size . "GB";
							} else {
								$new_size = $size . "MB";
							}
						} else {
							$new_size = $size . "MB";
						}

					} else {

						$errors[] = 'Invalid file size';

					}

				}

				// Validate Box Office

				if (isset($box_office)) {

					if (strlen($box_office) < 12) {

						if ($box_office >= 1 && $box_office <= 99999999999) {
							$new_box_office = $box_office;
						} else {
							$errors[] = 'Box Office value is less than 1 or grater than 99999999999';
						}

					} else {

						$errors[] = 'Box office value is much longer';

					}

				}

				// Validate Quality

				if (isset($quality) && isset($resolution)) {

					// Check resolution

					if ($resolution == "1080p") {
						$new_quality = $resolution ." ";
					} else if ($resolution == "720p") {
						$new_quality = $resolution ." ";
					} else {
						$new_quality = $resolution ." ";
					}

					// Check quality

					if ($quality == "WEB") {
						$new_quality .= $quality;
					} else if ($quality == "BRRip") {
						if ($new_quality == "480p ") {
							$new_quality = "720p BRRip";
						} else {
							$new_quality .= $quality;
						}
					} else {
						if ($new_quality == "480p " || $new_quality == "720p ") {
							$new_quality = "1080p 3D BluRay";
						} else {
							$new_quality .= $quality;
						}
					}

				}

				// Validate Directors

				if (isset($directors)) {

					$trim_directors = trim($directors);
					$new_directors = ucwords($trim_directors);

				}

				// Validate description

				if (isset($description)) {

					if (strlen($description) <= 10000) {

						$new_description = trim($description);

					}

				}

				// Validate Colour

				if (isset($color)) {

					$escape_color = trim($color);
					$lower_color = strtolower($escape_color);

					if (strpos($lower_color, '#') !== false) {
						$re_color = $lower_color;
					} else {
						$re_color = "#" . $lower_color;
					}

					if (strpos($re_color, '000000') !== false || strrpos($re_color, 'ffffff') !== false) {
						$errors[] = "Enter different colour without black (#000000) and white (#ffffff)";
					} else {
						$new_color = $re_color;
					}

				}

				// Poster Image Upload

				if (isset($poster_image)) {
					
					$file_name = $poster_image['name'];
					$file_type = $poster_image['type'];
					$tmp_name = $poster_image['tmp_name'];
					$file_error = $poster_image['error'];
					$file_size = $poster_image['size'];

					$folder_name = str_replace(': ', ' - ', $_POST['name']);

					$exploded_date = explode('-', $release_date);
					$year = $exploded_date[0];
					$upload_dir = '.././movies/' . $folder_name. ' (' . $year . ')/';

					if ($file_type != "image/jpeg") {
						$errors[] = 'Image file should be jpg.';
					}

					if ($file_error > 0) {
						$errors[] = 'File may be invalid or corrupted.';
					}

					if ($file_size > 1000000) {
						$errors[] = 'File size should be less than 1MB.';
					}

					if (!file_exists($upload_dir)) {

						if (mkdir($upload_dir, 0777, true)) {

							if (empty($errors)) {

								move_uploaded_file($tmp_name, $upload_dir . 'poster.jpg');

							}

						} else {

							$errors[] = 'Folders cannot be created recursively.';

						}

					} else {

						$errors[] = 'This file is already exists.';

					}

				}

				// Background Image Upload

				if (isset($background_image)) {
					
					$file_name = $background_image['name'];
					$file_type = $background_image['type'];
					$tmp_name = $background_image['tmp_name'];
					$file_error = $background_image['error'];
					$file_size = $background_image['size'];

					$folder_name = str_replace(': ', ' - ', $_POST['name']);

					$exploded_date = explode('-', $release_date);
					$year = $exploded_date[0];
					$upload_dir = '.././movies/' . $folder_name. ' (' . $year . ')/';

					if ($file_type != "image/jpeg") {
						$errors[] = 'Image file should be jpg.';
					}

					if ($file_error > 0) {
						$errors[] = 'File may be invalid or corrupted.';
					}

					if ($file_size > 1000000) {
						$errors[] = 'File size should be less than 1MB.';
					}

					if (!file_exists($upload_dir)) {

						if (mkdir($upload_dir, 0777, true)) {

							if (empty($errors)) {

								move_uploaded_file($tmp_name, $upload_dir . 'background.jpg');
								
							}

						} else {

							$errors[] = 'Folders cannot be created recursively.';

						}

					} else {

						if (empty($errors)) {

							move_uploaded_file($tmp_name, $upload_dir . 'background.jpg');

						}

					}

				}

				// Validate Trailer

				if (isset($trailer)) {

					if (strpos($trailer, 'https://www.youtube.com/embed/') !== false || strpos($trailer, 'https://www.youtube.com/watch?v=') !== false || strpos($trailer, 'https://youtu.be/') !== false) {

						$get_yt_mov_id = substr($trailer, -11);
						$new_trailer = 'https://www.youtube.com/embed/' . $get_yt_mov_id;

					} else {

						$errors[] = 'Trailer link should be YouTube. (Embed)';

					}

				}

				// Validate Download Link

				if (isset($download_link)) {

					if (strlen($download_link) < 5000) {
						$new_download_link = $download_link;
					} else {
						$errors[] = 'Download Link must be least 5000 characters.';
					}

				}

				// Validate Subtitles Download Link

				if (isset($sub_download_link)) {

					if (strlen($sub_download_link) < 5000) {
						$new_sub_download_link = $sub_download_link;
					} else {
						$errors[] = 'Subtitle Download Link must be least 5000 characters.';
					}

				}

				// Validate keywords

				if (isset($keywords)) {

					if (strlen($keywords) <= 65535) {

						$new_keywords = trim($keywords);

					}

				}

				if (empty($errors)) {

					$insert_query = "INSERT INTO movies (name, age_rating, runtime, imdb_rating, imdb_rating_count, release_date, genres, rotten_tomatoes, audience_score, rotten_rating_count, size, box_office, quality, directors, description, color, trailer, download_link, sub_download_link, keywords) VALUES ('{$new_name}', '{$new_age_rating}', '{$new_runtime}', '{$new_imdb_rating}', '{$new_imdb_rating_count}', '{$new_release_date}', '{$new_genres}', '{$new_rotten_tomatoes}', '{$new_audience_score}', '{$new_rotten_rating_count}', '{$new_size}', '{$new_box_office}', '{$new_quality}', '{$new_directors}', '{$new_description}', '{$new_color}', '{$new_trailer}', '{$new_download_link}', '{$new_sub_download_link}', '{$new_keywords}')";

					$result = mysqli_query($connection, $insert_query);

					if ($result) {
						$check_upcoming = "SELECT * FROM upcoming WHERE name = '{$new_name}' LIMIT 1";
						$check_upcoming_result_set = mysqli_query($connection, $check_upcoming);

						if (mysqli_num_rows($check_upcoming_result_set) == 1) {
							if ($del_file = mysqli_fetch_assoc($check_upcoming_result_set)) {
								$del_file_id = $del_file['id'];
								$del_mov_poster_name = str_replace(': ', ' - ', $del_file['name']);
								$del_mov_release_date = $del_file['release_date'];
								$explode_date = explode('-', $del_mov_release_date);
								$year = $explode_date[0];

								unlink("../upcoming/".$del_mov_poster_name." (".$year.").jpg");
								
								$del_upcoming = "DELETE FROM upcoming WHERE id = '{$del_file_id}'";
								$del_upcoming_result = mysqli_query($connection, $del_upcoming);
							}
						}
					}

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
	<link rel="stylesheet" href="css/enter.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="../js/jquery-3.4.1.js"></script>
	<title>Enter</title>
</head>
<body>

	<label class="toogle-btn">
		<input type="checkbox" id="dark-mode">
		<span class="slider"></span>
	</label>
	<header>
		<h1><a href="panel.php">Admin Panel</a></h1>
		<p>Welcome <b><?php if (isset($_SESSION['admin_name'])) { echo $_SESSION['admin_name']; } ?></b></p>
		<form action="inc/logout.php" method="post">
			<button type="submit" name="logout">Log Out</button>
		</form>
	</header>
	<div class="go-back"><a href="panel.php">« Go to Main Panel</a></div>
	<div class="container">
		<form action="enter.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Enter film details</legend>
				<div class="messages">
					<?php
						if (isset($_POST['save'])) {
							if (isset($result)) {
								echo "<p class=\"success\">" . $_POST['name'] . " has been saved</p>";
								header('Refresh: 5; URL=panel.php');
							}
							if (!empty($errors)) {
								echo "<div class=\"errors\">";
								foreach ($errors as $key => $value) {
									echo "<p>" . $value . "</p>";
								}
								echo "</div>";
							}
						}
					?>
				</div>
				<label>Name: </label>
					<input type="text" name="name" id="name" maxlength="255" placeholder="Enter film name">
				<label>Age Rating: </label>
					<input type="radio" name="age-rating" id="age-rating" value="PG-13" checked> PG-13
					<input type="radio" name="age-rating" id="age-rating" value="G"> G
					<input type="radio" name="age-rating" id="age-rating" value="PG"> PG
					<input type="radio" name="age-rating" id="age-rating" value="R"> R
					<input type="radio" name="age-rating" id="age-rating" value="NC-17"> NC-17
				<label>Runtime: </label>
					<input type="number" name="hours" id="hours" min="1" max="20" value="2"> hr
					<input type="number" name="minutes" id="minutes" min="1" max="59" value="30"> min
				<label>Rating: </label>
					<input type="number" name="imdb-rating" id="imdb-rating" min="0.1" max="10.0" value="6.0" step="0.1">
				<label>Rating Count: </label>
					<input type="number" name="imdb-rating-count" id="imdb-rating-count" min="0" max="99999999999" value="0" step="1">
				<label>Release date: </label>
					<input type="date" name="release-date" id="release-date" min="2001-01-01" max="<?php echo date('Y-m-d'); ?>">
				<label>Genres: </label>
					<ul>
						<li><input type="checkbox" name="genre[Action]" id="genre" value="Action"> Action</li>
						<li><input type="checkbox" name="genre[Adventure]" id="genre" value="Adventure"> Adventure</li>
						<li><input type="checkbox" name="genre[Animation]" id="genre" value="Animation"> Animation</li>
						<li><input type="checkbox" name="genre[Biography]" id="genre" value="Biography"> Biography</li>
						<li><input type="checkbox" name="genre[Comedy]" id="genre" value="Comedy"> Comedy</li>
						<li><input type="checkbox" name="genre[Crime]" id="genre" value="Crime"> Crime</li>
						<li><input type="checkbox" name="genre[Drama]" id="genre" value="Drama"> Drama</li>
						<li><input type="checkbox" name="genre[Family]" id="genre" value="Family"> Family</li>
						<li><input type="checkbox" name="genre[Fantasy]" id="genre" value="Fantasy"> Fantasy</li>
						<li><input type="checkbox" name="genre[Film-Noir]" id="genre" value="Film-Noir"> Film-Noir</li>
						<li><input type="checkbox" name="genre[History]" id="genre" value="History"> History</li>
						<li><input type="checkbox" name="genre[Horror]" id="genre" value="Horror"> Horror</li>
						<li><input type="checkbox" name="genre[Music]" id="genre" value="Music"> Music</li>
						<li><input type="checkbox" name="genre[Musical]" id="genre" value="Musical"> Musical</li>
						<li><input type="checkbox" name="genre[Mystery]" id="genre" value="Mystery"> Mystery</li>
						<li><input type="checkbox" name="genre[Romance]" id="genre" value="Romance"> Romance</li>
						<li><input type="checkbox" name="genre[Sci-Fi]" id="genre" value="Sci-Fi"> Sci-Fi</li>
						<li><input type="checkbox" name="genre[Sport]" id="genre" value="Sport"> Sport</li>
						<li><input type="checkbox" name="genre[Thriller]" id="genre" value="Thriller"> Thriller</li>
						<li><input type="checkbox" name="genre[War]" id="genre" value="War"> War</li>
						<li><input type="checkbox" name="genre[Western]" id="genre" value="Western"> Western</li>
					</ul>
				<label>Rotten Tomatoes: </label>
					<input type="number" name="rotten-tomatoes" id="rotten-tomatoes" min="0" max="100" value="0" step="1"> %
				<label>Audience Score: </label>
					<input type="number" name="audience-score" id="audience-score" min="0" max="100" value="0" step="1"> %
				<label>Rotten Tomatoes User Rating Count: </label>
					<input type="number" name="rotten-rating-count" id="rotten-rating-count" min="0" max="99999999999" value="0" step="1">
				<label>File size: </label>
					<input type="number" name="size" id="size" min="1" max="1023" value="1" step="0.01"> MB or GB
				<label>Box Office: </label>
					<input type="number" name="box-office" id="box-office" min="1" max="99999999999" value="1" step="1"> $
				<label>Quality: </label>
					<input type="radio" name="quality" id="quality" value="WEB" checked> WEB
					<input type="radio" name="quality" id="quality" value="BRRip"> BluRay
					<input type="radio" name="quality" id="quality" value="3D BluRay"> 3D BluRay
					<select name="resolution" id="resolution">
						<option value="1080p" selected>1080p</option>
						<option value="720p">720p</option>
						<option value="480p">480p</option>
					</select>
				<label>Directors: </label>
					<input type="text" name="directors" id="directors" maxlength="255" placeholder="Enter Directors">
				<label>Description</label>
					<textarea id="description" name="description" rows="5" cols="33" placeholder="Movie description..."></textarea>
				<label>Colour: </label>
					<input type="text" name="color" id="color" maxlength="7" placeholder="Enter hex color code">
				<label>Upload Movie Poster Image: </label>
					<pre>NOTE: Image file size should be 230px 345px. (YTS)</pre>
					<input type="file" name="poster-image" id="poster-image" accept="image/jpeg">
				<label>Upload Movie Background Image: </label>
					<pre>NOTE: Image file size should be 1920px 1080px.</pre>
					<input type="file" name="background-image" id="background-image" accept="image/jpeg">
				<label>Enter Movie Trailer Link: </label>
					<pre>NOTE: Trailer link should be YouTube.</pre>
					<input type="url" name="trailer" id="trailer" pattern="https://.*" placeholder="https://youtu.be/CJLYq0b81bo">
				<label>Enter Movie Download Link: </label>
					<pre>NOTE: Download link should be torrent.</pre>
					<input type="url" name="download-link" id="download-link" placeholder="https://yts.lt/torrent/download/5A4140BD59D66BCAC57CF05AF4A8FAB4EBCAE1C1">
				<label>Enter Movie Subtitle Download Link: </label>
					<input type="url" name="sub-download-link" id="sub-download-link" placeholder="https://www.yifysubtitles.com/subtitle/avengersendgame2019720pblurayx264ytsag-english-152239.zip">
				<label>Keywords</label>
					<textarea id="keywords" name="keywords" rows="5" cols="33" placeholder="Keywords for movie..."></textarea>
				<button type="submit" name="save" id="save">Save</button>
			</fieldset>
		</form>
	</div>
	<script>
		
		var darkModeToggleBtn = document.querySelector("#dark-mode");
		var goBackA = document.querySelector(".go-back a");
		var labels = document.querySelectorAll("label");
		let inputAll = document.querySelectorAll("input");
		let textareaAll = document.querySelectorAll("textarea");
		darkModeToggleBtn.addEventListener('change', function() {
			if (this.checked) {
				document.body.style.backgroundColor = "#1b1b1b";
				document.body.style.color = "white";
				goBackA.style.color = "white";
				for (var i = 0; i < labels.length; i++) {
					labels[i].style.color = "orange";
				}
				for (var i = 0; i < inputAll.length; i++) {
					inputAll[i].style.backgroundColor = "#1b1b1b";
					inputAll[i].style.color = "white";
				}
				for (var i = 0; i < textareaAll.length; i++) {
					textareaAll[i].style.backgroundColor = "#1b1b1b";
					textareaAll[i].style.color = "white";
				}
				localStorage.setItem('dark-mode-enabled', 'true');
			} else {
				document.body.style.backgroundColor = "white";
				document.body.style.color = "black";
				goBackA.style.color = "";
				for (var i = 0; i < labels.length; i++) {
					labels[i].style.color = "#ff3300";
				}
				for (var i = 0; i < inputAll.length; i++) {
					inputAll[i].style.backgroundColor = "white";
					inputAll[i].style.color = "black";
				}
				for (var i = 0; i < textareaAll.length; i++) {
					textareaAll[i].style.backgroundColor = "white";
					textareaAll[i].style.color = "black";
				}
				localStorage.clear();
			}
		});

		if (localStorage.getItem('dark-mode-enabled') == 'true') {
			document.body.style.backgroundColor = "#1b1b1b";
			document.body.style.color = "white";
			goBackA.style.color = "white";
			for (var i = 0; i < labels.length; i++) {
				labels[i].style.color = "orange";
			}
			for (var i = 0; i < inputAll.length; i++) {
				inputAll[i].style.backgroundColor = "#1b1b1b";
				inputAll[i].style.color = "white";
			}
			for (var i = 0; i < textareaAll.length; i++) {
				textareaAll[i].style.backgroundColor = "#1b1b1b";
				textareaAll[i].style.color = "white";
			}
			darkModeToggleBtn.checked = true;
		}

	</script>
</body>
</html>