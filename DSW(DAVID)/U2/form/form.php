<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de satisfacción</title>
</head>
<body>
    <form method="post">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre">
        <br><br>

        <label for="satisfaccion">Indique su nivel de satisfacción con el servicio</label>
        <select id="satisfaccion" name="satisfaccion">
            <option name="satisfecho">Satisfecho</option>
            <option name="neutral">Neutral</option>
            <option name="no_satisfecho">No satisfecho</option>
        </select>
        <br><br>

        <label for="comentarios">Comentario</label>
        <textarea id="comentarios" placeholder="Escriba su comentario"></textarea>
        <br><br>

        <input type="submit" value="Enviar encuesta">
        <input type="reset" value="Borrar datos">
    </form>

    <br>

    <?php
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $option= $_POST['satisfaccion'];
            
            if($option=='No satisfecho' || $option=='Neutral'){
                echo "Agradecemos su valoración. Tendremos en cuenta su opinión para futuras mejoras";
            }else if($option=='Satisfecho'){
                echo "Muchas gracias por su valoración positiva";
            }


        }
    ?>
</body>
</html>