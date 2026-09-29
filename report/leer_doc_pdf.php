<?php

include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";

include "../core/modules/index/model/UserData.php";
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');


 $reservation = ReservationData::getById($_GET["id"]);
               
           
  $tituloReporte = "Informe-".$reservation->id."";           
             
//require_once('../tcpdf/config/lang/eng.php');
//require_once('../tcpdf/tcpdf.php');
require_once('../TCPDF-master/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Marco farfan');
$pdf->SetTitle($tituloReporte);
$pdf->SetSubject('TCPDF Cierre');
$pdf->SetKeywords('TCPDF, PDF, Cierre, caja, guide');
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
//$pdf->setLanguageArray($l); 

// ---------------------------------------------------------

// set font
//$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();

//$txt  = $reservation->informe;
//$txt  ='<table border="0" style="width:100%" ><tr><td>';

$txt  ='<br>';
if (!empty($txt)){
    
    $lineas = file('file:///C:/Users/Lenovo/Documents/SEGURIDAD/Informe-187.doc');
$lineas = file('file:///C:/Users/Lenovo/Documents/SEGURIDAD/Informe-6756.doc');

     
      foreach ($lineas as $linea_num => $linea) {
        $txt.= html_entity_decode($linea);
     //   $pdf->writeHTML($txt, true, 1, true, 1);
    }
      
   // $txt.= html_entity_decode($reservation->informe); 
   // $txt.='</td></tr></table>';
  // echo $reservation->informe; //print_r($txt);
   
    $pdf->writeHTML($txt, true, 1, true, 1);
   
   
}
 
   

$pdf->Output($tituloReporte.'.pdf', 'I'); //

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
