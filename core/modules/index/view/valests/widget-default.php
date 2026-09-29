<script src='res/jquery.min.js'></script>
<script type="text/javascript">
              
        


$(document).ready(function(){
   $("#osocial_id").change(function () {
     //  alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });

           


              
$(document).ready(function(){
   $("#estudio_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });          
           </script>      



<div class="btn-group pull-right">
     <!--   cambio tecnicos 20/07/19 -->  
	 <a href="index.php?view=copiar_coseguro"  class="btn btn-danger" ><i class="fa fa-plus-square"></i> Crear coseguro</a>

<a href="index.php?view=aumentar_grupo"  class="btn btn-success" ><i class="fa fa-plus-square"></i>Actualizar x Obra </a>

                                                                                              
 <a href="index.php?view=aumentarcoseguro"  class="btn btn-primary" ><i class="fa fa-plus-square"></i> Actualizar x Porcentaje</a>
</div>

<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="valests">
        <?php
$estudios = EstudioData::getAll();
$obras = OsocialData::getAll();

        ?>

  <div class="form-group">

    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-th-list"></i></span>
<select name="estudio_id"   id="estudio_id"  class="form-control">
<option value="">Atenciones</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["estudio_id"]) && $_GET["estudio_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." -  ".$p->descripcion; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
<select name="osocial_id" id="osocial_id" class="form-control">
<option value="">Obra Social</option>
  <?php foreach($obras as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["osocial_id"]) && $_GET["osocial_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->nombre." "; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
   
  

  </div>
  <div class="form-group">

   
    
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar Busqueda</button>
    </div>

  </div>
</form>

		<?php
$users= array();

//echo $_GET["osocial_id"];
if((isset($_GET["estudio_id"])|| isset($_GET["osocial_id"])  )  ) {
$sql = "select * from valest where codest>0  and  codob>0  ";
if($_GET["estudio_id"]!=""){
	$sql .= " AND  codest = ".$_GET["estudio_id"];
}


if($_GET["osocial_id"]!=""){

	$sql .= " AND codob = ".$_GET["osocial_id"];
}



//echo $sql;
		$users = ValestData::getBySQL($sql);

}else{
		$users = ValestData::getAll();

}

?>
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newvalest" class="btn btn-default"><i class='fa fa-th-list'></i> Nuevo Coseguro</a>
</div>
		<h1>Valor de Atenciones y Coseguros</h1>
<br>
		<?php

		//$users = ValestData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Atenciones</th>
			<th>Obra Social</th>
                        <th>Codigo</th>
                        <th>Coseguro</th>
                        <th>Obra </th>
                         <th>Accion  </th>
			</thead>
			<?php
			foreach($users as $user){
                            $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
				?>
				<tr>
                                    <td><?php echo $estudio->id." ".$estudio->descripcion; ?></td>
				  <td><?php echo $osocial->id." ".$osocial->nombre; ?></td>
				 <td><?php echo $user->codigo." "; ?></td>
				<td><?php echo $user->coseguro." "; ?></td>
                                <td><?php echo $user->osocial." "; ?></td>
				<td style="width:130px;"><a href="index.php?view=editvalest&id=<?php echo $user->row_id;?>" class="btn btn-warning btn-xs">Modificar</a> </td>
				
                                
                                </tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Coseguros</p>";
		}


		?>


	</div>
</div>