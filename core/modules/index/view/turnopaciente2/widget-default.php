
<?php


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);
//print_r($reservation->pacient_id);

 //$paciente = PacientData::getById($reservation->pacient_id);
           $paciente = $reservation->getPacient();
          $medic = $reservation->getMedic();
         
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             if (!empty($reservation->medsoli) )
                                  
             $solicitante = $reservation->getMedic2();
$categorias = CategoryData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$estudios = EstudioData::getAll();
$medics = MedicData::getProfesionales();
//$tecnicos = MedicData::getTecnicos(); modif 07/07/19
$tecnicos = TecnicoData::getAll();
           
if(empty($paciente->osocial_id))

$sql = "select * from osocial order by nombre asc  ";
else
$sql = "select * from osocial where  id =$paciente->osocial_id OR id =$paciente->osocial_id2 OR id =$paciente->osocial_id3  ";

//echo $sql;
$obras = OsocialData::getBySQL($sql);
//echo '55555555';

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

             
             
             ///////////          
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
            var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 //alert(str);
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
$("#medico3").val(val);
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

            </script>
        </div>

 


<div class="col-md-10">
<h1>Segundo Turno  <?php echo " - ".$paciente->name." ".$paciente->lastname; ?></h1>
<form class="form-horizontal" role="form" method="post"  autocomplete="off"  action="./?action=addreservation">
  <div class="form-group">
 
    <div class="col-lg-5">
        <input type="text" name="paciente" required class="hidden" id="inputEmail1" placeholder="paciente" value=<?php echo $paciente->lastname." ".$paciente->name; ?>>
    
      <input type="text" name="title" required class="hidden" id="inputEmail1" placeholder="Asunto" value=<?php echo $paciente->lastname; ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-5 control-label">Paciente <?php echo $paciente->id." - ".$paciente->name." ".$paciente->lastname; ?>  </label>
    <div class="col-lg-5">
    <input type="hidden" name="pacient_id" required class="hidden" id="pacient_id" placeholder="pacient_id" value=<?php echo $paciente->id; ?> >
    <?php    echo "regitrado:". date("d-m-y h:i"); ?>
    </div>
  </div>
    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"  min="<?php echo date("Y-m-d");  ?>"  value ="<?php echo date("Y-m-d",strtotime($reservation->date_at." "));;  ?>">
    </div>
     <div class="col-lg-2">
       <?php 
      $min=date("i");
      $minutos= date("H:i",strtotime(" - $min min "));
      //echo $reservation->date_at ; 
      //echo $reservation->time_at ; 
      $desde= date("H:i",strtotime($reservation->time_at." "));///  date("h:i",strtotime($reservation->time_at." +10 minute"));
      $fecha= date("Y-m-d",strtotime($reservation->date_at." "));/// 
      //echo $fecha ; ?> 
        
      <input type="time" name="time_at" step="60"    value="<?php echo $desde;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
      
    
    </div>
  </div>
    
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social</label>
    <div class="col-lg-3">
        <select name="osocial_id" id="osocial_id" class="form-control" required>


  <?php foreach($obras as $p):?>
<option value="<?php echo $p->id; ?>" <?php if($osocial->id==$p->id){ echo "selected"; }?>><?php echo $p->nombre." - ".$p->id; ?></option>      
   
  <?php endforeach; ?>
<option value="2">2- Particular</option>
</select>
    </div>
    
   </div>   
 
       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria de Atencion</label>
    <div class="col-lg-3">
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria de Atencion-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($reservation->category_id==$p->id){ echo "selected"; }?> ><?php echo $p->name." - ".$p->id; ?></option>
   
  <?php endforeach; ?>
</select>
    </div>
    </div>  
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion</label>
    <div class="col-lg-5">
<select name="estudio_id" id="estudio_id"  class="form-control" required>

  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
     <div class="form-group">
           <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
   <div class="col-lg-5"> 
       <select name="modelo" id="modelo"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>
      <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
    <div class="col-lg-3">
        <select name="tipo" id="tipo" class="form-control" required>
            <option value="<?php echo $reservation->tipo; ?>"><?php echo $reservation->tipo; ?></option>
<option value="Ambulatorio">-- Ambulatorio --</option>
<option value="Internado">-- Internado</option>
  
</select>
    </div>
    
   </div>  
    
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id" required  class="form-control" >
<option value="">-- Profesionales que realizan el estudio-</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"    <?php if($medic->id==$p->id){ echo "selected"; }?>    ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
    
  
     
      <input type="hidden" name="medsoli"   id="medsoli" placeholder="medsoli" value="<?php echo $reservation->medsoli ;  ?>"  />
	
    
  <input type="hidden" name="tecnico_id"   id="tecnico_id" placeholder="medsoli" value="<?php echo $reservation->tecnico_id ;  ?>"  />

  
    
    
  
 
   
   
    
    
    
  
  <div class="form-group">
    
    <div class="col-lg-3">
<select name="status_id" class="hidden"   required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-3">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if($p->name=="Pagado"){ echo "selected"; }?>   ><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Pago</label>
    <div class="col-lg-3">
        
        <select name="tipo_pago" id="tipo_pago"  class="form-control"  style="background: #5cb85c; color: #fff;" required>
            <option value="EFECTIVO"  style="background: #5cb85c; color: #fff;">-- EFECTIVO --</option>
<option value="DEBITO"  style="background: #bc0000 ; color: #fff;">-- DEBITO</option>
  <option value="CREDITO" style="background: #FF8C00; color: #fff;">-- CREDITO</option>
</select>
    </div>
    
   </div>   
    
   <input type="hidden" name="caja"   id="caja" placeholder="medsoli" value="<?php echo $reservation->caja ;  ?>"  />
	
    
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="price" id="price" placeholder="Coseguro">
</div>
    </div>
  </div>
    
       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="observacion_coseguro"  id="observacion_coseguro" placeholder="observacion_coseguro">
</div>
    </div>
  </div>
    <div class="form-group">
  
    <div class="col-lg-10">
    <textarea class="hidden" name="note" placeholder="Nota"></textarea>
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
     
      <button type="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Agregar Siguiente Turno</button>
   
    </div>
  </div>
</form>

</div>
</div>