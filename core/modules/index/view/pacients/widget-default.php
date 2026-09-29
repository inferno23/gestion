<br>
<form class="form-horizontal" role="form">
  <input type="hidden" name="view" value="pacients">
  <div class="form-group">
    <div class="col-lg-5">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
        <input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
                                              echo $_GET["q"];
                                            } ?>" class="form-control" placeholder="Burcar por Apellido o Nombre o DNI sin puntos solo numeros">
      </div>
    </div>
</div>
  <div class="form-group">
<div class="col-lg-6">
      <button class="btn btn-primary btn-block">Procesar Busqueda</button>
    </div>
</div>
</form>

<?php
$users = array();

//echo $_GET["estudio_id"];
if ((isset($_GET["q"]))) {

  //echo $sql;
  $cadena = $_GET["q"];
  $palabra1 = $palabra2 = $palabra3 = '';
  // list($palabra1, $palabra2, $palabra3) = explode(' ', $cadena);

  $lines = explode(' ', $cadena);

  $num = count($lines);
  if ($num == 1) {
    list($palabra1) = explode(' ', $cadena);
    $palabra2 = $palabra3 = $palabra1;
  }

  if ($num == 2) {
    list($palabra1, $palabra2) = explode(' ', $cadena);
    $palabra3 = $palabra1;
  }

  if ($num == 3) {
    list($palabra1, $palabra2, $palabra3) = explode(' ', $cadena);
  }
  //    echo $num . '<br>';
  //echo $palabra1 . '<br>';

  //echo $palabra2 . '<br>';
  //echo $palabra3 . '<br>';

  $users = PacientData::getLike2($palabra1, $palabra2, $palabra3);
} else {
  //$users = PacientData::getAll();
  $sql = "select * from pacient order by lastname,name limit 0,300 ";
  //echo $sql;
  $users = ReservationData::getBySQL($sql);
}

?>

<div class="row">
  <div class="col-md-12">
    <div class="btn-group pull-right">
      <a href="index.php?view=newpacient" class="btn btn-primary"><i class='fa fa-male'></i> + Nuevo Paciente</a>
      <!-- error de excel -->
      <!--a href="./report/pacientes-xls.php?q=<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
                                                  echo $_GET["q"];
                                                } ?>" target="_blank" class="btn btn-success"  title="Descargar  xls  de los Registros de Pacientes"><i class="fa fa-file-excel-o"></i> Excel Pacientes</a-->

    </div>

    <h2><span class="glyphicon glyphicon-user"></span> Pacientes</h2>
    <br>
    <?php

    //$users = PacientData::getAll();
    if (count($users) > 0) {
      // si hay usuarios
    ?>

      <table class="table table-bordered table-hover">
        <thead>
          <th>Nombre completo</th>
          <th>Obra Social</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>Email</th>
          <th></th>
        </thead>
        <?php
        foreach ($users as $user) {

          // print_r($user);
          if (!empty($user->osocial_id))
            $osocial = $user->getOsocial();
        ?>
          <tr>
            <td><?php
                // echo utf8_encode($user->lastname);
                echo $user->lastname . ", " . $user->name . " - " . $user->no; ?>
            </td>

            <td><?php
                if (!empty($user->osocial_id)) {
                  echo $osocial->nombre;
                } else
                  $user->osocial_id
                ?></td>
            <td><?php echo $user->address; ?></td>

            <td><?php echo $user->phone; ?></td>
            <td><?php echo $user->email; ?></td>
            <td style="width:200px;">
              <a href="index.php?view=turnopaciente&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs"> turno</a>
              <a href="index.php?view=turno_consultorio2&category_id=7&estudio_id=108&id=<?php echo $user->id; ?>" class="btn btn-success btn-xs"> turno Consultorio</a>
              <a href="index.php?view=editpacient&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar</a>
              <a href="index.php?view=pacienthistory&id=<?php echo $user->id; ?>" class="btn btn-default btn-xs">Historial</a>

            </td>
          </tr>
      <?php
          /** <a href="index.php?view=delpacient&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>  */
        }
      } else {
        echo "<p class='alert alert-danger'>No hay pacientes</p>";
      }
      ?>
  </div>
</div>