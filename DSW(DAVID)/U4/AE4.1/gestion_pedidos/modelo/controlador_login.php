<?php

require_once 'modelo/conexion.php';



    if(!empty($_POST["btningresar"])){
        $conn=createConnection();
        if(!empty($_POST["correo"]) and !empty($_POST["clave"])){
            $correo=$_POST["correo"];
            $clave=$_POST["clave"];
            $stmt = $conn->prepare("SELECT identificador, correo,clave FROM restaurante WHERE correo = :correo AND clave = :clave");
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $clave);
            $stmt->execute();

if ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
  //$datos almacena los datos de la consulta como una matriz asociativa
    $_SESSION["correo"] = $datos['correo'];
    $_SESSION["id"]=$datos['identificador'];

    if (isset($_COOKIE['cart'])) {
        $_SESSION['carrito'] = json_decode($_COOKIE['cart'], true);
      } else {
        $_SESSION['carrito'] = [];
      }
    header("location:inicio.php");
    exit;
} else {
    echo "<div class='alert alert-danger'>Credenciales incorrectas</div>";
}
    }
        }else{    
        }
?>

