<?php 


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);


//print_r($reservation);
$estudios = EstudioData::getAllOrder();
$pacients = PacientData::getAll();
$categorias = CategoryData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
   $medic = $reservation->getMedic();
            $paciente = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
            // $tecnicos = $reservation->getTecnico();
$obras = OsocialData::getAll();
 //cambio medic categoria 20 por la tabla tecnos 07/07;
$tecnicos = TecnicoData::getAll();
$secretarias = UserData::getSecretarias();
$profesionales = UserData::getProfesionales();

$precio =$precio2 =  $precio3 =  $precio4 = $precio5 = 0;
$valor=ValestData::getRepeated( $reservation->estudio_id,$reservation->osocial_id);

   
if(empty($valor))
$precio = 0;
else
$precio = $valor->coseguro;




 
if (!empty($reservation->estudio2)){
  $valor2=ValestData::getRepeated( $reservation->estudio2,$reservation->osocial_id);
  if(!empty($valor2)){
    $precio2 = $valor2->coseguro;
   }
  // print_r($valor2);

 }
 if (!empty($reservation->estudio3)){
  $valor3=ValestData::getRepeated( $reservation->estudio3,$reservation->osocial_id);
  if(!empty($valor3)){
    $precio3 = $valor3->coseguro;
   }
  // print_r($valor3);
 }
 if (!empty($reservation->estudio4)){
  $valor4=ValestData::getRepeated( $reservation->estudio4,$reservation->osocial_id);
  if(!empty($valor4)){
    $precio4 = $valor4->coseguro;
   }
 }
 if (!empty($reservation->estudio5)){
  $valor5=ValestData::getRepeated( $reservation->estudio5,$reservation->osocial_id);
  if(!empty($valor5)){
    $precio5 = $valor5->coseguro;
   }
 }
 //echo("precio".$precio."  title2   ".$precio2."title3".$precio3."  title4   ".$precio4." title5".$precio5);

 $total= $precio +$precio2 +$precio3 +$precio4+$precio5  ;
 $precio = '$'.$precio.'-';
 $precio2 = '$'.$precio2.'-';
 $precio3 = '$'.$precio3.'-';
 $precio4 = '$'.$precio4.'-';
 $precio5 = '$'.$precio5.'-';
?>

<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
           
<div class="row">
	<div class="col-md-10">
	
          <h2><span class="fa fa-calendar"></span>Crear alarma</h2>

          <?php   

$volver= "agenda"; 
if(isset($_GET["volver"]) && $_GET["volver"]!=""){
 
  $volver= $_GET["volver"]; 
  //echo "volver a ".$volver; 

}
?> 
  <hr>
<form class="form-horizontal" role="form" method="post"    action="./?action=addalarma">
   <div class="form-group">
   
    <div class="col-lg-5">
        
          <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>"  >
        <input type="text" name="title" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
       <input type="text" name="note" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
   <input type="hidden" name="caja"   id="caja" placeholder="caja"  value="<?php echo $reservation->caja; ?>"  />
      <input type="hidden" name="user_informe"   id="user_informe" placeholder="user_informe"  value="<?php echo $reservation->user_informe; ?>"  />
  
   
  </div>
     </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"   value ="<?php echo date("Y-m-d");  ?>">
    </div>
    
    </div>
    
    
   <div class="form-group">
          <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora</label>
 
    <div class="col-lg-2">
       <?php 
      $min=date("i");
      $minutos= date("H:i");
     // echo $minutos;  ?> 
        
      <input type="time" name="time_at" step="60"    value="<?php echo  $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
      
    
    </div>


    <label for="inputEmail1" class="hidden"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
    <div class="hidden">
       <?php 
     //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
      $hora_fin = date('H:i', strtotime($reservation->time_at.'+30 minutes')); 
     // echo $hora_fin;  ?> 
        
      <input type="time" name="hora_fin" step="60"    value="<?php echo $reservation->hora_fin;  ?>"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
      
    
    </div>
  </div>
    
    
   <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user fa-2x"></i>Cliente</label>
    <div class="col-lg-7">
       
      <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo " ID:".$paciente->id." - ". $paciente->lastname ." ".$paciente->name." - DNI:".$paciente->no ." -  Fecha:".$paciente->day_of_birth ;  ?>" readonly placeholder="Escriba el nombre del paciente">
	
      <input type="hidden" name="pacient_id"   id="pacient_id" placeholder="pacient_id" value="<?php echo $paciente->id ;  ?>" />
	
    </div>    
   </div> 


   <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-briefcase fa-2x"></i>Datos:</label>
    <div class="col-lg-7">
       
      <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo " - Telf:".$paciente->phone." - Fijo:".$paciente->telefono_fijo." - Email:".$paciente->email ." - Cp:".$paciente->codigo_postal ;  ?>" readonly placeholder="Escriba el nombre del paciente">
	
     
    </div>    
   </div> 

   <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-home fa-2x"></i>Direccion:</label>
    <div class="col-lg-7">
       
      <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo " ".$paciente->address ." - ".$paciente->localidad ." - ".$paciente->provincia;  ?>" readonly placeholder="Escriba el nombre del paciente">
	
     
    </div>    
   </div> 

   

      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-area-chart"></i> ContraParte</label>
    <div class="col-lg-3">
       
        <select name="osocial_id" id="osocial_id" class="form-control" required readonly>

  <?php
    
  foreach($obras as $p):  ?>
    <option value="<?php echo $p->id; ?>"     <?php if($p->id==$osocial->id ){ echo "selected"; }?>     ><?php echo $p->nombre." - ".$p->id; ?></option>
  <?php endforeach; ?>
    <option value="2"> Particular </option>
