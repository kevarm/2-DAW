<!-- Implementa una clase denominada “CuentaCorriente”. Dicha clase tendrá las siguientes características:

Sus atributos serán todos privados: el número de la cuenta corriente, el nombre del tiutlar de la cuenta y el importe de que dispone. 
Dispondrá de un constructor sin parámetros y otro constructor con tres parámetros.
Tendrá los siguientes métodos:
ingresarDinero
retirarDinero
transferirDinero (se le debe pasar un objerto de tipo “CuentaCorriente”, a donde se transferirá el dinero)
consultarSaldo
Establece los parámetros que consideres necesarios en los métodos anteriores. Debes definir el tipo de los parámetros y de los valores devueltos para impedir que el programador cometa algún tipo de error al invocarlos. Comprueba que se genera un error en caso de que no coincida el tipo de los parámetros y/o los valores devueltos por los métodos.
Implementa un PHP que valide la correcta definición de las clases anteriores. -->

<?php
class CuentaCorriente
{
    private string $numero;
    private string $nombre;
    private float $dinero;

    //public function __construct() {}

    public function __construct($num, $nom, $din)
    {
        $this->numero = $num;
        $this->nombre = $nom;
        $this->dinero = $din;
    }

    public function ingresarDinero(float $din): void
    {
        if ($din == 0 || $din < 0) {
            throw new InvalidArgumentException("La cantidad a ingresar debe ser mayor a 0");
        } else {
            $this->dinero += $din;
        }
    }

    public function retirarDinero(float $din): void
    {
        if ($din <= 0) {
            throw new InvalidArgumentException("La cantidad a retirar debe ser mayor a 0");
        } elseif ($din <= $this->dinero) {
            $this->dinero -= $din;
        } else {
            throw new InvalidArgumentException("No dispone de tal cantidad en su cuenta");
        }
    }

    public function transferirDinero(CuentaCorriente $cuenta, float $din)
    {
        if ($din <= 0) {
            throw new InvalidArgumentException("La cantidad debe ser mayor a 0");
        } else if ($din > $this->dinero) {
            throw new InvalidArgumentException("No dispone de dicha cantidad en su cuenta");
        } else {
            $this->retirarDinero($din);
            $cuenta->ingresarDinero($din);
        }
    }

    public function consultarSaldo():float {
        return $this->dinero;
    }
}

try {
    $cuenta1= new CuentaCorriente("11111111","Kevin",50);
    $cuenta2= new CuentaCorriente("22222222","David",5000);

    $cuenta1->ingresarDinero(500);
    $cuenta2->ingresarDinero(100);

    echo "Cuenta 1 tiene ".$cuenta1->consultarSaldo()."<br>";
    echo "Cuenta 2 tiene ".$cuenta2->consultarSaldo()."<br>";

    $cuenta1->retirarDinero(100);
    $cuenta2->retirarDinero(4000);

    echo "Cuenta 1 tiene ".$cuenta1->consultarSaldo()."<br>";
    echo "Cuenta 2 tiene ".$cuenta2->consultarSaldo()."<br>";
    
    $cuenta1->transferirDinero($cuenta2,20);
    $cuenta2->transferirDinero($cuenta1,10);

    echo "Cuenta 1 tiene ".$cuenta1->consultarSaldo()."<br>";
    echo "Cuenta 2 tiene ".$cuenta2->consultarSaldo()."<br>";

}catch (InvalidArgumentException $e){
    echo "Error: ". $e->getMessage()."<br>";
}






?>