<?php
	include_once('functions.php'); 
	if (isset($_POST['author_name'])) {
		$db = connect(); 
		// не забываем обернуть в функцию htmlentities и mysqli_real_escape_string; 
		$author_name = $_POST['author_name']; 
		$author_name = escape($_POST['author_name'], $db); 
		$query = "INSERT INTO `authors`(`author_name`) VALUE ('$author_name')"; 
		mysqli_query($db, $query); 
		//echo ''
		if (!mysqli_error($db)) {
			header('Location: authors.php');
		} else {
			// дописать если есть ошибки 
			echo mysqli_error; 
		}
		mysqli_close($db); 
	}
	$title = 'Добавить автора'; 
	view('../templates/common/head.html', compact('title')); 
	view('../templates/authors/author_add.html'); 
	view('../templates/common/footer.html'); 


?>