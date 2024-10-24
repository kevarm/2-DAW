//Función para generar número aleatorio entre 1 y 100, ambos incluidos
function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1) + min);
}

let num1 = getRandomIntInclusive(1, 100);

//Bucle para elegir el número máximo de intentos
let intentosMax = 0;
while (intentosMax >= 0) {
    intentosMax= parseInt(prompt("Introduce un número máximo de intentos. Si no desea establecer máximo, introduzca un 0: "))
    if (intentosMax > 0) {
        alert("Usted tendrá " + intentosMax + " intentos.")
    } else if (intentosMax == 0) {
        alert("Ha decidido no tener máximo de intentos.")
    } else {
        alert("El valor introducido no es correcto");
    }
}

//Variable que almacena el número de intentos
let intentos = 0;

//Variable que almacena el número de intentos restantes si se han establecido
if(intentosMax>0){
    let contador= intentosMax-intentos;
}else{
    let contador=-1
}

//Variable que almacena el valor introducido por el usuario
let scan = 0;

//Array que recoge los números que va introduciendo el usuario
let scans = [];

while (scan != -1) {

    //Paso el valor que introduce el usuario a númerico para luego hacer las comprobaciones
    scan = parseInt(prompt("Introduce el número que creas correcto: \nPara rendirte, inserta '-1'"));

    //Entra por aquí si lo que introduce es un valor entre 1 y 100
    if (scan >= 1 && scan <= 100) {
        //Si introduce un valor válido, se suma el intento y se almacena en el array
        intentos++;
        scans.push(scan);
        if (scan < num1) {
            if ((num1 - scan) > 10) {
                alert("El número secreto es mayor que " + scan);
            } else {
                alert("El número secreto es mayor que " + scan + "." + " Estás muy cerca");
            }
        } else if (scan > num1) {
            if ((scan - num1) > 10) {
                alert("El número secreto es menor que " + scan);
            } else {
                alert("El número secreto es menor que " + scan + "." + " Estás muy cerca");
            }
        } else if (scan == num1) {
            alert("Has ganado! El número a adivinar era el " + num1 + ".\nHas utilizado " + intentos + " intentos.\n" +
                "Los números que ha introducido son los siguientes: " + scans);
            break;
        }
    }
    //Entra por aquí si el usuario decide rendirse
    else if (scan == -1) {
        alert("Juego finalizado");
        break;
    }
    //Si el valor introducido no corresponde con un valor entre 1-100 ni es un -1, pasa por aquí
    else {
        alert("El valor introducido no es válido, inténtelo de nuevo");
    }

}


