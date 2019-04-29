<? include_once('./views/templates/header.php'); ?>
	<h1> Редактировать книгу: </h1> 
	   <form name="register" method="POST" >          
		<div class="form_row">
		<label class="contact"><strong>Название:</strong></label>
		<input type="text" class="contact_input" name="book_name" value="<?= $bookInfo['name']; ?>"/>
		</div>
		<div class="form_row">
		<label class="contact"><strong>Цена:</strong></label>
		<input type="text" class="contact_input" name="book_price" value="<?= $bookInfo['price']; ?>"/>
		</div>
		<div class="form_row">
		<label class="contact"><strong>Издатель:</strong></label>
		<select name="publisher"> 
			<? foreach($publisherList as $publisher): ?>
				<option value="<?= $publisher['id'] ?>" <?= ($publisher['id'] == $bookInfo['publisher_id']) ? 'selected' : '' ?>> <?= $publisher['name'] ?></option>
			<? endforeach; ?>
		</select>
		<select name="authors[]" multiple> 
			<? foreach($authorList as $author): ?>
				<option value="<?= $author['id'] ?>" <?= (in_array($author['id'], $authors)) ? 'selected' : '' ?>> <?= $author['name'] ?></option>
			<? endforeach; ?>
		</select>
		</div>
		<div class="form_row">
		<input type="submit" class="register" value="Сохранить" />
		</div>   
	  </form>     
</div>		