//EJERCICIO 1
/*const radio = 5;

// Calcular el área de la circunferencia
let area = Math.PI * Math.pow(radio, 2);

// Calcular la longitud de la circunferencia
let longitud = 2 * Math.PI * radio;

// Mostrar los resultados
console.log("Área de la circunferencia: "+area.toFixed(2));
console.log("Longitud de la circunferencia: "+longitud.toFixed(2));*/

//EJERCICIO 2
/*const anioNacimiento=2010;

(2024-anioNacimiento>=18) ? console.log("Mayor de edad") : console.log("Menor de edad");*/

//EJERCICIO 3
/*var dato = "Ronaldo " + 5 + 5;
var dato = 5 + 5 + " Ronaldo ";

console.log(dato);*/

//EJERCICIO 4
/*let num1=5;
let palabra="hola";
const num3=7;
let array=[];
let boolean= false;
let indefinido=undefined;
let nulo=null;
let funcion=function(){return "prueba"};

console.log("La variable 'num1' es: "+typeof(num1));        
console.log("La variable 'palabra' es: "+typeof(palabra));   
console.log("La variable 'num3' es: "+typeof(num3));   
console.log("La variable 'array' es: "+typeof(array));       
console.log("La variable 'boolean' es: "+typeof(boolean));    
console.log("La variable 'indefinido' es: "+typeof(indefinido)); 
console.log("La variable 'nulo' es: "+typeof(nulo));            
console.log("La variable 'funcion' es: "+typeof(funcion));*/

//EJERCICIO 5
/*let ejemplo="Soy una variable";
console.log(ejemplo);

ejemplo="Soy la misma variable pero sobreescrita";
console.log(ejemplo);

function prueba(){
    console.log("Soy una función");
}
prueba();

function prueba(){
    console.log("Soy la función sobreescrita");
}
prueba();*/

//EJERCICIO 6
/*const input=document.getElementById("input");
    input.onmouseover= function(){
        input.value="Hola, has pasado el ratón";
    };

    input.onmouseout= function(){
        input.value="Hola, has salido fuera del input con el ratón";
    };

    input.onblur = function() {
            input.value = "Has quitado el foco del input"; 
        }*/

//EJERCICIO 8

/*
function obtenerDatos() {
    // Obtener el valor de la fecha ingresada
    const fechaValor = document.getElementById("fechaInput").value;

    // Dividir la fecha en partes (dd/mm/yyyy)
    const partes = fechaValor.split("/");

    // Extraer el mes (posición 1) y el año (posición 2)
    const mesExtraido = partes[1];
    const anioExtraido = partes[2];

    alert("Mes: "+mesExtraido+" / Año: "+anioExtraido);
}*/


//EJERCICIO 9

        // Definir el array propuesto
        var milista = ['panadero', 456, [0, 1, 2]];

        alert(milista);

        var posicionValor = milista[2][2];

        alert(posicionValor);