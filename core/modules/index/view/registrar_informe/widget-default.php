<?php 


date_default_timezone_set('America/Argentina/Buenos_Aires');

$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$categorias = CategoryData::getAll();
//$medics = MedicData::getAll();

$medics = MedicData::getProfesionalesByArea($reservation->category_id);
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
   $medic = $reservation->getMedic();
            $paciente = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             
             
             $tecnicos = TecnicoData::getAll();

               if (!empty($reservation->medsoli) )
             $solicitante = $reservation->getMedic2();


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


 function jumpTo(idSelect){ 
     

var sel = document.getElementById(idSelect).value; 


var valSelected = document.getElementById(idSelect).value;
var actual = document.getElementById("symtoms").value;
var GUARDAR= valSelected;
//alert(valSelected);
    var opts = document.getElementById(idSelect).options;
     var opts = document.getElementById("duplicado").options;/// saco del duplicado
    var optSelected = "";
   
    for(i=0;i<opts.length;i++){
        //alert(opts[i].value);
      if(opts[i].value == valSelected){
        optSelected = opts[i].text;
      }
     
    }
    
   // document.getElementById("mensaje").value += valSelected + ' - ' + optSelected + '\n';  
    
   var res = optSelected.substr(1, 1); /// ( 1 - D - xxxxxxx)
   /////alert(res);
   optSelected=optSelected.substr((optSelected.lastIndexOf(")")+1));
   
var value =  '<p style="text-align: center;">&#9679 &middot;' + optSelected +'</p> \n'; 
if ( res < 2 || res >5)
    value =  '<p style="text-align: left;">' + optSelected +'</p> \n';
// CKEDITOR.instances['informe'].insertElement(value);
   //CKEDITOR.instances['informe'].insertText(value);
   
   document.getElementById("symtoms").value=GUARDAR+'-'+actual;
  CKEDITOR.instances.informe.insertHtml( value);
} 






            </script>
 
 <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

 <!-- fin         wysihtml5  -->
<div class="row">
	<div class="col-md-10">
	 <br>
          <h2><span class="fa fa-medkit"></span> Registrar Informe de la Atencion Medica +</h2>
          <?php
          
           $osocial_id=$medic_id=$category_id=$estudio_id="";
      if(  isset($_GET["estudio_id"]) && ( $_GET["estudio_id"]!=""))
             $estudio_id=$_GET["estudio_id"];
       if(  isset($_GET["category_id"]) && ( $_GET["category_id"]!=""))
             $category_id=$_GET["category_id"];
       if(  isset($_GET["medic_id"]) && ( $_GET["medic_id"]!=""))
             $medic_id=$_GET["medic_id"];
       if(  isset($_GET["osocial_id"]) && ( $_GET["osocial_id"]!=""))
             $osocial_id=$_GET["osocial_id"];
          //$ruta= "&category_id=".$_GET['category_id']."&estudio_id=".$_GET['estudio_id']."&medic_id=".$_GET['medic_id']."&osocial_id=".$_GET['osocial_id'];
          $ruta= "&category_id=".$category_id."&estudio_id=".$estudio_id."&medic_id=".$medic_id."&osocial_id=".$osocial_id;
    
         // echo $ruta;
                  ?>
  <hr>
