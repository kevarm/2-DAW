<?php 
    class CuentaCorriente{
        private string $cuenta;
        private string $titular;
        private float $cantidad;

        public function __construct(string $cuenta, string $titular, float $cantidad){
            $numParametros=func_num_args();
            $getParametros=func_get_args();

            if($numParametros===0){
                $this->cuenta="";
                $this->titular="";
                $this->cantidad=0;
            }elseif($numParametros===3){
                $this->cuenta=$getParametros[0];
                $this->titular=$getParametros[1];
                $this->cantidad=$getParametros[2];
            }
        }

        public function getCuenta():string{
            return $this->cuenta;
        }

        public function setCuenta(string  $valor):void{
            $this->cuenta=$valor;
        }

        public function getTitular():string{
            return $this->titular;
        }

        public function setTitular( string $valor):void{
            $this->titular=$valor;
        }

        public function getImporte():float{
            return $this->cantidad;
        }

        public function setImporte(float $valor):void{
            $this->importe=$valor;
            }
        
        public function ingresarDinero(float $valor):void{
            if($valor>0){
                $this->cantidad=$this->cantidad+$valor; //Ora opcion más corta $this->importe += $valor
            }else{
                throw new InvalidArgumentException("Se ha producido un error");
            }
        }

        public function retirarDinero(float $valor):void{
            if($valor <$this->cantidad && $valor>0){
                $this->cantidad-=$valor;
            }else{
                throw new InvalidArgumentException("Se ha producido un error");
            }
        }

        public function transferirDinero(CuentaCorriente $cuenta, float $valor):void{
            if($this->cantidad>$valor && $valor>0){
                $this->cantidad-=$valor;
                $cuenta->setImporte($valor+$cuenta->getImporte());
            }
        }

        public function consultarSaldo():float{
            return $this->getImporte();
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