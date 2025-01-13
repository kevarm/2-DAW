<?php
require_once('fpdf/fpdf.php'); 
require_once('MiPDF.php');

class MiFPDF extends MiPDF {
    private $pdf;

    public function __construct($titulo = "", $contenido = "", $tipoLetra = "Arial", $tamano = 12, $alineacion = "L") {
        parent::__construct($titulo, $contenido, $tipoLetra, $tamano, $alineacion);
        $this->pdf = new FPDF();
    }

    public function generaDoc() {
        $this->pdf->AddPage();
        $this->pdf->SetFont($this->tipoLetra, '', $this->tamano);
        $this->pdf->Cell(0, 10, $this->titulo, 0, 1, $this->alineacion);
        $this->pdf->MultiCell(0, 10, $this->contenido);
        $this->contenido = $this->pdf->Output('S');  
    }

    public function almacenaDoc($ruta) {
        parent::almacenaDoc($ruta);
    }
}

?>