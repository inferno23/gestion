<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

?>
<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<script src='res/jquery.min.js'></script>
<div class="sin-json">

  <script type="text/javascript">
    $(document).ready(function() {
      $("#date_at").change(function() {
        //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');

      });
    });



    $(document).ready(function() {
      $("#osocial_id").change(function() {
        //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');

      });
    });





    $(document).ready(function() {
      $("#estudio_id").change(function() {
        //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');

      });
    });

    $(document).ready(function() {
      $("#medic_id").change(function() {
        //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');

      });
    });

    $(document).ready(function() {
      $("#category_id").change(function() {
        //alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');

      });
    });

    //////////////////////////////
    $(document).ready(function() {
      $("#category_id").change(function() {
        //alert ($(this).val()); 

        //alert ("modelos.php");
        $("#category_id option:selected").each(function() {
          elegido = $("#category_id").val();
          // alert (elegido);
          elegido = $(this).val();
          $('#order_form').submit();
          $.post("./core/modules/index/action/buscarestudio/action-default.php", {
              elegido: elegido
            }, function(data) {
              $("#estudio_id").html(data);
              //alert (data);
            })



            .fail(function(xhr, textStatus, errorThrown) {
              alert(xhr.status);
              alert(xhr.readyState);
              alert(xhr.status);
              alert(errorThrown);
              alert(textStatus);
              alert(xhr.responseText);
            });
        });
      })
    });
  </script>


  <style>
    .class1 {
      background-color: #ffa483
    }

    .class2 {
      background-color: #f593f1
    }
  </style>

  <div class="row"><br>
    <div class="col-md-12">

      <div class="btn-group pull-right">

        <?php
        $u = null;
        $categoria_id = "";
        $medicos_asociado  = "";
        
          $medics = MedicData::getProfesionales();
        

        $u = UserData::getById(Session::getUID());
        //  print_r($u);

        

        
        ?>

        <a href="index.php?view=newreservation&volver=reservations&date_at=<?php echo $_GET["date_at"];  ?>&category_id=&estudio_id=&medic_id=<?php echo $_GET["medic_id"];  ?>" class="btn btn-success"><i class="fa fa-plus-square"></i> Generar Nuevo Caso</a>
        <!-- a target="_blank" href="./report/listadosturnos-pdf.php?date_at=<?php echo $_GET["date_at"];  ?>&category_id=<?php echo $categoria_id;  ?>&estudio_id=<?php echo $_GET["estudio_id"];  ?>&medic_id=<?php echo $_GET["medic_id"];  ?>&osocial_id=<?php echo $_GET["osocial_id"];  ?>" class="btn btn-primary" title="Imprimir Turno"><i class="glyphicon glyphicon-print fa-1x"> Imprimir Busqueda</i></a -->

      </div>


      <h1>Casos</h1>
      <br>
      <form id="order_form" class="form-horizontal" role="form">
        <input type="hidden" name="view" value="reservations">
        <?php
        $pacients = PacientData::getAll();

        $estudios = EstudioData::getAll();
        $obra = OsocialData::getAll();
        $categorias = CategoryData::getAll();
        $tecnicos = TecnicoData::getAll();
        //echo "date_at".$_GET["date_at"];
        ?>

        <div class="form-group">
          <div class="col-lg-2">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="date" name="date_at" id="date_at" value="<?php
                                                                    if (isset($_GET["date_at"]) && $_GET["date_at"] != "") {
                                                                      echo $_GET["date_at"];
                                                                    } else
                                                                      echo date("Y-m-d");


                                                                    //  echo date("Y-m-d",strtotime(" - 3 day"));
                                                                    ?>" class="form-control" placeholder="Palabra clave" min="<?php echo date("Y-m-d", strtotime(" - 330 days"));  ?>">
            </div>
          </div>


          <div class="hidden">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Categoria -</option>
                <?php foreach ($categorias as $p) : ?>
                  <option value="<?php echo $p->id; ?>" <?php if ($p->id == $_GET["category_id"]) {
                                                          echo "selected";
                                                        } ?>><?php echo $p->name . " - " . $p->id; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-lg-3 btn-success">
            <div class="input-group">
              <span class="input-group-addon "><i class="fa fa-user"></i></span>
              <input type="text" name="paciente" maxlength="80" size="80"  class="col-lg-3 form-control" id="paciente" placeholder="Escriba el apellido del cliente">
	
            </div>
          </div>
          <div class="col-lg-3">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
              <select name="medic_id" id="medic_id" class="form-control" >
                <option value="">Profesional</option>
                <?php foreach ($medics as $p) : ?>
                  <option value="<?php echo $p->id; ?>" <?php if (isset($_GET["medic_id"]) && $_GET["medic_id"] == $p->id) {
                                                          echo "selected";
                                                        } ?>><?php echo $p->lastname . " " . $p->name . " " . $p->id; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>


          <div class="hidden">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
              <select name="osocial_id" id="osocial_id" class="form-control">
                <option value="">-- Obra Social-</option>
                <?php foreach ($obra as $p) : ?>
                  <option value="<?php echo $p->id; ?>" <?php if (isset($_GET["osocial_id"]) && $_GET["osocial_id"] == $p->id) {
                                                          echo "selected";
                                                        } ?>><?php echo $p->nombre . " - " . $p->id; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>




          <div class="col-lg-3">
            <button class="btn btn-primary btn-block">Buscar</button>
          </div>

        </div>

        <h2>Casos <?php
                    if (isset($_GET["date_at"]) && $_GET["date_at"] != "") {
                      //echo $_GET["date_at"]; 
                      echo  " del " . date("d/m/Y", strtotime($_GET["date_at"] . ""));
                    } else
                      echo  " desde el " . date("d/m/Y", strtotime(" - 5 days"))
                    ?></h2>
      </form>

      <?php
      // echo "date_at".$_GET["date_at"];

      $users = array();
      //if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
      if ((isset($_GET["date_at"]))
        && ($categoria_id != ""
          || $_GET["medic_id"] != "" || $_GET["date_at"] != "" || $_GET["osocial_id"] != "")
      ) {


        $sql = "select * from reservation where ";

        if ($_GET["date_at"] != "") {


          $sql .= " date_at <= \"" . $_GET["date_at"] . "\"";
         // date("d/m/Y", strtotime(" - 5 days"))

          
        } else {
          $sql .= " date_at <= \"" . date("Y-m-d") . "\"";
        }



        if (isset($_GET["paciente"])  && $_GET["paciente"] != "") {


          $sql .= " AND title LIKE '%" . $_GET["paciente"]. "%'";
          //  echo ''.$sql;
        }


        if ($categoria_id != "") {
          if ($categoria_id == "217" || $categoria_id == "219") {
            $categoria_id = 21;
          }

          $sql .= " AND category_id = " . $categoria_id;
          //  echo ''.$sql;
        }


        if (isset($_GET["estudio_id"])  && $_GET["estudio_id"] != "") {


          $sql .= " AND estudio_id = " . $_GET["estudio_id"];
          //  echo ''.$sql;
        }

        if (isset($_GET["osocial_id"])  && $_GET["osocial_id"] != "") {


          $sql .= " AND osocial_id = \"" . $_GET["osocial_id"] . "\"";
        }


        if (isset($_GET["medic_id"])  && $_GET["medic_id"] != "") {


          $sql .= " AND medic_id = " . $_GET["medic_id"];
        }



        if (isset($_GET["tecnico_id"])  && $_GET["tecnico_id"] != "") {
          $sql .= " AND tecnico_id = " . $_GET["tecnico_id"];
        }


        // 10 super admin

        if ($u->is_admin == 5) {



          $sql .= " AND (medic_id = $u->id OR  medsoli = $u->id)  ";
        }

        if ($u->is_admin == 1) {



          $sql .= " AND (  tecnico_id = $u->id    )  ";
        }


        $sql .= " AND status_id !=4  order by id desc";
        //STR_TO_DATE(time_at,'%H:%i')
        //echo ''.$sql;


       // echo '<br>'.$sql;

        $users = ReservationData::getBySQL($sql);

       
      } else {
        //$sql = "select * from reservation where  date_at = \"".date("Y-m-d")."\" order by date_at,STR_TO_DATE(time_at,'%H:%i') Desc limit 0,500  ";
        //		echo ''.$sql;
        // $users = ReservationData::getBySQL($sql);
        $users = ReservationData::getAll();
      }
      if (count($users) > 0) {
        // si hay usuarios
      ?>
        <table class="table table-bordered table-hover">
          <thead>
            <th>Hora</th>
            <th>Cliente</th>
            <th>Contraparte</th>
            <th>Tramites</th>
            <th>Detalle</th>

            
            <th></th>
          </thead>
          <?php
          $j = 0;
          foreach ($users as $user) {
            $pacient  = $user->getPacient();
            $medic = $user->getMedic();
            $estudio = $user->getEstudio();
            $osocial = $user->getOsocial();
            if (!empty($user->medsoli))
              $medic2 = $user->getMedic2();

            $class = "";

            if (($user->status_id == 6))
              $class = "class2";

            if (($user->status_id == 5))
              $class = "adjoined-top";
            if (($user->status_id == 4))
              $class = "btn-danger";


            if (($user->status_id == 3))
              $class = "class1";
            if (($user->status_id == 2))
              $class = "btn-success";
            if (($user->payment_id == 1))
              $class = "btn-warning";
            $j++;

          ?>
            <tr class="<?php echo $class ?>">
              <td><?php echo $j . "- " . $user->time_at; ?></td>
              <td><?php
                  if (!empty($pacient->name)) {
                    $texto = substr($pacient->lastname, 0, 10);
                    $texto1 = substr($pacient->name, 0, 8);
                    echo $texto . " " . $texto1 . ". - " . $pacient->no . ". - Telf:" . $pacient->phone . ". - " . $pacient->email;

                    // echo $texto." ".$texto1.". - ".$pacient->no;
                  }
                  // echo $pacient->name." ".$pacient->lastname." - ".$pacient->no; 
                  ?></td>
              <td><?php
                  if (!empty($user->osocial_id)) {
                    $texto = substr($osocial->id, 0, 3);
                    $texto1 = substr($osocial->nombre, 0, 15);
                    
                      echo $texto . " " . $texto1 . ".";
                  }

                  //echo $medic->lastname." ".$medic->name; 
                  ?></td>
              <td><?php echo $estudio->id." ".$estudio->descripcion; 
                  ?></td>
              <td><?php
              if (!empty($user->detalle)) {
                  echo html_entity_decode(substr($user->detalle, 0, 56));
                  //$texto = substr($osocial->nombre, 0, 6);
                  //echo $texto . " B:" . $user->id; 
                  echo  " ... Mas en ver Informacion " ; 

                }
               
                  ?></td>

             
              <td style="width:130px;">
              <a href="index.php?view=editreservation&volver=reservations&id=<?php echo $user->id; ?>" class="btn btn-primary btn-xs fa-lg" title="Modificar Caso"><i class="fa fa-edit"></i>Registar detalle dia</a>
                                                <a href="index.php?view=view_turno&id=<?php echo $user->id; ?>" class="btn btn-success btn-xs fa-lg " title="Ver detalles del Caso"><i class="fa fa-eye"></i>Ver Informacion</a>
                                              
                                                <a href="./?action=delreservation&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs fa-lg" title="Anular Turno" onclick="return confirm(' \n \n Estas seguro que deseas anular  el turno? \n <b>Al confirmar se eliminara todo registro</b> \n');"><i class="fa fa-trash"></i>Eliminar</a>


              </td>

            </tr>
        <?php

          }
        } else {
          echo "<p class='alert alert-danger'>No hay Casos con los filtros seleccionados. Por favor vuelva a intentar con otros filtros </p>";
          // echo "<br>category_id <br>.".$categoria_id;
        }


        ?>


    </div>
  </div>