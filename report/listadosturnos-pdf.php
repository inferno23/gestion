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
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["date_at"]))
        && ( $_GET["category_id"]!="" || $_GET["estudio_id"]!=""  || $_GET["medic_id"]!="" || $_GET["date_at"]!="" || $_GET["osocial_id"]!="") ) {
    
    
$sql = "select * from reservation where ";

if($_GET["date_at"]!=""){
   

            $sql .= " date_at = \"".$_GET["date_at"]."\"";
}else {
    $sql .= " date_at = \"".date("Y-m-d")."\"";
}
   
if($_GET["category_id"]!=""){
	$sql .= " AND category_id = ".$_GET["category_id"];
 }

if($_GET["estudio_id"]!=""){
	$sql .= " AND estudio_id = ".$_GET["estudio_id"];
}

if($_GET["osocial_id"]!=""){
            $sql .= " AND osocial_id = \"".$_GET["osocial_id"]."\"";
}

if($_GET["medic_id"]!=""){
	$sql .= " AND medic_id = ".$_GET["medic_id"];
}
$sql .= " AND status_id !=4  order by date_at,STR_TO_DATE(time_at,'%H:%i')";
//STR_TO_DATE(time_at,'%H:%i')
//echo ''.$sql;
		$resultado = ReservationData::getBySQL($sql);

 }
 
 $tituloReporte = "Listado de Turnos ";
             
                
              
                
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

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
$pdf->setLanguageArray($l); 

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 16);

// add a page
$pdf->AddPage();

// print a line using Cell()
//$pdf->Cell(0, 12, 'Example 001 - €àèéìòù', 1, 1, 'C');

// ---------------------------------------------------------


$textfont='helvetica';
$pdf->SetFont($textfont , "", 20);
$pdf->Ln(15);
$pdf->Cell(0,10,"$tituloReporte  -  ",1,1,'C');
//Restauracin de colores y fuentes

 

//Ttulos de las columnas
$header=array( 'FECHA','ESTUDIO', 'PACIENTE', 'OBRA SOCIAL', 'PROFESIONAL', 'SOLICITA', 'COSEGURO', 'OBSERV.');

//Colores, ancho de lnea y fuente en negrita
   $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.1); 


$pdf->setX(10);

$pdf->SetFont($textfont , "", 6);
//Cabecera
$w=array(20,43,37,18,21,20,13,13);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();

// Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
		
/************ primera categoriaaaa  * 		 */
           $fill=0;   
                            $pdf->SetFont($textfont , "", 6);
foreach ( $resultado as $fila){
                            $medic = $fila->getMedic();
                            $pacient = $fila->getPacient();
                            $estudio = $fila->getEstudio();
                             $osocial = $fila->getOsocial();
                                //// sumo subtotal por  categoria=0; 
                        
                             
                             
                             
$pdf->setX(10);

$fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
$pdf->Cell($w[0],5,$fecha_turno." ".$fila->time_at, 'LR', 0, 'L', $fill); 
$texto= substr($estudio->descripcion, 0, 40);
                                 //echo $texto."";


$pdf->Cell($w[1],5,$estudio->id." ".$texto, 'LR', 0, 'L', $fill); 
$pdf->Cell($w[2],5,$pacient->name." ".$pacient->lastname.". - ".$pacient->no, 'LR', 0, 'L', $fill);
 $texto= substr($osocial->nombre, 0, 8);
                               //  echo $texto." B:".$user->id;
                          
                          
$pdf->Cell($w[3],5,$osocial->id." ".$texto." B:".$fila->id,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);
$texto= substr($medic->lastname, 0, 10);
$texto1= substr($medic->name, 0, 1);

                      
$pdf->Cell($w[4],5,$texto.' '.$texto1,'LR', 0, 'L', $fill); 
$textosolicitante=" NO REGISTRA";
if (!empty($fila->medsoli) ) {
    $medic2 = $fila->getMedic2();
   
   $texto= substr($medic->lastname, 0, 10);
   $texto1= substr($medic->name, 0, 1);
        $textosolicitante= $texto.' '.$texto1;
}

$pdf->Cell($w[5],5,$textosolicitante,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);
$pdf->Cell($w[6],5,'$'.number_format($fila->price,2,".",","),'LR', 0, 'R', $fill); 
$pdf->Cell($w[7],5,'$'.number_format($fila->observacion_coseguro,2,".",","),'LR', 0, 'R', $fill); 
$pdf->Ln();
 
}
$pdf->Cell(0,0.5,"",1,1,'C');
$pdf->SetFont($textfont , "", 6);



			$fecha=date("d".'-'."m".'-'."Y".','."h:i:s");
	$pdf->Ln(2);
    $pdf->SetFont($textfont ,'',5);
	$pdf->Cell(20,4,$fecha);		
	
	//$pdf->SetY(-12);
	$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'R');	
    		
//$pdf->Output("ejemplo.pdf", "I");

$js = <<<EOD


EOD;
        // force print dialog
$js .= 'print(true);';
// set javascript
//$pdf->IncludeJS($js);
$pdf->Output($tituloReporte.'.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
