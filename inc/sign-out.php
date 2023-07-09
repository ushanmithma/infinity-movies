<?php

if (isset($_POST['signout_submit'])) {

	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['email']);
	header('Location: ../index.php');
	exit();

}

?>