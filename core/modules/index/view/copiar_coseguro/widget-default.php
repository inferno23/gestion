<?php 
$valor = 0;
$estudios = EstudioData::getAll();
$obras = OsocialData::getAll();
//<select name="team"  data-style="btn-info" id="team" multiple class=" selectpicker show-menu-arrow show-tick form-control" title="Obras a actualizar" data-width="100%"  data-size="100%">
 
?>
<div class="row">
	<div class="col-md-10">
	<h1>Crear  Valor de Coseguros en base a una Obra social</h1>
  <hr>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>




<form class="form-horizontal" role="form"  method="post" action="./?action=copiar_coseguro">
  
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social a Copiar los valores</label>
    <div class="col-lg-5">
<select name="osocial_id" class="form-control" required>
    
<option value="">-- SELECCIONE --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$valor){ echo "selected"; }?>><?php echo $p->id." -  ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social a Copiar los valores</label>
    <div class="col-lg-5">
        
 <select name="team[]"  data-style="btn-info" id="team" multiple class="selectpicker show-tick" title="Obras a actualizar" data-width="200%"  data-size="20">
   
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$valor){ echo "selected"; }?>><?php echo $p->id." -  ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  
  <div class="form-group">
 
  <div class="col-lg-10">
  <label for="inputEmail1" class="btn-warning control-label">  !!Esta accion requiere unos minutos. Por favor espere un momento luego de apretar el boton de crear</label>
  </div>
  </div>

  <div class="form-group">
   
    <div class="col-lg-offset-2 col-lg-10">
    
      <button type="submit" class="btn btn-success">Crear valor de Coseguro en base a la primero obra seleccionada</button>
    </div>
  </div>
</form>

	</div>
    
    
    
    
</div>
