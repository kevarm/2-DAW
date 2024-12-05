<?php

    session_start();

    $lang='es';

    if (isset($_COOKIE['lang'])){
        $lang= $_COOKIE['lang'];
    }

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php if ($lang=='en'): ?>
        <h1>Welcome to our site</h1>
        <p>You can choose your language using the link</p>
        <p><a href="index.php">Change language</a></p>

    <?php else: ?> 
        <h1>Bienvenido a nuestra web</h1>
        <p>Puedes elegir el idioma usando el enlace</p>
        <p><a href="index.php">Cambiar idioma</a></p>
    <?php endif; ?> 

    
</body>
</html>