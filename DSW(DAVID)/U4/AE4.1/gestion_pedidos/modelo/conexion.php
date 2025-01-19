<?php


function createConnection()
{
    try {
        $host = 'localhost';
        $dbname = 'gestionpedidos';
        $username = 'root';
        $password = '';
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
        return null;
    }
}

function getCategory($conn)
{
    try {
        $stmt = $conn->prepare("
            SELECT *
            FROM categoria;
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al realizar la consulta: " . $e->getMessage();
        return null;
    }
}

function getProducts($conn, $categoryId)
{
    try {
        $stmt = $conn->prepare("
        SELECT * 
        FROM producto 
        WHERE categoria = :categoryId");
        $stmt->execute(['categoryId' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al realizar la consulta de productos: " . $e->getMessage();
        return null;
    }
}
