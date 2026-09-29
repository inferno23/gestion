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
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Marco farfan');

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
$date_fin   = $date_at=date("Y-m-d");
if( (isset($_GET["date_at"]) && ( $_GET["date_at"]!=""  )))
$date_at=$_GET["date_at"];

if( (isset($_GET["date_fin"]) && ( $_GET["date_fin"]!=""  )))

  $date_fin   =   $_GET["date_fin"];



$tituloReporte= 'Informe de cierres desde'. $date_at.'_'.$date_fin;
$pdf->SetTitle($tituloReporte);
  $sql = "select * from cierre where created_at  between '".$date_at." 00:00:00' and '".$date_fin." 00:00:00'; ";
//$sql = "select * from hockey_stats  where game_date between '2012-03-11 00:00:00' and '2012-05-11 23:59:00' order by game_date desc;.'";
//echo ''.$sql;
$cierres_informados= CierreData::getBySQL($sql);
  
  if(count($cierres_informados)>0){
     
      foreach($cierres_informados as $cierre){
          
         $cierre_id= $cierre->id;
         $gastos = GastosData::getByCierre($cierre_id);
        $model= CierreData::getById($cierre_id);
      //  echo ' es '.$cierre_id;
        $resultado = ReservationData::getAllImagenByCierreId($cierre_id);
        
        
       

 $tituloReporte = "Informe de Cierre Nro ".$cierre_id;
                $usuario = UserData::getById($model->user_id);
           
                
                $tituloCierre= date("d/m/Y ",strtotime($model->created_at." "));
                
             
 
                $titulousuario = 'Usuario:'.$usuario->lastname;
                




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
$pdf->Cell(0,10,"$tituloReporte - $tituloCierre - $titulousuario ",1,1,'C');
//Restauracin de colores y fuentes

 

//Ttulos de las columnas
$header=array( 'FECHA','ESTUDIO', 'PACIENTE', 'OBRA SOCIAL', 'PROFESIONAL', 'COSEGURO', 'OBSERV.');

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
$pdf->Ln();

// Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
		
/************ primera categoriaaaa  * 		 */
                  $categoria=3;
                $totalcategoria=0;  $totalobservacion=0;
                $total=0;$totalCierre=0;
                 $Category = CategoryData::getById($categoria);
                 $pdf->SetFont($textfont , "", 8);
                                $pdf->SetFillColor(0, 191, 255); // Grey
		 $fill = 0; 
                                  $pdf->setX(10);
                            $pdf->Cell($w[0],5, " ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,$categoria. "  ".$Category->name, 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[2],5," ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[3],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[4],5," ",'LR', 0, 'R', $fill); 
                              $pdf->Cell($w[5],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[6],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Ln();
                            // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
                            $pdf->SetFont($textfont , "", 6);
foreach ( $resultado as $fila){
                            $medic = $fila->getMedic();
                            $pacient = $fila->getPacient();
                            $estudio = $fila->getEstudio();
                             $osocial = $fila->getOsocial();
                                //// sumo subtotal por  categoria=0; 
                        if ($categoria==$fila->category_id){
                             $totalcategoria=$totalcategoria+$fila->price;
                          }else{
                              $pdf->setX(10);
                            $pdf->Cell($w[0],5,$Category->name, 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,"Total $".$totalcategoria, 'LR', 0, 'C', $fill); 
                            $pdf->Cell($w[2],5," ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[3],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[4],5," ",'LR', 0, 'R', $fill); 
                             $pdf->Cell($w[5],5," ",'LR', 0, 'R', $fill); 
                              $pdf->Cell($w[6],5," ",'LR', 0, 'R', $fill); 
                            $totalcategoria=$fila->price;// primer elemnto de la nueva categoria
                              $categoria=$fila->category_id;
                                $Category = CategoryData::getById($categoria);
                                $pdf->Ln();
                                $pdf->SetFont($textfont , "", 8);
                                $pdf->SetFillColor(0, 191, 255); // Grey
		 $fill = 0; 
                                  $pdf->setX(10);
                            $pdf->Cell($w[0],5, " ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,$categoria. "  ".$Category->name, 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[2],5," ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[3],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[4],5," ",'LR', 0, 'R', $fill); 
                              $pdf->Cell($w[5],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[6],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Ln();
                            // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
                            $pdf->SetFont($textfont , "", 6);
                          }
                             
                             
                             
                             
$pdf->setX(10);

$fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
$pdf->Cell($w[0],5,$fecha_turno." ".$fila->time_at, 'LR', 0, 'L', $fill); 
$texto= substr($estudio->descripcion, 0, 20);
                                 //echo $texto."";


$pdf->Cell($w[1],5,$estudio->id." ".$texto, 'LR', 0, 'L', $fill); 
$pdf->Cell($w[2],5,$pacient->name." ".$pacient->lastname, 'LR', 0, 'L', $fill);
 $texto= substr($osocial->nombre, 0, 10);
                               //  echo $texto." B:".$user->id;
                          
                          
$pdf->Cell($w[3],5,$osocial->id." ".$texto." B:".$fila->id,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);
$nombre=$medic->name." ".$medic->lastname;
if(strlen ( $nombre )>25){
     $pdf->SetFont($textfont , "", 5);
                          }
$pdf->Cell($w[4],5,$nombre,'LR', 0, 'L', $fill); 
$pdf->SetFont($textfont , "", 6);
if ($fila->observacion_coseguro >0){
    $pdf->Cell($w[5],5,' - ','LR', 0, 'R', $fill); 
    $pdf->Cell($w[6],5,'$'.number_format($fila->observacion_coseguro,2,",","."),'LR', 0, 'R', $fill); 
}else{
    $pdf->Cell($w[5],5,'$'.number_format($fila->price,2,",","."),'LR', 0, 'R', $fill); 
    $pdf->Cell($w[6],5,'--','LR', 0, 'R', $fill); 
}


$pdf->Ln();
 $total = $total+$fila->price;
         $totalobservacion=$totalobservacion+$fila->observacion_coseguro;
  if(!empty($fila->observacion_coseguro)&&($fila->observacion_coseguro >0))
          $totalCierre=$totalCierre+ $fila->observacion_coseguro;
   else 
       $totalCierre=$totalCierre+ $fila->price;
                                        
//$fill=!$fill; 
}
/**********************ultima categoria ************************************/
  
  $fill = 0; 
$pdf->setX(10);
                            $pdf->Cell($w[0],5,$Category->name, 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,"Total $".$totalcategoria, 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[2],5," ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[3],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[4],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[5],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[6],5," ",'LR', 0, 'R', $fill); 
           

$pdf->Ln();
$pdf->Cell(array_sum($w), 0, '', 'T'); 
 /*****************************   gastos *****************************************/
$pdf->Ln();
$pdf->SetFont($textfont , "", 9);
$pdf->Cell(0,10,"Gastos ",1,1,'C');

$totalgastos=0;
$w=array(20,90,35,40);
$pdf->SetFont($textfont , "", 6);
foreach($gastos as $fila){
    if (strpos($fila->des, 'CONSULTORIO')> 0 ||  strpos($fila->des, 'LABORATORIO')> 0 ){
       // $pdf->Cell($w[0],5,'consultoriiooo sacar ', 'LR', 0, 'L', $fill); 
    }  else {
        $pdf->setX(10);
    $pdf->Cell($w[0],5,$fila->fecha, 'LR', 0, 'L', $fill); 
    $pdf->Cell($w[1],5, $fila->des, 'LR', 0, 'L', $fill); 
       $pdf->Cell($w[2],5,'$'.number_format($fila->monto,2,",","."),'LR', 0, 'R', $fill); 
     $pdf->Cell($w[3],5, $fila->observaciones, 'LR', 0, 'L', $fill); 
    //$fill=!$fill; 
    
     $totalgastos = $totalgastos+$fila->monto;
      $pdf->Ln();
    }
    
   

}

$pdf->SetFont($textfont , "", 9);
if (count ($gastos)>0){
    $fill=!$fill;
     
  //$pdf->Cell(0,10,"Total Gastos: $$totalgastos ",1,1,'C');
}
else 
 $pdf->Cell(0,10,"No se registraron Gastos ",1,1,'C');

//$pdf->Ln();
//$pdf->Cell(0,10,"Total: $total ",1,1,'C');
//$pdf->Cell(0,10,"Total: $total "." - Total Observacion: $ $totalobservacion "." - Total Cierre: $$totalCierre ",1,1,'C');
//$pdf->Ln();
//$pdf->Cell(0,10,"Total Observacion: $totalobservacion ",1,1,'C');
 $rendir=$totalCierre-$totalgastos;
//$pdf->Ln();
//$pdf->Cell(0,10,"Total Cierre: $totalCierre ",1,1,'C');
//$pdf->Ln();




///$pdf->MultiCell(62, 5, 'Total Coseguro ', 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(62, 5, 'Total  Coseguro', 1, 'R', 0, 0, '', '', true);
$pdf->MultiCell(61, 5, 'Total Gastos ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(62, 5, 'Total CAJA ', 1, 'C', 0, 1, '', '', true);

$pdf->MultiCell(62, 5, '$'.number_format($totalCierre,2,",","."), 1, 'R', 0, 0, '', '', true);
$pdf->MultiCell(61, 5, '$'.number_format($totalgastos,2,",","."), 1, 'C', 0, 0, '', '', true);
$pdf->SetFont($textfont , "B", 9);  
$pdf->MultiCell(62, 5, '$'.number_format($rendir,2,",","."), 1, 'C', 0, 1, '', '', true);
///$pdf->Cell(0,10,"TOTAL CAJA: $$rendir ",1,1,'C');

       }
      
  }else{
      $pdf->SetFont('helvetica', 'B', 16);

// add a page
$pdf->AddPage();

// print a line using Cell()
//$pdf->Cell(0, 12, 'Example 001 - €àèéìòù', 1, 1, 'C');

// ---------------------------------------------------------


$textfont='helvetica';
$pdf->SetFont($textfont , "", 17);
$pdf->Ln(15);
      $pdf->Cell(0,10,"NO hay cierres confirmados para el ".$date_at." al ".$date_fin ,1,1,'C');
  }
      
 ////////////////////////////////////////////////////////////// 

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
$tituloReporte= 'Informe de cierres desde'. $date_at.'_'.$date_fin;
$pdf->Output($tituloReporte.'.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
