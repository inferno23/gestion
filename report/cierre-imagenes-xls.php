<?php

//SELECT cierre, COUNT(*) FROM reservation GROUP BY cierre

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


$cierre=$_GET["id"];
$caja=$_GET["caja"];
$gastos = GastosData::getByCierre($cierre);
 $model= CierreData::getById($cierre);
                $resultado = ReservationData::getAllByCierreCaja($cierre, $caja);
                
/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');


		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Marcko") //Autor
							 ->setLastModifiedBy("Marcko") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de CIERRE CAJA ")
							 ->setKeywords("reporte cierre")
							 ->setCategory("Reporte excel");

		$tituloReporte = " CAJA";//$caja Cierre ".$cierre;
                $usuario = UserData::getById($model->user_id);
             // echo ($model);
           //   debug($model) ;
              
               // print_r($model);
                 $fecha_turno= date("d/m/Y ",strtotime($model->created_at." "));/// un mes
                //$tituloCierre = "Cierre: ".$fecha_turno;
                $tituloCierre = "Cierre CAJA ";
		$titulosColumnas = array( 'FECHA','ESTUDIO', 'PACIENTE', 'OBRA SOCIAL', 'PROFESIONAL', 'COSEGURO', 'OBSERVACION', '');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:G1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
                        ->setCellValue('B1',$caja)
                        ->setCellValue('C1'," Cierre")
                         ->setCellValue('D1',$cierre)
                        ->setCellValue('A2',$tituloCierre)
                        ->setCellValue('B2',"$caja: ".$fecha_turno)
                         ->setCellValue('C2','Generado:'.$usuario->lastname)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
                ->setCellValue('E3',  $titulosColumnas[4])
		 ->setCellValue('F3',  $titulosColumnas[5])
                 ->setCellValue('G3',  $titulosColumnas[6])
                  ->setCellValue('H3',  $titulosColumnas[7]);
		//Se agregan los datos de los alumnos
		$i = 4;
                 $categoria=1;
                $totalcategoria=0;  $totalobservacion=0;
                $total=0;$totalCierre=0;
                 $Category = CategoryData::getById($categoria);
                
                //print_r($Category);
                              $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $Category->name )
                        
        		           ->setCellValue('B'.$i,  " 666");
               // echo(print_r($resultado));
                foreach($resultado as $fila){
                            $medic = $fila->getMedic();
                            $pacient = $fila->getPacient();
                            $estudio = $fila->getEstudio();
                             $osocial = $fila->getOsocial();

                             
                              
                               //// sumo subtotal por  categoria=0; 
                        if ($categoria==$fila->category_id){
                             $totalcategoria=$totalcategoria+$fila->price;
                          }else{
                             
                            $i++;
                          
                              $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $Category->name)
                        
        		           ->setCellValue('B'.$i,  "Total ".$totalcategoria);
                            $i++;
                            $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i,  "Total ")
                        
        		    ->setCellValue('B'.$i,  " ".$totalcategoria);
                            
                            $totalcategoria=$fila->price;// primer elemnto de la nueva categoria
                              $categoria=$fila->category_id;
                                $Category = CategoryData::getById($categoria);
                                
                                 $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i, "  " )
                        
        		    ->setCellValue('B'.$i,  "  ");
                                  $i++;
                                 $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i, $categoria. "  ".$Category->name )
                        
        		    ->setCellValue('B'.$i,  "  ". $Category->name);
                                
                                
                                  $i++;
                                 $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $Category->name )
                        
        		           ->setCellValue('B'.$i,   $i." ---666-*--".$categoria);
                          }
                                   $fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
		///while ($fila = $resultado->fetch_array()) {
                                   $texto= substr($osocial->nombre, 0, 10);
                                    $textomedico= substr($medic->lastname, 0, 10);
                                         $textomedico1= substr($medic->name, 0, 1);
                                
                                    if (!empty( $pacient->name) ){
                                      $textopaciente= substr( $pacient->lastname, 0, 10);
                                         $textopaciente1= substr($pacient->name, 0, 8);
                                         // echo $texto." ".$texto1.". - ".$pacient->no;
                                }
                                   
                                   $textoestuydio= substr($estudio->descripcion, 0, 40);
			$objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i,  $fecha_turno." ".$fila->time_at)
        		    ->setCellValue('B'.$i,  $estudio->id." ".$textoestuydio)
		            ->setCellValue('C'.$i,  $textopaciente." ".$textopaciente1)
                            ->setCellValue('D'.$i, $osocial->id." ".$texto."  B:".$fila->id)
        		    ->setCellValue('E'.$i, $textomedico." ".$textomedico1)
                            ->setCellValue('F'.$i, utf8_encode(number_format($fila->price,2,".",",")) )
                            ->setCellValue('G'.$i, utf8_encode(number_format($fila->observacion_coseguro,2,".",",")) );
            		    //->setCellValue('I'.$i,$totalcategoria." ---" .$fila->category_id ." ---" .$fila->id);
					$i++;
                                        $total = $total+$fila->price;
                                        $totalobservacion=$totalobservacion+$fila->observacion_coseguro;
                                        if(!empty($fila->observacion_coseguro)&&($fila->observacion_coseguro >0))
                                             $totalCierre=$totalCierre+ $fila->observacion_coseguro;
                                        else 
                                           $totalCierre=$totalCierre+ $fila->price;
                                        
                                        
                                 
                                        
		}
               $i++;
                              $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $Category->name)
                        
        		           ->setCellValue('B'.$i,  "Total ".$totalcategoria);
                            $i++;
                            $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i,  "Total ")
                        
        		    ->setCellValue('B'.$i,  " ".$totalcategoria);
                /*****************************   gastos *****************************************/
                $i++;
                $i++;
               $i++;
                $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " Gastos")
                        
        		    ->setCellValue('B'.$i,  " ");
                $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " ")
                        
        		    ->setCellValue('B'.$i,  " ");
              
                 $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " Fecha  ")
                           ->setCellValue('B'.$i,  " Descripcion  ")
        		    ->setCellValue('C'.$i,  " Monto ");
                $totalgastos=0;
               // echo(print_r($resultado));
                foreach($gastos as $fila){
                            
              //$pos = strrchr ($fila->des, "-");

		  $textogasto= substr($fila->des, 0, 36);
                  $textogasto2= substr($fila->des, 36, 55);
			$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $fila->fecha." ")
        		    ->setCellValue('B'.$i,  $textogasto)
                                 ->setCellValue('C'.$i,  $textogasto2)
		            ->setCellValue('D'.$i,utf8_encode("$ ".number_format($fila->monto,2,".",",") ))
                            ->setCellValue('F'.$i, $fila->observaciones);
					$i++;
                                        $totalgastos = $totalgastos+$fila->monto;
                                        
                                        
		}
                 $i++;
                $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " ")
                        
        		    ->setCellValue('B'.$i,  " ");
                $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  "Total ")
                         ->setCellValue('B'.$i,  "Total Observacion ")
                         ->setCellValue('C'.$i,  "Total Gastos ");
        		  //  ->setCellValue('B'.$i,  " ".$total);
                
                
                $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  "".$total)
                        
        		    ->setCellValue('B'.$i,  " ".$totalCierre)                
                        
        		    ->setCellValue('C'.$i,  " ".$totalgastos);
                 $i++;
                 $rendir=$totalCierre-$totalgastos;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  "Total Caja ")
                          //->setCellValue('B'.$i,  " ".$totalCierre)
        		    ->setCellValue('B'.$i,  "".$rendir);
                
                /****************************************************************************************/
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>10,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,  
                'size' =>6,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'FFFFFF'   ///c47cf2  rosado
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial', 
                            'size' =>6,
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFFFFF')   //FFd9b7f4
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => 'FFFFFF'   ///FF431a5d   3a2a47
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:A".($i-1));// registros con color en columna A1
		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B4:B".($i-1));// registros con color en columna A1
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "C4:C".($i-1));// registros con color en columna A1
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "D4:D".($i-1));// registros con color en columna A1
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "E4:E".($i-1));// registros con color en columna A1
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "F4:F".($i-1));// registros con color en columna A1
			$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "G4:G".($i-1));// registros con color en columna A1
			
		for($i = 'A'; $i <= 'G'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(true);
		}
		
		// Se asigna el nombre a la hoja
                
		$objPHPExcel->getActiveSheet()->setTitle('REPORTES');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                
                $hoy=  date( "Y-m-d-h-i-s");
		header('Content-Disposition: attachment;filename="Cierre-'.$caja.'-'.$cierre.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		


?>