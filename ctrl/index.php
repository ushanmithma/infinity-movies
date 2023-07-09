<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (isset($_SESSION['admin_id'])) { header('Location: panel.php'); } ?>
<?php

if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	if (empty($username) || empty($password)) {
		header('Location: index.php?error=empty');
	} else {
		$query = "SELECT * FROM admins WHERE username = '{$username}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_check = mysqli_num_rows($result);

		if ($result_check == 0) {
			header('Location: index.php?error=notfound&username='.$username);
		} else {
			if ($check = mysqli_fetch_assoc($result)) {
				$check_pwd = password_verify($password, $check['password']);
				if ($check_pwd == false) {
					header('Location: index.php?error=pwd&username='.$username);
				} else {
					$_SESSION['admin_id'] = $check['id'];
					$_SESSION['admin_name'] = $check['name'];
					$_SESSION['admin_username'] = $check['username'];
					$query = "UPDATE admins SET last_seen = NOW() WHERE id = '{$_SESSION['admin_id']}'";
					$result_set = mysqli_query($connection, $query);
					header('Location: panel.php');
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
	<title>Admin Panel - Infinity Movies</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
	<script src="../js/jquery-3.4.1.js"></script>
</head>
<style>
* {margin: 0;padding: 0;box-sizing: border-box;}
body { font-family: sans-serif; }
.go-back {
	position: absolute;
	top: 20px;
	left: 20px;
}
.go-back a {
	color: #000;
	text-decoration: none;
}
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
form {
	width: 400px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
fieldset {
	padding: 10px;
}
p.error {
	color: red;
}
p.success {
	color: green;
}
label {
	display: block;
	margin-bottom: 8px;
}
input:focus {outline: none;border-bottom: 1px solid #ff3232;}
input {
	border:0;
	border-bottom: 1px solid #000;
}
input, button {
	display: block;
	width: 100%;
	padding: 8px;
	margin-bottom: 15px;
}
</style>
<body>
	<div class="go-back"><a href="../index.php">« Go Back</a></div>
	<label class="toogle-btn">
		<input type="checkbox" id="dark-mode">
		<span class="slider"></span>
	</label>
	<div class="login-form">
		<form action="index.php" method="post">
			<fieldset>
				<legend><h2>Log In</h2></legend>
				<?php
				if (isset($_GET['error'])) {
					if ($_GET['error'] == 'empty') {
						echo '<p class="error">Fill all the fields!</p>';
					} else if ($_GET['error'] == 'notfound') {
						if (isset($_GET['username'])) {
							echo '<p class="error">There is no admin as '.$_GET['username'].'!</p>';
						}
					} else if ($_GET['error'] == 'pwd') {
						echo '<p class="error">Invalid password or incorrect!</p>';
					}
				}
				?>
				<label for="username">Username:</label>
				<input type="text" name="username" placeholder="Username" value="<?php if (isset($_GET['username'])) { echo $_GET['username']; } ?>" autofocus>
				<label for="password">Password:</label>
				<input type="password" name="password" placeholder="Password">
				<button type="submit" name="submit">Log In</button>
			</fieldset>
		</form>
	</div>
	<script>
		var darkModeToggleBtn = document.querySelector("#dark-mode");
		var goBackA = document.querySelector(".go-back a");
		let searchBar = document.querySelector("#search");
		let inputTags = document.querySelectorAll("input");
		let submitBtn = document.querySelectorAll("button");
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