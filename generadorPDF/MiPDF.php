<?php

require_once('GeneradorPDF.php'); 

abstract class MiPDF implements GeneradorPDF {
    protected $titulo;
    protected $contenido;
    protected $tipoLetra;
    protected $tamano;
    protected $alineacion;

    const FORMATO_PDF = '.pdf';
    const TAMANO_DEF= 12;

    public function __construct()
    {
      $numArgs = func_num_args();
      $args = func_get_args();
  
      if ($numArgs === 2) {
        $this->titulo = $args[0];
        $this->contenido = $args[1];
        $this->tipoLetra = "Arial";
        $this->tamano = self::TAMANO_DEF;
        $this->alineacion = "L";
      } elseif ($numArgs === 5) {
        $this->titulo = $args[0];
        $this->contenido = $args[1];
        $this->tipoLetra = $args[2];
        $this->tamano = $args[3];
        $this->alineacion = $args[4];
      } else {
        throw new InvalidArgumentException("Número incorrecto de argumentos para el constructor.");
      }
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function getTipoLetra() {
        return $this->tipoLetra;
    }

    public function setTipoLetra($tipoLetra) {
        $this->tipoLetra = $tipoLetra;
    }

    public function getTamano() {
        return $this->tamano;
    }

    public function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    public function getAlineacion() {
        return $this->alineacion;
    }

    public function setAlineacion($alineacion) {
        $this->alineacion = $alineacion;
    }

    
    abstract public function generaDoc();

    public function almacenaDoc($ruta) {
        file_put_contents($ruta, $this->contenido);
    }

    public function devuelveDoc() {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $this->titulo . self::FORMATO_PDF . '"');        echo $this->contenido;
    }
}

?>