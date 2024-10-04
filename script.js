// Ejercicio 1
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
