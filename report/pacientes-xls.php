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

///  muchas datos p imprimmir
if(isset($_GET["q"]) && $_GET["q"]!=""){
    $resultado =  PacientData::getLike($_GET["q"]);
}else 
    $resultado =  PacientData::getAll(); //PacientData::getLike("F")
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

		$tituloReporte = "Reporte Pacientes ";
		$titulosColumnas = array( 'APELLIDO','NOMBRE', 'DNI', 'OBRA SOCIAL', 'DIRECCION', 'TELEFONO', 'EMAIL', '-');
		
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
                         ->setCellValue('H3',  $titulosColumnas[7])
                  ->setCellValue('I3',  $titulosColumnas[7]);
		//Se agregan los datos de los alumnos
		$i = 4;
                
                
                $total=0;
               // echo(print_r($resultado));
                foreach($resultado as $fila){
                           
                             $osocial = $fila->getOsocial();

                             
		///while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.$i,  $fila->lastname)
        		    ->setCellValue('B'.$i,  $fila->name)
		            ->setCellValue('c'.$i,  $fila->no)
                            ->setCellValue('D'.$i, $osocial->id." ".$osocial->nombre)
        		    ->setCellValue('E'.$i, $fila->address)
                                ->setCellValue('F'.$i,$fila->phone )
            		->setCellValue('G'.$i,$fila->email );
					$i++;
                                       
                                        
                                        
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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:A".($i-1));// registros
				
		for($i = 'A'; $i <= 'I'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
                
		$objPHPExcel->getActiveSheet()->setTitle('REPORTES DE PACIENTES');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                
                $hoy=  date( "Y-m-d-h-i-s");
		//header('Content-Disposition: attachment;filename="okPacientes'.$hoy.'.xls"');
	//	header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		


?>