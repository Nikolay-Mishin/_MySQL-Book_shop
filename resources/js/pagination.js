document.addEventListener ("DOMContentLoaded", () => {
    count = document.querySelector ('[name="count"]');
    filter = document.querySelector ('[name="filter"]');
    btn = document.getElementById ('pagination');
    count.addEventListener ('change', () => btn.setAttribute ('href', `./authors.php?count=${count.value}&filter=${filter.value}`));
    filter.addEventListener ('change', () => btn.setAttribute ('href', `./authors.php?count=${count.value}&filter=${filter.value}`));
});