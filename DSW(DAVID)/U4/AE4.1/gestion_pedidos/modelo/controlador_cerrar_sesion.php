<?php
    session_start();
    setcookie('cart', json_encode($_SESSION['carrito']), time() + (86400 * 30), "/");
    session_destroy();
    header("location: ../login.php");
?>