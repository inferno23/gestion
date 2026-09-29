<?php 

$user = EstudioData::getById($_GET["id"]);
$categorias = CategoryData::getAll();
/**<option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>><?php $p->name." - ".$p->id; ?></option>
*/
///echo 'user->category_id'.$user->category_id;
?>

<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<br>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Atencion</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatestudio" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-6">
      <input type="text" name="descripcion" value="<?php echo $user->descripcion;?>" class="form-control" id="descripcion" placeholder="descripcion">
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria de Atencion</label>
    <div class="col-lg-3">
<select name="category_id" id="category_id"  class="form-control" required>
<option value="">-- Categoria de estudio-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$user->category_id){ echo "selected"; }?>    ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
                    
                    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">preparativos*</label>
    <div class="col-md-6">
      <input type="text" name="preparativos" value="<?php echo $user->preparativos;?>" class="form-control" id="preparativos" placeholder="preparativos">
    </div>
  </div>
                       <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Espera*</label>
    <div class="col-md-6">
      <input type="text" name="espera" value="<?php if (!empty($user->espera)) echo $user->espera;  else echo "Sin Espera";?>" class="form-control" id="espera" placeholder="Ej. El estudio se podrá retirar en las prox. 48">
    </div>
  </div>
                       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Lugar*</label>
    <div class="col-md-6">
      <input type="text" name="lugar" value="<?php echo $user->lugar;?>" class="form-control" id="lugar" placeholder="Ej. La atención se realizará en el 3er piso">
    </div>
  </div>

  <input type="hidden" name="caja" value="Imagenes" class="form-control" id="caja" placeholder="caja. La atención se realizará en el 3er piso">
 
         
                    
                    <div class="adjoined-top">
		<div class="grid-container">
			<div class="content grid-width-100">
				<h1>protocolo del informe de la Atencion</h1>
                                <textarea class="text" rows="58" cols="75" id="informe"  name="informe" placeholder="Registrar informe de la atencion Medica">
   
  <?php
     
if (!empty($user->informe))
  echo html_entity_decode($user->informe); 


  ?>                     </textarea>
    
			</div>
		</div>
	</div>
	

<script>
    CKEDITOR.replace( 'informe',
	{
		enterMode : CKEDITOR.ENTER_BR,
                  line_height: "11px;13px;15px;18px;20px;25px;30px;"
	});
 
		
                CKEDITOR.config.height = '500';
                 
                CKEDITOR.config.font_defaultLabel = 'Arial';
               CKEDITOR.config.extraPlugins = 'justify,pagebreak,font,liststyle,lineheight,richcombo,floatpanel,listblock,panel,button,letterspacing';
               
              
               CKEDITOR.config.disableNativeSpellChecker = false;
               CKEDITOR.config.scayt_autoStartup = false;
                 CKEDITOR.config.scayt_sLang = 'es_ES';
                 CKEDITOR.config.wsc_lang = "es_ES";
                 CKEDITOR.config.scayt_defLan = 'es_ES';  
                
	</script>
                    
        <br>   <br>   <br>               
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar registro de la atencion </button>
    </div>
  </div>
</form>
	</div>
</div>