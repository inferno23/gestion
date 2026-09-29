<?php 


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$categorias = CategoryData::getAll();
$medics = MedicData::getProfesionalesByArea($reservation->category_id);



$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
   $medic = $reservation->getMedic();
            $paciente = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             
             
             
               $tecnicos = TecnicoData::getAll();
               if (!empty($reservation->medsoli) )
             $solicitante = $reservation->getMedic2();


?>

<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
          
 
 <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

 <!-- fin         wysihtml5  -->
<div class="row">
	<div class="col-md-10">
	 <br>
          <h2><span class="fa fa-medkit"></span> Registrar Informe de la Atencion * </h2>
          <?php
          
           $osocial_id=$medic_id=$category_id=$estudio_id="";
      if(  isset($_GET["estudio_id"]) && ( $_GET["estudio_id"]!=""))
             $estudio_id=$_GET["estudio_id"];
       if(  isset($_GET["category_id"]) && ( $_GET["category_id"]!=""))
             $category_id=$_GET["category_id"];
       if(  isset($_GET["medic_id"]) && ( $_GET["medic_id"]!=""))
             $medic_id=$_GET["medic_id"];
       if(  isset($_GET["osocial_id"]) && ( $_GET["osocial_id"]!=""))
             $osocial_id=$_GET["osocial_id"];
          //$ruta= "&category_id=".$_GET['category_id']."&estudio_id=".$_GET['estudio_id']."&medic_id=".$_GET['medic_id']."&osocial_id=".$_GET['osocial_id'];
          $ruta= "&category_id=".$category_id."&estudio_id=".$estudio_id."&medic_id=".$medic_id."&osocial_id=".$osocial_id;
    
         // echo $ruta;
                  ?>
  <hr>
<form class="form-horizontal" role="form" method="post" action="./?action=informereservation<?php echo $ruta; ?>">
   <div class="form-group">
     <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>"  >
    
            <input type="text" name="title"  class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>" >
     <input type="text" name="note" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
  
 
     </div>
    
    
  
    <input type="text" name="caja"  class="hidden" id="caja" placeholder="caja"  value="<?php echo $reservation->caja;  ?>" >
  
   
         
    <input type="text" name="tipo"  class="hidden" id="tipo" placeholder="tipo"  value="<?php echo $reservation->tipo;  ?>" >
  
   
     
  <?php  
     //$min=date("i");
      $minutos= date("H:i",strtotime($reservation->time_at." "));
     // echo $minutos;  ?> 
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label"><i class="fa fa-calendar fa-2x"></i><?php  echo date("d/m/Y",strtotime($reservation->date_at." ") )." ".$minutos;  ?></label>
   
    <input type="hidden" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"   value ="<?php  echo date("Y-m-d",strtotime($reservation->date_at." "));  ?>" readonly>
    
     
        
      <input type="hidden" name="time_at"  value="<?php echo $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora" readonly>
      
    
    <label for="inputEmail1" class="col-lg-3 control-label"><i class="fa fa-male fa-2x"></i><?php echo $paciente->lastname ." ".$paciente->name ;  ?></label>
   
   
  
      <input type="hidden"    name="paciente" required class="form-control" id="paciente" value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  placeholder="Escriba el nombre del paciente" readonly>
	
      <input type="hidden" name="pacient_id"   id="pacient_id" placeholder="pacient_id" value="<?php echo $paciente->id ;  ?>" />
	
   
     
   </div> 
      <div class="form-group">
    <label for="inputEmail1"  control-label"><i class="fa fa-area-chart"></i> Obra Social: </label>
     <label for="inputEmail1"  control-label"><?php echo $osocial->nombre ."".$osocial->id."  " ;  ?></label>
     <input type="hidden" name="osocial_id"   id="osocial_id" placeholder="osocial_id" value="<?php echo $osocial->id ; ?>"  />
	   <label for="inputEmail1" ><i class="fa fa-medkit fa-2x"></i><?php echo $estudio->id." - ".$estudio->descripcion." "; ?></label>
    <input type="hidden" name="estudio_id"   id="estudio_id" placeholder="estudio_id" value="<?php echo $estudio->id ; ?>"  />
	    </div>  
    
   
     <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user-md fa-2x"></i>Profesional </label>
   <label for="inputEmail1" class="col-lg-2 control-label"><?php echo $medic->lastname." ".$medic->name ;  ?></label>
   
      
      <input type="hidden" name="medic_id" id="medic_id" placeholder="medic_id"  value="<?php echo $medic->id;  ?>" />
	
       
    </div>
    
    
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Modificar Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id"  class="form-control" >
<option value="">-- Profesionales que realizan el Informe-</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"        <?php if($p->id==$reservation->medic_id	){ echo "selected"; }?>       ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
    </div>
    
    
    <input type="hidden" name="medsoli"   id="medsoli" placeholder="medsoli" value="0"> 
   

   
    <input type="hidden" name="tecnico_id"   id="tecnico_id" placeholder="tecnico_id" value="0"> 
   

   
    
 
        <input type="hidden" name="payment_id" value="<?php echo $reservation->payment_id;?>" class="form-control" id="payment_id" placeholder="payment_id">
  
   

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro <i class="fa fa-usd"></i><?php echo $reservation->price;?></label>
    
    <input type="hidden" name="price" value="<?php echo $reservation->price;?>" class="form-control" id="price" placeholder="price" readonly>
  

    <label for="inputEmail1" class="col-lg-2 control-label">Observacion <i class="fa fa-usd"></i><?php echo $reservation->observacion_coseguro;?></label>
   
  <input type="hidden" name="observacion_coseguro" value="<?php echo $reservation->observacion_coseguro;?>" class="form-control" id="observacion_coseguro" placeholder="observacion_coseguro" readonly>
  
  </div>
     
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fechade Informe</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="fecha_informe"   required class="form-control" id="datepicker" placeholder="Fecha"  min="<?php echo date("Y-m-d");  ?>"  value ="<?php 
       if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
           echo $_GET["date_at"]; 
       }else
        
        echo date("Y-m-d");  ?>">
    </div>
    
  </div>
  
  <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-stethoscope fa-2x"></i> Estado</label>
   
    <div class="col-lg-3">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if ($p->id==5) echo "selected"; ?> ><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
    
   <?php  
   $estudio_id=$estudio->id;
  $items = InformeData::getByEstudio($estudio_id);
   ?>
    
   
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 1</label>
    <div class="col-lg-5">
