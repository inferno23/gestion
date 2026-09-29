
<?php
//INSERT INTO `category` (`id`, `name`) VALUES ('20', 'TECNICOS');

date_default_timezone_set('America/Argentina/Buenos_Aires');

if(empty($_GET["id"]))
Core::redir("index.php?view=pacients");

$paciente = PacientData::getById($_GET["id"]);


$medics = MedicData::getProfesionalesByArea(7);//  7 es consultorio
//print_r($medics);
$categorias = CategoryData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$estudios = EstudioData::getAll();
//$sql = "select * from osocial where  id =$paciente->osocial_id OR id =$paciente->osocial_id2 OR id =$paciente->osocial_id3  ";
$obras = OsocialData::getAll();

//$tecnicos = MedicData::getTecnicos(); cambio 04/07/2019
$tecnicos = TecnicoData::getAll();
if(empty($paciente->osocial_id))

$sql = "select * from osocial order by nombre asc  ";
else
$sql = "select * from osocial where  id =$paciente->osocial_id OR id =$paciente->osocial_id2 OR id =$paciente->osocial_id3  ";

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
            // alert (data);
             
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
//////////////////////////////////// obra social actualiza el coseguro
$(document).ready(function(){
   $("#osocial_id").change(function () {
     //  alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#osocial_id option:selected").each(function () {
             elegido= $("#estudio_id").val()  ;// invierto los elegidos 
           //  alert (elegido);
            elegido2=$(this).val();
            
             //alert (elegido2);
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo").html(data);
            /// alert (data);
             
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
            if (osocial_id[i].value != cadena[0]&& osocial_id[i].value != cadena[1]&& osocial_id[i].value != cadena[2]&& osocial_id[i].value != 22222&& osocial_id[i].value != 22212) {
              osocial_id.remove(i);
            }
        }
          
        //document.getElementById("osocial_id").innerHTML = html;
}

            </script>
        </div>

 


<div class="col-md-10">
<h1><i class="fa fa-user-md"></i>Nuevo Turno Consultorio  </h1>
<h1> <?php echo " - ".$paciente->name." ".$paciente->lastname; ?></h1>
<form class="form-horizontal" role="form" method="post" autocomplete="off" action="./?action=addreservation">
  <div class="form-group">
   
    <div class="col-lg-5">
        <input type="text" name="title" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="cargar el nombre del paciente">
       <input type="text" name="caja" required class="hidden" id="inputEmail1" placeholder="caja"  value="caja ">
 
    
    </div>
  </div>
    
    
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"  min="<?php echo date("Y-m-d");  ?>"  value ="<?php 
       if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
           echo $_GET["date_at"]; 
       }else
        
        echo date("Y-m-d");  ?>">
    </div>
    <div class="col-lg-2">
       <?php 
      $min=date("i");
      $minutos= date("H:i",strtotime(" - $min min "));
     //echo "date_at".$_GET["date_at"];  ?> 
        
      <input type="time" name="time_at" step="300"    value="<?php echo $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
      
    
    </div>
  </div>
   <div class="form-group">
        
    
         <label for="inputEmail1" class="col-lg-5 control-label">Paciente <?php echo $paciente->id." - ".$paciente->name." ".$paciente->lastname; ?></label>
   
       <input type="text" name="paciente" required class="hidden" id="inputEmail1"  placeholder="paciente" value=<?php echo $paciente->lastname." ".$paciente->name; ?>>
     <input type="hidden" name="pacient_id" required class="hidden" id="pacient_id" placeholder="pacient_id" value=<?php echo $paciente->id; ?> >
   
      
    </div>
    
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social</label>
    <div class="col-lg-3">
        <select name="osocial_id" id="osocial_id" class="form-control" required>
<option value="2">-- SELECCIONE Obra Social --</option>

  <?php
  //$sql = "select * from osocial where  id =$paciente->osocial_id OR id =$paciente->osocial_id2 OR id =$paciente->osocial_id3  ";
//$obras = OsocialData::getAll();
  
  
  foreach($obras as $p):  ?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->nombre." - ".$p->id; ?></option>
  <?php endforeach; ?>
   <option value="2"> Particular </option>
</select>
    </div>
    
   </div>   
 
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria de estudio</label>
    <div class="col-lg-3">
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria de estudio-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$_GET["category_id"]){ echo "selected"; }?> ><?php echo $p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
    
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estudio</label>
    <div class="col-lg-5">
<select name="estudio_id" id="estudio_id"  class="form-control" required>
<option value="">-- SELECCIONE Estudio--</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"     <?php if($p->id==$_GET["estudio_id"]){ echo "selected"; }?>     >      <?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
    
      <div class="form-group">
   
    <div class="col-lg-3">
        <input type="hidden" name="tipo"   id="tipo" placeholder="tipo"  value="Ambulatorio" />
        <input type="hidden" name="tecnico_id"   id="tipo" placeholder="tecnico_id" value="0"  />
         <input type="hidden" name="medsoli"   id="medsoli" placeholder="medsoli"   />
          <input type="hidden" name="payment_id"   id="payment_id" placeholder="pagado"  value="2" />
           <input type="hidden" name="modelo"   id="modelo" placeholder="modelo es el selec de coseguro al elegir la obra del paciente"   />
    </div>
    
   </div>   
   
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id"  class="form-control" >
<option value="">-- Profesionales que realizan el Informe-</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>
    
    
    
     
  
  <div class="form-group">
    
    <div class="col-lg-3">
<select name="status_id" class="hidden" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
 
   
    
    
    
    
    <div class="form-group">
    
    <div class="col-lg-3">
<div class="input-group">
  
  <input type="hidden" class="form-control" name="price" id="price" placeholder="Costo">
</div>
    </div>
  </div>
     <div class="form-group">
  
    <div class="col-lg-3">
<div class="input-group">
  
  <input type="hidden" class="form-control" id="observacion_coseguro" name="observacion_coseguro" placeholder="observacion_coseguro">
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
    <div class="col-lg-offset-3 col-lg-12">
         <button type="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Agregar Turno</button>
   
     
    </div>
  </div>
</form>

</div>
</div>