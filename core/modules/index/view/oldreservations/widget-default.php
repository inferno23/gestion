<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>
		<h1>Citas</h1>
<br>
		<?php

		$users = ReservationData::getOld();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Paciente</th>
			<th>Medico</th>
                        <th>Estudio</th>
                         <th>Obra Social</th>
                         <th>Solicita</th>
                         <th>Precio</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
                                 $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
                                   $medic2 = $user->getMedic2();
				?>
				<tr>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->lastname; ?></td>
                                <td><?php echo $estudio->id." ".$estudio->descripcion; ?></td>
                                 <td><?php echo $osocial->id." ".$osocial->nombre; ?></td>
                                 <td><?php echo $medic2->lastname; ?></td>
                                 <td><?php echo "$".$user->price." "  ; ?></td>
				<td><?php echo $user->date_at; ?></td>
				<td style="width:130px;">
				<a href="index.php?view=editreservation&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				</td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>