<select name="informe1" id="informe1"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==1){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 2</label>
    <div class="col-lg-5">
<select name="informe2" id="informe2"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==2){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
   
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 3</label>
    <div class="col-lg-5">
<select name="informe3" id="informe3"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==3){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
         <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 4</label>
    <div class="col-lg-5">
<select name="informe4" id="informe4"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==4){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
         <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 5</label>
    <div class="col-lg-5">
<select name="informe5" id="informe5"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==5){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
         <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 6</label>
    <div class="col-lg-5">
<select name="informe6" id="informe6"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==6){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
         <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item 7</label>
    <div class="col-lg-5">
<select name="informe7" id="informe7"    class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p):
      if ($p->codigo_informe==7){      
?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>
 <?php  } endforeach; ?>
</select>           
    </div>
    </div> 
    <input type="hidden" name="detalle"  class="form-control" id="detalle" placeholder="detalle">
  <input type="hidden" name="fecha_atencion" class="form-control" id="fecha_atencion" placeholder="fecha_atencion">
  <input type="hidden" name="hora_atencion" class="form-control" id="hora_atencion" placeholder="hora_atencion">
  
    
     <?php  $textousuario=$u=null;
if(Session::getUID()!=""){
  $u = UserData::getById(Session::getUID());
  $user = $u->name." ".$u->lastname;
 $textousuario=$user;
  }
  ?>
      <input type="hidden" name="user_informe" value="<?php echo $u->id;?>" class="form-control" id="user_informe" placeholder="user_informe">
  
   
    <div class="col-lg-1">
     

    <textarea class="hidden" name="note" placeholder="Nota"></textarea>
    
    <textarea class="hidden" name="sick" placeholder="sick" value="INFORME" >INFORME</textarea>
    
  
    <textarea  id="symtoms" class="hidden" name="symtoms" placeholder="Sintomas"></textarea>
    
    <textarea class="hidden" name="medicaments" placeholder="Medicamentos"></textarea>
    
  </div>
    
    
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-2x"></i>Registrar informe de Imagenes</button>
    </div>
  </div>
</form>

	</div>
</div>