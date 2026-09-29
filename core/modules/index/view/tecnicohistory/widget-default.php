<?php
$pacient = TecnicoData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">

<div class="btn-group pull-right">
	<a href="index.php?view=tecnicos" class="btn btn-success"></i> Volver al listado de tecnicos</a>
        
</div>
		<h1>Historial de Citas del tecnico</h1>
<h4>Tecnico: <?php echo $pacient->name." ".$pacient->lastname;?></h4>

<br>
		<?php
		$users = ReservationData::getAllByTecnicoId($_GET["id"]);
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$pacient->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay citas</p>";
		}


		?>


	</div>
</div>