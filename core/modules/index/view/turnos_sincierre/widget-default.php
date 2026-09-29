<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
            <script type="text/javascript">
              
     

$(document).ready(function(){
   $("#osocial_id").change(function () {
       //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });
         
$(document).ready(function(){
   $("#date_at").change(function () {
       //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });

              
$(document).ready(function(){
   $("#estudio_id").change(function () {
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
              //////////////////////////////
$(document).ready(function(){
   $("#category_id").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#category_id option:selected").each(function () {
             elegido= $("#category_id").val()  ;
            // alert (elegido);
            elegido=$(this).val();
            $.post("./core/modules/index/action/buscarestudio/action-default.php", { elegido: elegido }, function(data){
            $("#estudio_id").html(data);
            //alert (data);
            })
            
        
                   
            .fail( function(xhr, textStatus, errorThrown) {
                alert(xhr.status);
                alert(xhr.readyState);
                  alert(xhr.status);
                  alert(errorThrown);
                   alert(textStatus);
                alert(xhr.responseText);
            });            
        });
   })
});

     </script>         



<div class="row"><br>
	<div class="col-md-12">

<div class="btn-group pull-right">
	<a href="index.php?view=cierrecaja" class="btn btn-success"  title="Registrar  Nuevo Cierrre de Caja"     onclick="return confirm(' \n \n Estás seguro que desea realizar el cierre de caja? \n Al confirmar no se permitira modificar ningun cambio en los registros contables  \n');" ><i class='fa fa-money'></i> + Registrar  Nuevo Cierrre de Caja</a>
                           
</div>
</div>			  
</div>

<div class="row">
	<div class="col-md-12">
   

		<h1>Registros que conformaran el Proximo Nuevo Cierre de caja</h1>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="turnos_sincierre">
<input type="hidden" name="cierre" id="cierre" value="">

        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getProfesionales();
$estudios = EstudioData::getAll();
$obra = OsocialData::getAll();
$categorias = CategoryData::getAll();
 $gastos =GastosData::getAllsinCierre();
 //print_r($gastos);
 //echo "date_at".$_GET["date_at"];
        ?>




       

  <div class="form-group">
    
      
       <div class="col-lg-3">
		<div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria de estudio-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
  <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
<select name="estudio_id"  id="estudio_id"  class="form-control">
<option value="">Estudio</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["estudio_id"]) && $_GET["estudio_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->descripcion." - ".$p->id." "; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
<select name="medic_id" id="medic_id"  class="form-control">
<option value="">Profesional</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->lastname." ".$p->name." ". $p->id; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
         
      
      <div class="col-lg-3"> 
      <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="osocial_id" id="osocial_id"  class="form-control" >
<option value="">-- Obra Social-</option>
  <?php foreach($obra as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->nombre." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
   </div>

    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<h2>Registros del Cierre <?php echo $_GET["cierre"];  ?></h2>
</form>

		<?php
               // echo "date_at".$_GET["date_at"];
                
$users= array();
//if(    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]) && isset($_GET["osocial_id"])) {
if( ( $_GET["category_id"]!="" || $_GET["estudio_id"]!="" || $_GET["medic_id"]!="" || $_GET["osocial_id"]!="") ) {
    
    
$sql = "select * from reservation where id >0  ";

if($_GET["medic_id"]!=""){

	$sql .= " AND medic_id = ".$_GET["medic_id"];
}
if($_GET["category_id"]!=""){
	$sql .= " AND category_id = ".$_GET["category_id"];
      //  echo ''.$sql;
}


if($_GET["estudio_id"]!=""){


	$sql .= " AND estudio_id = ".$_GET["estudio_id"];
      //  echo ''.$sql;
}


if($_GET["osocial_id"]!=""){
    

            $sql .= " AND osocial_id = \"".$_GET["osocial_id"]."\"";
}


$sql .= " AND payment_id =2 ";// modif 15/06/19

$sql .= " AND status_id !=4 ";
 $cierre=$_GET["cierre"];

$sql .= " AND cierre IS NULL ";
//echo ''.$sql;
		$users = ReservationData::getBySQL($sql);

}else{
    
    $cierre="";
		$users = ReservationData::getAllsinCierre();
//echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
                            <th>Hora</th>
			<th>Paciente</th>
			<th>Profesional</th>
                        <th>Estudio</th>
                         <th>Obra Social</th>
                         <th>Solicita</th>
                         <th>Coseguro</th>
			  <th>Observ</th>
                   
			</thead>
			<?php
                        $j=1;
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
                                 $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
                                   $medic2 = $user->getMedic2();
				?>
				<tr>
                                    <td><?php echo $j++."- ".$user->time_at; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname." - ".$pacient->no; ?></td>
				<td><?php
                                 if (!empty($user->medic_id) ){
                                      $texto= substr($medic->lastname, 0, 10);
                                         $texto1= substr($medic->name, 0, 1);
                                 echo $texto." ".$texto1.".";
                                 }
                                 
                                      //echo $medic->lastname." ".$medic->name; ?></td>
                                
                                
                                
                                <td><?php echo $estudio->id;//." ".$estudio->descripcion; ?></td>
                                  <td><?php 
                                 $texto= substr($osocial->nombre, 0, 6);
                                 echo $texto." B:".$user->id; ?></td>
                              <td><?php  
 if (empty($user->medsoli) ) {
   echo $user->medsoli." NO REGISTRA";
}else
                               echo  $medic2->lastname; ?></td>
                                 <td style = "text-align: right;"><?php echo "$".$user->price.",00 "  ; ?></td>
                                 <td style = "text-align: right;"><?php echo "$".$user->observacion_coseguro.",00 "  ; ?></td>
				
                                
				</tr>
				<?php
                                /***
                                 *   <a  href="./?action=sacarcierre&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs" title="Sacar registro del cierre actual" onclick="return confirm(' \n \n  <h1><b>Estás seguro que deseas sacar del cierre de caja ? \n Al confirmar este registro no estara asociado a un cierre y se sumara al proximo cierre a generar </h1></b> \n');"   ><i class="fa fa-trash"></i></a>
                            	
                                 */

			}



		}else{
			echo "<p class='alert alert-danger'>No hay  turnos con cierre </p>";
		}


		if(count($gastos)>0){
			// si hay $gastos
                   // echo "<p class='alert alert-danger'>Gastos del Proximo Cierre </p>";
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Fecha</th>
                        <th><p class='alert alert-danger'>Gastos del Proximo Cierre </p></th>
                        <th>Monto</th>
			
			</thead>
			<?php
			foreach($gastos as $gasto){
                            
                            
				?>
				<tr>
				
                                    <td><?php 
                                    
                                   // echo " ".$user->fecha;
                                  echo  date("d/m/Y",strtotime("$gasto->fecha"));
                                    ?></td>
                                <td><?php echo " ".$gasto->des; ?></td>
                                <td><?php echo " $ ".$gasto->monto; ?></td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Gastos</p>";
		}


		?>

	</div>
</div>