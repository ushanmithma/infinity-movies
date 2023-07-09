<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php

if (isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

	if (empty($name) || empty($username) || empty($password) || empty($confirm_password)) {
		header('Location: admins.php?error=empty');
	} else if (strlen(trim($name)) > 256) {
		header('Location: admins.php?error=name');
	} else if (strlen(trim($username)) > 256 || $username == trim($username) && strpos($username, ' ') !== false) {
		header('Location: admins.php?error=username');
	} else if ($password !== $confirm_password) {
		header('Location: admins.php?error=password&name='.$name.'&username='.$username);
	} else {

		$query = "SELECT * FROM admins WHERE username = '{$username}'";
		$result = mysqli_query($connection, $query);
		$result_check = mysqli_num_rows($result);

		if ($result_check == 1) {
			header('Location: admins.php?error=userexists&name='.$name.'&username='.$username);
		} else {

			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO admins (name, username, password) VALUES ('{$name}', '{$username}', '{$hashed_pwd}')";
			if (mysqli_query($connection, $query)) {
				header('Location: admins.php?adding=success');
			}

		}

	}
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
form#add {
	width: 512px;
	margin: 40px auto;
}
#add h2 {
	margin: 20px 0;
}
#add > p {
	text-align: right;
}
p.error {
	color: red;
}
p.success {
	color: green;
}
#add label {
	display: block;
	margin-bottom: 8px;
}
#add input:focus {outline: none;border-bottom: 1px solid #ff3232;}
#add input {
	border:0;
	border-bottom: 1px solid #000;
}
#add input, button {
	display: block;
	width: 512px;
	padding: 8px;
	margin-bottom: 15px;
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
	<form action="admins.php" method="post" id="add">
		<h2>Add Member</h2>
		<?php
		if (isset($_GET['error'])) {
			if ($_GET['error'] == 'empty') {
				echo '<p class="error">Fill all the fields!</p>';
			} else if ($_GET['error'] == 'name') {
				echo '<p class="error">Invalid name!</p>';
			} else if ($_GET['error'] == 'username') {
				echo '<p class="error">Invalid username!</p>';
			} else if ($_GET['error'] == 'password') {
				echo '<p class="error">Password isn\'t match!</p>';
			} else {
				echo '<p class="error">Username is already exists!</p>';
			}
		}
		if (isset($_GET['adding'])) {
			if ($_GET['adding'] == 'success') {
				echo '<p class="success">New admin has been added!</p>';
			}
		}
		?>
		<label for="name">Name:</label>
		<input type="text" name="name" placeholder="Name" value="<?php if (isset($_GET['name'])) { echo $_GET['name']; } ?>">
		<label for="username">Username:</label>
		<input type="text" name="username" placeholder="Username" value="<?php if (isset($_GET['username'])) { echo $_GET['username']; } ?>">
		<label for="password">Password:</label>
		<input type="password" name="password" placeholder="Password">
		<label for="password">Confirm Password:</label>
		<input type="password" name="confirm_password" placeholder="Confirm Password">
		<button type="submit" name="submit">Add</button>
	</form>
	<script>
		var darkModeToggleBtn = document.querySelector("#dark-mode");
		var goBackA = document.querySelector(".go-back a");
		let searchBar = document.querySelector("#search");
		let inputTags = document.querySelectorAll("input");
		let submitBtn = document.querySelectorAll("#add button");
		darkModeToggleBtn.addEventListener('change', function() {
			if (this.checked) {
				document.body.style.backgroundColor = "#1b1b1b";
				document.body.style.color = "white";
				goBackA.style.color = "white";
				for (var i = 0; i < inputTags.length; i++) {
					inputTags[i].style.borderBottom = "1px solid white";
					inputTags[i].style.backgroundColor = "#1b1b1b";
					inputTags[i].style.color = "white";
				}
				for (var i = 0; i < submitBtn.length; i++) {
					submitBtn[i].style.color = "white";
					submitBtn[i].style.backgroundColor = "#1b1b1b";
				}
				localStorage.setItem('dark-mode-enabled', 'true');
			} else {
				document.body.style.backgroundColor = "white";
				document.body.style.color = "black";
				goBackA.style.color = "";
				for (var i = 0; i < inputTags.length; i++) {
					inputTags[i].style.borderBottom = "1px solid black";
					inputTags[i].style.backgroundColor = "white";
					inputTags[i].style.color = "black";
				}
				for (var i = 0; i < submitBtn.length; i++) {
					submitBtn[i].style.color = "";
					submitBtn[i].style.backgroundColor = "";
				}
				localStorage.clear();
			}
		});

		if (localStorage.getItem('dark-mode-enabled') == 'true') {
			darkModeToggleBtn.checked = true;
			document.body.style.backgroundColor = "#1b1b1b";
			document.body.style.color = "white";
			goBackA.style.color = "white";
			for (var i = 0; i < inputTags.length; i++) {
				inputTags[i].style.borderBottom = "1px solid white";
				inputTags[i].style.backgroundColor = "#1b1b1b";
				inputTags[i].style.color = "white";
			}
			for (var i = 0; i < submitBtn.length; i++) {
				submitBtn[i].style.color = "white";
				submitBtn[i].style.backgroundColor = "#1b1b1b";
			}
		}
	</script>
</body>
</html>
<?php mysqli_close($connection); ?>