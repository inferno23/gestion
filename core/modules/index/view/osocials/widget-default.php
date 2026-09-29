<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newosocial" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Obra Social</a>
</div>
		
                
                 <h1><span class="fa fa-area-chart"></span> Obra Social</h1>
<br>
		<?php

		$users = OsocialData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->id." ".$user->nombre; ?></td>
				<td style="width:130px;"><a href="index.php?view=editosocial&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delosocial&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Obra Social</p>";
		}


		?>


	</div>
</div>