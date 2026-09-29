<?php 

$user = InformeData::getById($_GET["id"]);
$categorias = EstudioData::getAll();
/**<option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>><?php $p->name." - ".$p->id; ?></option>
*/
///echo 'user->category_id'.$user->category_id;
?>


<div class="row">
	<div class="col-md-12">
	<h1>Modificar Items del  Informe </h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateinforme" role="form">


  
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">estudio</label>
    <div class="col-lg-3">
<select name="codigo_estudio" id="codigo_estudio"  class="form-control" required>
<option value="">-- Estudio-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$user->codigo_estudio){ echo "selected"; }?>    ><?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
                    
            
                   
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"> codigo_informe</label>
    <div class="col-lg-2">
        <select name="codigo_informe" id="codigo_informe" class="form-control" required>

<option value="1" <?php if("1"==$user->codigo_informe){ echo "selected"; }?>>- 1</option>
<option value="2" <?php if("2"==$user->codigo_informe){ echo "selected"; }?>>- 2</option>
<option value="3" <?php if("3"==$user->codigo_informe){ echo "selected"; }?>>- 3</option>
   
<option value="4" <?php if("4"==$user->codigo_informe){ echo "selected"; }?>>- 4</option>
<option value="5" <?php if("5"==$user->codigo_informe){ echo "selected"; }?>>- 5</option>
<option value="6" <?php if("6"==$user->codigo_informe){ echo "selected"; }?>>- 6</option>
<option value="7" <?php if("7"==$user->codigo_informe){ echo "selected"; }?>>- 7</option>
<option value="8" <?php if("8"==$user->codigo_informe){ echo "selected"; }?>>- 8</option>
<option value="9" <?php if("9"==$user->codigo_informe){ echo "selected"; }?>>- 9</option>
</select>
    </div>
    
   </div>      
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"> subcodigo</label>
    <div class="col-lg-2">
        <select name="subcodigo" id="subcodigo" class="form-control" required>

<option value="" <?php if(""==$user->subcodigo){ echo "selected"; }?>>- </option>
<option value="A" <?php if("A"==$user->subcodigo){ echo "selected"; }?>>- A</option>
<option value="B" <?php if("B"==$user->subcodigo){ echo "selected"; }?>>- B</option>
   
<option value="C" <?php if("C"==$user->subcodigo){ echo "selected"; }?>>- C</option>
<option value="D" <?php if("D"==$user->subcodigo){ echo "selected"; }?>>- D</option>
<option value="F" <?php if("F"==$user->subcodigo){ echo "selected"; }?>>- F</option>
<option value="G" <?php if("G"==$user->subcodigo){ echo "selected"; }?>>- G</option>
<option value="H" <?php if("H"==$user->subcodigo){ echo "selected"; }?>>- H</option>
<option value="I" <?php if("I"==$user->subcodigo){ echo "selected"; }?>>- I</option>
</select>
    </div>
    
   </div>      
                    
              
                    
                    
                    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">descripcion*</label>
    <div class="col-md-6">
      <input type="text" name="descripcion" class="form-control" id="descripcion" value="<?php echo $user->descripcion;?>"  placeholder="descripcion">
    </div>
  </div>
                    
                    
                       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">observacion*</label>
    <div class="col-md-6">
      <input type="text" name="observacion" class="form-control" id="observacion" value="<?php echo $user->observacion;?>" placeholder="observacion a  mostrar en el informe">
    </div>
  </div>
                                   
                   
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Estudio</button>
    </div>
  </div>
</form>
	</div>
</div>