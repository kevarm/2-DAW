<?php

require_once 'vendor/autoload.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;

class MiDompdf extends MiPDF {
    private $pdf;

    public function __construct($titulo = "", $contenido = "", $tipoLetra = "Arial", $tamano = 12, $alineacion = "L") {
        parent::__construct($titulo, $contenido, $tipoLetra, $tamano, $alineacion);
        $this->pdf = new Dompdf();
    }

    public function generaDoc() {
        $html = '<html><body>';
        $html .= '<h1>' . $this->titulo . '</h1>';
        $html .= '<p>' . nl2br($this->contenido) . '</p>';
        $html .= '</body></html>';

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->contenido = $this->pdf->output();
    }

    public function almacenaDoc($ruta) {
        file_put_contents($ruta, $this->contenido);
    }

    public function devuelveDoc() {
        ob_end_clean(); 
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $this->titulo . '.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        echo $this->contenido;
    }
}

?>

