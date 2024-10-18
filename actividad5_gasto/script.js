//Variable que recoge el límite del presupuesto
let maximo = "";

//Expresión regular que me evalúa que sólo se hayan introducido números
let comprobacion = /[a-zA-Z\W]/;


//Bucle que obliga al usuario a introducir un 0 en caso de que no quiera poner presupuesto máximo o un número positivo (no decimal)
while (maximo == "") {
    maximo = prompt("Introduce un límite del presupuesto. Si no desea límite, introduzca 0");
    if (comprobacion.test(maximo)) {
        alert("El valor introducido no es válido. No se permiten letras, caracteres especiales ni números decimales");
        maximo = "";
        continue;
    }
}

//Arrays que almacenan los gastos totales y por categorías
let gastos = [];
let transporte = [];
let alimentacion = [];
let vivienda = [];


//Variable que va acumulando los gastos para saber si se pasa del presupuesto o no
let acumulado = 0;

//Bucle que pide gastos. Sólo para si se supera presupuesto máximo o si no hay presupuesto, cuando usuario introduzca un 0
while (maximo == 0 || acumulado < maximo) {
    let gasto = prompt("Introduce un gasto: \n Si no desea introducir más gastos, introduzca un '0'");
    if (comprobacion.test(gasto) || gasto<0) {
        alert("El valor introducido no es válido. No se permiten letras, caracteres especiales ni números decimales.");
        continue;
    } else {
        //Variable para pasar el gasto que introduce el usuario a número para hacer operaciones
        gasto = parseInt(gasto);
    }
    if (gasto == 0) {
        break;
    } else {
        gastos.push(gasto);
        acumulado = acumulado + gasto;

        //Bucle que almacena el gasto en el array de la categoría que introduzca el usuario
        let categoria = 0;
        while (categoria != "1" && categoria != "2" && categoria != "3") {
            categoria = prompt("Introduzca el número 1, 2 o 3 para especificar la categoría del gasto: \n 1. Transporte \n 2. Alimentación \n 3. Vivienda");

            if (categoria == "1") {
                transporte.push(gasto);
            } else if (categoria == "2") {
                alimentacion.push(gasto);
            } else if (categoria == "3") {
                vivienda.push(gasto);
            }else{
                alert("El valor introducido no es válido");
                continue;
            }
        }
    }
}

//Variables para almacenar el gasto total de cada categoría y la suma de todos
let gastoTransp = 0;
let gastoAlimen = 0;
let gastoVivien = 0;
let gastoTotal = 0;

//Bucles que me da el gasto total por categoría recorriendo los arrays y sumando los valores
for (let i = 0; i < transporte.length; i++) {
    gastoTransp = gastoTransp + transporte[i];
}
for (let i = 0; i < alimentacion.length; i++) {
    gastoAlimen = gastoAlimen + alimentacion[i];
}
for (let i = 0; i < vivienda.length; i++) {
    gastoVivien = gastoVivien + vivienda[i];
}
for (let i = 0; i < gastos.length; i++) {
    gastoTotal = gastoTotal + gastos[i];
}

//Si no se supera el presupuesto máximo, saldrá este alert
if (acumulado <= maximo) {
    alert("Su presupuesto máximo es de: " + maximo + "€ \n" +
        "Sus gatos totales ascienden a: " + gastoTotal + "€ \n" +
        "Le sobran "+ (maximo-gastoTotal)+"€ del presupuesto establecido \n" +
        "El total de sus gastos en transporte asciende a: " + gastoTransp + "€ \n" +
        "El total de sus gastos en alimentación asciende a: " + gastoAlimen + "€ \n" +
        "El total de sus gastos en vivienda asciende a: " + gastoVivien + "€"
    );

//Si no hay presupuesto establecido, saldrá este alert
}else if (maximo==0) {
        alert("Sus gatos totales ascienden a: " + gastoTotal + "€ \n" +
            "El total de sus gastos en transporte asciende a: " + gastoTransp + "€ \n" +
            "El total de sus gastos en alimentación asciende a: " + gastoAlimen + "€ \n" +
            "El total de sus gastos en vivienda asciende a: " + gastoVivien + "€"
        );
//Si se supera el presupuesto máximo, saldrá este alert
} else{
    alert("Su presupuesto máximo es de: " + maximo + "\n" +
        "Sus gastos totales ascienden a: " + gastoTotal + "\n" +
        "Sus gastos sobrepasan en " + (gastoTotal - maximo) + "€ el presupuesto establecido \n" +
        "El total de sus gastos en transporte asciende a: " + gastoTransp + "\n" +
        "El total de sus gastos en alimentación asciende a: " + gastoAlimen + "\n" +
        "El total de sus gastos en vivienda asciende a: " + gastoVivien
    );
}
