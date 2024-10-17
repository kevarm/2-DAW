//Variable que recoge el límite del presupuesto
let maximo = "";

//Expresió regular que me evalúa que sólo se hayan introducido números
let comprobacion = /[0-9]+/;

while (maximo == "" || maximo < 0) {
    maximo = prompt("Introduce un límite del presupuesto. Si no desea límite, introduzca 0");
    if (!comprobacion.test(maximo) || maximo < 0) {
        alert("El valor introducido no es válido");
        maximo = "";
        continue;
    }
}

let gastos = [];
let transporte = [];
let alimentacion = [];
let vivienda = [];


//Variable que va acumulando los gastos
let acumulado = 0;
while (maximo == 0 || acumulado < maximo) {
    let gasto = prompt("Introduce un gasto: \n Si no desea introducir más gastos, introduzca un '0'");
    if (!comprobacion.test(gasto) || gasto<0) {
        alert("El valor introducido no es válido");
        continue;
    } else {
        gasto = parseInt(gasto);
    }
    if (gasto == 0) {
        break;
    } else {
        gastos.push(gasto);
        acumulado = acumulado + gasto;

        let categoria = 0;
        while (categoria != "1" && categoria != "2" && categoria != "3") {
            categoria = prompt("Introduzca el número 1, 2 o 3 para especificar la categoría del gasto: \n 1. Transporte \n 2. Alimentación \n 3. Vivienda");

            if (categoria == "1") {
                transporte.push(gasto);
            } else if (categoria == "2") {
                alimentacion.push(gasto);
            } else if (categoria == "3") {
                vivienda.push(gasto);
            }
        }
    }
}

let gastoTransp = 0;
let gastoAlimen = 0;
let gastoVivien = 0;
let gastoTotal = 0;

//Bucles que me da el gasto total por categoría
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

if (acumulado <= maximo) {
    alert("Su presupuesto máximo es de: " + maximo + "€ \n" +
        "Sus gatos totales ascienden a: " + gastoTotal + "€ \n" +
        "Sus gastos se encuentran dentro del presupuesto \n" +
        "El total de sus gastos en transporte asciende a: " + gastoTransp + "€ \n" +
        "El total de sus gastos en alimentación asciende a: " + gastoAlimen + "€ \n" +
        "El total de sus gastos en vivienda asciende a: " + gastoVivien + "€"
    );
} else {
    alert("Su presupuesto máximo es de: " + maximo + "\n" +
        "Sus gastos totales ascienden a: " + gastoTotal + "\n" +
        "Sus gastos sobrepasan en " + (gastoTotal - maximo) + "€ el presupuesto establecido \n" +
        "El total de sus gastos en transporte asciende a: " + gastoTransp + "\n" +
        "El total de sus gastos en alimentación asciende a: " + gastoAlimen + "\n" +
        "El total de sus gastos en vivienda asciende a: " + gastoVivien
    );
}
