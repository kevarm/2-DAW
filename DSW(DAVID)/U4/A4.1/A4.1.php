<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php

    if (!isset($_COOKIE['visitas'])) {
        setcookie('visitas', '1', time() + 3600 * 24); // Expira en 24 horas
        echo "Bienvenido por primera vez";
    } else {
        $visitas = $_COOKIE['visitas'] + 1;
        setcookie('visitas', $visitas, time() + 3600 * 24); // Expira en 24 horas
        echo "Bienvenido por $visitas vez";
    }
    echo "</br>";

   /* function reiniciar(){
        $_COOKIE['visitas']=1;*/

    function saludo(){
        echo "hola";
    }
    
///Crear una cookie
setcookie("nombre_usuario", "Juan", time() + (86400 * 30), "/"); // Expira en 30 días

// Leer la cookie
if(isset($_COOKIE["nombre_usuario"])) {
    echo "Bienvenido de nuevo, " . $_COOKIE["nombre_usuario"];
} else {
    echo "Bienvenido, visitante!";
}
    ?>



    <br>
    <input type="submit" onclick= "reiniciar()">Reiniciar contador</input>
        


    
</body>

</html>