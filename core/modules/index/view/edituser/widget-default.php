<?php 
$user = UserData::getById($_GET["id"]);
date_default_timezone_set('America/Argentina/Buenos_Aires');


$medics = MedicData::getProfesionales();
//print_r($medics);
$medicosSeleccionados =UserMedicData::getAllByUser($_GET["id"]);
     //print_r($medicosSeleccionados);
     $registrados[]="";
     foreach($medicosSeleccionados as $p):
      //echo $p->idMedic ;
       $registrados[]=$p->idMedic;
  endforeach;  
  
   //print_r($registrados);
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Usuario</h1>
	<br>
		<form class="form-horizontal" method="post" autocomplete="off" id="addproduct" action="index.php?view=updateuser" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de usuario*</label>
    <div class="col-md-6">
      <input type="text" name="username" value="<?php echo $user->username;?>" class="form-control" required id="username" placeholder="Nombre de usuario">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" autocomplete="off" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="password" autocomplete="off" placeholder="Contrase&ntilde;a">
<p class="help-block">La contrase&ntilde;a solo se modificara si escribes algo, en caso contrario no se modifica.</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label" >Esta activo</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="is_active" <?php if($user->is_active){ echo "checked";}?>> 
    </label>
  </div>
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Rol de Usuario</label>
    <div class="col-lg-3">
        <select name="is_admin" id="is_admin" class="form-control" required>
  <option value="0" <?php if($user->is_admin==0){ echo "selected"; }?>>-- Consultas</option>
            <option value="1" <?php if($user->is_admin==1){ echo "selected"; }?>>-- Turnero --</option>
 <option value="5" <?php if($user->is_admin==5){ echo "selected"; }?>>-- Odontologo</option>
 
  <option value="10" <?php if($user->is_admin==10){ echo "selected"; }?>>-- Administrador</option>
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
    <option value="<?php echo $p->id; ?>"   <?php if(in_array($p->id, $registrados)) echo "selected" ; ?> ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="text-danger col-lg-2 control-label">Mantener la tecla Ctrl para seleccionar varios profesionales asociado)</label>
    </div>
            

                    
                    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Modulo Area</label>
    <div class="col-lg-3">
        <select name="modulo" id="modulo" class="form-control" required>
 
           
  <option value="1" <?php if($user->modulo==1){ echo "selected"; }?>  >-- Imagenes</option>
  

  <option value="7" <?php if($user->modulo==7){ echo "selected"; }?>>-- Consultorio </option>
  
  <option value="8" <?php if($user->modulo==8){ echo "selected"; }?>>-- Laboratorio</option>
</select>
    </div>
    
   </div>   
                    
                    
                    
                    
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </div>
  </div>
</form>
	</div>
</div>