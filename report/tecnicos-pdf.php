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
include "../core/modules/index/model/TecnicoData.php";
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');


$periodo=$_GET["periodo"];
 
$mes=$_GET["mes"];

 if(isset($_GET["tecnico_id"]) && $_GET["tecnico_id"]!=""){
    $enviar=$_GET["tecnico_id"];
    $medic_id= " and t.tecnico_id=".$_GET["tecnico_id"]; 
  } else  
     $medic_id= ""; 
 
 
  $sql = "SELECT t.id,m.id as tecnico,t.osocial_id,t.tecnico_id,t.pacient_id,t.estudio_id, m.lastname, m.name,t.tipo_pago,t.observacion_coseguro, t.category_id, precio_obra, t.date_at, t.price, t.time_at FROM `reservation` t left join tecnicos m on m.id = t.tecnico_id  where   MONTH(t.date_at) = '$mes' and YEAR(t.date_at) = '$periodo' and m.id != 0 and status_id in (2,5) $medic_id order by date_at,STR_TO_DATE(time_at,'%H:%i')";
 // echo $sql;  
//$sql = "SELECT m.id as tecnico, m..name as categoria FROM `reservation` t left join estudio e on e.id = t.estudio_id left join tecnicos m on m.id = t.tecnico_id left join category c on c.id = t.category_id where c.id in (3,4,5,6,9,17,21,217,219) and MONTH(t.date_at) = '$mes' and YEAR(t.date_at) = '$periodo' and m.id != 0 and status_id in (2,5) $medic_id GROUP BY m.lastname, m.name,e.descripcion order by m.lastname, m.name, c.id, e.id";

  
$resultado = ReservationData::getBySQL($sql);
 
 $tituloReporte = " Reportes Atenciones de Tecnicos por periodo";//
              
           
                
                $tituloCierre= 'Mes:'.$mes;
                
             
 
                $titulousuario = 'Periodo:'.$periodo;
       // echo $sql;         
                
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Marco farfan');
$pdf->SetTitle($tituloReporte);
$pdf->SetSubject('TCPDF Cierre');
$pdf->SetKeywords('TCPDF, PDF, Tecnico, Tecnico, tecnico');
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
// add a page
$pdf->AddPage();
// ---------------------------------------------------------


$textfont='helvetica';
$pdf->SetFont($textfont , "", 15);
$pdf->Ln(15);
$pdf->Cell(0,10,"$tituloReporte - $tituloCierre - $titulousuario ",1,1,'C');
//Restauracin de colores y fuentes

 

//Ttulos de las columnas
$header=array( 'FECHA','ESTUDIO', 'PACIENTE', 'OBRA SOCIAL', 'TECNICO', 'COSEGURO', 'OBSERV.');

//Colores, ancho de lnea y fuente en negrita
   $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.1); 


$pdf->setX(10);

$pdf->SetFont($textfont , "", 6);
//Cabecera
$w=array(20,50,38,28,27,13,10);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);

		 $fill = 0; 

                            $pdf->Ln();
                            // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
        $pdf->SetFont($textfont , "", 6);
        foreach ( $resultado as $fila){
            $pdf->setX(10);

$fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
$pdf->Cell($w[0],5,$fecha_turno." ".$fila->time_at, 'LR', 0, 'L', $fill); 
 $estudio = $fila->getEstudio();
 $tecnico = $fila->getTecnico();
$pacient  = $fila->getPacient();
$osocial = $fila->getOsocial();
$texto= substr($estudio->descripcion, 0, 20);
                                 //echo $texto."";


$pdf->Cell($w[1],5,$estudio->id." ".$texto, 'LR', 0, 'L', $fill); 
$pdf->Cell($w[2],5,$pacient->name." ".$pacient->lastname, 'LR', 0, 'L', $fill);
 $texto= substr($osocial->nombre, 0, 10);
                               //  echo $texto." B:".$user->id;
                          
                          
$pdf->Cell($w[3],5,$osocial->id." ".$texto." B:".$fila->id,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);
$nombre=$tecnico->name." ".$tecnico->lastname;
if(strlen ( $nombre )>25){
     $pdf->SetFont($textfont , "", 5);
                          }
$pdf->Cell($w[4],5,$nombre,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);


if(!empty($fila->tipo_pago))
$tipo_pago= substr($fila->tipo_pago, 0, 3);
else {
   $tipo_pago= 'EFE';
}

if ($fila->observacion_coseguro >0){
    $pdf->Cell($w[5],5,$tipo_pago.' - ','LR', 0, 'R', $fill); 
    $pdf->Cell($w[6],5,'$'.number_format($fila->observacion_coseguro,2,",","."),'LR', 0, 'R', $fill); 
}else{
    $pdf->Cell($w[5],5,'$'.number_format($fila->price,2,",","."),'LR', 0, 'R', $fill); 
    $pdf->Cell($w[6],5,'--'.$tipo_pago,'LR', 0, 'R', $fill); 
}


$pdf->Ln();
        }
  
$pdf->Ln();


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
