<link rel="stylesheet" href="ckeditor/samples/css/samples.css">

<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
            <script type="text/javascript">
              
              
$(document).ready(function(){
   $("#date_at").change(function () {
      // alert ($(this).val()); 
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
 
 $(document).ready(function(){
   $("#osocial_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });   
 
 $(document).ready(function(){
   $("#category_id").change(function () {
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


		<h1>Turnos Atendidos</h1>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="turnos_atendidos">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getProfesionales();
$estudios = EstudioData::getAll();
if(isset($_GET["category_id"]) && $_GET["category_id"]!=""){
                     $estudios = EstudioData::getByCategory($_GET["category_id"]);
                     $medics = MedicData::getProfesionalesByArea($_GET["category_id"]);
                      
                  }
$obra = OsocialData::getAll();
$categorias = CategoryData::getAll();
$tecnicos = TecnicoData::getAll();
 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
     <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" id="date_at" value="<?php 
                  if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
                      echo $_GET["date_at"]; 
                      
                  }else
                      echo date("Y-m-d");
                      
                  
                //  echo date("Y-m-d",strtotime(" - 3 day"));
                      ?>" class="form-control" placeholder="Palabra clave"  >
		</div>
    </div>
      
      
       <div class="col-lg-3">
		<div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria--</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["category_id"]) && $_GET["category_id"]==$p->id){ echo "selected"; } ?>   ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
  <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
<select name="estudio_id"  id="estudio_id"  class="form-control">
<option value="">Atencion</option>
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
    <option value="<?php echo $p->id; ?>"  <?php if(isset($_GET["osocial_id"]) && $_GET["osocial_id"]==$p->id){ echo "selected"; } ?> ><?php echo $p->nombre." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
   </div>
 
   <input type="hidden" name="tecnico_id"   id="tecnico_id"  />
	
    
  
      
    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<h2>Turnos  Atendidos <?php 
                  if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
                      //echo $_GET["date_at"]; 
                     echo  " del ".date("d/m/Y",strtotime($_GET["date_at"].""));
                      
                  }else 
                      echo  " desde el ". date("d/m/Y",strtotime(" - 5 days"))
                      ?></h2>
</form>

		<?php
               // echo "date_at".$_GET["date_at"];
                
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["date_at"]))
        && ( $_GET["estudio_id"]!="" || $_GET["date_at"]!=""|| $_GET["medic_id"]!="" || $_GET["category_id"]!="" || $_GET["osocial_id"]!="") ) {
    
    
$sql = "select * from reservation where ";


if($_GET["date_at"]!="" ||$_GET["date_at"]!="" ){
            $sql .= " date_at = \"".$_GET["date_at"]."\"";
}

if($_GET["estudio_id"]!=""){	
	$sql .= " AND estudio_id = ".$_GET["estudio_id"];
      //  echo ''.$sql;
}



 
if($_GET["osocial_id"]!=""){
            $sql .= " AND osocial_id = \"".$_GET["osocial_id"]."\"";
}


if($_GET["medic_id"]!=""){
	$sql .= " AND medic_id = ".$_GET["medic_id"];
}


if(isset($_GET["tecnico_id"])){
	
        
        if($_GET["tecnico_id"]!=""){
	$sql .= " AND tecnico_id = ".$_GET["tecnico_id"];
}
        
}

if($_GET["category_id"]!=""){
	$sql .= " AND category_id = ".$_GET["category_id"];
}


/// dos 2 atendida 5 informada
$sql .= " AND (status_id =2 OR status_id =5) order by date_at,STR_TO_DATE(time_at,'%H:%i') ";

//echo ''.$sql;
		$users = ReservationData::getBySQL($sql);

}else{
    $sql = "select * from reservation where status_id =2 OR status_id =5  order by date_at,STR_TO_DATE(time_at,'%H:%i')";
		$users = ReservationData::getBySQL($sql);//getByStatusId(2);/// 2 atendiudos //5 informado
    //echo ' no filtraaa '.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
                            <th>Hora</th>
			<th>Paciente</th>
			<th>Profesional</th>
                        <th>Atencion</th>
                         <th>Obra Social</th>
                       
                         <th>Coseguro</th>
			  <th>Observ</th>
                        <th width="8%">Inf</th>
			</thead>
			<?php
                        $numero_orden=0;
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
                                 $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
                                  if (!empty($user->medsoli) )
                                   $medic2 = $user->getMedic2();
                                   $class="";
                                 //  echo " status_id ".$user->status_id;
                                      if (($user->status_id==5)   ) 
                                   $class="adjoined-top";
                                   if (($user->status_id==2)  ) 
                                   $class="btn-success";
                                   $numero_orden++;
                                      // echo " class ".$class;
				?>
				  <tr class="<?php echo $class ?>"  >
                                    <td><?php echo $numero_orden."- ".$user->time_at; ?></td>
				<td><?php
                                if (!empty( $pacient->name) ){
                                      $texto= substr( $pacient->lastname, 0, 10);
                                         $texto1= substr($pacient->name, 0, 5);
                                          echo $texto." ".$texto1.". - ".$pacient->no.". - Telf:".$pacient->phone.". - ".$pacient->email;
                                }
                                
                                //echo $pacient->name." ".$pacient->lastname." - ".$pacient->no; ?></td>
				<td><?php
                                if (!empty($user->medic_id) ){
                                      $texto= substr($medic->lastname, 0, 10);
                                         $texto1= substr($medic->name, 0, 1);
                                          if (!empty($user->tecnico_id) ){
                                            $tecnico  = $user->getTecnico();
                                             $texto3= substr($tecnico->lastname, 0, 10);
                                                $texto4= substr($tecnico->name, 0, 1);
                                        echo  $texto." ".$texto1.". Tecnico:".$texto3." ".$texto4.".";
                                        }else
                                        echo $texto." ".$texto1.".";
                                 }
                                
                                
                                 ?></td>
                                <td><?php echo $estudio->id;//." ".$estudio->descripcion; ?></td>
                                 <td><?php  
                                 $texto= substr($osocial->nombre, 0, 6);
                                 echo $texto." bono:".$user->id;
                                 
                                 ; ?></td>
                               
                                 <td><?php echo "$".$user->price." "  ; ?></td>
                                    <td><?php echo "$".$user->observacion_coseguro." "  ; ?></td>
				
				<td style="width:130px;">
                                    <?php  
                                      //informadaa
                                     if (($user->category_id!=8) &&($user->category_id!=7)   )  {
                                          ?>
                                        <a href="index.php?view=registrar_informe_imagen&id=<?php echo $user->id;?>&category_id=<?php echo $_GET["category_id"];?>&estudio_id=<?php echo $_GET["estudio_id"];?>&medic_id=<?php echo $_GET["medic_id"];?>&osocial_id=<?php echo $_GET["osocial_id"];?>" class="btn btn-warning btn-xs" title="Registrar Informe"><i class="fa fa-medkit"></i></a>
                                      <?php 
                                              
                                     }  else {
                                            ?>  
                                              <a href="index.php?view=registrar_informe&id=<?php echo $user->id;?>&category_id=<?php echo $_GET["category_id"];?>&estudio_id=<?php echo $_GET["estudio_id"];?>&medic_id=<?php echo $_GET["medic_id"];?>&osocial_id=<?php echo $_GET["osocial_id"];?>" class="btn btn-success btn-xs" title="Registrar Informe Imagen"><i class="fa fa-medkit"></i></a>
                                   
                                        <?php 
                                     }
                                          ?>  
                                         <?php  
                                      //informadaa
                                     if (($user->status_id==5)   )  {
                                         //echo '$user->category_id-***'.$user->category_id;
                                          if (($user->category_id==8)   )  {
                                               ?>
                                        <a href="./report/informeLaboratorio-pdf.php?id=<?php echo $user->id;?>" target="_blank"  class="btn btn-primary btn-xs"  title="Imprimir Informe de Atencion"><i class="glyphicon glyphicon-print "></i></a>
	                                      <?php }else {
                                                  $ruta="file://C:\Users\Lenovo\Documents\SEGURIDAD"; 
                                               //  $ruta="  file://win-9og78e9s45q/Informes/"; 
                                                  ////file://win-9og78e9s45q/Informes/Informe-4801
                                                  //  \\WIN-9OG78E9S45Q\Informes
                                                  //$archivo = 'file:///C:/Users/Lenovo/Documents/SEGURIDAD/Informe-187.doc';
                                                //  echo '<iframe src="http://docs.google.com/viewer?url='.$archivo.'&embedded=true" width="600" height="780" style="border: none;"></iframe>';
                                              // echo '  <iframe src="http://docs.google.com/gview?url=http://localhost/sima/report/1.docx&embedded=true" style="width:500px; height:375px;" frameborder="0"></iframe>';
                                                  ?>
                                                   
                                                   <a href="./report/informe-pdf.php?id=<?php echo $user->id;?>" target="_blank"  class="btn btn-primary btn-xs"  title="Imprimir Informe de Atencion"><i class="glyphicon glyphicon-print "></i></a>
                                         
			          <?php  }
                                     } ?>
                                     
                                </td>
                                
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes con turnos</p>";
		}


		?>


	</div>
</div>