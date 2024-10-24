<?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $lang= $_POST['lang'];
            setcookie("lang", $lang, time()+(30 * 24 * 60 * 60), "/");
        }
        header("Location: A4.2.php");
        exit();
    ?>