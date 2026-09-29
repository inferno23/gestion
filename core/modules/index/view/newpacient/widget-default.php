<?php
//ALTER TABLE `pacient` ADD `osocial_id` INT NULL AFTER `day_of_birth`;
//ALTER TABLE `pacient` ADD `osocial_id2` INT NULL AFTER `osocial_id`
//ALTER TABLE `pacient` ADD `osocial_id3` INT NULL AFTER `osocial_id`
$obras = OsocialData::getAll();

$fechaturno=$horaturno=$categoria=$estudio_id=Null;
if(isset($_REQUEST['fecha']) && $_REQUEST['fecha']!="")
{
    $fechaturno=$_REQUEST['fecha'];
}
if(isset($_REQUEST['hora']) && $_REQUEST['hora']!="")
{
    $horaturno=$_REQUEST['hora'];
}
if(isset($_REQUEST['categoria']) && $_REQUEST['categoria']!="")
{
  $categoria=$_REQUEST['categoria'];
}
if(isset($_REQUEST['estudio_id']) && $_REQUEST['estudio_id']!="")
{
  $estudio_id=$_REQUEST['estudio_id'];
}

?>


<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Paciente</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addpacient" role="form">

   <input type="hidden" name="fechaturno"   id="fechaturno" value="<?php echo $fechaturno?>" >
   <input type="hidden" name="horaturno"   id="horaturno" value="<?php echo $horaturno?>" >
    <input type="hidden" name="categoria"   id="categoria" value="<?php echo $categoria?>" >
     <input type="hidden" name="estudio_id"   id="estudio_id" value="<?php echo $estudio_id?>" >
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-4">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>
    <div class="col-md-4">
      <input type="text" name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
                       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social</label>
    <div class="col-lg-4">
<select name="osocial_id" class="form-control" required>
<option value="">-- SELECCIONE Obra Social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
   </div>   
                    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">numero afiliado</label>
    <div class="col-md-4">
      <input type="text" name="numero_afiliado"  class="form-control" id="lastname" placeholder="numero_afiliado en la obra social">
    </div>
  </div>
                    
                          <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Segunda Obra Social</label>
    <div class="col-lg-4">
<select name="osocial_id2" class="form-control">
<option value="">-- Segunda Obra Social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
   </div>   
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">numero afiliado 2</label>
    <div class="col-md-4">
      <input type="text" name="numero_afiliado2"  class="form-control" id="lastname" placeholder="numero_afiliado2 en obra social 2">
    </div>
  </div>
                    
                          <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tercera Obra Social</label>
    <div class="col-lg-4">
<select name="osocial_id3" class="form-control" >
<option value="">-- Tercera Obra Social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php 
    
    echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
   </div>   
                    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Genero*</label>
    <div class="col-md-6">
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox1" name="gender" required value="h"> Hombre
</label>
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox2" name="gender" required value="m"> Mujer
</label>
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox2" name="gender" required value="o"> Otro
</label>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Nacimiento</label>
    <div class="col-md-3">
      <input type="date" name="day_of_birth" class="form-control"  id="address1" placeholder="Fecha de Nacimiento">
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">DNI</label>
    <div class="col-md-3">
      <input type="text" name="no" class="form-control"  id="no" placeholder="Dni" maxlength="10" required >
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion</label>
    <div class="col-md-6">
      <input type="text" name="address" class="form-control"  id="address1" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    <div class="col-md-4">
      <input type="text" name="email" class="form-control" id="email1" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-4">
      <input type="text" name="phone" class="form-control" id="phone1" placeholder="Telefono">
    </div>
  </div>
 
      <textarea name="sick" class="hidden" id="sick" placeholder="Enfermedad"></textarea>
    
      <textarea name="medicaments" class="hidden" id="sick" placeholder="Medicamentos"></textarea>
   
      <textarea name="alergy" class="hidden" id="sick" placeholder="Alergia"></textarea>
    
  </div>
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Paciente</button>
    </div>
  </div>
</form>
	</div>
</div>