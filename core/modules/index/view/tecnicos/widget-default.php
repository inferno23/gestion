
<script src='res/jquery.min.js'></script>
<script type="text/javascript">
             
            
$(document).ready(function(){
   $("#category_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });  
              
$(document).ready(function(){
   $("#category_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });          
           </script>   
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newtecnico" class="btn btn-success"><i class='fa fa-plus-square'></i> Agregar un Nuevo tecnico</a>
        
         
<!--
ALTER TABLE `medic` ADD `is_profesional` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_active`;
 -->
</div>
		
                
                  <h1><span class="fa fa-flask"></span> Tecnicos</h1>
<br>

<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="tecnicos">
        

  <div class="form-group">

   
   <div class="col-lg-5">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Burcar por Apellido o Nombre">
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria de estudio-</option>
  <?php 
  $categorias = CategoryData::getAll();
  foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name." - ".$p->id; ?></option>
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

//echo $_GET["estudio_id"];
if((isset($_GET["q"]) && ( $_GET["q"]!=""  ))) {

		$users = TecnicoData::getLike($_GET["q"]);

}else if((     isset($_GET["category_id"]) && ( $_GET["category_id"]!=""  ))) {
    
	$users = TecnicoData::getProfesionalesByArea($_GET["category_id"]);
}else{
		$users = TecnicoData::getAll();

}
                
                
                
                
                
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Direccion</th>
			<th>Email</th>
			<th>Telefono</th>
			<th>Area</th>
			<th></th>
			</thead>
			<?php
                         
			foreach($users as $user){
                            $class="";
                            if (($user->is_profesional=="1")  ) 
                                   $class="btn-success";
				?>
				  <tr class="<?php echo $class ?>"  >
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->address; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo $user->phone; ?></td>
				<td><?php if($user->category_id!=null){ echo $user->getCategory()->name; } ?></td>
				<td style="width:200px;">
				<a href="index.php?view=tecnicohistory&id=<?php echo $user->id;?>" class="btn btn-default btn-xs">Historial</a>
				<a href="index.php?view=edittecnico&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?view=deltecnico&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>

				</td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay tecnicos</p>";
		}


		?>


	</div>
</div>