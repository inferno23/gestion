<?php 
$valor =0;
$estudios = EstudioData::getAll();
$obras = OsocialData::getAll();

?>
<div class="row">
	<div class="col-md-10">
	<h1>Modificar Valor de Coseguros</h1>
  <hr>


<form class="form-horizontal" role="form" method="post" action="./?action=aumentarcoseguro">
  
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">obra Social</label>
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
    <label for="inputEmail1" class="col-lg-2 control-label">Porcentaje a Aumentar*</label>
    <div class="col-md-6">
        <input type="text" name="porcentaje"  required class="form-control" size="3" maxlength="3" min="1" max="100" id="porcentaje" placeholder="porcentaje a aumentar">
    </div>
  </div>
 

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    
      <button type="submit" class="btn btn-default">Actualizar valor de Coseguro</button>
    </div>
  </div>
</form>

	</div>
</div>