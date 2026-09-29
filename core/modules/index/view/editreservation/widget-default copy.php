<?php 


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);
$estudios = EstudioData::getByCategory($reservation->category_id);
$pacients = PacientData::getAll();
$categorias = CategoryData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
   $medic = $reservation->getMedic();
            $paciente = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
            // $tecnicos = $reservation->getTecnico();
$obras = OsocialData::getAll();
 //cambio medic categoria 20 por la tabla tecnos 07/07;
$tecnicos = TecnicoData::getAll();
?>

<script src='res/jquery.min.js'></script>
  <div class="sin-json">
                      
            <script type="text/javascript">
             
               $(document).ready(function(){
   $("#category_id").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#category_id option:selected").each(function () {
             elegido= $("#category_id").val()  ;
          //   alert (elegido);
            elegido=$(this).val();
            $.post("./core/modules/index/action/buscarmedicoxarea/action-default.php", { elegido: elegido }, function(data){
            $("#medic_id").html(data);
            })
            
        
                   
            .fail( function(xhr, textStatus, errorThrown) {
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
  
$(document).ready(function(){
   $("#category_id").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#category_id option:selected").each(function () {
             elegido= $("#category_id").val()  ;
             //alert (elegido);
            elegido=$(this).val();
            $.post("./core/modules/index/action/buscarestudio/action-default.php", { elegido: elegido }, function(data){
            $("#estudio_id").html(data);
            })
            
        
                   
            .fail( function(xhr, textStatus, errorThrown) {
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

             
             
             ////////////////////////////// actualiza el coseguro
$(document).ready(function(){
   $("#estudio_id").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#estudio_id option:selected").each(function () {
             elegido2= $("#osocial_id").val()  ;
         //    alert (elegido2);
            elegido=$(this).val();
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo").html(data);
             alert (data);
             
                 var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 alert(str);
                 $("#price").val(str);
            
            })
            
        
                   
            .fail( function(xhr, textStatus, errorThrown) {
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

// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		//url: "readCountry.php",
                url: "./core/modules/index/action/addpost/action-default.php?elegido="+$(this).val(),
		data:'elegido='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(./image/loader.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectCountry(val, val2) {
$("#search-box").val(val2);


//alert(val);
$("#medic_id").val(val);
$("#suggesstion-box").hide();



}




// AJAX call for autocomplete 2 medico solicitante
$(document).ready(function(){
	$("#medico-solicitante").keyup(function(){
               // alert($(this).val());
		$.ajax({
		type: "POST",
		//url: "readCountry.php",
                url: "./core/modules/index/action/updatepost/action-default.php?elegido="+$(this).val(),
		data:'elegido='+$(this).val(),
		beforeSend: function(){
			$("#medico-solicitante").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion2-box").show();
			$("#suggesstion2-box").html(data);
			$("#medico-solicitante").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectMedico(val, val2) {
$("#medico-solicitante").val(val2);


//alert(val);
$("#medsoli").val(val);
$("#suggesstion2-box").hide();




}


// AJAX call for autocomplete 2 medico solicitante
$(document).ready(function(){
	$("#paciente").keyup(function(){
               // alert($(this).val());
		$.ajax({
		type: "POST",
		//url: "readCountry.php",
                url: "./core/modules/index/action/buscarpaciente/action-default.php?elegido="+$(this).val(),
		data:'elegido='+$(this).val(),
		beforeSend: function(){
			$("#paciente").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#paciente-box").show();
			$("#paciente-box").html(data);
			$("#paciente").css("background","#FFF");
		}
		});
	});
});
//To select Paciente name
function selectPaciente(val, val2, val3) {
$("#paciente").val(val2);


//alert(val3);
  var cadena=val3.split("-");;//explode("-",val3);
//alert(cadena[0]);
 var hay=cadena.length;
$("#pacient_id").val(val);
$("#paciente-box").hide();
var osocial_id = document.getElementById('osocial_id');
var html="";
      /**  for(var key in cadena) {
           // alert(obj[key]);
            html += "<option value=" + key  + ">" +cadena[key] + "</option>";
        }*/
        for (var i = osocial_id.length - 1; i >= 0; --i) {
            if (osocial_id[i].value != cadena[0]&& osocial_id[i].value != cadena[1]&& osocial_id[i].value != cadena[2]&& osocial_id[i].value != 2&& osocial_id[i].value != 12) {
              osocial_id.remove(i);
            }
        }
          
        //document.getElementById("osocial_id").innerHTML = html;
}

            </script>
<div class="row">
	<div class="col-md-10">
	
          <h2><span class="fa fa-calendar"></span> Modificar Turno</h2>
  <hr>
<form class="form-horizontal" role="form" method="post" action="./?action=updatereservation">
   <div class="form-group">
   
    <div class="col-lg-5">
        
          <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>"  >
        <input type="text" name="title" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
       <input type="text" name="note" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
   <input type="hidden" name="caja"   id="caja" placeholder="caja"  value="<?php echo $reservation->caja; ?>"  />
     <input type="hidden" name="fecha_atencion"   id="fecha_atencion" placeholder="fecha_atencion"  value="<?php echo $reservation->fecha_atencion; ?>"  />
   <input type="hidden" name="hora_atencion"   id="hora_atencion" placeholder="hora_atencion"  value="<?php echo $reservation->hora_atencion; ?>"  />
   <input type="hidden" name="fecha_informe"   id="fecha_informe" placeholder="fecha_informe"  value="<?php echo $reservation->fecha_informe; ?>"  />
  <input type="hidden" name="user_informe"   id="user_informe" placeholder="user_informe"  value="<?php echo $reservation->user_informe; ?>"  />
  
   
  </div>
     </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"   value ="<?php echo $reservation->date_at;  ?>">
    </div>
    
    </div>
    
    
   <div class="form-group">
          <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora</label>
 
    <div class="col-lg-2">
       <?php 
      $min=date("i");
      $minutos= date("H:i",strtotime(" - $min min "));
     // echo $minutos;  ?> 
        
      <input type="time" name="time_at" step="600"    value="<?php echo $reservation->time_at;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
      
    
    </div>
  </div>
    
    
   <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-male fa-2x"></i>Paciente</label>
    <div class="col-lg-5">
       
      <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>" readonly placeholder="Escriba el nombre del paciente">
	
      <input type="hidden" name="pacient_id"   id="pacient_id" placeholder="pacient_id" value="<?php echo $paciente->id ;  ?>" />
	
    </div>
     
   </div> 
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-area-chart"></i> Obra Social</label>
    <div class="col-lg-3">
       
        <select name="osocial_id" id="osocial_id" class="form-control" required>

  <?php
    
  foreach($obras as $p):  ?>
    <option value="<?php echo $p->id; ?>"     <?php if($p->id==$osocial->id ){ echo "selected"; }?>     ><?php echo $p->nombre." - ".$p->id; ?></option>
  <?php endforeach; ?>
    <option value="2"> Particular </option>
</select>
    </div>
    
   </div>   
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-lg-3">
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria --</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if($p->id==$estudio->category_id){ echo "selected"; }?>   ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
    
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion</label>
    <div class="col-lg-5">
<select name="estudio_id" id="estudio_id"  class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"     <?php if($p->id==$reservation->estudio_id){ echo "selected"; }?>     >      <?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>   
    
   
 
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id" required class="form-control" >
<option value="">-- Profesionales --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>    ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>
       
      <input type="hidden" name="medsoli"   id="medsoli" placeholder="medsoli" value="<?php echo $reservation->medsoli ;  ?>"  />
	
    
    <input type="hidden" name="tecnico_id"   id="tecnico_id" placeholder="medsoli" value="<?php echo $reservation->tecnico_id ;  ?>"  />
	
    
  
    <input type="hidden" name="tipo"   id="tipo" placeholder="tipo" value="<?php echo $reservation->tipo ;  ?>"  />
	
    
    
    
    
  <div class="form-group">
           <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-money fa-2x"></i> Estado de Pago</label>
 
    <div class="col-lg-3">
      
        <select name="payment_id" id="payment_id" class="form-control" required>
           
            
            <option value="1" <?php  if($reservation->payment_id<2){ echo "selected"; } ;?> class="btn-warning">-- Pendiente de pago --</option>
<option value="2" <?php  if($reservation->payment_id==2){ echo "selected"; } ;?>>-- Pagado</option>
  
</select>
        
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Pago</label>
    <div class="col-lg-3">
        
        <select name="tipo_pago" id="tipo_pago"  class="form-control"  style="background: #5cb85c; color: #fff;" required>
            <option value="EFECTIVO"  <?php  if($reservation->tipo_pago=="EFECTIVO"){ echo "selected"; } ;?> style="background: #5cb85c; color: #fff;" >-- EFECTIVO --</option>
<option value="DEBITO"  <?php  if($reservation->tipo_pago=="DEBITO"){ echo "selected"; } ;?> style="background: #bc0000 ; color: #fff;">-- DEBITO</option>
  <option value="CREDITO"  <?php  if($reservation->tipo_pago=="CREDITO"){ echo "selected"; } ;?> style="background: #FF8C00; color: #fff;">-- CREDITO</option>
</select>
    </div>
    
   </div>   
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
    <input type="text" name="price" value="<?php echo $reservation->price;?>" class="form-control" id="price" placeholder="price">
  
</div>
    </div>
  </div>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" name="observacion_coseguro" value="<?php echo $reservation->observacion_coseguro;?>" class="form-control" id="observacion_coseguro" placeholder="observacion_coseguro">
  
</div>
    </div>
  </div>
    
  <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-stethoscope fa-2x"></i> Estado</label>
   
    <div class="col-lg-3">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if($p->id==$reservation->status_id){ echo "selected"; }?> ><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
    
    <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="sick" placeholder="Enfermedad"></textarea>
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
      <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-2x"></i>Modificar Turno</button>
    </div>
  </div>
</form>

	</div>
</div>