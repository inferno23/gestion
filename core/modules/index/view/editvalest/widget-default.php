<?php 
$valor = ValestData::getById($_GET["id"]);
$estudios = EstudioData::getAll();
$obras = OsocialData::getAll();

?>
<div class="row">
	<div class="col-md-10">
	<h1>Modificar Valor de Coseguros</h1>
  <hr>
<form class="form-horizontal" role="form" method="post" action="index.php?view=updatevalest">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estudio</label>
    <div class="col-lg-5">
<select name="estudio_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$valor->codest){ echo "selected"; }?>><?php echo $p->id." -  ".$p->descripcion; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">obra Social</label>
    <div class="col-lg-5">
<select name="osocial_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$valor->codob){ echo "selected"; }?>><?php echo $p->id." -  ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
 
    
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">codigo atencion</label>
    <div class="col-lg-5">
<div class="input-group">
 
  <input type="text" class="form-control" value="<?php echo $valor->codigo;?>" name="codigo" placeholder="codigo">
</div>
    </div>
  </div>

    
 

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">coseguro</label>
    <div class="col-lg-5">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" value="<?php echo $valor->coseguro;?>" name="coseguro" placeholder="coseguro">
</div>
    </div>
  </div>

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo osocial</label>
    <div class="col-lg-5">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" value="<?php echo $valor->osocial;?>" name="osocial" placeholder="Costo osocial">
</div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="row_id" value="<?php echo $valor->row_id; ?>">
      <button type="submit" class="btn btn-default">Actualizar valor de Coseguro</button>
    </div>
  </div>
</form>

	</div>
</div>