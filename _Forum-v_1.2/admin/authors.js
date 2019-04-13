let buttons = document.getElementsByClassName ('remove');
for (let i = 0; i < buttons.length; i++) {
	buttons[i].addEventListener ('click', function (e) {
		if (!confirm ('Вы действительно хотите удалить эту запись?')) {
			e.preventDefault(); 
		}
	}); 
}