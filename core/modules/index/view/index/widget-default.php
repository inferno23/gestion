<?php


//print_r(count($events));
foreach($events as $event){
   
	$thejson[] = array("title"=>$event->title,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at);

}
 //print_r(($thejson));
 //print_r(json_encode($thejson));
 
/// $thejson =[{"title":"Vaca","url":".\/?view=editreservation&id=1979","start":"2016-10-17T9:00"},{"title":"Barahona","url":".\/?view=editreservation&id=2025","start":"2016-10-17T9:10"},{"title":"Alderete","url":".\/?view=editreservation&id=2371","start":"2016-10-19T9:10"},{"title":"Mendez","url":".\/?view=editreservation&id=4279","start":"2016-10-19T19:00"},{"title":"Poeta","url":".\/?view=editreservation&id=2256","start":"2016-10-20T9:30"},{"title":"Rojas","url":".\/?view=editreservation&id=2819","start":"2016-10-24T9:00"},{"title":"Vilca","url":".\/?view=editreservation&id=3917","start":"2016-11-02T9:00"},{"title":"Torres","url":".\/?view=editreservation&id=4227","start":"2016-11-02T90:20"},{"title":"Figueres","url":".\/?view=editreservation&id=4236","start":"2016-11-03T9:10"}];

?>
<script>

var today = new Date();
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
                       
			defaultDate: today,
                        defaultView:'agendaDay',// 'basicDay',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
                         minTime: "05:00:00",
                         maxTime: "24:00:00",
                        
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNameShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],           
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],            
                        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                        buttonText: {
                            today: 'hoy',
                            month: 'mes',
                            week: 'semana',
                            day: 'dia'

                        },
                        
			events: <?php echo json_encode($thejson); ?>
		});
		
	});

</script>


<div class="row">
<div class="col-md-12">
<h1>Calendario</h1>
<div id="calendar" style="width:75%;height:75%"></div>

</div>
</div>
