<div class="row">
	<div class="col-md-12">
            
             <h2><span class="fa fa-bar-chart"></span> Reportes Obra Social por periodo</h2>

<br>

          
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reporte_caja">
        <?php

        ?>

  <div class="form-group">

  
   
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon">Mes</span>
		 <select name="mes" id="mes" class="form-control" required>

<option value="1"  <?php if("1"==$_GET["mes"]){ echo "selected"; }?>>-Enero</option>
<option value="2" <?php if("2"==$_GET["mes"]){ echo "selected"; }?>>-Febrero</option>
<option value="3" <?php if("3"==$_GET["mes"]){ echo "selected"; }?>>-Marzo</option>
<option value="4" <?php if("4"==$_GET["mes"]){ echo "selected"; }?>>-Abril</option>
<option value="5" <?php if("5"==$_GET["mes"]){ echo "selected"; }?>>-Mayo</option>
<option value="6" <?php if("6"==$_GET["mes"]){ echo "selected"; }?>>-Junio</option>
<option value="7" <?php if("7"==$_GET["mes"]){ echo "selected"; }?>>-Julio</option>
<option value="8" <?php if("8"==$_GET["mes"]){ echo "selected"; }?>>-Agosto</option>
<option value="9" <?php if("9"==$_GET["mes"]){ echo "selected"; }?>>-Septiembre</option>
<option value="10" <?php if("10"==$_GET["mes"]){ echo "selected"; }?>>-Octubre</option>
<option value="11" <?php if("11"==$_GET["mes"]){ echo "selected"; }?>>-Noviembre</option>
<option value="12" <?php if("12"==$_GET["mes"]){ echo "selected"; }?>>-Diciembre</option>





</select></div>
        
         <?php 
      $year=date("Y");
      $month=date("m");
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
      ?> 
        
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon">Periodo</span>
                  <select name="periodo" id="periodo" class="form-control" required>

<option value="<?php echo $year; ?>"   ><?php echo $year." - "; ?></option>
   <option value="<?php echo $year-1; ?>"   ><?php echo $year-1; ?></option>
  
</select>
		
		</div>
    </div>
 <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
<select name="caja" id="caja" class="form-control" required>

<option value="Imagenes">- Caja de Estudios por imagenes</option>
<option value="Laboratorio">- Caja de Estudios Bioquimicos - Laboratorio</option>
<option value="Consultorio">- Caja de consultorios</option>
   
</select>
		</div>
    </div>
  </div>
  <div class="form-group">

   
   
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar</button>
    </div>

  </div>
</form>

		
<?php 
if(isset($_GET["periodo"]) && $_GET["periodo"]!=""){
    $periodo= $_GET["periodo"]; 
  } else  
     $periodo= $year; 
  
  if(isset($_GET["mes"]) && $_GET["mes"]!=""){
    $mes= $_GET["mes"]; 
  } else  
     $mes= $month-1; 
  
  
   if(isset($_GET["caja"]) && $_GET["caja"]!=""){
    $caja= $_GET["caja"]; 
  } else  
     $caja= "Imagenes"; 
  
  //$mes=$mes-1;
 // echo $mes; 
  $texto = " mes ".$meses[$mes]. " - ".$periodo." Caja ".$caja ;
  //$sql = "select * from reservation where YEAR(created_at) ='$periodo' AND MONTH (created_at) = '$mes' AND caja  = '$caja'  ";
$sql = "select * from reservation where YEAR(created_at) ='$periodo' AND MONTH (created_at) = '$mes' AND caja  = '$caja'  order by osocial_id , id ";
//echo '$sql'.$sql;  
$resultado = ReservationData::getBySQL($sql);
if($resultado)
$fila=$resultado[0];
//echo(print_r($fila->estudio_id ));

 ?>
		</div>
			
			<div class="panel-heading">
                            <a href="./report/multiple-xls.php?mes=<?php echo $mes; ?>&periodo=<?php echo $periodo; ?>&caja=<?php echo $caja; ?>" target="_blank" class="btn btn-primary btn-xs pull-left"><i class="fa fa-download"> DESCARGAR LA BUSQUEDA   <?php echo $texto; ?> </i></a>
			</div>
			


	</div>
</div>
    
   