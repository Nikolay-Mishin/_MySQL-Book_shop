<? include_once('./views/templates/header.php'); ?>
	<h1> Книги: </h1> 
	  <div class="new_products">
		<? foreach($bookList as $book): ?>
			<div class="new_prod_box">
				<a href="<?= ROOT . "book/$book[book_id]"; ?>"><?= $book['book_name']; ?></a>
				<div class="new_prod_bg">
				<a href="<?= ROOT . "book/$book[book_id]"; ?>"><img src="<?= IMAGES . 'thumb1.gif'; ?>" alt="" title="" class="thumb" border="0" /></a>
				<button class="buy" data-book-id="<?=$book['book_id']?>" > Купить </button>
				</div>           
			</div>
		<? endforeach; ?>
		<?= $pagination->get(); ?> 
</div>		