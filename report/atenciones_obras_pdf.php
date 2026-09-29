<?php

include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";

session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

  $j=0;
$periodo=$_GET["periodo"];
 
$mes=$_GET["mes"];
   if(isset($_GET["osocial_id"]) && $_GET["osocial_id"]!=""){
    $enviar=$_GET["osocial_id"];
    $osocial_id= " and t.osocial_id=".$_GET["osocial_id"]; 
  } else  
     $osocial_id= ""; 
  

   $sql = "SELECT m.id, m.nombre, t.category_id,COUNT(t.id) as cantidad, SUM(observacion_coseguro) as observacion_coseguro,SUM(case when observacion_coseguro =0 then price else observacion_coseguro end ) as price , SUM(price) as price2 , SUM(precio_obra) as precio_obra, e.descripcion, c.name as categoria FROM `reservation` t left join estudio e on e.id = t.estudio_id left join osocial m on m.id = t.osocial_id left join category c on c.id = t.category_id where c.id in (3,4,5,6,9,17,21,217,219) and MONTH(t.date_at) = '$mes' and YEAR(t.date_at) = '$periodo' and m.id != 0 and status_id in (2,5) $osocial_id GROUP BY m.nombre, m.id ,e.descripcion order by m.nombre, m.id , c.id, e.id";

$resultado = ReservationData::getBySQL($sql);
 
 $tituloReporte = " Atenciones Informadas de Obra Social por periodo";//
              
           
                
                $tituloCierre= 'Mes:'.$mes;
                
             
 
                $titulousuario = 'Periodo:'.$periodo;
                
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


// add a page
$pdf->AddPage();

// print a line using Cell()
//$pdf->Cell(0, 12, 'Example 001 - €àèéìòù', 1, 1, 'C');

// ---------------------------------------------------------


$textfont='helvetica';
$pdf->SetFont($textfont , "", 15);
$pdf->Ln(15);
$pdf->Cell(0,10,"$tituloReporte - $tituloCierre - $titulousuario ",1,1,'C');
//Restauracin de colores y fuentes

 

//Ttulos de las columnas

$header = array( 'OBRA SOCIAL','CATEGORIA','ESTUDIO', 'CANTIDAD',  'MONTO OBRA SOCIAL', 'COSEGURO');
	
//Colores, ancho de lnea y fuente en negrita
   $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.1); 


$pdf->setX(10);

$pdf->SetFont($textfont , "", 6);
//Cabecera
$w=array(30,35,60,10,27,27);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();

// Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
		
/************ primera categoriaaaa  * 		 */
                  $i = 4;
                $medico= $totalmedico=0; $totalprecio_obra= $totalprecio=0;
                $total=0;$totalCantidad=0;
                
                 $pdf->SetFont($textfont , "", 8);
                                $pdf->SetFillColor(0, 191, 255); // Grey
		 $fill = 0; 
                                  $pdf->setX(10);
                           
                            // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
                            $pdf->SetFont($textfont , "", 6);
foreach ( $resultado as $fila){
                            
                       if ($medico==$fila->id){
                            $totalCantidad=$totalCantidad+$fila->cantidad;
                            $totalprecio_obra=$totalprecio_obra+$fila->precio_obra;
                            $totalprecio=$totalprecio+$fila->price;
                          }else{
                              $pdf->setX(10);
                             if(empty($medico))
                                $p;
                            else{
                                 $pdf->SetFont($textfont , "B", 8);
                                 $pdf->Cell($w[0],5," ",'LR', 0, 'R', $fill); 
                                $pdf->Cell($w[1],5," ",'LR', 0, 'R', $fill); 
                                 $pdf->Cell($w[2],5,'TOTAL', 'LR', 0, 'L', $fill); 
                                 $pdf->Cell($w[3],5,"".$totalCantidad, 'LR', 0, 'C', $fill); 
                          
                            $pdf->Cell($w[4],5,"$".utf8_encode(number_format($totalprecio_obra,2,".",",")), 'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[5],5,"$".utf8_encode(number_format($totalprecio,2,".",",")),'LR', 0, 'R', $fill); 
                            $pdf->Ln();
                            }
                               
                              
                            //  / primer elemnto de la nueva categoria al cambiar
                                $medico=$fila->id;
                                $totalCantidad=$fila->cantidad;
                                $totalprecio_obra=$fila->precio_obra;
                                $totalprecio=$fila->price;
                                
                                $pdf->SetFont($textfont , "", 8);
                                $pdf->SetFillColor(0, 191, 255); // Grey
		 $fill = 0; 
                 if(!empty($medico)){
                      $pdf->setX(10);
                                  
                            $pdf->Cell($w[0],5, " ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,$fila->id." ".substr($fila->nombre, 0, 18), 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[2],5," ", 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[3],5," ",'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[4],5," ",'LR', 0, 'R', $fill); 
                              $pdf->Cell($w[5],5," ",'LR', 0, 'R', $fill); 
                          
                            $pdf->Ln();
                 }
                                 
                            // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont(''); 
                            $pdf->SetFont($textfont , "", 6);
                          }
                             
                             
                             
                             
$pdf->setX(10);


$pdf->Cell($w[0],5,$fila->id." ".substr($fila->nombre, 0, 18), 'LR', 0, 'L', $fill); 
$pdf->Cell($w[1],5, substr($fila->categoria, 0, 30)." ", 'LR', 0, 'L', $fill); 
$pdf->Cell($w[2],5, substr($fila->descripcion, 0, 38), 'LR', 0, 'L', $fill);
                   
                          
$pdf->Cell($w[3],5,$fila->cantidad,'LR', 0, 'C', $fill); 
$pdf->Cell($w[4],5,'$'.utf8_encode(number_format($fila->precio_obra,2,".",",")),'LR', 0, 'R', $fill); 
$pdf->Cell($w[5],5,'$'.utf8_encode(number_format($fila->price,2,".",",")),'LR', 0, 'R', $fill); 

$pdf->Ln();

                                        
//$fill=!$fill; 
}
/**********************ultima categoria ************************************/
  
  $fill = 0; 
$pdf->setX(10);
 $pdf->SetFont($textfont , "B", 8);
                            $pdf->Cell($w[0],5,'', 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[1],5,'TOTAL', 'LR', 0, 'L', $fill); 
                            $pdf->Cell($w[2],5,$fila->id." ".substr($fila->nombre, 0, 18), 'LR', 0, 'L', $fill); 
                          
                            $pdf->Cell($w[3],5," ".$totalCantidad, 'LR', 0, 'C', $fill); 
                            $pdf->Cell($w[4],5,"$". utf8_encode(number_format($totalprecio_obra,2,".",",")),'LR', 0, 'R', $fill); 
                            $pdf->Cell($w[5],5,"$". utf8_encode(number_format($totalprecio,2,".",",")),'LR', 0, 'R', $fill); 
                            
                          
           

$pdf->Ln();
$pdf->Cell(array_sum($w), 0, '', 'T'); 
 
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
