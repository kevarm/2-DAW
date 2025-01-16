
<?php
    // Importacion de conexión a la base de datos
    require_once "conexion.php";

    
    // Función para obtener los carteles ganadores
    function getCategory(){
        // Crear conexión
        $conn = createConnection();
        
        try {
            // Query para obtener los datos
            $stmt = $conn->prepare("
                SELECT nombre, descripcion
                FROM categoria;
            ");
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            echo "Error al realizar la consulta: " . $e->getMessage();
        }
    }

?>