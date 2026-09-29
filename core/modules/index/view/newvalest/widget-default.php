<?php

$estudios = EstudioData::getAll();
$obras = OsocialData::getAll();
?>

<div class="row">
<div class="col-md-10">
<h1>Nuevo Coseguro</h1>
<form class="form-horizontal" role="form" method="post" action="index.php?view=addvalest">
   
    
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estudio</label>
    <div class="col-lg-7">
<select name="codest" class="form-control" required>
<option value="">-- SELECCIONE Estudio--</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->descripcion; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social</label>
    <div class="col-lg-5">
<select name="codob" class="form-control" required>
<option value="">-- SELECCIONE Obra Social --</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
   </div>   
    
       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">codigo atencion</label>
    <div class="col-lg-5">
<div class="input-group">
 
  <input type="text" class="form-control"  name="codigo" placeholder="codigo">
</div>
    </div>
  </div>
   
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-5">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="coseguro" placeholder="Coseguro">
</div>
    </div>
  </div>
    
        <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Parte de Obra Social </label>
    <div class="col-lg-5">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="osocial" placeholder="Parte de Obra Social ">
</div>
    </div>
  </div>
    
    
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Coseguro</button>
    </div>
  </div>
</form>

</div>
</div>