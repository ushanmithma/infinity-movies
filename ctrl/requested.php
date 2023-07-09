<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php if (isset($_SESSION['admin_id'])) { $current_id = $_SESSION['admin_id']; } ?>
<?php

$req_mov_count = "SELECT COUNT(id) AS count FROM requests";
$req_mov_count_result_set = mysqli_query($connection, $req_mov_count);
$req_mov_count_result = mysqli_fetch_assoc($req_mov_count_result_set);

$req_mov_members_count = $req_mov_count_result['count'];

$rows_pre_page = 12;

$last_page = ceil($req_mov_members_count / $rows_pre_page);

if (isset($_GET['p']) and !empty($_GET['p']) and $_GET['p'] >= 1 and $_GET['p'] <= $last_page) {
	$page_no = $_GET['p'];
	
} else {
	$page_no = 1;

}

$start = ($page_no - 1) * $rows_pre_page;

$query = "SELECT r.id, r.name, r.year, r.description, r.user_id, u.first_name, u.last_name FROM requests r, users u WHERE r.user_id = u.id LIMIT {$start}, {$rows_pre_page}";

$result_set = mysqli_query($connection, $query);

// Page controller

// first page
$first = "<a href=\"requested.php?p=1\">First</a>";

// last page
$last_page_no = ceil($req_mov_members_count / $rows_pre_page);
$last = "<a href=\"requested.php?p={$last_page_no}\">Last</a>";

// next page
if ($page_no >= $last_page_no) {
	$next = "<span>Next</span>";
	$last = "<span>Last</span>";
		
} else {
	$next_page_no = $page_no + 1;
	$next = "<a href=\"requested.php?p={$next_page_no}\">Next</a>";
}

// previous page
if ($page_no <= 1) {
	$prev = "<span>Previous</span>";
	$first = "<span>First</span>";
		
} else {
	$prev_page_no = $page_no - 1;
	$prev = "<a href=\"requested.php?p={$prev_page_no}\">Previous</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel - Infinity Movies</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="../js/jquery-3.4.1.js"></script>
</head>
<style>
* {margin: 0;padding: 0;box-sizing: border-box;}
body { font-family: sans-serif; }
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
header {
	width: 100%;
	height: 10vh;
	background-color: #1b1b1b;
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	align-items: center;
}
header h1 {
	width: 33.3%;
}
header h1 a {
	color: #fff;
	text-decoration: none;
	padding-left: 50px;
}
header p {
	width: 33.3%;
	color: #fff;
}
header form {
	width: 33.3%;
	padding-right: 50px;
}
header form button {
	float: right;
	width: 80px;
	height: 30px;
}
.go-back {
	margin-top: 40px;
}
.go-back a {
	margin-left: 80px;
	color: #000;
	text-decoration: none;
}
table {
	width: 90%;
	margin: 20px auto 20px auto;
	border-collapse: collapse;
}
table tr:nth-child(odd) {
	background-color: #e6e6e6;
}
table tr th {
	background: #aaa;
	text-align: left;
}
table tr th, tr td {
	padding: 10px;
	border-bottom: 1px solid #aaa;
}
footer {
	width: 100%;
	height: 10vh;
	background-color: #1b1b1b;
	color: #fff;
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	justify-content: space-around;
	align-items: center;
}

footer h3 {
	color: #fff;
	text-align: center;
	padding: 27px 0;
	font-weight: normal;
}

footer h3 a {
	text-decoration: none;
	font-size: 90%;
	font-weight: bolder;
	color: #ff3300;
	transition: all 0.3s ease;
}

footer h3 a:hover {
	color: orange;
}

footer h3 span {
	opacity: 0.8;
	color: #ff3300;
	cursor: not-allowed;
}
</style>
<body>
	<label class="toogle-btn">
		<input type="checkbox" id="dark-mode">
		<span class="slider"></span>
	</label>
	<header>
		<h1><a href="index.php">Admin Panel</a></h1>
		<p>Welcome <b><?php if (isset($_SESSION['admin_name'])) { echo $_SESSION['admin_name']; } ?></b></p>
		<form action="inc/logout.php" method="post">
			<button type="submit" name="logout">Log Out</button>
		</form>
	</header>
	<div class="go-back"><a href="panel.php">« Go to Main Panel</a></div>
	<div class="view-admins">
		<table>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Year</th>
				<th>Description</th>
				<th>user_id</th>
				<th>User's Name</th>
			</tr>
			<?php
			
			while ($row = mysqli_fetch_assoc($result_set)) {
				$id = $row['id'];
				$name = $row['name'];
				$year = $row['year'];
				$description = $row['description'];
				$user_id = $row['user_id'];
				$usersfname = $row['first_name'];
				$userslname = $row['last_name'];

				echo '<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$year.'</td><td>'.$description.'</td><td>'.$user_id.'</td><td>'.$usersfname.' '.$userslname.'</td></tr>';

			}
			?>
		</table>
	</div>
	<footer>
		<?php echo '<h3>' . $first .'</h3><h3>' . $prev . '</h3><h3>Page ' . $page_no . ' of ' . $last_page_no . '</h3><h3>' . $next . '</h3><h3>' . $last . '</h3>'; ?>
	</footer>
	<script>
		var darkModeToggleBtn = document.querySelector("#dark-mode");
		var goBackA = document.querySelector(".go-back a");
		var tableTrThTags = document.querySelectorAll("table tr th");
		var tableTrTags = document.querySelectorAll("table tr:nth-child(odd)");
		var tableTrTdaTags = document.querySelectorAll("table tr td a");
		darkModeToggleBtn.addEventListener('change', function() {
			if (this.checked) {
				document.body.style.backgroundColor = "#1b1b1b";
				document.body.style.color = "white";
				goBackA.style.color = "white";
				for (var i = 0; i < tableTrThTags.length; i++) {
					tableTrThTags[i].style.backgroundColor = "black";
				}
				for (var i = 0; i < tableTrTags.length; i++) {
					tableTrTags[i].style.backgroundColor = "#4d4d4d";
				}
				for (var i = 0; i < tableTrTdaTags.length; i++) {
					tableTrTdaTags[i].style.color = "white";
				}
				localStorage.setItem('dark-mode-enabled', 'true');
			} else {
				document.body.style.backgroundColor = "";
				document.body.style.color = "";
				goBackA.style.color = "";
				for (var i = 0; i < tableTrThTags.length; i++) {
					tableTrThTags[i].style.backgroundColor = "";
				}
				for (var i = 0; i < tableTrTags.length; i++) {
					tableTrTags[i].style.backgroundColor = "";
				}
				for (var i = 0; i < tableTrTdaTags.length; i++) {
					tableTrTdaTags[i].style.color = "";
				}
				localStorage.clear();
			}
		});

		if (localStorage.getItem('dark-mode-enabled') == 'true') {
			darkModeToggleBtn.checked = true;
			document.body.style.backgroundColor = "#1b1b1b";
			document.body.style.color = "white";
			goBackA.style.color = "white";
			for (var i = 0; i < tableTrThTags.length; i++) {
				tableTrThTags[i].style.backgroundColor = "black";
			}
			for (var i = 0; i < tableTrTags.length; i++) {
				tableTrTags[i].style.backgroundColor = "#4d4d4d";
			}
			for (var i = 0; i < tableTrTdaTags.length; i++) {
				tableTrTdaTags[i].style.color = "white";
			}
		}
	</script>
</body>
</html>
<?php mysqli_close($connection); ?>