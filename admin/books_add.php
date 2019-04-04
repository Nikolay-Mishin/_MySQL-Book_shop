<?php
	include_once('functions.php'); 
	$db = connect(); 
	$query = "SELECT * FROM `publishers`"; 
	$result = mysqli_query($db, $query); 
	$publishers = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$query1 = "SELECT * FROM `authors` WHERE `author_is_deleted` = 0"; 
	$result1 = mysqli_query($db, $query1); 
	$authors = mysqli_fetch_all($result1, MYSQLI_ASSOC);
	
	if (isset($_POST['book_name'])) {
		
		// не забываем обернуть в функцию htmlentities и mysqli_real_escape_string; 
		$book_name = escape($_POST['book_name'], $db);
		$books_price = escape($_POST['book_price'], $db); 
		// загружаем данные в таблицу books; 
		$query = "INSERT INTO `authors`(`author_name`) VALUE ('$author_name')"; 
		// заносим данные в промежуточную таблицу books_authors; 
		mysqli_query($db, $query); 
		if (!mysqli_error($db)) {
			header('Location: authors.php');
		} else {
			// дописать если есть ошибки 
		}

	}
	mysqli_close($db); 

?>
<form method="POST"> 
	Название: <input type="text" name="book_name"> <br>
	Цена: <input type="number" name="book_price"> <br>
	Издатель: <select name="book_publisher"> 
				<? foreach ($publishers as $publisher): ?> 
					<option value="<?= $publisher['publisher_id']; ?>"> <?= $publisher['publisher_name']; ?></option> 
				<? endforeach; ?>
			  </select> 
	<br>
	Год: <input type="number" name="book_year"> <br>
	Количество: <input type="number" name="book_quantity"> <br>
	Автор: <select name="book_author" multiple> 
			<? foreach ($authors as $author): ?> 
				<option value="<?= $author['author_id']; ?>"> <?= $author['author_name']; ?></option> 
			<? endforeach; ?>
		  </select> 
	<br> 
	<input type="submit" value="Сохранить"> <br> 
</form>