<?php

require_once('MiFPDF.php');  
require_once('MiDomPdf.php'); 

interface GeneradorPDF {
    public function generaDoc();
    public function almacenaDoc($ruta);
    public function devuelveDoc();
}

$titulo ="Mi titulo FPDF";
$contenido = "Este es el contenido de ejemplo para el documento con libreria FPDF.";

// Poner true si quieres usar FPDF o false si quieres usar DomPdf
$usarFPDF = true; 

try {
    if ($usarFPDF) { 
        $pdf = new MiFPDF($titulo, $contenido); 
        $pdf->generaDoc();  
        $pdf->almacenaDoc('documento_fpdf.pdf'); 
        $pdf->devuelveDoc();  
    } else {
        $pdfLib = new MiDompdf("Mi Título Dompdf", "Este es el contenido del PDF generado con Dompdf.", "Arial", 12, "C");
        $pdfLib->generaDoc(); 
        $pdfLib->almacenaDoc('documento_dompdf.pdf'); 
        $pdfLib->devuelveDoc(); 
    }
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}


?>
