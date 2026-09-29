<?php 


//$categorias = CategoryData::getAll();
/**<option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>><?php $p->name." - ".$p->id; ?></option>
*/
///echo 'user->category_id'.$user->category_id;
?>
<div class="row">
	<div class="col-md-12">
	<h1>Generar Cierre de caja</h1>
	<br>
	<form class="form-horizontal" role="form" method="post" action="./?action=cierrecaja">           
      

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Observaciones*</label>
    <div class="col-md-6">
      <input type="text" name="observaciones" required class="form-control" id="observaciones" placeholder="Observaciones">
    </div>
  </div>

                    
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Generar Cierre de Caja</button>
    </div>
  </div>
</form>
	</div>
</div>