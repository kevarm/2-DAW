// EJERCICIO 1
/*
let num1= prompt("Introduce un número: ");
let num2= prompt("Introduce otro número: ");

if (isNaN(num1)){
    console.log("No se ha introducido un número");
}else if (isNaN(num2)){
    console.log("No se ha introducido un número");
}else{
    num1=Number(num1);
    num2=Number(num2);

    let suma= num1+ num2;
    let resta= num1 - num2;
    let multiplicacion= num1 * num2;
    let division= num1 / num2;
    console.log("Los números introducidos por el usuario fueron el "+num1+" y el "+num2+"\n"
        + "La suma de ambos números es: " + suma + "\n"
        + "La resta de ambos números es: " + resta + "\n"
        + "La multiplicación de ambos números es: " + multiplicacion + "\n"
        + "La división de ambos números es: " + division + "\n"
    );
}
*/


//EJERCICIO 2
/*
let edad= prompt("Introduce tu edad: ");
const mayoria=18;

if (isNaN(edad)){
    console.log("No se ha introducido un número");
}else{
    edad=Number(edad);
    console.log("La edad introducida por el usuario ha sido: "+edad+"\n");
    if(edad>=mayoria){
        console.log("Es mayor de edad");
    }else{
        console.log("Es menor de edad");
    }
}
*/

//EJERCICIO 3
/*
let num1=prompt("Introduce un número: ");
let num2=prompt("Introduce otro número: ");
let num3=prompt("Introduce otro número: ");

if (isNaN(num1)&&isNaN(num2)&&isNaN(num3)){
    console.log("No se han introducido tres números");
}else{
    num1=Number(num1);
    num2=Number(num2);
    num3=Number(num3);

    console.log("Los números introducidos por el usuario fueron el "+num1+", el "+num2+" y el "+num3+"\n");

    if(num1>num2&&num1>num3){
        console.log("El mayor número introducido es el: "+num1);
    }else if (num2>num1&&num2>num3){
        console.log("El mayor número introducido es el: "+num2);
    } else {
        console.log("El mayor número introducido es el: "+num3);
    }
}
*/

//EJERCICIO 4
/*
for (let index = 0; index <=10; index++) {
    console.log(index + " - " + Math.pow(Number(index),2));
    
}
*/

//EJERCICIO 5
/*
function factorial(n) {
    if (n === 0 || n === 1) {
        return 1;
    }
    return n * factorial(n - 1);
}

const numero = Number(prompt("Por favor, introduce un número:"));

if (!isNaN(numero) && numero >= 0) {
    const resultado = factorial(numero);
    console.log(`El factorial de ${numero} es ${resultado}`);
} else {
    console.log("Por favor, introduce un número válido mayor o igual a 0.");
}
*/

//EJERCICIO 6
/*
let numero = prompt("Por favor, introduce un número para ver su tabla de multiplicar:");
numero=Number(numero);

if (isNaN(numero)) {
    console.log("Por favor, introduce un número.");
} else {
    console.log("Tabla de multiplicar del número "+numero);
    for (let i = 1; i <= 10; i++) {
        console.log(numero + " x "+i+" = "+(numero*i));
    }
}
*/

//EJERCICIO 7
/*
let num=prompt("Introduce la temperatura actual: ");
let temp=Number(num);


if (isNaN(temp)) {
    console.log("Por favor, introduce un número.");
} else {
console.log("La temperatura actual es de "+temp+" grados \n");
temp<15 ? console.log("Hace frio") : console.log("Hace calor");
}
*/