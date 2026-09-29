<?php $reservation = ReservationData::getById($_GET["id"]);
   $medic = $reservation->getMedic();
   $pacient = $reservation->getPacient();
   $estudio = $reservation->getEstudio();
    $osocial = $reservation->getOsocial();
$imagen = ($_GET["imagen"]);

$cambiar =  $reservation->imagen;
if($imagen=="2"){
  $cambiar =  $reservation->imagen2;
}
if($imagen=="3"){
  $cambiar =  $reservation->imagen3;
}
if($imagen=="4"){
  $cambiar =  $reservation->imagen4;
}
if($imagen=="5"){
  $cambiar =  $reservation->imagen5;
}


?>
<div class="row">
	<div class="col-md-12">
	<h1>Modificar Imagen</h1>

  <div class="col-md-10">
	 <img src="./image/logo.png" alt="Clinica Odontologica" style="width:150px;height:148px;"><h1>Turno  Bono:<?php echo $reservation->id; ?></h1> 
   <br>
  
    
    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
    <div class="col-md-10">

  
 <label for="inputEmail1"><i class="fa fa-male fa-2x"></i><?php echo $pacient->id." - ".$pacient->name." ".$pacient->lastname; ?>
 </label>
    </div>
  </div>
    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-md-10">
        <label for="inputEmail1" ><i class="fa fa-user-md fa-2x"></i><?php echo $medic->id." - ".$medic->name." ".$medic->lastname; ?></label>
    </div>
  </div>

  <?php
   $target_dir = "./image/".$reservation->id."/";
  
  if (!empty($cambiar))  {  ?>
<div class="form-group ">
<label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
    
    <img class="img-responsive" src="<?php echo ($target_dir.$cambiar); ?>" 
    alt="<?php  echo ($cambiar); ?>">

    <a href="<?php  echo ( $target_dir.$cambiar); ?>" download="<?php echo ($cambiar); ?>">
Descargar Imagen <?php echo ($cambiar); ?>
</a>

<<br></br>
<?php  } ?> 


    <br>
	<br>
 
	<form class="form-horizontal" action="./?action=cambiar_imagen" method="POST" enctype="multipart/form-data"/>
  <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>"  >
  <input type="text" name="imagen" required class="hidden" id="imagen" value="<?php echo $imagen; ?>"  >
Modificar imagen: <input name="archivo" id="archivo" type="file"  class="btn-info" />
<br><br>   
<input class="btn-success" type="submit" name="subir" value="Subir imagen"/>
</form>
	</div>
</div>