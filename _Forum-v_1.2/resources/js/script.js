$(document).ready(() => {
    const rate = (value, remove, add) => {
        $(value).removeClass (remove); 
        $(value).addClass (add); 
    };
    let cur_rate = 0;
    let rate_stars = $('.rate_stars');
	let stars = $('.rate_book'); 
    book = ($(document).attr ('location')['search']).split (/\?id=(\d)/)[1];
    rate_stars.hover (
        function () { 
            stars.hover (
                function () {
                    let mark = $(this).data ('mark'); 
                    $.each (stars, (i, val) => { if (i + 1 <= mark) rate (val, 'far', 'fas full'); });
                    $(this).on ('click', () => {
                        cur_rate = mark;
                        $('.btn-rate').attr ('href', `../modules/mark.php?mark=${mark}&book=${book}`);
                    });
                }, 
                function () { $.each (stars, (i, value) => rate (value, 'fas full', 'far')); }
            );
        }, 
		function () { if (cur_rate > 0) { $.each (stars, (i, val) => { if (i + 1 <= cur_rate) rate (val, 'far', 'fas full'); }); } }
	);
}); 