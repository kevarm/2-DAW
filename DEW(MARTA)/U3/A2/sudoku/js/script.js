// En modificado en principio se va a colocar el sudoku original pero este 
// array es el que va a ir modificándose para generar
// el sudoku aleatorio.
var original = [
    2, 1, 5, 9, 3, 8, 4, 6, 7,
    7, 8, 6, 1, 2, 4, 3, 5, 9,
    9, 3, 4, 6, 5, 7, 2, 8, 1,
    8, 6, 9, 5, 4, 2, 1, 7, 3,
    1, 4, 3, 7, 8, 6, 5, 9, 2,
    5, 2, 7, 3, 9, 1, 8, 4, 6,
    6, 7, 2, 4, 1, 5, 9, 3, 8,
    4, 9, 8, 2, 6, 3, 7, 1, 5,
    3, 5, 1, 8, 7, 9, 6, 2, 4];

var modificado = [
    2, 1, 5, 9, 3, 8, 4, 6, 7,
    7, 8, 6, 1, 2, 4, 3, 5, 9,
    9, 3, 4, 6, 5, 7, 2, 8, 1,
    8, 6, 9, 5, 4, 2, 1, 7, 3,
    1, 4, 3, 7, 8, 6, 5, 9, 2,
    5, 2, 7, 3, 9, 1, 8, 4, 6,
    6, 7, 2, 4, 1, 5, 9, 3, 8,
    4, 9, 8, 2, 6, 3, 7, 1, 5,
    3, 5, 1, 8, 7, 9, 6, 2, 4];

// La función generaSudoku realiza todo el trabajo de generación 
// del sudoku
function generaSudoku() {
    var salida, i, j;
    var pos = 0;
    // En este primer bucle se muestra en la página web el sudoku 
    // original
    // Se va recorriendo el array de 9 en 9 posiciones para ir pre-
    // sentando el sudoku en la web
    // dentro del párrafo con id="sudokuOrig"
    for (i = 0; i < 9; i++) {
        salida = "";
        for (j = 0; j < 9; j++) {
            pos = j + i * 9;
            salida += original[pos] + " ";
        }
        document.getElementById("sudokuOrig").innerHTML = document.
            getElementById("sudokuOrig").innerHTML + salida + "<br>";
    }

    // En las siguientes 4 líneas es donde se van cambiando las 
    // filas y columnas para hacer el sudoku
    // lo más aleatorio posible.
    cambiaColumnas();
    cambiaFilas();
    cambiaColumnas();
    cambiaFilas();

    //Cuantas más llamadas se hagan a las funciones cambiaColumnas() y cambiaFilas(), más aleatorio será el sudoku.
    //Se pueden invocar estas funciones cuantas veces se quiera.

    //En este primer bucle se muestra en la página web el sudoku generado
    //Se va recorriendo el array de 9 en 9 posiciones para ir presentando el sudoku en la web
    //dentro del párrafo con id=“sudokuAleat”
    pos = 0;
    for (i = 0; i < 9; i++) {
        salida = "";
        for (j = 0; j < 9; j++) {
            pos=9*i+j;
            salida += modificado[pos] + " ";
            
        }
        document.getElementById("sudokuAleat").innerHTML = document.getElementById("sudokuAleat").innerHTML + salida + "<br>";
    }
}



//La función aleatorio genera un número aleatorio entre min y max
function aleatorio(min, max) {
    var horquilla = max - min;
    var aleatorio = Math.round(Math.random() * horquilla) + min;
    return aleatorio;
}

//La función cambiaColumnas() intercambia columnas de cada grupo de manera aleatoria.
function cambiaColumnas() {
    var pos = 0, i, aux;
    //En este primer bucle se cambian las columnas del grupo 1
    var columnaA = aleatorio(0, 2) + pos;
    var columnaB = aleatorio(0, 2) + pos;
    // columnaA y columnaB contienen el valor de las columnas a intercambiar.

    // Ambas variables contendrán un valor aleatorio entre 0 y 2.
    for (i = 0; i < 9; i++) {
        aux = modificado[columnaA];
        console.log(aux);
        modificado[columnaA] = modificado[columnaB];
        console.log(modificado[columnaA]);
        modificado[columnaB] = aux;
        console.log(modificado[columnaB]);
        //En las tres líneas anteriores se intercambian los valores de las columnas
        columnaA += 9;
        columnaB += 9;
        //hay que saltar 9 porque el siguiente elemento de la columna está 9 posiciones más adelante en el array
    }

    pos = 3;
    //En este rpimer bucle se cambias las columnas del grupo 1
    columnaA = aleatorio(0, 2) + pos;
    columnaB = aleatorio(0, 2) + pos;
    //Columna A y B contienen el valor de las columnas a intercambiar
    //Ambas variables contendrán un valor aleatorio entre 3 y 5
    for (i = 0; i < 9; i++) {
        aux = modificado[columnaA];
        modificado[columnaA] = modificado[columnaB];
        modificado[columnaB] = aux;
        columnaA += 9;
        columnaB += 9;
    }

    pos = 6;
    //En este primer bucle se cambian las columnas del grupo 1
    columnaA = aleatorio(0, 2) + pos;
    columnaB = aleatorio(0, 2) + pos;
    //Columna A y B contienen el valor de las columnas a intercambiar
    //Ambas variables contendrán un valor aleatorio entre 6 y 8
    for (i = 0; i < 9; i++) {
        aux = modificado[columnaA];
        modificado[columnaA] = modificado[columnaB];
        modificado[columnaB] = aux;
        columnaA += 9;
        columnaB += 9;
    }
}

function cambiaFilas() {
    var pos = 0, i, aux;
    var filaA = 9 * aleatorio(0, 2) + pos;
    var filaB = 9 * aleatorio(0, 2) + pos;
    //En filaA y B se almacenan los primeros elementos de cada fila a intercambiar
    //En este caso las filas a intercambiar serán de la 0 a la 2.
    for (i = 0; i < 9; i++) {
        aux = modificado[filaA];
        modificado[filaA] = modificado[filaB];
        modificado[filaB] = aux;
        filaA += 1;
        filaB += 1;
    }
    //como los elementos de una fila están consecutivos solamente hay que incrementar en una unidad la posición
    pos = 27;
    //Las siguientes tres líneas comienzan a partir de la posición 27
    filaA = 9 * aleatorio(0, 2) + pos;
    filaB = 9 * aleatorio(0, 2) + pos;

    for (i = 0; i < 9; i++) {
        aux = modificado[filaA];
        modificado[filaA] = modificado[filaB];
        modificado[filaB] = aux;
        filaA += 1;
        filaB += 1;
    }

    pos = 54;
    //Las siguientes tres líneas comienzan a partir de la posición 54
    filaA = 9 * aleatorio(0, 2) + pos;
    filaB = 9 * aleatorio(0, 2) + pos;

    for (i = 0; i < 9; i++) {
        aux = modificado[filaA];
        modificado[filaA] = modificado[filaB];
        modificado[filaB] = aux;
        filaA += 1;
        filaB += 9;
    }
}

generaSudoku();