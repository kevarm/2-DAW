<?php

interface DocumentoPDF{
  public function generaDoc();
  public function almacenaDoc($path);
  public function devuelveDoc();
}

abstract class MiPDF{
  protected string $titulo;
  protected string $contenido;
  protected string $tipoLetra;
  protected int $tamano;
  protected string $alineacion;

  protected const EXTENSION = ".pdf";

  public function __construct()
  {
    $numArgs = func_num_args();
    $args = func_get_args();

    if ($numArgs === 2) {
      $this->titulo = $args[0];
      $this->contenido = $args[1];
      $this->tipoLetra = "Arial";
      $this->tamano = 12;
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

  public function getTitulo(): string{
    return $this->titulo;
  }

  public function setTitulo(string $titulo): void{
    $this->titulo = $titulo;
  }

  public function getContenido(): string{
    return $this->contenido;
  }

  public function setContenido(string $contenido): void{
    $this->contenido = $contenido;
  }

  public function getTipoLetra(): string{
    return $this->tipoLetra;
  }

  public function setTipoLetra(string $tipoLetra): void{
    $this->tipoLetra = $tipoLetra;
  }

  public function getTamanoLetra(): int{
    return $this->tamano;
  }

  public function setTamanoLetra(int $tamanoLetra): void{
    $this->tamano = $tamanoLetra;
  }

  public function getAlineacion(): string{
    return $this->alineacion;
  }

  public function setAlineacion(string $alineacion): void{
    $this->alineacion = $alineacion;
  }

  abstract public function generaDoc();
  abstract public function almacenaDoc(string $filePath);
  abstract public function devuelveDoc();
}

//Librería FPDF
require_once './fpdf186/fpdf.php';

class MiFPDF extends MiPDF implements DocumentoPDF
{
  private $pdf;

  public function __construct($titulo = "Documento PDF", $contenido = "", $tipoLetra = "Arial", $tamano = 12, $alineacion = "L"){
    parent::__construct($titulo, $contenido, $tipoLetra, $tamano, $alineacion);
    $this->pdf = new FPDF();
  }

  public function generaDoc(){
    $this->pdf->AddPage();
    $this->pdf->SetFont($this->tipoLetra, '', $this->tamano);
    $this->pdf->SetTitle($this->titulo);
    $this->pdf->MultiCell(0, 10, $this->contenido, 0, $this->alineacion);
  }

  public function almacenaDoc($path){
    $this->pdf->Output('F', $path . parent::EXTENSION);
  }

  public function devuelveDoc(){
    $this->pdf->Output('I', $this->titulo . parent::EXTENSION);
  }
}


//Librería PDFLIB
require_once './PDFlib-10.0.2-Windows-x86-php/bind/php/Eclipse PDT/PDFlib.php';

class MiPDFLib extends MiPDF implements DocumentoPDF{
  private $pdf;

  public function __construct($titulo = "Documento PDFLib", $contenido = "Hola", $tipoLetra = "Helvetica", $tamano = 12, $alineacion = "L"){
    parent::__construct($titulo, $contenido, $tipoLetra, $tamano, $alineacion);
    $this->pdf = new PDFlib();

    if ($this->pdf->begin_document("", "") === 0) {
      throw new Exception("No se pudo iniciar el documento PDFlib: " . $this->pdf->get_errmsg());
    }

    $this->pdf->set_info("Creator", "MiPDFLib");
    $this->pdf->set_info("Author", "TuNombre");
    $this->pdf->set_info("Title", $this->titulo);
  }

  public function generaDoc(){
    $this->pdf->begin_page_ext(595, 842, "");

    $font = $this->pdf->load_font($this->tipoLetra, "winansi", "");
    if ($font === 0) {
      throw new Exception("No se pudo cargar la fuente: " . $this->pdf->get_errmsg());
    }

    $this->pdf->setfont($font, $this->tamano);
    $this->pdf->show_xy($this->titulo, 50, 800);
    $this->pdf->continue_text($this->contenido); 
    $this->pdf->end_page_ext("");
  }

  public function almacenaDoc($path){
    $this->generaDoc();
    $this->pdf->end_document("");
    file_put_contents($path . parent::EXTENSION, $this->pdf->get_buffer());
  }

  public function devuelveDoc(){
    $this->generaDoc();

    $this->pdf->end_document("");

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $this->titulo . parent::EXTENSION . '"');
    echo $this->pdf->get_buffer();
  }

  public function __destruct(){
    $this->pdf = null;
  }
}

$pdf1 = new MiFPDF("Documento1", "Creado con librería fpdf", "Arial", 12, "L");
$pdf1->generaDoc();
$pdf1->almacenaDoc("fichero_fpdf");
$pdf1->devuelveDoc();

$pdf2 = new MiPDFLib("Documento2", "Creado con librería pdflib", "Helvetica", 12, "L");
$pdf2->almacenaDoc("documento_pdflib");

