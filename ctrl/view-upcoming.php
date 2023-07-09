<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php

	$query = "SELECT COUNT(id) AS count FROM upcoming";
	$result_set = mysqli_query($connection, $query);
	$result = mysqli_fetch_assoc($result_set);

	$movie_count = $result['count'];

	$rows_pre_page = 10;

	$last_page = ceil($movie_count / $rows_pre_page);

	if (isset($_GET['p']) and !empty($_GET['p']) and $_GET['p'] >= 1 and $_GET['p'] <= $last_page) {
		$page_no = $_GET['p'];
		
	} else {
		$page_no = 1;

	}

	$start = ($page_no - 1) * $rows_pre_page;
	
	$query = "SELECT id, name, release_date FROM upcoming ORDER BY release_date, name LIMIT {$start}, {$rows_pre_page}";

	$result_set = mysqli_query($connection, $query);

	// Page controller

	// first page
	$first = "<a href=\"view-upcoming.php?p=1\">First</a>";

	// last page
	$last_page_no = ceil($movie_count / $rows_pre_page);
	$last = "<a href=\"view-upcoming.php?p={$last_page_no}\">Last</a>";

	// next page
	if ($page_no >= $last_page_no) {
		$next = "<span>Next</span>";
		$last = "<span>Last</span>";
			
	} else {
		$next_page_no = $page_no + 1;
		$next = "<a href=\"view-upcoming.php?p={$next_page_no}\">Next</a>";
	}

	// previous page
	if ($page_no <= 1) {
		$prev = "<span>Previous</span>";
		$first = "<span>First</span>";
			
	} else {
		$prev_page_no = $page_no - 1;
		$prev = "<a href=\"view-upcoming.php?p={$prev_page_no}\">Previous</a>";
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="stylesheet" href="css/home.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="../js/jquery-3.4.1.js"></script>
	<title>Admin Panel - Infinity Movies</title>
</head>
<body>
	<label class="toogle-btn">
		<input type="checkbox" id="dark-mode">
		<span class="slider"></span>
	</label>
	<div class="container">
		<header>
			<h1><a href="panel.php">Admin Panel</a></h1>
			<p>Welcome <b><?php if (isset($_SESSION['admin_name'])) { echo $_SESSION['admin_name']; } ?></b></p>
			<form action="inc/logout.php" method="post">
				<button type="submit" name="logout">Log Out</button>
			</form>
		</header>
		<div class="functions">
			<ul>
				<li><a href="add-upcoming.php">« Go Back</a></li>
			</ul>
		</div>
		<form action="view-upcoming.php" method="post"><input type="search" name="search" id="search" placeholder="Search..." onkeyup="searchq();" autocomplete="off"></form>
		<section class="movie-set">
			<div class="mov-area">
				<?php

					while ($result = mysqli_fetch_assoc($result_set)) {

						$mov_release_date = $result['release_date'];
						$explode_date = explode('-', $mov_release_date);

						$mov_poster_name = str_replace(': ', ' - ', $result['name']);
						$year = $explode_date[0];

						echo '<a href="update-upcoming.php?id=' . $result['id'] . '">' . '<img src="../upcoming/' . $mov_poster_name . ' (' . $year . ').jpg" title="' . $result['name'] . ' (' . $year . ')" alt="' . $result['name'] . ' (' . $year . ')' . '">' . '</a>';

					}

				?>
			</div>
		</section>
		<footer>
			<?php echo '<h3>' . $first .'</h3><h3>' . $prev . '</h3><h3>Page ' . $page_no . ' of ' . $last_page_no . '</h3><h3>' . $next . '</h3><h3>' . $last . '</h3>'; ?>
		</footer>
	</div>
	<script>

		var darkModeToggleBtn = document.querySelector("#dark-mode");
		let searchBar = document.querySelector("#search");
		var movAreaImages = document.querySelectorAll(".mov-area a img");
		var functionsLinks = document.querySelectorAll(".functions ul li a");
		darkModeToggleBtn.addEventListener('change', function() {
			if (this.checked) {
				document.body.style.backgroundColor = "#1b1b1b";
				searchBar.style.backgroundColor = "#1b1b1b";
				searchBar.style.color = "white";
				for (var i = 0; i < movAreaImages.length; i++) {
					movAreaImages[i].style.border = "1px solid white";
				}
				for (var i = 0; i < functionsLinks.length; i++) {
					functionsLinks[i].style.color = "white";
				}
				localStorage.setItem('dark-mode-enabled', 'true');
			} else {
				document.body.style.backgroundColor = "white";
				searchBar.style.backgroundColor = "white";
				searchBar.style.color = "black";
				for (var i = 0; i < movAreaImages.length; i++) {
					movAreaImages[i].style.border = "1px solid black";
				}
				for (var i = 0; i < functionsLinks.length; i++) {
					functionsLinks[i].style.color = "";
				}
				localStorage.clear();
			}
		});

		if (localStorage.getItem('dark-mode-enabled') == 'true') {
			darkModeToggleBtn.checked = true;
			document.body.style.backgroundColor = "#1b1b1b";
			searchBar.style.backgroundColor = "#1b1b1b";
			searchBar.style.color = "white";
			for (var i = 0; i < movAreaImages.length; i++) {
				movAreaImages[i].style.border = "1px solid white";
			}
			for (var i = 0; i < functionsLinks.length; i++) {
				functionsLinks[i].style.color = "white";
			}
		}

		function searchq() {
			var search_txt = $("input[name='search']").val();
			$.post("inc/search-upcoming.php", {searchVal: search_txt}, function(output) {
				$(".mov-area").html(output);
			});
		}
	</script>
</body>
</html>