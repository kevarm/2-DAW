var texto = document.getElementById('texto');
var button = document.getElementById('btnSubmit');
if (document.getElementById('terror').checked) {
    button.addEventListener("click", creaTerror, false);
} else {
    button.addEventListener("click", creaFantasia, false);
}

function creaTerror() {
    texto.innerHTML = "";
    var nombre = document.getElementById('nombre').value.toString();

    var terror = [
        " En la oscuridad de la noche, " + nombre + " escuchó un susurro que lo llamaba desde el armario. ",
        nombre + " sabía que no debía entrar al bosque, pero las risas que venían de allí eran demasiado tentadoras. ",
        " Mientras " + nombre + " se miraba al espejo, se dio cuenta de que su reflejo sonreía, pero él no. ",
        " Los pasos detrás de " + nombre + " se hacían cada vez más cercanos, pero al voltear, no había nadie. ",
        " Un grito desgarrador rompió el silencio y " + nombre + " supo que no estaba solo en la casa abandonada. ",
        " La sombra de " + nombre + " comenzó a moverse por su cuenta bajo la luz de la luna. ",
        nombre + " encontró una muñeca antigua en el sótano, y desde entonces, los muebles cambiaban de lugar por la noche. ",
        " El diario que " + nombre + " encontró tenía su nombre escrito en cada página, aunque él nunca lo había visto antes. ",
        " Una voz grave susurró al oído de " + nombre +" : 'Por fin te encontré.' ",,
        " Los cuadros en la pared seguían los movimientos de " + nombre + " con miradas vacías y penetrantes. "
    ];


    while (terror.length > 0) {
        var nAleatorio = Math.round(Math.random() * terror.length - 1);

        if (terror[nAleatorio] == undefined) {
            nAleatorio = Math.round(Math.random() * terror.length - 1);
        } else {
            texto.innerHTML += terror[nAleatorio];
            terror.splice(nAleatorio, 1);
        }
    }
}
function creaFantasia() {
    texto.innerHTML = "";
    var nombre = document.getElementById('nombre').value.toString();

    var fantasia = [
        " En el corazón del bosque encantado, " + nombre + " encontró un árbol que susurraba secretos antiguos.",
        nombre + " despertó una mañana con alas doradas en su espalda y un mapa mágico en sus manos.",
        " El dragón miró a " + nombre + " con ojos llenos de sabiduría antes de dejarle pasar a su guarida.",
        " Cuando " + nombre + " tocó la varita mágica, el mundo a su alrededor comenzó a llenarse de colores vibrantes.",
        nombre + " siguió a un unicornio plateado hasta un lago donde las estrellas parecían bailar en el agua.",
        " En la cima de la montaña de cristal, " + nombre + " descubrió un castillo habitado por seres de luz.",
        " El anciano hechicero le entregó a " + nombre + " un libro que escribía sus pensamientos en tiempo real.",
        nombre + " se sumergió en el río encantado y emergió en un reino completamente diferente.",
        " Las flores comenzaron a hablar con " + nombre + " mientras caminaba por el jardín de la reina mágica.",
        " El reloj de arena en manos de " + nombre + " podía detener el tiempo, pero solo por un momento."
    ];

    while (fantasia.length > 0) {
        var nAleatorio = Math.round(Math.random() * fantasia.length - 1);

        if (fantasia[nAleatorio] == undefined) {
            nAleatorio = Math.round(Math.random() * fantasia.length - 1);
        } else {
            texto.innerHTML += fantasia[nAleatorio];
            fantasia.splice(nAleatorio, 1);
        }
    };
}
