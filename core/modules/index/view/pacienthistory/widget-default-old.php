<?php
$pacient = PacientData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<div class="btn-group pull-right">
  
  
</div>

</div>
		<h1>Historial de Atenciones del Paciente</h1>
<h4>Paciente: <?php echo $pacient->name." ".$pacient->lastname;?></h4>
<br>
		<?php
		$users = ReservationData::getAllByPacientId($_GET["id"]);
		if(count($users)>0){
			$_SESSION["report_paciente"] = $users;
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Nro</th>
			<th>Fecha</th>
			<th>Profesional</th>
                        <th>Atencion</th>
                         <th>Obra Social</th>
                        
                         <th>Coseguro</th>
                         <th>Observ</th>
			</thead>
			<?php
                        $i=0;
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
                                $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
                                   $medic2 = $user->getMedic2();
                                   $class="";
                                   if (($user->status_id==5)   ) 
                                   $class="adjoined-top";
                                   if (($user->status_id==2)  ) 
                                   $class="btn-success";
                                    if (($user->payment_id==1)  ) 
                                   $class="btn-warning";


				?>
				   <tr class="<?php echo $class ?>"  >
                                <td><?php 
                                $i++;
                                echo $i ?></td>    
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				
				<td><?php 
                                if (!empty($user->medic_id) ){
                                      $texto= substr($medic->lastname, 0, 10);
                                         $texto1= substr($medic->name, 0, 1);
                                 echo $texto." ".$texto1.".";
                                 }
                               // echo $medic->id." ".$medic->name." ".$medic->lastname; ?></td>
                                <td><?php echo $estudio->id." ".$estudio->descripcion; ?></td>
                                 <td><?php echo $osocial->id." ".$osocial->nombre; ?></td>
                                
                                 <td><?php echo "$".$user->price." - Bono:".$user->nbono; 
                                 ?></td>

<td style = "text-align: right;"><?php echo "$".$user->observacion_coseguro.",00 "  ; ?></td>
				
		
				<td style="width:130px;">
                                    <a href="index.php?view=view_reservation&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs" title="Ver  Detalle del Turno"><i class="fa fa-edit"></i></a>
                                 <a href="./report/informe-pdf.php?id=<?php echo $user->id;?>" target="_blank"  class="btn btn-primary btn-xs"  title="Imprimir Informe de Atencion"><i class="glyphicon glyphicon-print "></i></a>
			
                                </td>
				</tr>
				<?php 

			}



		}else{
			echo "<p class='alert alert-danger'>No hay citas</p>";
		}


		?>


	</div>
</div>