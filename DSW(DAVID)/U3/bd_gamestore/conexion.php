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
    $dns = "pgsql:host=$host;dbname=$db";
    $conn = new PDO($dns, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $ex) {
    error_log("Error en la conexión a la base de datos: " .
      $ex->getMessage());
    return null;
  }
}
