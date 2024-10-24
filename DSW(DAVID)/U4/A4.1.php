<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button type="submit">Reiniciar contador</button>
            

    <?php
    if (!isset($_COOKIE['visitas'])) {
        setcookie('visitas', '1', time() + 3600 * 24); // Expira en 24 horas
        echo "Bienvenido por primera vez";
    } else {
        $visitas = $_COOKIE['visitas'] + 1;
        setcookie('visitas', $visitas, time() + 3600 * 24); // Expira en 24 horas
        echo "Bienvenido por $visitas vez";
    }

    ?>
</body>

</html>