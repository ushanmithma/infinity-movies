<?php

	$connection = mysqli_connect('localhost', 'root', '', 'infinity_movies');

	$output = '';

	if (isset($_POST['searchVal']) || !empty($_POST['searchVal']) || strlen(trim($_POST['searchVal'])) > 1) {
		$searchq = $_POST['searchVal'];

		$query = "SELECT * FROM upcoming WHERE name LIKE '%{$searchq}%' ORDER BY release_date, name LIMIT 10";
		$result_set = mysqli_query($connection, $query);
		$count = mysqli_num_rows($result_set);
		
		if ($count == 0) {
			$output .= '<pre style="color: red;">There was no search result!</pre>';
		} else {
			while ($row = mysqli_fetch_assoc($result_set)) {
				$id = $row['id'];
				$name = $row['name'];
				$release_date = $row['release_date'];
				$date = explode('-', $release_date);
				$year = $date[0];
				$poster_name = str_replace(': ', ' - ', $row['name']);

				$output .= '<a href="update-upcoming.php?id=' . $id . '">' . '<img src="../upcoming/' . $poster_name . ' (' . $year . ').jpg" title="' . $name . ' (' . $year . ')" alt="' . $name . '">' . '</a>';
			}
		}
	}

	echo $output;

?>