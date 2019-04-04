<?php
	include_once('functions.php'); 
	$db = connect(); 
	if (isset($_GET['id'])) {
		$author_id = $_GET['id']; 
		$query = "UPDATE `authors` 
				  SET `author_is_deleted` = 1 
				  WHERE `author_id` = $author_id"; 
		mysqli_query($db, $query); 
		if (!mysqli_error($db)) {
			header('Location: authors.php');
		} else {
			// дописать если есть ошибки 
		}		
	}
	mysqli_close($db); 
?>