<form class="form-horizontal" role="form" method="post" action="./?action=updatereservation<?php echo $ruta; ?>">
   <div class="form-group">
     <input type="text" name="id" required class="hidden" id="id" value="<?php echo $reservation->id; ?>"  >
    
    <div class="col-lg-3">
        
            <input type="text" name="title"  class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>" >
     <input type="text" name="note" required class="hidden" id="inputEmail1" placeholder="Asunto"  value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  >
  
   
  </div>
     </div>
    
    
  
    <input type="text" name="caja"  class="hidden" id="caja" placeholder="caja"  value="<?php echo $reservation->caja;  ?>" >
  
   
         
    <input type="text" name="tipo"  class="hidden" id="tipo" placeholder="tipo"  value="<?php echo $reservation->tipo;  ?>" >
  
   
     
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-calendar fa-2x"></i>Fecha</label>
    <div class="col-lg-2" data-date-format="dd-mm-yyyy" >
        <input type="date" name="date_at"   required class="form-control" id="datepicker" placeholder="Fecha"   value ="<?php  echo date("Y-m-d",strtotime($reservation->date_at." "));  ?>" readonly>
    
       <?php  
     //$min=date("i");
      $minutos= date("H:i",strtotime($reservation->time_at." "));
     // echo $minutos;  ?> 
        
      <input type="time" name="time_at"  value="<?php echo $minutos;  ?>" required class="form-control" id="inputEmail1" placeholder="Hora" readonly>
      
    
    </div>
  </div>
    
    
    
   <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-male fa-2x"></i>Paciente</label>
    <div class="col-lg-5">
       
      <input type="text" name="paciente" required class="form-control" id="paciente" value="<?php echo $paciente->lastname ." ".$paciente->name ;  ?>"  placeholder="Escriba el nombre del paciente" readonly>
	
      <input type="hidden" name="pacient_id"   id="pacient_id" placeholder="pacient_id" value="<?php echo $paciente->id ;  ?>" />
	
    </div>
     
   </div> 
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-area-chart"></i> Obra Social</label>
    <div class="col-lg-3">
       <input type="text" name="osocial" required class="form-control" id="osocial" value="<?php echo $osocial->nombre ."".$osocial->id ;  ?>"  placeholder="$osocial" readonly>
	
       <input type="hidden" name="osocial_id"   id="osocial_id" placeholder="osocial_id" value="<?php echo $osocial->id ; ?>"  />
	
    </div>
    
   <label for="inputEmail1" ><i class="fa fa-medkit fa-2x"></i><?php echo $estudio->id." - ".$estudio->descripcion." "; ?></label>
   
 
 <input type="hidden" name="estudio_id"   id="estudio_id" placeholder="estudio_id" value="<?php echo $estudio->id ; ?>"  />
	
   
    </div>  
    
   
     <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user-md fa-2x"></i>Profesional</label>
    <div class="col-lg-5">
       
      <input type="text" name="search-box" required class="form-control" id="search-box"   value="<?php echo $medic->lastname." ".$medic->name ;  ?>" placeholder="Escriba el nombre del Profesional" readonly>
	
     <div id="suggesstion-box"></div>
        </div>
    </div>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Modificar Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id"  class="form-control" >
<option value="">-- Profesionales que realizan el Informe-</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"        <?php if($p->id==$reservation->medic_id	){ echo "selected"; }?>       ><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>
    
    
    
    
    
    <input type="hidden" name="medsoli"   id="medsoli" placeholder="medsoli" value="0"> 
   

   
    <input type="hidden" name="tecnico_id"   id="tecnico_id" placeholder="tecnico_id" value="0"> 
   

 
    
    
    
    
    
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
    
    
        <input type="hidden" name="payment_id" value="<?php echo $reservation->payment_id;?>" class="form-control" id="payment_id" placeholder="payment_id">
  
   

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
    <input type="text" name="price" value="<?php echo $reservation->price;?>" class="form-control" id="price" placeholder="price" readonly>
  
</div>
    </div>
  </div>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" name="observacion_coseguro" value="<?php echo $reservation->observacion_coseguro;?>" class="form-control" id="observacion_coseguro" placeholder="observacion_coseguro" readonly>
  
</div>
    </div>
  </div>
     
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fechade Informe</label>
    <div class="col-lg-3" data-date-format="dd-mm-yyyy" >
        <input type="date" name="fecha_informe"   required class="form-control" id="datepicker" placeholder="Fecha"  min="<?php echo date("Y-m-d");  ?>"  value ="<?php 
       if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
           echo $_GET["date_at"]; 
       }else
        
        echo date("Y-m-d");  ?>">
    </div>
    
  </div>
  
  <div class="form-group">
         <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-stethoscope fa-2x"></i> Estado</label>
   
    <div class="col-lg-3">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"  <?php if ($p->id==5) echo "selected"; ?> ><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
    
   <?php  
   
$estudio_id=$estudio->id;
  $items = InformeData::getByEstudio($estudio_id);
 // echo print_r($items[0]->descripcion);//["InformeData"]
