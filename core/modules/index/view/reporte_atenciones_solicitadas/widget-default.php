<script type="text/javascript">
              
              
$(document).ready(function(){
   $("#mes").change(function () {
       //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });



$(document).ready(function(){
   $("#periodo").change(function () {
       //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });

           


              
$(document).ready(function(){
   $("#medic_id").change(function () {
       //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });        

 </script>   
 <?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$medics = MedicData::getAll();
        ?>
<div class="row">
	<div class="col-md-12">          
             <h2><span class="fa fa-bar-chart"></span> Reportes Atenciones Solicitadas por periodo</h2>

<br>

          
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="reporte_atenciones_solicitadas">
       
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
                 <option value="<?php echo $year; ?>"  <?php if($year==$_GET["periodo"]){ echo "selected"; }?> ><?php echo $year." - "; ?></option>
                  <option value="<?php echo $year-1; ?>" <?php if($year-1 ==$_GET["periodo"]){ echo "selected"; }?> ><?php echo $year-1; ?></option> 
                 </select>	
                </div>
    </div>
 
    <div class="col-lg-3">
        <div class="input-group">
        <span class="input-group-addon">Profesionales</span>
<select name="medic_id" id="medic_id"  class="form-control" >
<option value="">-- Profesionales que realizan el Informe-</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php
     if(isset($_GET["medic_id"]) && $_GET["medic_id"]!=""){
         if($p->id ==$_GET["medic_id"]){ echo "selected"; }
     }
   ?>   ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
 <?php endforeach; ?>
</select>
    </div>
   </div>

   
   
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
  
   $enviar= ""; 
   if(isset($_GET["medic_id"]) && $_GET["medic_id"]!=""){
    $medic_id= " and t.medsoli=".$_GET["medic_id"]; 
     $enviar=$_GET["medic_id"]; 
  } else  
     $medic_id= ""; 
  ?>
 
  <table class="table table-bordered table-hover">
			<thead>
                            <th>Profesional</th>
			<th>Categoria</th>
			<th>Estudio</th>
                        <th>Cantidad</th>
                          <th>Monto OS</th>
                         <th>Coseguro</th>
			
                     
			</thead>
  
  
  <?php
                        $j=0;
  $texto = " mes ".$meses[$mes]. " - ".$periodo." medico:".$enviar;
  $sql = "SELECT m.id as medico,m.lastname, m.name, t.category_id,COUNT(t.id) as cantidad, SUM(observacion_coseguro) as observacion_coseguro,SUM(case when observacion_coseguro =0 then price else observacion_coseguro end  ) as price , SUM(price) as price2 , SUM(precio_obra) as precio_obra, e.descripcion, c.name as categoria FROM `reservation` t left join estudio e on e.id = t.estudio_id left join medic m on m.id = t.medsoli left join category c on c.id = t.category_id where c.id in (3,4,5,6,9,17,21,217,219) and MONTH(t.date_at) = '$mes' and YEAR(t.date_at) = '$periodo' and m.id != 0 and status_id in (2,5) $medic_id  GROUP BY m.lastname, m.name,e.descripcion order by m.lastname, m.name, c.id, e.id";
//echo '-'.$sql;  
$resultado = ReservationData::getBySQL($sql);
$medico= $totalmedico=0; $totalprecio_obra= $totalprecio=0;
                $total=0;$totalCantidad=0;
                
                  
foreach ( $resultado as $fila){  
    if ($medico==$fila->medico){
        $totalCantidad=$totalCantidad+$fila->cantidad;
        $totalprecio_obra=$totalprecio_obra+$fila->precio_obra;
        $totalprecio=$totalprecio+$fila->price;
    }  else {  ?>
                        <tr class="<?php echo $class ?>"  >
                            <td><?php echo " " ?></td>
                            <td><?php echo " " ?></td>
                            <td><strong><?php echo "TOTAL " ?> </strong></td>
                                    <td><strong><?php echo $totalCantidad;  ?></strong></td>
                                   <td><strong><?php echo number_format($totalprecio_obra,2,".",","); ?></strong></td>
                                   <td><strong><?php echo number_format($totalprecio,2,".",",");  ?></strong></td>
                                          
                         </tr>
<?php  // primer elemnto de la nueva categoria al cambiar
                $medico=$fila->medico;
                $totalCantidad=$fila->cantidad;
                $totalprecio_obra=$fila->precio_obra;
                $totalprecio=$fila->price;
            }   ?>
                        <tr class="<?php echo $class ?>"  >
                                    <td><?php echo $fila->lastname." ".substr($fila->name, 0, 8); ?></td>
                                    <td><?php echo $fila->categoria; ?></td>
                                    <td><?php echo $fila->descripcion ; ?></td>
                                    <td><?php echo $fila->cantidad ; ?></td>
                                    <td><?php echo  number_format($fila->precio_obra,2,".",","); ?></td>
                                    <td><?php echo  number_format($fila->price,2,".",","); ?></td>
                                   
                         </tr>
<?php } //fin for  ?>
                            <tr class="<?php echo $class ?>"  >
                            <td><?php echo " " ?></td>
                            <td><?php echo " " ?></td>
                           <td><strong><?php echo "TOTAL " ?> </strong></td>
                                    <td><strong><?php echo $totalCantidad;  ?></strong></td>
                                   <td><strong><?php echo number_format($totalprecio_obra,2,".",","); ?></strong></td>
                                   <td><strong><?php echo number_format($totalprecio,2,".",",");  ?></strong></td>
                               </tr>
                         
		</div>
			
			<div class="panel-heading">
                         <a href="./report/atenciones_solicitadas_xls.php?mes=<?php echo $mes; ?>&periodo=<?php echo $periodo; ?><?php if(!empty($enviar)) echo "&medic_id=".$enviar; ?>" target="_blank" class="btn btn-primary btn-xs pull-left"><i class="fa fa-download"> DESCARGAR LA BUSQUEDA   <?php echo $texto; ?> </i></a>
			 <a href="./report/atenciones_solicitadas_pdf.php?mes=<?php echo $mes; ?>&periodo=<?php echo $periodo; ?><?php if(!empty($enviar)) echo "&medic_id=".$enviar; ?>" target="_blank" class="btn btn-danger btn-xs pull-left"><i class="fa fa-file-pdf-o"> DESCARGAR PDF   <?php echo $texto; ?> </i></a>
			</div>
			


	</div>
</div>
    
   