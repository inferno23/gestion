<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/MedicData.php";
session_start();
              $j=0;
$periodo=$_GET["periodo"];
 
$mes=$_GET["mes"];
   if(isset($_GET["medic_id"]) && $_GET["medic_id"]!=""){
    $enviar=$_GET["medic_id"];
    $medic_id= " and t.tecnico_id=".$_GET["medic_id"]; 
  } else  
     $medic_id= ""; 
  
  $sql = "SELECT m.id as tecnico, m.lastname, m.name, t.category_id,COUNT(t.id) as cantidad, SUM(observacion_coseguro) as observacion_coseguro,SUM(case when observacion_coseguro =0 then price else observacion_coseguro end  ) as price , SUM(price) as price2 , SUM(precio_obra) as precio_obra, e.descripcion, c.name as categoria FROM `reservation` t left join estudio e on e.id = t.estudio_id left join tecnicos m on m.id = t.tecnico_id left join category c on c.id = t.category_id where c.id in (3,4,5,6,9,17,21,217,219) and MONTH(t.date_at) = '$mes' and YEAR(t.date_at) = '$periodo' and t.medic_id IS NOT NULL and status_id in (2,5) $medic_id GROUP BY m.lastname, m.name,e.descripcion order by m.lastname, m.name, c.id, e.id";

  
$resultado = ReservationData::getBySQL($sql);

                
/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';



		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();
$tituloReporte = " Reportes Atenciones de Tecnicos por periodo";//$caja Cierre ".$cierre;
		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Marcko") //Autor
							 ->setLastModifiedBy("Marcko") //Ultimo usuario que lo modificó
							 ->setTitle($tituloReporte)
							 ->setSubject($tituloReporte)
							 ->setDescription("")
							 ->setKeywords($tituloReporte)
							 ->setCategory($tituloReporte);

		
              
           //   debug($model) ;
              
               // print_r($model);
           
                //$tituloCierre = "Cierre: ".$fecha_turno;
                $tituloCierre = $tituloReporte;
		$titulosColumnas = array( 'PROFESIONAL','CATEGORIA','ESTUDIO', 'CANTIDAD',  'MONTO OBRA SOCIAL', 'COSEGURO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:F1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
                        ->setCellValue('B1','')
                        ->setCellValue('C1'," ")
                         ->setCellValue('D1'," ")
                        ->setCellValue('A2',$tituloCierre)
                        ->setCellValue('B2',"Mes:$mes ")
                         ->setCellValue('C2','Periodo:'.$periodo)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
                ->setCellValue('E3',  $titulosColumnas[4])
		 ->setCellValue('F3',  $titulosColumnas[5])    ;
		//Se agregan los datos de los alumnos
		$i = 4;
                $medico= $totalmedico=0; $totalprecio_obra= $totalprecio=0;
                $total=0;$totalCantidad=0;
                
                
                              
               // echo(print_r($resultado));
                foreach($resultado as $fila){
                     //print_r(($fila));
                           
                         if ($medico==$fila->tecnico){
                            $totalCantidad=$totalCantidad+$fila->cantidad;
                            $totalprecio_obra=$totalprecio_obra+$fila->precio_obra;
                            $totalprecio=$totalprecio+$fila->price;
                          }else{
                             
                            $i++;
                           if($totalCantidad>0){
                              $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,   "Total ".$totalCantidad)
                        
        		           ->setCellValue('B'.$i,  utf8_encode(number_format($totalprecio_obra,2,".",",")) )
                                ->setCellValue('C'.$i,  utf8_encode(number_format($totalprecio,2,".",",")) );
                            $i++;
                            
                           
                                 $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i,  "Total ")
                        
        		           ->setCellValue('B'.$i,  " ".$totalCantidad);
                            }
                           
                            
                          //  / primer elemnto de la nueva categoria al cambiar
                $medico=$fila->tecnico;
                $totalCantidad=$fila->cantidad;
                $totalprecio_obra=$fila->precio_obra;
                $totalprecio=$fila->price;
                                
                                 $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i, "  " )
                        
        		    ->setCellValue('B'.$i,  "  ");
                                  $i++;
                                 $objPHPExcel->setActiveSheetIndex(0)
                                            ->setCellValue('A'.$i,$fila->lastname." ".$fila->name )
                        
        		    ->setCellValue('B'.$i,  "  ". $fila->lastname." ".substr($fila->name, 0, 8));
                                
                                
                                  $i++;
                                 $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $fila->lastname." ".substr($fila->name, 0, 8) )
                        
        		           ->setCellValue('B'.$i,   $i." ");
                          }
                                   
                               
                                  
			$objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i,  $fila->lastname." ".substr($fila->name, 0, 8))
        		    ->setCellValue('B'.$i,  $fila->categoria)
		            ->setCellValue('C'.$i, $fila->descripcion)
                            ->setCellValue('D'.$i, $fila->cantidad)
        		  
                            ->setCellValue('E'.$i, utf8_encode(number_format($fila->precio_obra,2,".",",")) )
                            ->setCellValue('F'.$i, utf8_encode(number_format($fila->price,2,".",",")) );
            		    //->setCellValue('I'.$i,$totalcategoria." ---" .$fila->category_id ." ---" .$fila->id);
					$i++;
                                        
                                 
                                    
		}//FIN FOR
               $i++;
                              $objPHPExcel->setActiveSheetIndex(0)
                              
                               ->setCellValue('A'.$i,   "Total: ".$totalCantidad)
                        
        		           ->setCellValue('B'.$i,  utf8_encode(number_format($totalprecio_obra,2,".",",")) )
                                ->setCellValue('C'.$i,  utf8_encode(number_format($totalprecio,2,".",",")) );
                              
                              
                              
                          
                /*****************************   gastos *****************************************/
               
                
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
		header('Content-Disposition: attachment;filename="AtencionTecnicos-'.$mes.'-'.$periodo.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		


?>