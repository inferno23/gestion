<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/GastosData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
session_start();

$gastos = GastosData::getAllToday();
                $resultado = ReservationData::getAllToday();
/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');


		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de alumnos")
							 ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Reporte ";
		$titulosColumnas = array( 'FECHA','ESTUDIO', 'PACIENTE', 'OBRA SOCIAL', 'PROFESIONAL', 'COSEGURO', '', '');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:I1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
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
                
                
                $total=0;
               // echo(print_r($resultado));
                foreach($resultado as $fila){
                            $medic = $fila->getMedic();
                            $pacient = $fila->getPacient();
                            $estudio = $fila->getEstudio();
                             $osocial = $fila->getOsocial();

                              $fecha_turno= date("d/m/Y ",strtotime($fila->date_at." "));/// un mes
		///while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $fecha_turno." ".$fila->time_at)
        		    ->setCellValue('B'.$i,  $estudio->id." ".$estudio->descripcion)
		            ->setCellValue('c'.$i,  $pacient->name." ".$pacient->lastname)
                            ->setCellValue('D'.$i, $osocial->id." ".$osocial->nombre)
        		    ->setCellValue('E'.$i, $medic->name." ".$medic->lastname)
            		->setCellValue('F'.$i, utf8_encode("$ ".number_format($fila->price,2,".",",")));
					$i++;
                                        $total = $total+$fila->price;
                                        
                                        
		}
                $i++;
                $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " ")
                        
        		    ->setCellValue('B'.$i,  " ");
                $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  "Total ")
                        
        		    ->setCellValue('B'.$i,  " ".$total);
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
                           ->setCellValue('B'.$i,  " Fecha  ")
        		    ->setCellValue('C'.$i,  " Monto ");
                $totalgastos=0;
               // echo(print_r($resultado));
                foreach($gastos as $fila){
                            

		///while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $fila->fecha." ")
        		    ->setCellValue('B'.$i,  $fila->des)
		            ->setCellValue('C'.$i,utf8_encode("$ ".number_format($fila->monto,2,".",",") ))
                            ->setCellValue('D'.$i, $fila->observaciones);
					$i++;
                                        $totalgastos = $totalgastos+$fila->monto;
                                        
                                        
		}
                
                 $i++;
                $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  " ")
                        
        		    ->setCellValue('B'.$i,  " ");
                $i++;
		$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  "Total Gastos ")
                        
        		    ->setCellValue('B'.$i,  " ".$totalgastos);
                
                /****************************************************************************************/
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
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
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
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
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '3a2a47'
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:A".($i-1));// registros
				
		for($i = 'A'; $i <= 'D'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
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
		header('Content-Disposition: attachment;filename="Reporte'.$hoy.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		


?>