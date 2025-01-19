<!-- index.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS -->
</head>

<body>


    <?php include 'header.php'; ?> <!-- Incluye el archivo del header -->

    <main>
        <section id="inicio">
            <div class=centrado>
                <h2>Bienvenido a el Pajar</h2>
            </div>
            <p>
                En el Pajar, nuestro gestor en línea te permite hacer tus compras de productos y gestionar el transporte de manera sencilla y eficiente. <br>
                A través de nuestra plataforma, podrás:Comprar productos frescos y de calidad directamente desde nuestro sistema, asegurando que siempre tengas los ingredientes necesarios para ofrecer lo mejor a tus clientes. <br>
                Gestionar el transporte de tus productos para garantizar entregas puntuales y mantener siempre el stock adecuado. <br>
                Nuestro objetivo es facilitarte la operación diaria del restaurante, optimizando la compra y el transporte para que puedas enfocarte en lo que mejor haces: servir comida deliciosa. <br>
                Visita nuestra página web para comenzar a gestionar tus pedidos y entregas de forma más eficiente.</p>
        </section>
        <section id="servicios">
            <div class=centrado>
                <h2>Servicios</h2>
            </div>
            <p>
            Hacer un pedido: <button class=numTlfC><a class=numTlf href="carrito.php"> Carrito</a></button> <br><br>  
            Mirar mis facturas: <button class=numTlfC><a class=numTlf href="carta.php"> carta</a></button> <br><br>  
            Mirar mis pedidos: <button class=numTlfC><a class=numTlf href="pedidos.php"> Pedidos</a></button> <br><br>  

                
            </p>
        </section>
        <section id="contacto">
            <div class=centrado>
                <h2>Contactanos</h2>
            </div> <p>
            Contacta a traves de nuetsro numero: <button class=numTlfC><a class=numTlf href="tel:+34 605335423">605335423</a></button> <br><br>
            Nuestro instagram es el siguiente botón: <button class=instagramB> <a class=instagram href="https://www.instagram.com/barplayaelboya?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">El boya arguniguin</a></button> <br><br>
            Aqui como llegar a nuestro restaurante mas famoso: <button class=ubicacionB><a class=ubicacion href="https://www.google.com/maps/dir/28.0952832,-15.4435584/direccion+el+boya/@27.931007,-15.6984554,11z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0xc3f7deec701615d:0x5c33c154af9b897!2m2!1d-15.6721139!2d27.7524374?entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D">
            Llega a nosotros </a></button> </p>
        </section>
    </main>

    <script src="script.js"></script> <!-- Enlace al archivo JavaScript -->
</body>

</html>