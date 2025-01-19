// script.js
let prevScrollPos = window.pageYOffset;
const header = document.getElementById("header");

window.onscroll = function() {
    const currentScrollPos = window.pageYOffset;
    if (prevScrollPos > currentScrollPos) {
        header.style.top = "0"; // Muestra el header al hacer scroll hacia arriba
    } else {
        header.style.top = "-30px"; // Oculta el header al hacer scroll hacia abajo
    }
    prevScrollPos = currentScrollPos;
};
