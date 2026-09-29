<?php 
$user = TecnicoData::getById($_GET["id"]);
$categories = CategoryData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar tecnico</h1>
	<br>
<form class="form-horizontal" method="post" id="updatetecnico"  action="./?action=updatetecnico" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>" <?php if($user->category_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

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
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" value="<?php echo $user->address;?>" class="form-control" required id="username" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone"  value="<?php echo $user->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>
      <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label"> Realiza servicios en la institución<?php echo  $user->is_profesional ?></label>
    <div class="col-lg-4">
        <select name="is_profesional" id="is_profesional" class="form-control" required>

<option value="0" <?php if("0"==$user->is_profesional){ echo "selected"; }?>>- No Realiza servicios</option>
<option value="1" <?php if("1"==$user->is_profesional){ echo "selected"; }?> >-Realiza servicios en la institución</option>
 
</select>
    </div>
    
   </div>        
 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label" >Esta activo</label>
    <div class="col-md-2">

    <select name="is_active" id="is_active" class="form-control" required>

<option value="0" <?php if("0"==$user->is_active){ echo "selected"; }?>>- NO esta Activo</option>
<option value="1" <?php if("1"==$user->is_active){ echo "selected"; }?> >-Activo</option>
 
</select>

    </div>
  </div>
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Tecnico</button>
    </div>
  </div>
</form>
	</div>
</div>