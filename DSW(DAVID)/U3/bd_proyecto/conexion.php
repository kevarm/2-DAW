<?php
    function conectar($host, $db, $user, $pass) {
        try {
          $dns = "mysql:host=$host;dbname=$db";
          $conn = new PDO($dns, $user, $pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
        } catch (PDOException $ex) {
          error_log("Error en la conexión a la base de datos: ".
                     $ex->getMessage());
          return null;
        }
      }   
?>
