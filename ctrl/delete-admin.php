<?php require_once('inc/connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); } ?>
<?php if (isset($_SESSION['admin_id'])) { $current_id = $_SESSION['admin_id']; } ?>
<?php

if (isset($_GET['p']) && !empty($_GET['p'])) {
	$current_page = $_GET['p'];

	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = mysqli_real_escape_string($connection, $_GET['id']);

		if ($id == $current_id) {
			header('Location: list-admin.php?p='.$current_page.'&error=delete_current');
			exit();
		} else {
			$query = "DELETE FROM admins WHERE id = {$id}";
			if (mysqli_query($connection, $query)) {
				header('Location: list-admin.php?p='.$current_page.'&delete=success');
				exit();
			}
		}
	} else {
		header('Location: list-admin.php?p='.$current_page.'&delete=error');
		exit();
	}
}

?>

<?php mysqli_close($connection); ?>