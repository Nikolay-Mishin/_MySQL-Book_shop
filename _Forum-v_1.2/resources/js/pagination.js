document.addEventListener ("DOMContentLoaded", () => {
    let file = document.location.pathname.toLowerCase().split ('/_git/_MySQL/_MySQL-Book_shop/admin/pages/'.toLowerCase())[1];
    let count = document.querySelector ('[name="count"]');
    let filter = document.querySelector ('[name="filter"]');
    let btn = document.getElementById ('pagination');

    const link_set = () => { btn.setAttribute ('href', `./${file}?count=${count.value}&filter=${filter.value}`) };

    count.addEventListener ('change', () => link_set());
    filter.addEventListener ('change', () => link_set());
});