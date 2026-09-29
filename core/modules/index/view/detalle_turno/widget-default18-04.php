<?php


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$categorias = CategoryData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$medic = $reservation->getMedic();
$paciente = $reservation->getPacient();
$estudio = $reservation->getEstudio();
$osocial = $reservation->getOsocial();

//cambio medic categoria 20 por la tabla tecnos 07/07;
$tecnicos = TecnicoData::getAll();


?>

<script src='res/jquery.min.js'></script>
<div class="sin-json">

  <script type="text/javascript">





  </script>

  <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
  <link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

  <div class="row">
    <div class="col-md-10">
      <br>
      <h2><span class="fa fa-medkit"></span> Registrar atencion Medica</h2>
      <?php

      $osocial_id = $medic_id = $category_id = $estudio_id = "";
      if (isset($_GET["estudio_id"]) && ($_GET["estudio_id"] != ""))
        $estudio_id = $_GET["estudio_id"];
      if (isset($_GET["category_id"]) && ($_GET["category_id"] != ""))
        $category_id = $_GET["category_id"];
      if (isset($_GET["medic_id"]) && ($_GET["medic_id"] != ""))
        $medic_id = $_GET["medic_id"];
      if (isset($_GET["osocial_id"]) && ($_GET["osocial_id"] != ""))
        $osocial_id = $_GET["osocial_id"];
      //$ruta= "&category_id=".$_GET['category_id']."&estudio_id=".$_GET['estudio_id']."&medic_id=".$_GET['medic_id']."&osocial_id=".$_GET['osocial_id'];
      $ruta = "&category_id=" . $category_id . "&estudio_id=" . $estudio_id . "&medic_id=" . $medic_id . "&osocial_id=" . $osocial_id;

      // echo $ruta;
      ?>
      <hr>


      <form class="form-horizontal" role="form" method="post" action="./?action=updatereservation">

        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="./?action=updatereservation<?php echo $ruta; ?>">

          <div class="form-group">
            <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>">

            <div class="col-lg-3">

              <input type="text" name="title" class="hidden" id="inputEmail1" placeholder="Asunto" value="<?php echo $paciente->lastname . " " . $paciente->name;  ?>">
              <input type="text" name="note" required class="hidden" id="inputEmail1" placeholder="Asunto" value="<?php echo $paciente->lastname . " " . $paciente->name;  ?>">


            </div>
          </div>


          <div class="form-group">
            <input type="text" name="caja" class="hidden" id="caja" placeholder="caja" value="<?php echo $reservation->caja;  ?>">

            <div class="col-lg-3">

              <input type="text" name="tipo" class="hidden" id="tipo" placeholder="tipo" value="<?php echo $reservation->tipo;  ?>">


            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha</label>
            <div class="col-lg-3" data-date-format="dd-mm-yyyy">
              <input type="date" name="date_at" required class="form-control" id="datepicker" placeholder="Fecha" value="<?php echo date("Y-m-d", strtotime($reservation->date_at . " "));  ?>" readonly>
            </div>

          </div>


          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Inicio</label>

            <div class="col-lg-2">
              <?php
              //$min=date("i");
              $minutos = date("H:i", strtotime($reservation->time_at . " "));
              // echo $minutos;  
              ?>

              <input type="time" name="time_at" value="<?php echo $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora Inicio" readonly>


            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>

            <div class="col-lg-2">
              <?php
              //$min=date("i");
              $minutos = date("H:i", strtotime($reservation->hora_fin . " "));
              // echo $minutos;  
              ?>

              <input type="time" name="hora_fin" value="<?php echo $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora Fin" readonly>


            </div>
          </div>


          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-male fa-2x"></i>Paciente</label>
            <div class="col-lg-5">

              <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo $paciente->lastname . " " . $paciente->name;  ?>" placeholder="Escriba el nombre del paciente" readonly>

              <input type="hidden" name="pacient_id" id="pacient_id" placeholder="pacient_id" value="<?php echo $paciente->id;  ?>" />

            </div>

          </div>
          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-area-chart"></i> Obra Social</label>
            <div class="col-lg-3">
              <input type="text" name="osocial" required class="form-control" id="osocial" value="<?php echo $osocial->nombre . "" . $osocial->id;  ?>" placeholder="$osocial" readonly>

              <input type="hidden" name="osocial_id" id="osocial_id" placeholder="osocial_id" value="<?php echo $osocial->id; ?>" />

            </div>

          </div>


          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label">Atencion</label>
            <div class="col-md-10">
              <label for="inputEmail1"><i class="fa fa-medkit fa-2x"></i><?php
                                                                          echo $estudio->id . " - " . $estudio->descripcion . " ";
                                                                          /// echo $estudio->id." - ".$estudio->descripcion." ";
                                                                          if (!empty($reservation->estudio2)) {
                                                                            $id2 = $reservation->estudio2;
                                                                            $estudio2 =  EstudioData::getById($id2);;

                                                                            // print_r($estudio2);
                                                                            echo " - Atencion 2: " . $estudio2->id . " - " . $estudio2->descripcion . " ";
                                                                          }
                                                                          if (!empty($reservation->estudio3)) {
                                                                            $estudio3 = $reservation->getEstudio3();
                                                                            echo " - Atencion 3: " . $estudio3->id . " - " . $estudio3->descripcion . " ";
                                                                          }

                                                                          if (!empty($reservation->estudio4)) {
                                                                            $estudio4 = $reservation->getEstudio4();
                                                                            echo " - Atencion 4: " . $estudio4->id . " - " . $estudio4->descripcion . " ";
                                                                          }
                                                                          if (!empty($reservation->estudio5)) {
                                                                            $estudio5 = $reservation->getEstudio5();
                                                                            echo " - Atencion 5: " . $estudio5->id . " - " . $estudio5->descripcion . " ";
                                                                          }




                                                                          ?></label>
            </div>

            <input type="hidden" name="estudio_id" id="estudio_id" placeholder="estudio_id" value="<?php echo $reservation->estudio_id; ?>" />

            <input type="hidden" name="estudio2" id="estudio2" placeholder="estudio2" value="<?php echo $reservation->estudio2; ?>" />

            <input type="hidden" name="estudio3" id="estudio3" placeholder="estudio3" value="<?php echo $reservation->estudio3; ?>" />

            <input type="hidden" name="estudio4" id="estudio4" placeholder="estudio4" value="<?php echo $reservation->estudio4; ?>" />

            <input type="hidden" name="estudio5" id="estudio5" placeholder="estudio5" value="<?php echo $reservation->estudio5; ?>" />


          </div>


          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user-md fa-2x"></i>Profesional</label>
            <div class="col-lg-5">

              <input type="text" name="search-box" required class="form-control" id="search-box" value="<?php echo $medic->lastname . " " . $medic->name;  ?>" placeholder="Escriba el nombre del Profesional" readonly>

              <input type="hidden" name="medic_id" id="medic_id" placeholder="medic_id" value="<?php echo $medic->id;  ?>" />
              <div id="suggesstion-box"></div>
            </div>
          </div>

          <input type="hidden" name="tecnico_id" id="tecnico_id" placeholder="tecnico_id" value="0" />







          <input type="hidden" name="medsoli" id="medsoli" placeholder="medsoli" value="<?php echo $reservation->medsoli;  ?>" />







          <div class="form-group">
            <div class="col-lg-3">
              <input type="hidden" name="payment_id" value="<?php echo $reservation->payment_id; ?>" class="form-control" id="payment_id" placeholder="payment_id">

            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Pago</label>
            <div class="col-lg-3">

              <select name="tipo_pago" id="tipo_pago" class="form-control" style="background: #5cb85c; color: #fff;" required>
                <option value="EFECTIVO" <?php if ($reservation->tipo_pago == "EFECTIVO") {
                                            echo "selected";
                                          }; ?> style="background: #5cb85c; color: #fff;">-- EFECTIVO --</option>
                <option value="DEBITO" <?php if ($reservation->tipo_pago == "DEBITO") {
                                          echo "selected";
                                        }; ?> style="background: #bc0000 ; color: #fff;">-- DEBITO</option>
                <option value="CREDITO" <?php if ($reservation->tipo_pago == "CREDITO") {
                                          echo "selected";
                                        }; ?> style="background: #FF8C00; color: #fff;">-- CREDITO</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
              <div class="col-lg-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" name="price" value="<?php echo $reservation->price; ?>" class="form-control" id="price" placeholder="price" readonly>

                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
              <div class="col-lg-3">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" name="observacion_coseguro" value="<?php echo $reservation->observacion_coseguro; ?>" class="form-control" id="observacion_coseguro" placeholder="observacion_coseguro" readonly>

                </div>
              </div>
            </div>



            <div class="form-group">
              <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-stethoscope fa-2x"></i> Estado</label>

              <div class="col-lg-3">
                <select name="status_id" class="form-control" required>
                  <?php foreach ($statuses as $p) : ?>
                    <option value="<?php echo $p->id; ?>" <?php if ($p->id == 2) echo "selected"; ?>><?php echo $p->name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>




            <tr class="table-success">
              <?php

              $target_dir = "./image/" . $reservation->id . "/";
              if (!empty($reservation->imagen)) {  ?>
                <td>

                  <img src="<?php echo ($target_dir . $reservation->imagen); ?>" width="300" height="300" class="img-responsive" alt="Logo">

                </td>
              <?php  } ?>
              <?php if (!empty($reservation->imagen2)) {  ?>
                <td>

                  <img src="<?php echo ($target_dir . $reservation->imagen2); ?>" width="300" height="300" class="img-responsive" alt="Logo">

                </td>


              <?php  } ?>
              <?php if (!empty($reservation->imagen3)) {  ?>
                <td>

                  <img src="<?php echo ($target_dir . $reservation->imagen3); ?>" width="300" height="300" class="img-responsive" alt="Logo">

                </td>
              <?php  } ?>
              <?php if (!empty($reservation->imagen4)) {  ?>
                <td>

                  <img src="<?php echo ($target_dir . $reservation->imagen4); ?>" width="300" height="300" class="img-responsive" alt="Logo">

                </td>
              <?php  } ?>
              <?php if (!empty($reservation->imagen5)) {  ?>
                <td>

                  <img src="<?php echo ($target_dir . $reservation->imagen5); ?>" width="300" height="300" class="img-responsive" alt="Logo">

                </td>
              <?php  } ?>

          </div>
    </div>
    </tr>
    <br>
    <br>
    <div class="row">
      <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-upload fa-2x"></i> Imagen </label>


        <input type="file" name="fileToUpload[]" id="fileToUpload[]" multiple>
      </div>

    </div>

    <div class="adjoined-top">
      <div class="grid-container">
        <div class="content grid-width-100">
          <h1>Detalle de la Atencion</h1>
          <textarea class="text" rows="4" cols="45" id="detalle" name="detalle" placeholder="Registrar Observacion de la atencion Medica"></textarea>

        </div>
      </div>
    </div>


    <script>
      CKEDITOR.replace('detalle');
    </script>


    <div class="form-group">

      <div class="col-lg-10">

        <input type="hidden" name="sick" id="sick" placeholder="sick" value="ATENCION" />
        <input type="hidden" name="user_informe" id="user_informe" placeholder="user_informe">
        <input type="hidden" name="fecha_informe" id="fecha_informe" placeholder="fecha_informe">

      </div>
    </div>
    <div class="form-group">

      <div class="col-lg-10">
        <textarea class="hidden" name="symtoms" placeholder="Sintomas"></textarea>
      </div>
    </div>
    <div class="form-group">

      <div class="col-lg-10">
        <textarea class="hidden" name="medicaments" placeholder="Medicamentos"></textarea>
      </div>
    </div>


    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
        <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-2x"></i>Registrar la atencion Medica</button>
      </div>
    </div>
    </form>

  </div>
</div>