//8 es alboratorio

  if($estudio->category_id==8){
     $estudio_laboratorio= EstudioData::getByCategory(8);
  }
  
  
  //print_r($estudio_laboratorio);
  ?>
    
   
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">item para el  Informe</label>
    <div class="col-lg-5">
<select name="informe1" id="informe1"  onchange="jumpTo('informe1');"  class="form-control" >
<option value="">--Seleccione un item para el  Informe-</option>
  <?php foreach($items as $p): ?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".""; ?></option>

 <?php
  endforeach;
 
  ?>
</select>
        <select name="duplicado" id="duplicado"    class="hidden" >
<option value="">--Sduplicado-</option>
  <?php foreach($items as $p): ?>
    <option value="<?php echo $p->id; ?>"><?php echo "(".$p->codigo_informe."-".$p->subcodigo."-".$p->descripcion.")".$p->observacion.""; ?></option>

 <?php
  endforeach;
 
  ?>
</select>
        
    </div>
    </div> 
    
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Solo laboratorio</label>
    <div class="col-lg-5">
<select name="informe2" id="informe2"  onchange="jumpTo2('informe2');"  class="form-control" >
<option value="">--Seleccione un item para el  laboratorio-</option>
  <?php foreach($estudio_laboratorio as $p): ?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->descripcion.""; ?></option>

 <?php
  
  
  endforeach;
  
  
 
  ?>
</select>
    </div>
    </div> 
    
    
    
 <script>
function jumpTo2(idSelect){ 
     

var valSelected = document.getElementById(idSelect).value;

var text="";

             
         var jArray= <?php echo json_encode($estudio_laboratorio ); ?>;

    for(var i=0;i<jArray.length;i++){
       // alert(jArray[i].id);
        if(jArray[i].id == valSelected){
            
           text=jArray[i].informe;
           //alert("es eeee "+text);
        }
    }
          
//var cleanText = text.replace(/&amp;nbsp;/g,"");
//var cleanText = text.replace(/\xA0/g,' ');
//var cleanText = text.replace(/&amp;nbsp;/g,"");
//text = text.replace(/&lt;/g,"<");
//text = text.replace(/&gt;/g,'>');
//text = text.replace(/&amp;/g,'&');

 text =   text +' \n\n';
var value =  html_entity_decode2 (text); 
  CKEDITOR.instances.informe.insertHtml( value);
  
}
function html_entity_decode2(str) {
  var ta = document.createElement("textarea");
  ta.innerHTML=str.replace(/</g,"&lt;").replace(/>/g,"&gt;");
  toReturn = ta.value;
  ta = null;
  return toReturn
}
function html_entity_decode(message) {
    
  return message.replace(/[<>'"]/g, function(m) {
    return '&' + {
      '\'': 'apos',
      '"': 'quot',
      '&': 'amp',
      '<': 'lt',
      '>': 'gt',
    }[m] + ';';
  });
}

            </script>
    
    
    <input type="hidden" name="detalle"  class="form-control" id="detalle" placeholder="detalle">
  <input type="hidden" name="fecha_atencion" class="form-control" id="fecha_atencion" placeholder="fecha_atencion">
  <input type="hidden" name="hora_atencion" class="form-control" id="hora_atencion" placeholder="hora_atencion">
  
    
     <?php  $textousuario=$u=null;
