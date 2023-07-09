<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php

	$check = "SELECT COUNT(id) AS count FROM upcoming";
	$get_count = mysqli_query($connection, $check);
	$count = mysqli_fetch_assoc($get_count);
	$mov_count = $count['count'];

	if (isset($_GET['id']) and !empty($_GET['id'])) {

		$id = $_GET['id'];

		$get_query = "SELECT name, release_date, imdb_rating, trailer FROM upcoming WHERE id = '{$id}' LIMIT 1";

		$result_set_get_query = mysqli_query($connection, $get_query);

		if (isset($result_set_get_query)) {

			$get_query_result = mysqli_fetch_assoc($result_set_get_query);

			// Set Values to input fields

			$get_name = $get_query_result['name'];
			$get_release_date = $get_query_result['release_date'];
			$get_imdb_rating = $get_query_result['imdb_rating'];
			$get_trailer = $get_query_result['trailer'];

		}

		$errors = array();
		$imgerrors = array();

		if (isset($_POST['update'])) {

			if (!isset($_POST['name']) || strlen(trim($_POST['name'])) <1) {
				$errors[] = 'Movie Name is missing or invalid';
			}

			if (!isset($_POST['imdb-rating']) || strlen(trim($_POST['imdb-rating'])) <1) {
				$errors[] = 'Movie IMDb Rating is missing or invalid';
			}

			if (!isset($_POST['release-date']) || strlen(trim($_POST['release-date'])) <1) {
				$errors[] = 'Movie Release Date is missing or invalid';
			}

			if (!isset($_FILES['poster-image']) || empty($_FILES['poster-image'])) {
				$errors[] = 'Movie Poster image is missing or invalid';
			}

			if (!isset($_POST['trailer']) || strlen(trim($_POST['trailer'])) <1) {
				$errors[] = 'Movie Trailer link is missing or invalid';
			}

			if (empty($errors)) {

				$name = mysqli_real_escape_string($connection, $_POST['name']);
				$imdb_rating = mysqli_real_escape_string($connection, $_POST['imdb-rating']);
				$release_date = mysqli_real_escape_string($connection, $_POST['release-date']);
				$poster_image = $_FILES['poster-image'];
				$trailer = mysqli_real_escape_string($connection, $_POST['trailer']);
				
				// Validate Name

				if (isset($name)) {

					if (strlen($name) < 1000) {

						$new_name = trim($name);

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

							if ($imdb_rating >= 0.0 && $imdb_rating <= 10.0) {
								$new_imdb_rating = $imdb_rating;
							} else {
								$errors[] = 'IMDb rating is less than 1 or grater than 10.0';
							}

						}

					} else {

						$new_imdb_rating = $imdb_rating;

					}

				}

				// Poster Image Upload

				if (isset($poster_image)) {
					
					$file_name = $poster_image['name'];
					$file_type = $poster_image['type'];
					$tmp_name = $poster_image['tmp_name'];
					$file_error = $poster_image['error'];
					$file_size = $poster_image['size'];

					$poster_name = str_replace(': ', ' - ', $_POST['name']);

					$exploded_date = explode('-', $release_date);
					$year = $exploded_date[0];
					$upload_dir = '.././upcoming/';

					if ($file_type != "image/jpeg") {
						$imgerrors[] = 'Image file should be jpg.';
					}

					if ($file_error > 0) {
						$imgerrors[] = 'File may be invalid or corrupted.';
					}

					if ($file_size > 1000000) {
						$imgerrors[] = 'File size should be less than 1MB.';
					}

					if (empty($imgerrors)) {

						move_uploaded_file($tmp_name, $upload_dir . $poster_name . ' (' . $year . ').jpg');

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

				if (empty($errors)) {

					$update_query = "UPDATE upcoming SET name = '{$new_name}', release_date = '{$new_release_date}', imdb_rating = '{$new_imdb_rating}', trailer = '{$new_trailer}' WHERE id = '{$id}' LIMIT 1";

					$result = mysqli_query($connection, $update_query);

				}

			}

		}

	} else {
		header('Location: view-upcoming.php');
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
	<title>Update Upcoming Details</title>
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
	<div class="go-back"><a href="view-upcoming.php">« Go Back</a></div>
	<div class="container">
		<form action="update-upcoming.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Update Upcoming film details</legend>
				<div class="messages">
					<?php
						if (isset($_POST['update'])) {
							if (isset($result)) {
								echo "<p class=\"success\">" . $_POST['name'] . " has been updated</p>";
								header('Refresh: 5; URL=view-upcoming.php');
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
					<input type="text" name="name" id="name" maxlength="255" placeholder="Enter film name" value="<?php if (isset($id)) { echo $get_name; } ?>">
				<label>Rating: </label>
					<input type="number" name="imdb-rating" id="imdb-rating" min="0.0" max="10.0" value="<?php if (isset($id)) { echo $get_imdb_rating; } ?>" step="0.1">
				<label>Release date: </label>
					<input type="date" name="release-date" id="release-date" min="2001-01-01" value="<?php if (isset($id)) { echo $get_release_date; } ?>">
				<label>Upload Movie Poster Image: </label>
					<pre>NOTE: Image file size should be 230px 345px. (YTS)</pre>
					<input type="file" name="poster-image" id="poster-image" accept="image/jpeg">
				<label>Enter Movie Trailer Link: </label>
					<pre>NOTE: Trailer link should be YouTube.</pre>
					<input type="url" name="trailer" id="trailer" pattern="https://.*" placeholder="https://youtu.be/CJLYq0b81bo" value="<?php if (isset($id)) { echo $get_trailer; } ?>">
				<button type="submit" name="update" id="update">Update</button>
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