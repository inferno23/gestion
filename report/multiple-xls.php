<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/ValestData.php";
include "../core/modules/index/model/StatusData.php";  
include "../core/modules/index/model/PaymentData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
include "../core/modules/index/model/UserData.php";
session_start();

$mes=$_GET["mes"];
$caja=$_GET["caja"];

$periodo=$_GET["periodo"];

 $sql = "select * from reservation where status_id !=4 AND YEAR(date_at) ='$periodo' AND MONTH (date_at) = '$mes' AND caja  = '$caja'  order by osocial_id, id ";

//echo $sql;
//$usuario = UserData::getById($model->user_id);
$resultado = ReservationData::getBySQL($sql);
/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';
                require_once '../lib/PHPExcel/PHPExcel/IOFactory.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');

 $meses = array( 
'1' => 'Enero', 
'2' => 'Febrero', 
'3' => 'Marzo', 
'4' => 'Abril', 
'5' => 'Mayo', 
'6' => 'Junio', 
'7' => 'Julio', 
'8' => 'Agosto', 
'9' => 'Septiembre', 
'10' => 'Octubre', 
'11' => 'Noviembre', 
'12' => 'Diciembre', 
);
	


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Marcko farfan") //Autor
							 ->setLastModifiedBy("Marcko farfan") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel cel 3888568587")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de CIERRE CAJA ")
							 ->setKeywords("reporte cierre")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Servicio de Diagnostico por  $caja ";
                 $tituloCierre = "Periodo ".$meses[$mes].' '.$periodo;
                 $titulosColumnas = array( 'FECHA','NRO AFILIADO', 'PACIENTE', 'CODIGO', 'IMPORTE', '');
		
// Create a first sheet, representing sales data
//$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'primera hoja');
                 $pestana=0;
$objPHPExcel->setActiveSheetIndex($pestana)
        		    ->mergeCells('A1:I1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex($pestana)
					->setCellValue('A1',$tituloReporte)
                        ->setCellValue('A2',$tituloCierre)
                       //  ->setCellValue('C2','Generado:')


->setCellValue('A4',  $titulosColumnas[0])
		            ->setCellValue('B4',  $titulosColumnas[1])
        		    ->setCellValue('C4',  $titulosColumnas[2])
            		->setCellValue('D4',  $titulosColumnas[3])
                ->setCellValue('E4',  $titulosColumnas[4])
		 ->setCellValue('F4',  $titulosColumnas[5]) ;
// echo(print_r($resultado));
                $i = 5;
                
                
                
                $fila=$resultado[0];
              
                 $misma_obra=$fila->estudio_id;
                $totalcategoria=0;  $totalobservacion=0;
                $total=0;$totalCierre=0;
                foreach($resultado as $fila){
                            
                            $pacient = $fila->getPacient();
                            $estudio = $fila->getEstudio();
                             $osocial = $fila->getOsocial();

                             $valest = ValestData::getRepeated($fila->estudio_id, $fila->osocial_id);
                            //  $valest = ValestData::getRepeated(109, 2);
                              $textocodigo= '';
                                    if (empty($valest)) {
                                      $textocodigo= '';
                                  }else
                                    $textocodigo = $valest->codigo;
                                  
                        if ($misma_obra==$fila->osocial_id){
                              $total = $total+$fila->precio_obra;
                          }else{
                              // Create a new worksheet, after the default sheet
                              $i++;
                             $i++;
		$objPHPExcel->setActiveSheetIndex($pestana)
                                ->setCellValue('A'.$i,  "")
                        	->setCellValue('B'.$i,  " ")                
                                     ->setCellValue('C'.$i,  " ") 
                                ->setCellValue('D'.$i,  " TOTAL")  
        		       ->setCellValue('E'.$i,   utf8_encode(number_format($total,2,",",".") ));
                              
                               $total=$fila->precio_obra;
                            $objPHPExcel->createSheet();
                              $pestana++;
                              $objPHPExcel->setActiveSheetIndex($pestana)
        		    ->mergeCells('A1:I1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex($pestana)
					->setCellValue('A1',$tituloReporte)
                        ->setCellValue('A2',$tituloCierre)
                        // ->setCellValue('C2','Generado:')


                           ->setCellValue('A4',  $titulosColumnas[0])
		            ->setCellValue('B4',  $titulosColumnas[1])
        		    ->setCellValue('C4',  $titulosColumnas[2])
            		->setCellValue('D4',  $titulosColumnas[3])
                ->setCellValue('E4',  $titulosColumnas[4])
		 ->setCellValue('F4',  $titulosColumnas[5]) ;
                               $i = 5;
                              $misma_obra=$fila->osocial_id;
                            // Add some data to the second sheet, resembling some different data types
                            $objPHPExcel->setActiveSheetIndex($pestana);
                            
                            $objPHPExcel->getActiveSheet()->setTitle(''.$osocial->nombre); 
                             $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Obra:'.$osocial->nombre);
                          }
                                  
                                  
                        
                $fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
		  $titulo=mb_convert_encoding($pacient->lastname,'UTF-8','ISO-8859-1');
			$objPHPExcel->setActiveSheetIndex($pestana)
                            ->setCellValue('A'.$i,  $fecha_turno." ")
        		    ->setCellValue('B'.$i,  $pacient->numero_afiliado." ".$pacient->numero_afiliado2)
		            ->setCellValue('C'.$i,  $titulo." ".$pacient->name)
                            ->setCellValue('D'.$i,  " ".$textocodigo)
                           
                            ->setCellValue('E'.$i, utf8_encode(number_format($fila->precio_obra,2,",",".")) )
                          //  ->setCellValue('F'.$i, utf8_encode(number_format($fila->observacion_coseguro,2,".",",")) )
            		    ;
					$i++;
                                     //   $total = $total+$fila->price;
                                       
                                        
                                        
                                 
                                        
		}
               
                /**$i++;
               
                 * 
                 */
/*****************************************************************/
  /*
   * 
   * 
   * 
   * 
   * borro pestana con nombre Worksheet
   */
       $objPHPExcel->setActiveSheetIndexByName('Worksheet');
$sheetIndex = $objPHPExcel->getActiveSheetIndex();
$objPHPExcel->removeSheetByIndex($sheetIndex);        
// Create a new worksheet, after the default sheet
//$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
//$objPHPExcel->setActiveSheetIndex(1);
//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'aquiiii ');

// Rename 2nd sheet
//$objPHPExcel->getActiveSheet()->setTitle('Second sheet');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Content-Disposition: attachment;filename="Reporte-'.$caja.'-'.$meses[$mes].'-'.$periodo.'.xls"');
		
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
		
		exit;
		


?>