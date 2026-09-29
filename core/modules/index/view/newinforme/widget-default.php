<?php 


$categorias = EstudioData::getAll();
/**<option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>><?php $p->name." - ".$p->id; ?></option>
*/
///echo 'user->category_id'.$user->category_id;
?>
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Item de Informe</h1>
	<br>
		<form class="form-horizontal" method="post" id="addinforme" action="index.php?view=addinforme" role="form">


  
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion</label>
    <div class="col-lg-3">
<select name="codigo_estudio" id="codigo_estudio"  class="form-control" required>
<option value="">-- Atencion-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"   ><?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
             
                      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"> codigo_informe</label>
    <div class="col-lg-2">
        <select name="codigo_informe" id="codigo_informe" class="form-control" required>

<option value="1">- 1</option>
<option value="2">- 2</option>
<option value="3">- 3</option>
   
<option value="4">- 4</option>
<option value="5">- 5</option>
<option value="6">- 6</option>
<option value="7">- 7</option>
<option value="8">- 8</option>
<option value="9">- 9</option>
</select>
    </div>
    
   </div>      
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"> subcodigo</label>
    <div class="col-lg-2">
        <select name="subcodigo" id="subcodigo" class="form-control" required>

<option value="">- </option>
<option value="A">- A</option>
<option value="B">- B</option>
   
<option value="C">- C</option>
<option value="D">- D</option>
<option value="F">- F</option>
<option value="G">- G</option>
<option value="H">- H</option>
<option value="I">- I</option>
</select>
    </div>
    
   </div>      
                    
              
                    
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">descripcion*</label>
    <div class="col-md-6">
      <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion">
    </div>
  </div>
                    
                    
                       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">observacion*</label>
    <div class="col-md-6">
      <input type="text" name="observacion" class="form-control" id="observacion" placeholder="observacion a  mostrar en el informe">
    </div>
  </div>
                    
                   
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar item al iforme</button>
    </div>
  </div>
</form>
	</div>
</div>