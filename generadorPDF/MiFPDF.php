<?php
require_once('fpdf/fpdf.php'); 
require_once('MiPDF.php');

class MiFPDF extends MiPDF {
    private $pdf;

    public function generaDoc() {
        $this->pdf = new FPDF();
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