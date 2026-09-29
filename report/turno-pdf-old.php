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


 $reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             
  $tituloReporte = "Bono-".$reservation->id."";           
             
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
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(3, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('times', 'B', 16);

// add a page
$pdf->AddPage();
$textfont='helvetica';
$leyenda1="      Gral. Belgrano 1778" ;
$leyenda2=" Tel (0388) 4265671" ;
$leyenda3="  San Salvador de Jujuy" ;


  

 
// $section1 = $word->createSection(array('marginLeft'=>15, 'marginRight'=>6, 'marginTop'=>70, 'marginBottom'=>70));

 //$section1->addImage("../image/logo.jpg", array('width'=>110, 'height'=>110, 'align'=>'left'));
  $pdf->Image("../image/logo3.png", '15', '0',25,25);  
  $pdf->setY(26);
  $pdf->Ln();
  $pdf->SetFont($textfont ,'B',9); 
$pdf->Cell(0,0,"  $leyenda1 ",0,0,'L');
$pdf->Ln(3);
$pdf->Cell(0,0,"  $leyenda2 ",0,0,'L');
$pdf->Ln(3);
$pdf->Cell(0,0,"  $leyenda3 ",0,0,'L');
  
 
// ---------------------------------------------------------



$pdf->SetFont($textfont , "", 12);
$pdf->Ln();
$pdf->Cell(0,10,"$tituloReporte ",0,0,'L');
//Restauracin de colores y fuentes
//$interlineado=5;
 $pdf->Ln(5);

$total = 0;


 $texto_estudio=ucwords(strtolower($estudio->descripcion)); // Hello World! $_POST["name"];
$fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes

$largo= strlen($texto_estudio);
         if($largo>23){
              $texto= substr($texto_estudio, 0,25);
            
              $texto2= substr($texto_estudio, 26,60);
            
              $pdf->Cell(0,8,"$texto" ,0,0,'L'); 
          $pdf->Ln(5);
           $pdf->Cell(0,8,"$texto2" ,0,0,'L'); 
         }else    
        $pdf->Cell(0,10," ".$texto_estudio,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,"Paciente: ",0,0,'L');
$pdf->Ln(5);
$textopaciente= ( $pacient->lastname." ".$pacient->name );
$pdf->Cell(0,10," ".$textopaciente,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,"Turno:".$fecha ,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,"Hora:".$reservation->time_at ,0,0,'L');
//$pdf->Ln(4);

/*** modif tecnico 07/07/19  */
 if (!empty($reservation->tecnico_id) ){
     $pdf->Ln(5);
       $tecnico = $reservation->getTecnico();
       // echo $tecnico->id." - ".$tecnico->name." ".$tecnico->lastname;
     $pdf->Cell(0,10,"tecnico:".$tecnico->lastname." ".$tecnico->name  ,0,0,'L');
     
 }         


$pdf->SetFont($textfont , "", 12);
$pdf->Ln(5);
$pdf->Cell(0,10,"Realizado Por" ,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,"  $medic->lastname  $medic->name " ,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,"O.S.: $osocial->nombre" ,0,0,'L');

//$pdf->Ln(5);
/**$pdf->Cell(0,10,"Operador" ,0,0,'L'); 
$pdf->Ln(5);
$leyendaRecepcion="Firma Recepcion";
if (!empty($reservation->user_id)){
     $usuario  = UserData::getById($reservation->user_id);
    $leyendaRecepcion="    ".$usuario->lastname." ".$usuario->name;
}

 $pdf->Cell(0,10,"  $leyendaRecepcion" ,0,0,'L'); 
 * 
 */
 //$pdf->Ln(3);
 //$pdf->Cell(0,10,"  Firma Tecnico" ,0,0,'L'); 
//$pdf->Ln(3);
 
 //$pdf->Cell(0,10,"  Firma Profesional" ,0,0,'L'); 

if (!empty($reservation->price) ){
    $pdf->Ln(5); 
    $pdf->SetFont($textfont , "", 8);
    $pdf->Cell(0,10,"Coseguro: $".$reservation->price ,0,0,'L'); 
}
if (!empty($reservation->precio_obra) ){
  $pdf->Ln(5); 
  $pdf->SetFont($textfont , "", 8);
  $pdf->Cell(0,10,"Obra: $".$reservation->precio_obra ,0,0,'L'); 
} 
    
    
    
if (!empty($estudio->lugar) ){
    $pdf->Ln(5);
    $pdf->SetFont($textfont , "", 8);
     $pdf->Cell(0,10,"".$estudio->lugar ,0,0,'L'); 
}
   
    
    
$pdf->Ln(5);
if (!empty($estudio->preparativos) ){
    $pdf->SetFont($textfont , "", 8);
    $pdf->Cell(0,10,"Preparacion" ,0,0,'L'); 

$pdf->Ln(3);
}

 $leyendaPreparativos=" ";
 //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
 $pdf->SetFont($textfont , "", 8);
 if (!empty($estudio->preparativos)){
     $leyendaPreparativos="".$estudio->preparativos."";
     $preparativos = explode(".", $leyendaPreparativos);
     $resultado = count($preparativos); 
     $pdf->Ln(3);
     foreach ($preparativos as $prepa) {
          // si el preparativo mas de 20 pasar a la otra linea
         $largo= strlen($prepa);
         if($largo>20){
              $texto= substr($prepa, 0,30);
              $texto2= substr($prepa, 30,60);
              $pdf->Cell(0,8,"*$texto" ,0,0,'L'); 
          // $pdf->Ln(5);
           $pdf->Cell(0,8,"$texto2" ,0,0,'L'); 
         }else
                  
          $pdf->Cell(0,10," *$prepa" ,0,0,'L'); 
           $pdf->Ln(5);
     }
        
}
//$pdf->Ln(1);
$fecha=date("d".'-'."m".'-'."Y".' '."h:i");
$pdf->SetFont($textfont , "", 6);
$leyendaRecepcion="Creado";
 $leyendaImprimir="Imp";
$usuario=null;
$fecha_generado= date("d/m/Y h:i",strtotime($reservation->created_at." "));/// un mes
if (!empty($reservation->user_id)){
     $usuario  = UserData::getById($reservation->user_id);
    $leyendaRecepcion="Generado: ".$usuario->lastname." ".$usuario->name." ".$fecha_generado;
      }
      
if(Session::getUID()!=""){
  $usuario = UserData::getById(Session::getUID());
  $leyendaImprimir="Emitido:".$usuario->lastname." ".$usuario->name;
  

  }
  
   $pdf->Cell(0,10,"$leyendaRecepcion" ,0,0,'L');
   $pdf->Ln(3);
   $pdf->Cell(0,10,"$leyendaImprimir - $fecha" ,0,0,'L');
  




//$pdf->Ln();

			
	$pdf->Ln(3);
    $pdf->SetFont($textfont ,'',5);
	
    		
$style = array(
	'position' => 'S',
	'border' => false,
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
$pdf->write1DBarcode($reservation->id, 'C39', '', '', 45, 20, 0.4, $style, 'N');


$pdf->Ln();

$js = <<<EOD


EOD;
        // force print dialog
$js .= 'print(true);';
$pdf->IncludeJS("print();"); 
$pdf->Output($tituloReporte.'.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
