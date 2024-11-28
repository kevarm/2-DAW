<?php
    class Electrodomestico{
        private float $precio;
        private string $color;
        private string $consumo;
        private float $peso;

        public const COLORES=["blanco","negro","rojo","azul","gris"];
        public const CONSUMOS=["A","B","C","D","E","F"];

        public function __construct(){
            $this->precio=100;
            $this->color="blanco";
            $this->consumo="F";
            $this->peso=5;
        }

        public function getPrecio():float{
            return $this->precio;
        }

        public function setPrecio(float $precio):void{
            $this->precio=$precio;
        }

        public function getColor():float{
            return $this->color;
        }

        public function setColor(float $color):void{
            $this->color=$color;
        }

        public function getConsumo():float{
            return $this->consumo;
        }

        public function setConsumo(float $consumo):void{
            $this->consumo=$consumo;
        }

        public function getPeso():float{
            return $this->peso;
        }

        public function setPeso(float $peso):void{
            $this->peso=$peso;
        }

        private function comprobarConsumoEnergetico(string $letra):string{
            if(in_array($letra, self::CONSUMOS)){
                return $letra;
            }else{
                return self::CONSUMOS;
            }
        }

        public function precioFinal():float{
            
        }
    }
?>