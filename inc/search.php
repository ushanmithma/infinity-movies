<?php session_start(); ?>
<?php

	$connection = mysqli_connect('localhost', 'root', '', 'infinity_movies');

	$output = '';

	if (isset($_POST['searchVal']) || !empty($_POST['searchVal']) || strlen(trim($_POST['searchVal'])) > 1) {
		$searchq = $_POST['searchVal'];

		$query = "SELECT * FROM movies WHERE name LIKE '{$searchq}%' OR name LIKE '%{$searchq}%' OR keywords LIKE '%{$searchq}%' ORDER BY name, release_date DESC LIMIT 6";
		$result_set = mysqli_query($connection, $query);
		$count = mysqli_num_rows($result_set);
		
		if ($count == 0) {
			$output .= '<pre style="color: red;">There was no search result!</pre>';
		} else {
			while ($row = mysqli_fetch_assoc($result_set)) {
				$id = $row['id'];
				$name = $row['name'];
				$folder_name = str_replace(': ', ' - ', $row['name']);
				$release_date = $row['release_date'];
				$date = explode('-', $release_date);
				$year = $date[0];

				$output .= '<a href="view.php?id=' . $id . '"><img src="movies/' . $folder_name . ' (' . $year . ')/poster.jpg" alt="' . $name . '"><div class="search-movname"><span>'. $name . ' (' . $year .')</span></div></a>';
			}
		}
	}

	echo $output;

?>