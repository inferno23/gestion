<?php 
$user = FeriadosData::getById($_GET["id"]);

?>
<div class="row">
	<div class="col-md-12">
	
        
            <h1></span> Modificar feriados <i class="fa fa-edit"></i></h1>
	<br>
		<form class="form-horizontal" method="post" id="addferiado" action="index.php?view=updatferiado" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="fecha"   required class="form-control" id="fecha" placeholder="Fecha"    value ="<?php echo $user->fecha;  ?>">
    </div>
    
    </div>
    

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-4">
      <input type="text" name="des" value="<?php echo $user->des;?>" class="form-control" id="des" placeholder="Descripcion">
    </div>
  </div>
 
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i>Modificar feriado</button>
    </div>
  </div>
</form>
	</div>
</div>