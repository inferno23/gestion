<?php 


$categorias = CategoryData::getAll();
/**<option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>><?php $p->name." - ".$p->id; ?></option>
*/
///echo 'user->category_id'.$user->category_id;
?>
<div class="row">
	<div class="col-md-12">
	<h1>Nueva Atencion</h1>
	<br>
		<form class="form-horizontal" method="post" id="addestudio" action="index.php?view=addestudio" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria de Atencion</label>
    <div class="col-lg-3">
<select name="category_id" id="category_id"  class="form-control" required>
<option value="">-- Categoria de Atencion-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"   ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">preparativos*</label>
    <div class="col-md-6">
      <input type="text" name="preparativos" class="form-control" id="preparativos" placeholder="preparativos">
    </div>
  </div>
             <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label"> Rendicion de Caja</label>
    <div class="col-lg-4">
        <select name="caja" id="caja" class="form-control" required>

<option value="Imagenes">- Caja de Estudios por imagenes</option>
<option value="Laboratorio">- Caja de Estudios Bioquimicos - Laboratorio</option>
<option value="Consultorio">- Caja de consultorios</option>
   
</select>
    </div>
    
   </div>  
               
                    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Tiempo de espera para retirar el estudio.
</label>
    <div class="col-md-6">
      <input type="text" name="espera" class="form-control" id="espera" placeholder=". Ej. El estudio se podrá retirar en las prox. 48
hs hábiles por la tarde
">
    </div>
  </div>
                    
                        
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Lugar de atención. </label>
    <div class="col-md-6">
      <input type="text" name="lugar" class="form-control" id="lugar" placeholder="Ej. La atención se realizará en el 3er piso">
    </div>
  </div>
                    
                    
                    
                    
                    
                    
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar estudio</button>
    </div>
  </div>
</form>
	</div>
</div>