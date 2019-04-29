$(document).ready(function () {
	$('.buy').click(function () {
		let book_id = $(this).data('book-id'); 
		let cart; 
		if (Cookies.get('cart')) {
			cart = JSON.parse(Cookies.get('cart'));
			if (cart[book_id] == undefined) {
				cart[book_id] = 1; 
			} else {
				cart[book_id]++; 
			}
		} else {
			cart = {}; 
			cart[book_id] = 1;
		}
		let stringifyCart = JSON.stringify(cart); 
		Cookies.set('cart', stringifyCart, { expires: 7 }); 
	});

});