<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
            <script type="text/javascript">
              
  
  $(document).ready(function(){
    $("#id").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
}); 

     </script>         




<div class="row">
	<div class="col-md-12">

            

		<h1>Turnos</h1>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="buscar_turno">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getProfesionales();
$estudios = EstudioData::getAll();
$obra = OsocialData::getAll();
$categorias = CategoryData::getAll();

 /**PROBLEMA: compré un lector de código de barras en Steren, al conectarlo y escanear un código me abría una nueva pantalla en Chrome típicamente a los downloads. Si se escaneaba de nuevo, ponía el número de captura en la pantalla de downloads.
SOLUCIÓN: el lector manda un último caracter que hace abrir esta pantalla por lo que se debe cambiar la terminación 
  * que manda el lector a la hora de escanear. Lo ideal es ver el instructivo o manual y encontrar el modo 
  * para cambiar la terminación de CR+LF (carriage return + line feed) a sólo CR (pues a mí me funcionó).
  *  Es decir, en el lector de Steren COM595 necesitarás el código que anexo;
  * %7S0+
  * %7S0+
  * 
  *  sólo necesitas imprimirlo y leerlo con el lector. Eso es todo.
   */     ?>

  <div class="form-group">
     
      
     
  <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
 <input type="text" name="id" id="id" class="form-control" placeholder="Ingrese Codigo"  autofocus onmouseover="this.focus();" >
		
		</div>
    </div>
   
         
      
      

    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<h2>Turnos </h2>
</form>

		<?php
               // echo "date_at".$_GET["date_at"];
                
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["id"]))
        && ( $_GET["id"]!="" ) ) {
    
    
$sql = "select * from reservation where id = ".$_GET["id"];





//echo ''.$sql;
		$users = ReservationData::getBySQL($sql);

}else{
		$users= array();
//echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
                            <th>Hora</th>
			<th>Paciente</th>
			<th>Profesional</th>
                        <th>Estudio</th>
                         <th>Obra Social</th>
                         <th>Solicita</th>
                         <th>Coseguro</th>
			  <th>Observ</th>
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
                                    <td><?php echo " ".$user->time_at; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname." - ".$pacient->no; ?></td>
				<td><?php
                                 if (!empty($user->medic_id) )
                                      echo $medic->lastname." ".$medic->name; ?></td>
                                <td><?php echo $estudio->id;//." ".$estudio->descripcion; ?></td>
                                 <td><?php echo $osocial->id." ".$osocial->nombre; ?></td>
                                 <td><?php  
 if (empty($user->medsoli) ) {
   echo $user->medsoli;
}else
                               echo  $medic2->lastname; ?></td>
                                 <td><?php echo "$".$user->price." "  ; ?></td>
                                    <td><?php echo "$".$user->observacion_coseguro." "  ; ?></td>
				
				<td style="width:130px;">
                                    <a href="index.php?view=editreservation&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs" title="Modificar Turno"><i class="fa fa-edit"></i></a>
                                    <a href="./report/turno.php?id=<?php echo $user->id;?>"  class="btn btn-primary btn-xs"  title="Imprimir Turno"><i class="glyphicon glyphicon-print "></i></a>
			            <?php  
                                    if (empty($user->cierre) ) {
                                      ?>
                                    
                                    <a  href="./?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs" title="Anular Turno" onclick="return confirm(' \n \n Estás seguro que deseas anular  el turno? \n Al confirmar se devolvera el monto del coseguro \n');"   ><i class="fa fa-trash"></i></a>
                            	   <?php  
                                   } else{
			echo "<p class='btn btn-danger btn-xs' title='Registro Bloquedo al ser parte de un cierre'><i class='fa fa-ban'></i></p>";
		}
                                      ?>
                                </td>
                                
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes con turnos</p>";
		}


		?>


	</div>
</div>