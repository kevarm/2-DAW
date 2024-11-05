//Creo mis productos
let ordenador = ["ordenador", 800, 3];
let television = ["television", 300, 4];
let auricular = ["auriculares", 100, 6];
let microondas = ["microondas", 80, 2];
let nevera = ["nevera", 500, 1];

//Los almaceno en un array
let inventario = [ordenador, television, auricular, microondas, nevera];

//Creo un array para almacenar mis productos en el carrito
let carrito = [];

//Variable que almacenan mi stock actual del producto elegido 
let stock = 0;

//Variable que me mantiene el bucle de compra activo
let proceso = true;

//Petición al usuario del producto y cantidad
let nombreProducto = prompt("introduzca el nombre del producto: ");
let cantidad=0;
let scan=true;
do{
    cantidad = parseInt(prompt("introduzca la cantidad que desee: "));
    if (cantidad <= 0 || cantidad  == isNaN) {
        alert("Nuum")
    } else {
        scan=false
    }
}while(scan==true)



let verificacion = false;

agregarAlCarrito(nombreProducto, cantidad);

function agregarAlCarrito(nombreProducto, cantidad) {
    //Bucle que sigue pidiendo productos hasta que el usuario decida finalizar la compra
    while (proceso == true) {

        for (let i = 0; i < inventario.length; i++) {
            //Primero verificamos que el nombre del producto se encuentre en el array
            if (inventario[i][0] == nombreProducto) {
                console.log("El producto existe");
                //Variable que me guarda que se ha encontrado el nombre del producto. En caso de que no se encuentre, tras el for saldrá mensaje de no existe.
                verificacion = true;
                // Comprobamos si hay suficiente stock
                if (inventario[i][2] < cantidad) {
                    alert("No existe stock suficiente del producto " + nombreProducto);
                    break;
                } else {
                    // Calculamos el nuevo stock
                    let stock = inventario[i][2] - cantidad;
                    // Actualizamos el inventario
                    inventario[i][2] = stock;

                    alert("Producto agregado al carrito");
                    // Almacenamos el precio del producto en el carrito
                    carrito.push(inventario[i][1] * cantidad);
                    break;
                }
            }
        }

        if (verificacion == false) {
            alert("El producto no existe");
        }


        //Variable que almacena si el usuario quiere seguir comprando o no
        let comprobacion = 2;

        while (comprobacion != 1 || comprobacion != 0) {
            comprobacion = parseInt(prompt("Si desea seguir comprando, introduzca un 1.\nEn caso contrario, introduzca un 0:"));

            if (comprobacion == 0) {
                proceso = false;
                break;
            } else if (comprobacion == 1) {
                //No me los está recogiendo, pero aquí la intención era recoger los nuevos valores y volver a iterar.
                nombreProducto = prompt("introduzca el nombre del producto: ");
                cantidad = parseInt(prompt("introduzca la cantidad que desee: "));
                break;
            }
        }
    }
}



function calcularTotal() {
    let total = 0;
    for (let i = 0; i < carrito.length; i++) {
        total = total + carrito[i];
    }
    alert("El total de tu compra es de: " + total + " €")
}

//Vacía el carrito, muestra el mensaje por consola y muestra como se queda el inventario final tras actualizarse
function comprar() {
    carrito.length = 0;
    console.log("Compra realizada con éxito");
    console.log(inventario);
    //Comprobación de que el carrito está vacío
    console.log(carrito);
}

//Si el usuario ha decidido no seguir comprando, se lanza esta condición que inicializa las funciones
if (proceso == false) {
    calcularTotal();
    comprar();
}





