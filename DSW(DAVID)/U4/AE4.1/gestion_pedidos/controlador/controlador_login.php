<?php
    require_once __DIR__ . '/../modelo/conexion.php';
    if(!empty($_POST["btningresar"])){
        if(!empty($_POST["correo"]) and !empty($_POST["clave"])){
            $correo=$_POST["correo"];
            $clave=$_POST["clave"];
            
            $sql = $conn->query("SELECT * FROM restaurante WHERE correo='$correo' and clave='$clave'");

            if($datos=$sql->fetchObject()){
                header("location:inicio.php");
            }else{
                echo "<div class='alert alert-danger'>Acceso denegado</div>";
            }
        }
        }else{
           
        }
?>