if(Session::getUID()!=""){
  $u = UserData::getById(Session::getUID());
  $user = $u->name." ".$u->lastname;
 $textousuario=$user;
  }
  ?>
      <input type="hidden" name="user_informe" value="<?php echo $u->id;?>" class="form-control" id="user_informe" placeholder="user_informe">
  
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Registra Informe </label>
         <div class="col-lg-3">
   <input type="text" name="usuario"  class="form-control" id="usuario" value="<?php echo  $textousuario;  ?>"  placeholder="usuario" readonly>
	 </div>
        
        
        <div class="adjoined-top" >
		<div class="grid-container" >
			<div class="content grid-width-100" >
				<h1>Informe de Atencion</h1>
				 <textarea  class="text" rows="40" cols="45" id="informe"  name="informe"    autofocus  placeholder="Registrar informe de la atencion Medica">
                                     <?php  if($estudio->category_id!=28 && empty($reservation->informe)) {
                                          $fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes
                                   
                                     if($estudio->category_id!=8)
                                     echo"<p style='text-align: center;'><strong><u><span style='font-size:16px'><span style='font-family:Times New Roman,Times,serif'>$estudio->descripcion </span></span></u></strong></p>"; 
                                     //echo " <h3 style='text-align: center;'><u><strong> $estudio->descripcion</strong></u></h3>";
                                   
                                     echo"<BR>";
                                     
                                     echo "<span style='font-size:16px;'><span style='font-family:Times New Roman,Times,serif;'><u>Numero de Estudio:</u> $reservation->id <BR>";
                                     echo "<u>Turno:</u> ".$fecha." <BR> ";
                                     echo "<u>Paciente:</u> ".$paciente->lastname.", ".$paciente->name." -  DNI:   ".$paciente->no."<BR> ";
                                   if (!empty($reservation->medsoli) ) 
                                        echo "<u>Medico Solicitante:</u> $solicitante->lastname ", "  $solicitante->name <BR>";
                                     
                                   echo "<u>Obra Social:</u> $osocial->nombre </span></span><BR>";
                                   
                                      echo " <br/>";
                                         echo  $estudio->informe;  
                                    } else {
                                       // $fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes
                               /**           echo " <h2 style='text-align: center;'><strong> $estudio->descripcion</strong></h2><BR>";
                                    echo " Numero de Estudio:  $reservation->id <BR>";
                                    echo " Turno:".$fecha." <BR> ";
                                    echo " Paciente:   ".$paciente->lastname." ".$paciente->name." -  DNI:   ".$paciente->no."<BR> ";
                                   echo " Medico Solicitante:   $solicitante->lastname  $solicitante->name <BR>";
                                   echo " Obra Social:   $osocial->nombre <BR><BR>";
                              */       
                                        
                                        echo $reservation->informe;
                                   }  ?>
                                 </textarea>
    
			</div>
		</div>
	</div>
	

<script>
		CKEDITOR.replace( 'informe',
	{  
		enterMode : CKEDITOR.ENTER_BR,
                line_height: "11px;13px;15px;18px;20px;25px;30px;"
	});
        
                CKEDITOR.config.height = 500; 
              //CKEDITOR.config.extraPlugins = 'basicstyles';
                CKEDITOR.config.removeButtons = 'Subscript,Superscript';
                //<p><span style="line-height: 1px;">jkkjjkkjkjjjkjjk</span></p> no se nota el cambio
                //<p style="line-height: 2px; font-size: 8pt;">fdfsff</p>
               //  <p><span style="line-height: 1px; display: block;">jkkjjkkjkjjjkjjk</span></p> con display: block; funciona pero no muy bien

             CKEDITOR.config.extraPlugins = 'basicstyles,justify,pagebreak,font,liststyle,lineheight,richcombo,floatpanel,listblock,panel,button,letterspacing';
               CKEDITOR.config.allowedContent = true;/// para q tome <u> underline en algunos servidores
                CKEDITOR.config.font_defaultLabel = 'Arial';
               CKEDITOR.config.disableNativeSpellChecker = false;
               CKEDITOR.config.scayt_autoStartup = false;
                 CKEDITOR.config.scayt_sLang = 'es_ES';
                 CKEDITOR.config.wsc_lang = "es_ES";
                 CKEDITOR.config.scayt_defLan = 'es_ES';
                 //CKEDITOR.config.line_height = '1px;1.1px;1.2px;1.3px;1.4px;1.5px';
                 
	</script>
    <div class="col-lg-10">
     

    <textarea class="hidden" name="note" placeholder="Nota"></textarea>
    </div>
  </div>
    <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="sick" placeholder="sick" value="INFORME" >INFORME</textarea>
    </div>
  </div>
      <div class="form-group">
   
    <div class="col-lg-10">
    <textarea  id="symtoms" class="hidden" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div>
        <div class="form-group">
   
    <div class="col-lg-10">
    <textarea class="hidden" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div>
    
    
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-2x"></i>Registrar informe de la atencion Medica</button>
    </div>
  </div>
</form>

	</div>
</div>