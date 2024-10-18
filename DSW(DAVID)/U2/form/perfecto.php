<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número perfecto</title>
</head>
<body>
    <?php
        $num=28;
        $sum=0;
        for($i=1;$i<$num;$i++){
            if(($num%$i)==0){
                $sum=$sum+$i;
            }
        }

        if($sum==$num){
            echo 'El número '.$num.' es perfecto.';
        }else{
            echo 'El número '.$num.' no es perfecto.';
        }

    ?>
</body>
</html>