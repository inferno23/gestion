<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');


$medics = MedicData::getProfesionales();
//print_r($medics);

     
?>

<div class="row">
	<div class="col-md-12">
	<h1>Agregar Usuario</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=adduser" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de usuario*</label>
    <div class="col-md-6">
      <input type="text" name="username" class="form-control" required id="username" placeholder="Nombre de usuario">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" required name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" required name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
    </div>
  </div>

  
                    
                      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Rol de Usuario</label>
    <div class="col-lg-3">
        <select name="is_admin" id="is_admin" class="form-control" required>
  <option value="0">-- Consultas</option>
            <option value="1">-- Turnero --</option>

  <option value="5">-- Odontologo </option>
  
  <option value="10">-- Administrador</option>
</select>
    </div>
    
   </div>   


      
   <div class="form-group">
    <label for="inputEmail1" class="text-secondary col-lg-2 control-label">Profesional asociado</label>
    <div class="col-lg-3">
<select multiple="multiple" required name="medic_id[]" id="medic_id"   class="form-control" size='10' >

  <?php 
  //medic_id obtenido de la url selected
  foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="text-danger col-lg-2 control-label">Mantener la tecla Ctrl para seleccionar varios profesionales asociado)</label>
    </div>
                    
                    
                  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">*</label>
    <div class="hidden">
        <select name="modulo" id="modulo" class="form-control" required>
  
            <option value="1">-- Imagenes --</option>

  

  <option value="7">-- Consultorio</option>
  
  <option value="8">-- Laboratorio</option>
</select>
    </div>
    
   </div>        
                    
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Usuario</button>
    </div>
  </div>
</form>
	</div>
</div>