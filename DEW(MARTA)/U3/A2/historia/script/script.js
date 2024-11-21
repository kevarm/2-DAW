var texto = document.getElementById('texto');
var button = document.getElementById('btnSubmit');
if (document.getElementById('lepero').checked) {
    button.addEventListener("click", creaTerror, false);
} else {
    button.addEventListener("click", creaFantasia, false);
}

function creaTerror() {
    texto.innerHTML = "";
    var nombre = document.getElementById('nombre').value.toString();

    var terror = [
        "En Murcia las naranjas siempre han sido muy baratas, pero ahora le parecen caras.",
        "La ciudad se llena siempre en verano, pero en invierno es un desierto. ",
        "" + nombre + " visitaba a su abuela, ella siempre le hacía buena comida. ",
        "La Juventud lo dejó deprimido y ahora " + nombre + " solo tiene a su peluche. ",
        "No tenía ganas de hacer deporte así que " + nombre + " engordó hasta el límite. ",
        "Los donuts eran su debilidad, pero últimamente estaba comportándose de forma extraña. ",
        "" + nombre + " antes era calvo, pero se hizo un injerto capilar. "
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
        "En Lepe las flores se marchitan en Primavera, así que no había excusa. ",
        "" + nombre + " era una persona modesta que conducía un Ford Ka. ",
        "Cada semana " + nombre + " visitaba a sus padres. ",
        "Cualquiera lo hubiera adivinado. ",
        "Llovía fuerte aquella noche y " + nombre + " no podía dejar de pensar en los campos de fresas. ",
        "A " + nombre + " no le gustaba la informática. "
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
