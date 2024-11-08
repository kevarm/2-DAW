<?php
function conexion($host, $db, $user, $pass)
{
  try {
    /*$driver = "mysql"; // Nombre del controlador, se puede cambiar a "pgsql" para PostgreSQL
    $host = "localhost";
    $dbname = "campus";
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "gamestore";
    $username = "postgre";
    $password = "1234";*/

   /*
    Para cambiar tipo de BD, tendrías que cambiar en $dns el mysql por la variable $tipo y darle de valor o mysql o pgsql
    $tipo = 'pgsql'
    */

    
    $dns = "mysql:host=$host;dbname=$db";
    $conn = new PDO($dns, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $ex) {
    error_log("Error en la conexión a la base de datos: " .
      $ex->getMessage());
    return null;
  }
}
