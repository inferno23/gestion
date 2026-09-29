<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

?>

<link href='res/fullcalendar.min.css' rel='stylesheet' />
<link href='res/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='res/js/moment.min.js'></script>
<script src='res/fullcalendar.min.js'></script>

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






<div class="row">
  <div class="col-md-12">
    <h1>Agenda de Turnos <?php echo $_GET["date_at"]; ?></h1>



    <form id="order_form" class="form-horizontal" role="form">
      <input type="hidden" name="view" value="agenda">



      <?php
      $pacients = PacientData::getAll();
     // $medics = MedicData::getProfesionales();
      $estudios = EstudioData::getAll();
      $obra = OsocialData::getAll();
      $categorias = CategoryData::getAll();

      $feriados = FeriadosData::getAll();
      $medicos_asociado  = "";
      $u = UserData::getById(Session::getUID());
      //  print_r($u);

      //  echo "essss:". $u->id;
      if ($u->is_admin==10){
        $medics = MedicData::getProfesionales();
      }else{

           
            $UserMedic=UserMedicData::getAllByUser($u->id);

           // print_r($UserMedic);
            foreach ($UserMedic as $medico){
              //echo $medico->id;
                 $medicos_asociado =  $medico->idMedic.','.$medicos_asociado;
            }
            
            $medicos_asociado = substr($medicos_asociado, 0, -1);
           
           $sql = "select * FROM medic WHERE id IN ($medicos_asociado) ORDER BY id DESC";
          // echo $sql;
           
           $medics = MedicData::getBySQL($sql);
            //print_r($medics);

          }
      ?>

      <div class="form-group">



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
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-recycle"></i></span>
            <select name="estudio_id" id="estudio_id" class="form-control">
              <option value="">Atenciones</option>
              <?php
              if ($_GET["category_id"] != "") {
                $estudios = EstudioData::getByCategory($_GET["category_id"]);

                $medics = MedicData::getProfesionalesByArea($_GET["category_id"]);
              }


              foreach ($estudios as $p) : ?>
                <option value="<?php echo $p->id; ?>" <?php if (isset($_GET["estudio_id"]) && $_GET["estudio_id"] == $p->id) {
                                                        echo "selected";
                                                      } ?>><?php echo $p->descripcion . " - " . $p->id . " "; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
            <select name="medic_id" id="medic_id" class="form-control">
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
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="date" name="date_at" id="date_at" value="<?php
                                                                  if (isset($_GET["date_at"]) && $_GET["date_at"] != "") {
                                                                    echo $_GET["date_at"];
                                                                  } else
                                                                    echo date("Y-m-d");


                                                                  //  echo date("Y-m-d",strtotime(" - 3 day"));
                                                                  ?>" class="form-control" placeholder="Palabra clave">
          </div>
        </div>
        <br> <br>
        <div class="col-lg-1">
          <button class="btn btn-primary btn-block">Buscar</button>
        </div>

      </div>

      <h2>Turnos </h2>
      <?php

      $thejson = array();
      if (($_GET["category_id"] != "" || $_GET["estudio_id"] != ""  || $_GET["medic_id"] != ""  || $_GET["date_at"] != "")) {


        $sql = "select * from reservation where ";



        if ((isset($_GET["date_at"]) && ($_GET["date_at"] != ""))) {

          //echo $_GET["date_at"];
          $desde = date("Y-m-d", strtotime($_GET["date_at"] . "- 7 day "));
          $sql .= " date_at >= \"" . $desde . "\"";
        } else {

          $desde = date("Y-m-d", strtotime("- 7 day "));
          $sql .= " date_at >= \"" . $desde . "\"";
        }
        if ($_GET["category_id"] != "" && $_GET["category_id"] > 0) {


          $sql .= " AND category_id = " . $_GET["category_id"];
          //  echo ''.$sql;
        }




        if ($_GET["estudio_id"] != "") {


          $sql .= " AND estudio_id = " . $_GET["estudio_id"];
          //  echo ''.$sql;
        }



        if ($_GET["osocial_id"] != "") {


          $sql .= " AND osocial_id = \"" . $_GET["osocial_id"] . "\"";
        }


        if ($_GET["medic_id"] != "") {
          $medic_id=$_GET["medic_id"];

          $sql .= " AND medic_id = " . $_GET["medic_id"];
        }


// 10 super admin

if ($u->is_admin !=10){
         

          
  $sql .= " AND medic_id IN ($medicos_asociado) ";

}


        $sql .= " AND status_id !=4  order by date_at,STR_TO_DATE(time_at,'%H:%i')";
        //$sql .= " order by date_at,STR_TO_DATE(time_at,'%H:%i')";
        //echo ''.$sql;
        $events = ReservationData::getBySQL($sql);
      } else {
        //echo '$eventsv   nada';
        $events = ReservationData::getEvery();
      }
      //$events = ReservationData::getEvery();
      echo '<br> cantidad de registros;';
      print_r(count($events));
      echo '<br>';


      foreach ($events as $event) {
        //$desde= date("H:i",strtotime(" 1500"));

        $desde = date("H:i", strtotime($event->time_at . " "));
        // $final= date("H:i",strtotime(" + $min min "));
        //if($event->status_id == 4)
        //$event->title = "CANCELADO - ".$event->title;

        $color = "rgba(255, 99, 132, 0.2)";
        if ($event->medic_id == 3) {
          $color = "rgba(22,160,133, 0.2)";
        }
        if ($event->medic_id == 5) {
          $color = "rgba(255, 205, 86, 0.2)";
        }
        if ($event->medic_id == 6) {
          $color = "rgba(51,105,232, 0.2)";
        }
        if ($event->medic_id == 8) {
          $color = "rgba(244,67,54, 0.2)";
        }
        if ($event->medic_id == 10) {
          $color = "rgba(244,67,54, 0.2)";
        }
        if ($event->medic_id == 11) {
          $color = "rgba(34,198,246, 0.2)";
        }
        if ($event->medic_id == 12) {
          $color = "rgba(153, 102, 255, 0.2)";
        }
/// agrego hora final 02/02/2022
        $final =   date("H:i", strtotime($desde . " +30 minute"));

       if(!empty($event->hora_fin)){
           $final = date("H:i", strtotime($event->hora_fin . " "));
         //  echo '<br> $event->hora_fin'.$event->hora_fin.'<br> $event->hora_fin';

      }
 
       // $fecha_fin = date("H:i", strtotime($event->fecha_fin . " "));

       // $final =   date("H:i", strtotime($desde . " +20 minute"));





        $titulo = mb_convert_encoding($event->title, 'UTF-8', 'ISO-8859-1'); /// problemas al no cerarr el ene en el titulo
        $thejson[] = array("color" => $color, "title" => $titulo, "start" => $event->date_at . "T" . $event->time_at,"end" => $event->date_at . "T" . $final, "url" => "?view=editreservation&id=" . $event->id);

        //$thejson[] = array("title"=>$event->title,"url"=>"./?view=view_reservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at ,"end"=>$event->date_at."T".$final);
        //echo $event->id.'---';

        ///echo '<br>';
        //print_r(json_encode($thejson));
      }
      foreach ($feriados as $feriado) {
        $color = "red";
        $titulo = mb_convert_encoding($feriado->des, 'UTF-8', 'ISO-8859-1'); /// problemas al no cerarr el ene en el titulo
        $thejson[] = array("color" => $color, "title" => $titulo, "start" => $feriado->fecha . "T09:00", "end" => $feriado->fecha . "T20:00");
      }

      //print_r(count($thejson));
      //print_r ($thejson);


      //echo json_encode($thejson);
      ?>
    </form>

    <script>
      var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

        for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
          }
        }
        return 0;
      };

      var date_at = getUrlParameter('date_at');



      console.log(date_at);
      $(document).ready(function() {

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          defaultDate: moment(date_at),
          titleRangeSeparator: ' \u2014 ', // emphasized dash
          defaultTimedEventDuration: '00:30:00',
          forceEventDuration: true,
          hiddenDays: [0], // Sunday=0  ,,[ 2, 4 ]hide Tuesdays and Thursdays
          //defaultDate: today,
          defaultView: 'agendaWeek', // 'basicDay',agendaWeek,agendaDay
          editable: false, ///true
          eventLimit: true, // allow "more" link when too many events
          minTime: "09:00:00",
          maxTime: "20:00:00",
          axisFormat: 'H:mm',
          timezone: 'local',
          titleFormat: 'DD/MM YYYY',
          columnFormat: 'dddd D/M',
          timeFormat: 'H:mm', // uppercase H for 24-hour clock,
          allDaySlot: false,
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNameShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          eventTextColor: 'black',
          buttonText: {
            today: 'hoy',
            month: 'mes',
            week: 'semana',
            day: 'dia'

          },
          selectable: true,
          eventRender: function(event, element) {
            element.attr('title', event.tip);
          },
          select: function(start, end, jsEvent, view) {
            date_at = moment(start).format('YYYY-MM-DD');
            time_at = moment(start).format('HH:mm');
            //25/02/22 envio medic_id
            medic_id= $("#medic_id").val()  ;

            //  var abc = prompt('Esta por crear un turno el dia '+date_at+' a las'+time_at);

            window.location.href = "./index.php?view=newreservation&category_id&estudio_id=&medic_id=" + medic_id + "&date_at=" + date_at + "&time_at=" + time_at + "&osocial_id=";

            //    var allDay = !start.hasTime && !end.hasTime;
            //     var newEvent = new Object();
            //    newEvent.title = abc;
            //     newEvent.start = moment(start).format();
            //    newEvent.allDay = false;
            // $('#calendar').fullCalendar('renderEvent', newEvent);

          },
          events: <?php

                  echo json_encode($thejson); ?>

        });

      });
    </script>

    <style>
      body .fc {
        font-size: 1em;

      }

      body .fc td {
        height: 78px !important;
      }
    </style>
    <div id="calendar" style="width:98%;height:95%"></div>

    <br><br>
  </div>
</div>