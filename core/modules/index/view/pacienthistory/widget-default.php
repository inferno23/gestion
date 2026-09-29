<?php
$pacient = PacientData::getById($_GET["id"]);
?>
<div class="row">
        <div class="col-md-12">
                <div class="btn-group pull-right">
                        <div class="btn-group pull-right">
                        <a href="index.php?view=turno_consultorio2&category_id=7&estudio_id=108&id=<?php echo $pacient->id; ?>" class="btn btn-success btn-xs"> +Generar un Nuevo caso al cliente</a>

                        </div>
                              
    
 
                       

   </div>
   <br>
<br>
   <div class="btn-group pull-right">
  
  <?php  

   
$target_dir = "./image/cliente/".$pacient->id."/";
   if (!empty($pacient->image))  {  ?>

    
    <img class="img-responsive" width="350" height="600" src="<?php echo ($target_dir.$pacient->image); ?>" 
    alt="<?php  echo ($pacient->image); ?>" >


<?php  } ?>  
   </div>
  

                
                <h1>Historial de Casos del Cliente</h1>
                
              
         
    
<h1><span class="label label-primary"><i class="fa fa-user" aria-hidden="true"></i> </i>
 <?php echo " - ".$pacient->name." ".$pacient->lastname; ?>
 <?php echo " - Dni/CUIL:".$pacient->no." - Telf:".$pacient->phone; ?> 
</span>
 </h1>



 <h1><i class="" aria-hidden="true"></i><span class="label label-primary">  </i>
 
 <?php echo " Fijo:".$pacient->telefono_fijo." - ".$pacient->email; ?>
 
</span>
 </h1>

 <h1><i class="" aria-hidden="true"></i><span class="label label-primary">  </i>
 
 <?php echo " CP: ".$pacient->codigo_postal." - ".$pacient->address; ?>
 <?php echo " - ".$pacient->localidad." - ".$pacient->provincia; ?>
</span>
 </h1>
              
 
<<br></br>
          
              
              
              
                <br>
                <?php
                $id=$_GET["id"];
                $u = UserData::getById(Session::getUID());
               // $users = ReservationData::getAllByPacientId($_GET["id"]);
                $sql = "select * from reservation where  pacient_id=".$id;
                if ($u->is_admin != 10) {
                

                        

                        $sql .= " AND (medic_id IN ($u->id)  OR  medsoli IN ($u->id) OR  tecnico_id IN ($u->id)    )  ";
                 }
                 $sql .= " order by id desc";
                        
                 $users = ReservationData::getBySQL($sql);
         
                // echo '<br>'.$sql;

                if (count($users) > 0) {
                        $_SESSION["report_paciente"] = $users;
                ?>
                        <table class="table table-bordered table-hover">
                                <thead>
                                      
                                        <th>Fecha</th>
                                        <th>Profesional</th>
                                        <th>Tramite</th>
                                        <th>Contraparte</th>
                                        <th>Detalle</th>
                                        <th>Acciones</th>
                                        
                                </thead>
                                <?php
                                $i = 0;
                                foreach ($users as $user) {
                                        $pacient  = $user->getPacient();
                                        $medic = $user->getMedic();
                                        $estudio = $user->getEstudio();
                                        $osocial = $user->getOsocial();
                                        $medic2 = $user->getMedic2();
                                        $categoria = $user->getCategory();
                                        $class = "btn-warning";

                                        /**
                                        if (($user->status_id == 5))
                                                $class = "adjoined-top";
                                                
                                        if (($user->status_id == 1))
                                                $class = "btn-success";
                                        if (($user->status_id == 1))
                                                $class = "btn-warning";
                                        if (($user->status_id == 3))
                                                $class = "btn-info";
                                        if (($user->status_id == 4))
                                                $class = "btn-danger";
                                                */


                                ?>
                                        <tr class="<?php echo $class ?>">
                                                
                                                <td><?php echo $user->date_at ; ?></td>

                                                <td><?php
                                                        if (!empty($user->medic_id)) {
                                                                $texto = substr($medic->lastname, 0, 10);
                                                                $texto1 = substr($medic->name, 0, 7);
                                                                echo $texto . " " . $texto1 . ".";
                                                        }
                                                        // echo $medic->id." ".$medic->name." ".$medic->lastname; 
                                                        ?></td>
                                                <td><?php echo " ".$categoria->name." - ".$estudio->descripcion . "(" . $estudio->id. ")"; ?></td>
                                                <td><?php echo $osocial->id . " " . $osocial->nombre; ?></td>

                                               
                                                <td>
                                                        <?php echo html_entity_decode($user->detalle); ?>
                                                </td>
                                                <td style="width:130px;">
                                                      
                                              
                                                <a href="index.php?view=editreservation&volver=reservations&id=<?php echo $user->id; ?>" class="btn btn-primary btn-xs fa-lg" title="Modificar Caso"><i class="fa fa-edit"></i>Registar detalle dia</a>
                                                <a href="index.php?view=view_turno&id=<?php echo $user->id; ?>" class="btn btn-success btn-xs fa-lg " title="Ver detalles del Caso"><i class="fa fa-eye"></i>Ver Informacion</a>

                                        </td>
                                        </tr>
                        <?php

                                }
                        } else {
                                echo "<p class='alert alert-danger'>No hay casos registrados al cliente</p>";
                        }


                        ?>


        </div>
</div>
<div class="hidden">
        <div class="hidden">
                <div class="btn-group pull-right">
                        <div class="btn-group pull-right">


                        </div>

                </div>
                <h2>Detalle de atenciones</h2>

                <?php
                $users = ReservationData::getAllByPacientId($_GET["id"]);
                if (count($users) > 0) {
                        $_SESSION["report_paciente"] = $users;
                ?>
                        <table class="hidden">
                                <thead>
                                        <th>Fecha</th>
                                        <th>Tramite</th>
                                        <th>Detalle</th>

                                </thead>
                                <?php
                                $i = 0;
                                foreach ($users as $user) {
                                        $estudio = $user->getEstudio();
                                ?>
                                        <tr class="<?php echo $class ?>">
                                                <td><?php echo $user->date_at . " " . $user->time_at; ?></td>
                                                <td><?php echo $estudio->descripcion; ?></td>
                                                <td>
                                                        <?php echo html_entity_decode($user->detalle); ?>
                                                </td>

                                        </tr>
                        <?php

                                }
                        } else {
                                echo "<p class='alert alert-danger'>No hay citas</p>";
                        }


                        ?>


        </div>
</div>