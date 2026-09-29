<div class="row">
	<div class="col-md-12">
            
             <h2><span class="fa fa-bar-chart"></span> Reportes</h2>

<br>
<div class="panel-heading">
<a href="./report/caja-xls.php" class="btn btn-success btn-xs pull-right"><i class="fa fa-download"> DESCARGAR Caja Diaria</i></a>
			</div>
          
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reports">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
        ?>

  <div class="form-group">

  
   
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">INICIO</span>
		  <input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">FIN</span>
		  <input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
 <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
<select name="medic_id" class="form-control">
<option value="">PROFESIONAL</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->lastname." - ".$p->name." ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
  </div>
  <div class="form-group">

   
   
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar</button>
    </div>

  </div>
</form>

		<?php
$users= array();
if((  isset($_GET["medic_id"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ( $_GET["medic_id"]!="" || $_GET["start_at"]!="" ||  $_GET["finish_at"]!="")  ) {
$sql = "select * from reservation where ";
if($_GET["medic_id"]!=""){
	$sql .= " medic_id = ".$_GET["medic_id"];
}




if($_GET["start_at"]!=""  || $_GET["finish_at"]){
    
    if($_GET["start_at"]==""  ){
        $_GET["start_at"]=date("Y-m-d");
   }
    if($_GET["finish_at"]==""  ){
        $_GET["finish_at"]=date("Y-m-d");
   }
    
    if($_GET["medic_id"]!=""  ){
            $sql .= " and ";
    }
  //echo " <BR> SSS".$sql;
	$sql .= " ( date_at >= \"".$_GET["start_at"]."\" and date_at <= \"".$_GET["finish_at"]."\" ) ";
}


$sql .= " AND status_id !=4 "; // sacar a los cancelados

 //echo " <BR>".$sql;

		$users = ReservationData::getBySQL($sql);

}else{
   // echo $sql;
		$users = ReservationData::getAllToday();

}
		if(count($users)>0){
			// si hay usuarios
			$_SESSION["report_data"] = $users;
			?>
			
			<div class="panel-heading">
			<a href="./report/report-xls.php" class="btn btn-primary btn-xs pull-left"><i class="fa fa-download"> DESCARGAR LA BUSQUEDA REALIZADA</i></a>
			</div>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Fecha</th>
			<th>Paciente</th>
			<th>Estudio</th>
			
                        <th>OS</th>
                      
			
			<th>Coseguro</th>
			<th>Observacion</th>
			</thead>
			<?php
			$total = 0;
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
                                 $estudio = $user->getEstudio();
                                  $osocial = $user->getOsocial();
                                   //$medic2 = $user->getMedic2();
				?>
				<tr>
                                    <td><?php echo $user->time_at; ?></td>
                                    <td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				 <td><?php  
                                  if (!empty($user->estudio_id) ){
                                        $texto= substr($estudio->descripcion, 0, 20);
                                 echo $estudio->id." ".$texto.""; 
                                  }
                                     
                                 
                                 
                                  ?></td>
				  <td><?php 
                                   if (!empty($user->osocial_id) )
                                       $texto= substr($osocial->nombre, 0, 6);
                                 echo $texto." bono:".$user->id; 
                                //  echo $osocial->id." ".$osocial->nombre; ?></td>
				
				
                                
                               
				
                                <td>$ <?php
                                if (!empty($user->price) )
                                echo number_format($user->price,2,",",".");?></td>
				<td>$ <?php 
                                if (!empty($user->observacion_coseguro) )
                                echo number_format($user->observacion_coseguro,2,",",".");?></td>
				
				</tr>
				<?php
				$total += $user->price;

			}
			echo "</table>";
			?>
			<div class="panel-body">
			<h1>Total: $ <?php echo number_format($total,2,",",".");?></h1>
			</div>
			<?php



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>
    
    </div>