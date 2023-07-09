<?php

session_start();

if (isset($_POST['signin_submit'])) {

	$connection = mysqli_connect('localhost', 'root', '', 'infinity_movies');

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	// Check empty fields
	if (empty($email) || empty($password)) {

		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$current_id = $_GET['id'];
			header('Location: ../view.php?id='. $current_id . '&error=empty');
			exit();
		} else if (isset($_GET['page']) && !empty($_GET['page'])) {
			header('Location: ../requests.php?error=empty');
			exit();
		} else {
			header('Location: ../index.php?error=empty');
			exit();
		}

	} else {

		$trimed_email = trim($email);

		$query = "SELECT * FROM users WHERE email = '{$trimed_email}'";
		$result = mysqli_query($connection, $query);
		$result_check = mysqli_num_rows($result);

		if ($result_check < 1) {

			if (isset($_GET['id']) && !empty($_GET['id'])) {
				$current_id = $_GET['id'];
				header('Location: ../view.php?id='. $current_id . '&error=nouser&email='.$trimed_email);
				exit();
			} else if (isset($_GET['page']) && !empty($_GET['page'])) {
				header('Location: ../requests.php?error=nouser&email='.$trimed_email);
				exit();
			} else {
				header('Location: ../index.php?error=nouser&email='.$trimed_email);
				exit();
			}

		} else {

			if ($row = mysqli_fetch_assoc($result)) {

				// De-hashing password
				$hashed_password_check = password_verify($password, $row['password']);

				if ($hashed_password_check == false) {

					if (isset($_GET['id']) && !empty($_GET['id'])) {
						$current_id = $_GET['id'];
						header('Location: ../view.php?id='. $current_id .'&error=passwordsign&replaceemail='.$trimed_email);
						exit();
					} else if (isset($_GET['page']) && !empty($_GET['page'])) {
						header('Location: ../requests.php?error=passwordsign&replaceemail='.$trimed_email);
						exit();
					} else {
						header('Location: ../index.php?error=passwordsign&replaceemail='.$trimed_email);
						exit();
					}

				} else if ($hashed_password_check == true) {

					// Sign in user here
					$_SESSION['id'] = $row['id'];
					$_SESSION['first_name'] = $row['first_name'];
					$_SESSION['last_name'] = $row['last_name'];
					$_SESSION['email'] = $row['email'];

					if (isset($_GET['id']) && !empty($_GET['id'])) {
						$current_id = $_GET['id'];
						header('Location: ../view.php?id='. $current_id .'&signin=success');
						exit();
					} else if (isset($_GET['page']) && !empty($_GET['page'])) {
						header('Location: ../requests.php?signin=success');
						exit();
					} else {
						header('Location: ../index.php?signin=success');
						exit();
					}

				}

			}

		}

	}

} else {

	header('Location: ../index.php?login=error');
	exit();

}

?>