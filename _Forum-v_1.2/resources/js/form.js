//https://www.w3schools.com/howto/howto_js_toggle_class.asp

document.addEventListener ("DOMContentLoaded", () => {
    console.log ("DOM fully loaded and parsed");
    el = document.querySelector ('.fa-eye');
    pass = document.querySelector ('[name=password]');
    passc = document.querySelector ('[name=password_dub]');
    el.addEventListener ('click', () => {
        el.classList.toggle ('open-eye');
        if (el.classList.contains ('open-eye')) {
            pass.setAttribute ('type', 'text');
            passc.setAttribute ('type', 'text');
        }
        else {
            pass.setAttribute ('type', 'password');
            passc.setAttribute ('type', 'password');
        }
    });
    console.log (el.classList, pass, passc, pass.getAttribute ('type'));
});