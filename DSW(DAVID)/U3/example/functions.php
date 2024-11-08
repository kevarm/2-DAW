<?php
/*
CONEXIÓN MYSQL
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Campus";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
    // Si ocurre un error en la conexión, die() muestra el mensaje de error y detiene la ejecución del resto del script, evitando posibles problemas al intentar trabajar con una conexión inválida.
}

// Consulta para obtener el alumnado y las aulas en las que están matriculados
$sql = "SELECT alumnado.dni, alumnado.nombre, alumnado.apellidos, alumnado.email, GROUP_CONCAT(aulasvirtuales.nombrelargo SEPARATOR ', ') AS aulas
        FROM alumnado
        JOIN matriculas ON alumnado.dni = matriculas.dni
        JOIN aulasvirtuales ON matriculas.id_aula = aulasvirtuales.id
        GROUP BY alumnado.dni";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Aulas</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["dni"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["aulas"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>*/


function crearConexion($host, $db, $user, $pass) {
  try {
    $dns = "mysql:host=$host;dbname=$db";
    $conn = new PDO($dns, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    error_log("Error en la conexión a la base de datos: " .
      $e->getMessage());
    return null;
  }
}

?>
