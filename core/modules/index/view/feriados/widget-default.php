



<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newferiado" class="btn btn-success"><i class='fa fa-money'></i> + Registrar  Nuevo Feriado</a>
</div>
		
                
                 <h1><span class="fa fa-money"></span> Feriados</h1>
<br>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="Feriados">
        <?php

$feriados = FeriadosData::getAll();



 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
    
 <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" id="date_at" value="<?php 
                  if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
                      echo $_GET["date_at"]; 
                      
                  }else
                      echo date("Y-m-d");
                      
                  
                //  echo date("Y-m-d",strtotime(" - 3 day"));
                      ?>" class="form-control" placeholder="Palabra clave"    >
		</div>
    </div>

    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<?php
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["date_at"]) && ( $_GET["date_at"]!=""  ))) {
    
    
$sql = "select * from feriados where fecha ='".$_GET["date_at"]."'";

//echo ''.$sql;

	$users = FeriadosData::getBySQL($sql);
}else{
		$users = FeriadosData::getAll();
                //echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                       
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
                            
                            
				?>
				<tr>
				
                                    <td><?php 
                                    
                                   // echo " ".$user->fecha;
                                  echo  date("d/m/Y",strtotime("$user->fecha"));
                                    ?></td>
                                <td><?php echo " ".$user->des; ?></td>
                                <td>
                                <a href="index.php?view=editferiado&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs" title="Modificar feriado"><i class="fa fa-edit"></i> Modificar</a>
                                            <a href="index.php?view=delferiado&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs" title="Eliminar feriado"><i class="fa fa-trash-o"></i> Eliminar</a>
                            	       
      </td>    
                                   </tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Feriados</p>";
		}


		?>


	</div>
</div>