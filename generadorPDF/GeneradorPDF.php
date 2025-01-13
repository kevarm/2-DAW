<?php

require_once('MiFPDF.php');  
require_once('MiDomPdf.php'); 

interface GeneradorPDF {
    public function generaDoc();
    public function almacenaDoc($ruta);
    public function devuelveDoc();
}

$titulo = "Mi Informe PDF";
$contenido = "Este es el contenido de ejemplo para el documento PDF.";

// Poner true si quieres usar FPDF o false si quieres usar DomPdf
$usarFPDF = true; 

if ($usarFPDF) { 
    $pdf = new MiFPDF($titulo, $contenido, "Arial", 12, "C"); 
    $pdf->generaDoc();  
    $pdf->almacenaDoc('documento_fpdf.pdf'); 
    $pdf->devuelveDoc();  
} else {
    $pdfLib = new MiDompdf("Mi Título Dompdf", "Este es el contenido del PDF generado con Dompdf.", "Arial", 12, "C");
    $pdfLib->generaDoc(); 
    $pdfLib->almacenaDoc('documento_tcpdf.pdf'); 
    $pdfLib->devuelveDoc(); 
}

?>
