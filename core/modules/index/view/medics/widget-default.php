
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
	<a href="index.php?view=newmedic" class="btn btn-success"><i class='fa fa-plus-square'></i> Agregar un Nuevo Profesional</a>
        
         
<!--
ALTER TABLE `medic` ADD `is_profesional` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_active`;
 -->
</div>
		
                
                  <h1><span class="fa fa-user-md"></span> Profesionales</h1>
<br>

<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="medics">
        

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
<option value="">-- Categoria -</option>
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

//echo 'yyyyy'.$_GET["q"];
		$users = MedicData::getLike($_GET["q"]);

}else if((     isset($_GET["category_id"]) && ( $_GET["category_id"]!=""  ))) {
    
    
   // echo 'eeeeeeeee'.$_GET["category_id"];
	$users = MedicData::getProfesionalesByArea($_GET["category_id"]);
}else{
		$users = MedicData::getAll();

}


if(Session::getUID()!=""){
	$u = UserData::getById(Session::getUID());
	 if ($u->is_admin==5){
		 $medico_id = $u->id;
  
	  // echo  "<br> solo el medico medic_id:". $medico_id;
  
	   $sql = " select * from medic where id= ".$medico_id;
  
	   $medics = MedicData::getBySQL($sql);
	
	 
	}	
	$medicos_asociado  = "";
	
		 
	 //10 es super admin;
	 if ($u->is_admin==10){
	  $medics = MedicData::getProfesionales();
	}else{
	
		 //// muestro los medicos asociados a un usuario 
		  $UserMedic=UserMedicData::getAllByUser($u->id);
	
		 // print_r($UserMedic);
		  foreach ($UserMedic as $medico){
			//echo $medico->id;
			   $medicos_asociado =  $medico->idMedic.','.$medicos_asociado;
		  }
		  
		  $medicos_asociado = substr($medicos_asociado, 0, -1);
		 
		 $sql = "select * FROM medic WHERE id IN ($medicos_asociado) ORDER BY id ASC";
		// echo $sql;
		 
		 $medics = MedicData::getBySQL($sql);
		  //print_r($medics);
	
		}


                
}               
                
                
		if(count($medics)>0){
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
                         
			foreach($medics as $user){
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
				<a href="index.php?view=medichistory&id=<?php echo $user->id;?>" class="btn btn-primary btn-xs">Historial</a>
				<a href="index.php?view=editmedic&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				
				</td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay medicos asociados a su cuenta por favor informe al administrador</p>";
		}


		?>


	</div>
</div>