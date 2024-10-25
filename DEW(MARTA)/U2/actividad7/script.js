//Función para generar número aleatorio entre 1 y 100, ambos incluidos
let num1 =Math.floor(Math.random() * 100 + 1);
alert(num1);


//Bucle para elegir el número máximo de intentos
let intentosMax = -1;
while (intentosMax == -1) {
    intentosMax = parseInt(prompt("Introduce un número máximo de intentos. Si no desea establecer máximo, introduzca un 0: "))
    if (intentosMax > 0) {
        alert("Usted tendrá " + intentosMax + " intentos.")
        break;
    } else if (intentosMax == 0) {
        alert("Ha decidido no tener máximo de intentos.")
        intentosMax = -2;
        break;
    } else {
        alert("El valor introducido no es correcto");
        intentosMax = -1;
    }
}

//Variable que almacena el número de intentos
let intentos = 0;

//Variable que almacena el valor introducido por el usuario
let scan = 0;

//Array que recoge los números que va introduciendo el usuario
let scans = [];

while (scan != -1 && intentosMax != 0) {

    //Paso el valor que introduce el usuario a númerico para luego hacer las comprobaciones
    scan = parseInt(prompt("Introduce el número que creas correcto (entre el 1 y el 100, ambos incluídos): \nPara rendirte, inserta '-1'"));

    //Entra por aquí si lo que introduce es un valor entre 1 y 100
    if (scan >= 1 && scan <= 100 && intentosMax != 0) {
        //Si introduce un valor válido, se suma el intento y se almacena en el array
        intentos++;

        if (intentosMax > 0) { intentosMax--; }

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
if (intentosMax == 0) {
    alert("Juego finalizado. Ha agotado los intentos");
}


