<?php

include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/GastosData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
include "../core/modules/index/model/CierreData.php";
include "../core/modules/index/model/CategoryData.php";
include "../core/modules/index/model/UserData.php";
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');


 $reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $solicitante = $reservation->getMedic2();
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
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();
$textfont='helvetica';



  
 
// $section1 = $word->createSection(array('marginLeft'=>15, 'marginRight'=>6, 'marginTop'=>70, 'marginBottom'=>70));

 //$section1->addImage("../image/logo.jpg", array('width'=>110, 'height'=>110, 'align'=>'left'));
  //$pdf->Image("../image/logo.jpg", '0', '0',25,25);  
  //$pdf->setY(26);
  //$pdf->Ln();
  
 
// ---------------------------------------------------------

//Restauracin de colores y fuentes

 $pdf->Ln(4);

$total = 0;
$fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes
$pdf->SetFont($textfont , "", 11);
$pdf->setY(50);
/**
$pdf->Cell(0,10," ".$estudio->descripcion,1,1,'C');

$pdf->Cell(0,10," Numero de Estudio:  $reservation->id" ,0,0,'L');
$pdf->Ln(4);

$pdf->Cell(0,10," Paciente:   ".$pacient->lastname." ".$pacient->name." -  DNI:   ".$pacient->no,0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10," Turno:".$fecha." "  ,0,0,'L');//$reservation->time_at 
$pdf->Ln(4);

$pdf->Cell(0,10," Medico Solicitante:   $solicitante->lastname  $solicitante->name " ,0,0,'L');
$pdf->Ln(5);


$pdf->Cell(0,10," Obra Social:   $osocial->nombre" ,0,0,'L');//$osocial->id -
 * 
 */
$pdf->Ln(8);
//$txt  = $reservation->informe;
$txt  ='<table border="0" style="width:100%" ><tr><td>';

//$txt  ='<br>';
if (!empty($txt)){
    $txt.= html_entity_decode($reservation->informe); 
    $txt.='</td></tr></table>';
  // echo $reservation->informe; //print_r($txt);
   
    $pdf->writeHTML($txt, true, 1, true, 1);
   
   
}
 
/**
 $pdf->Cell(0,10,"   Datos del profesional responsable del estudio" ,0,0,'L');
$pdf->Ln();
$pdf->Cell(0,10,"   $medic->lastname  $medic->name " ,0,0,'L');
$pdf->Ln();
*/
			$fecha=date("d".'-'."m".'-'."Y".','."h:i:s");
	$pdf->Ln(2);
    $pdf->SetFont($textfont ,'',5);
	
    		
$style = array(
	'position' => 'S',
	'border' => true,
	'padding' => 4,
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 5,
	'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
//$pdf->write1DBarcode($reservation->id, 'C39', '', '', 50, 25, 0.4, $style, 'N');

$js = <<<EOD


EOD;
        // force print dialog
$js .= 'print(true);';
// set javascript
//$pdf->IncludeJS($js);


ob_end_clean();
$pdf->IncludeJS("print();"); 

$pdf->Output($tituloReporte.'.pdf', 'I'); //

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
