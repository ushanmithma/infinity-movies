<?php

if (isset($_POST['logout'])) {

	session_start();
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_name']);
	unset($_SESSION['admin_username']);
	header('Location: ../index.php');
	exit();

}

?>