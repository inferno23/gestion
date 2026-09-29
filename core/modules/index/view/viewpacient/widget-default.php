<?php $user = PacientData::getById($_GET["id"]);

$obras = OsocialData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Paciente</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatepacient" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-4">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-4">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
                    
                     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra social </label>
    <div class="col-lg-4">
<select name="osocial_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$user->osocial_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
           <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Segunda Obra social </label>
    <div class="col-lg-4">
<select name="osocial_id2" class="form-control" required>
<option value="">-- SELECCIONE Segunda Obra social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$user->osocial_id2){ echo "selected"; }?>><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
                    
                       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tercera Obra social </label>
    <div class="col-lg-4">
<select name="osocial_id3" class="form-control" required>
<option value="">-- SELECCIONE Tercera Obra social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$user->osocial_id3){ echo "selected"; }?>><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
                               
                    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Genero*</label>
    <div class="col-md-6">
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox1" name="gender" required <?php if($user->gender=="h"){ echo "checked"; }?> value="h"> Hombre
</label>
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox2" name="gender" required <?php if($user->gender=="m"){ echo "checked"; }?> value="m"> Mujer
</label>
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox2" name="gender" required <?php if($user->gender=="o"){ echo "checked"; }?> value="o"> Otro
</label>
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Nacimiento</label>
    <div class="col-md-3">
      <input type="date" name="day_of_birth" class="form-control"  id="address1" value="<?php echo $user->day_of_birth;?>" placeholder="Fecha de Nacimiento">
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">DNI</label>
    <div class="col-md-3">
          <input type="text" name="no" value="<?php echo $user->no;?>" class="form-control" id="no" placeholder="no">
  
     
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion</label>
    <div class="col-md-6">
      <input type="text" name="address" class="form-control" value="<?php echo $user->address;?>"  id="address1" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    <div class="col-md-4">
      <input type="text" name="email" class="form-control" id="email1" value="<?php echo $user->email;?>"  placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-4">
      <input type="text" name="phone" class="form-control" id="phone1" value="<?php echo $user->phone;?>" placeholder="Telefono">
    </div>
  </div>
 
      <textarea name="sick" class="hidden" id="sick" placeholder="Enfermedad"><?php echo $user->sick;?></textarea>
 
      <textarea name="medicaments" class="hidden" id="sick" placeholder="Medicamentos"><?php echo $user->medicaments;?></textarea>
   
      <textarea name="alergy" class="hidden" id="sick" placeholder="Alergia"><?php echo $user->alergy;?></textarea>
   

  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
    </div>
  </div>
</form>
	</div>
</div>