</select>
    </div>
    
   </div>   
   <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria </label>
    <div class="col-lg-4">
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria --</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$_GET["category_id"]){ echo "selected"; }?> ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
    
    
  
    <div class="form-group">

   
    <label for="inputEmail1" class="col-lg-2 control-label"><i class=" fa fa-medkit"></i>Atencion</label>
    <div class="col-lg-5">
<select name="estudio_id" id="estudio_id"  class="form-control" required readonly>
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if($p->id==$reservation->estudio_id){ echo "selected"; }?>  >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
 
    <?php endforeach; ?>
</select>
    </div>
    <div class="hidden"> 
       <select name="modelo" id="modelo"  class="form-control" >    
         <option value="<?php echo $precio; ?>"><?php echo $precio ?></option>
    
    </select>
      </div>  
    </div>  



    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 2</label>
    <div class="col-lg-5">
<select name="estudio2" id="estudio2"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"      <?php if($p->id==$reservation->estudio2){ echo "selected"; }?> >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="hidden"> 
       <select name="modelo2" id="modelo2"  class="form-control" >    
    
    <option value="<?php echo $precio2; ?>"><?php echo $precio2 ?></option>
    </select>
      </div>  
    </div>  

    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 3</label>
    <div class="col-lg-5">
<select name="estudio3" id="estudio3"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$reservation->estudio3){ echo "selected"; }?> >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="hidden"> 
       <select name="modelo3" id="modelo3"  class="form-control" >    
       <option value="<?php echo $precio3; ?>"><?php echo $precio3 ?></option>
    
    </select>
      </div>  
    </div>  

    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 4</label>
    <div class="col-lg-5">
<select name="estudio4" id="estudio4"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"       <?php if($p->id==$reservation->estudio4){ echo "selected"; }?>  >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
 <?php endforeach; ?>
</select>
    </div>
    <div class="hidden"> 
       <select name="modelo4" id="modelo4"  class="form-control" >    
       <option value="<?php echo $precio4; ?>"><?php echo $precio4 ?></option>
    
    </select>
      </div>  
    </div>  


    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 5</label>
    <div class="col-lg-5">
<select name="estudio5" id="estudio5"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"    <?php if($p->id==$reservation->estudio5){ echo "selected"; }?> >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="hidden"> 
       <select name="modelo5" id="modelo5"  class="form-control" >    
       <option value="<?php echo $precio5; ?>"><?php echo $precio5 ?></option>
    
    </select>
      </div>  
    </div>  

 
      <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id" required class="form-control" >
<option value="">-- Profesionales --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>    ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>

      <input type="hidden" name="tipo"   id="tipo" placeholder="tipo" value="<?php echo $reservation->tipo ;  ?>"  />
	
    
    
    
    
  <div class="hidden">
           <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-money fa-2x"></i> Estado de Pago</label>
 
    <div class="col-lg-3">
      
        <select name="payment_id" id="payment_id" class="form-control" required>
           
            
            <option value="1" <?php  if($reservation->payment_id<2){ echo "selected"; } ;?> class="btn-warning">-- Pendiente de pago --</option>
<option value="2" <?php  if($reservation->payment_id==2){ echo "selected"; } ;?>>-- Pagado</option>
  
</select>
        
    </div>
  </div>
 <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Pago</label>
    <div class="col-lg-3">
        
        <select name="tipo_pago" id="tipo_pago"  class="form-control"  style="background: #5cb85c; color: #fff;" required>
            <option value="EFECTIVO"  <?php  if($reservation->tipo_pago=="EFECTIVO"){ echo "selected"; } ;?> style="background: #5cb85c; color: #fff;" >-- EFECTIVO --</option>
<option value="DEBITO"  <?php  if($reservation->tipo_pago=="DEBITO"){ echo "selected"; } ;?> style="background: #bc0000 ; color: #fff;">-- DEBITO</option>
  <option value="CREDITO"  <?php  if($reservation->tipo_pago=="CREDITO"){ echo "selected"; } ;?> style="background: #FF8C00; color: #fff;">-- CREDITO</option>
</select>
    </div>
    
   </div>   
    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
    <input type="text" name="price" value="<?php echo $reservation->price;?>" class="form-control" id="price" placeholder="price">
  
</div>
    </div>
  </div>
     <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" name="observacion_coseguro" value="0" class="form-control" id="observacion_coseguro" placeholder="observacion_coseguro">
  
</div>
    </div>
  </div>
    
  <div class="hidden">
         <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-stethoscope fa-2x"></i> Estado</label>
   
    <div class="col-lg-3">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if($p->id==$reservation->status_id){ echo "selected"; }?> ><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>


  
    
    <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="sick" placeholder="Enfermedad"></textarea>
    </div>
  </div>
      <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div>
        <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div>
  
  
  <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha Fecha Acc/1ra Manif 2</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="fecha_informe"   id="fecha_informe"   class="form-control" id="datepicker" placeholder="Fecha"   value ="<?php echo $reservation->fecha_informe;  ?>">
    </div>
    
    </div>

  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-archive fa-2x"></i> Registrar detalle de la alarma</label>
   
   <div class="col-lg-3">
				 <textarea class="text" rows="4" cols="65" id="detalle"  name="detalle"     placeholder="Registrar detalle">
        </textarea>
    
			</div>
		</div>

   
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">

    <input type="hidden"  class="form-control" id="volver" name="volver" value="<?php echo $volver; ?>">

      <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-2x"></i>Crear alarma para el caso</button>
    

      
      <a href="index.php?view=<?php echo $volver; ?>&category_id=&estudio_id=2&medic_id=&osocial_id=&date_at=<?php echo $reservation->date_at; ?>" class="btn btn-primary"><i class='fa fa-calendar'></i> Cancelar - Volver</a>
     
    
    </div>
  </div>
</form>

	</div>
</div>