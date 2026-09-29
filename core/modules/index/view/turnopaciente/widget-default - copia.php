
<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
if(empty($_GET["id"]))
Core::redir("index.php?view=newreservation&estudio_id=&category_id=");

$paciente = PacientData::getById($_GET["id"]);


$medics = MedicData::getProfesionales();
//print_r($medics);
$categorias = CategoryData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$estudios = EstudioData::getAll();
//$obras = OsocialData::getAll();
if(empty($paciente->osocial_id))

$sql = "select * from osocial order by nombre asc  ";
else

$sql = "select * from osocial where  id =$paciente->osocial_id ";

// solo tomo una obra en el sql echo $sql;
$obras = OsocialData::getBySQL($sql);
     
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

             
             
             ////////////////////////////// actualiza el coseguro     
                 
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
/// 222222222222  actualiza el coseguro estudio 22222222222
          $(document).ready(function(){
   $("#estudio2").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#estudio2 option:selected").each(function () {
             elegido2= $("#osocial_id").val()  ;
         //    alert (elegido2);
            elegido=$(this).val();
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo2").html(data);
            
            // alert (data);
             
                 var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 //alert(str);

                  /* Para obtener el texto */
                  var combo = document.getElementById("modelo");
                  var selected = combo.options[combo.selectedIndex].text;
                  if (selected.length == 0 && selected === "") {
                    atencion1 = 0;
                    alert("Por favor ingresar las atenciones de forma secuencial sin omitir la anterior.");
                  }else                  
                    atencion1 = selected.substring(selected.indexOf("$")+1,selected.indexOf("-"));
                  
                   
                  var valor1 = parseFloat(str);
                  var valor2 = parseFloat(atencion1);
                  var total = valor1+valor2;

                 $("#price").val(total);
            
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

/// 333333333  actualiza el coseguro estudio 333333333333
$(document).ready(function(){
   $("#estudio3").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#estudio3 option:selected").each(function () {
             elegido2= $("#osocial_id").val()  ;
         //    alert (elegido2);
            elegido=$(this).val();
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo3").html(data);
            // alert (data);
             
                 var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 //alert(str);
                  /* Para obtener el texto */
                  var combo = document.getElementById("modelo");
                  var selected = combo.options[combo.selectedIndex].text;
                //  var atencion1 = selected.substring(selected.indexOf("$")+1,selected.indexOf("-"));
                  if (selected.length == 0 && selected === "") {
                    atencion1 = 0;
                    alert("Por favor ingresar la atencione 1 sin omitir la anterior.");
                  }else 
                   atencion1 = selected.substring(selected.indexOf("$")+1,selected.indexOf("-"));
                
                    var combo2 = document.getElementById("modelo2");
                  var selected2 = combo2.options[combo2.selectedIndex].text;
                  var atencion2 = selected2.substring(selected2.indexOf("$")+1,selected2.indexOf("-"));
                  
                  if (selected2.length == 0 && selected2 === "") {
                    atencion2 = 0;
                    alert("Por favor ingresar la atencione 2 sin omitir la anterior.");
                  }else 
                   atencion2 = selected2.substring(selected2.indexOf("$")+1,selected2.indexOf("-"));
                  


                  var valor3 = parseFloat(str);
                  var valor2 = parseFloat(atencion2);
                  var valor1 = parseFloat(atencion1);
                  var total = valor1+valor2+valor3;

                 $("#price").val(total);
                 
            
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


/// 444444444  actualiza el coseguro estudio 444444444444
$(document).ready(function(){
   $("#estudio4").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#estudio4 option:selected").each(function () {
             elegido2= $("#osocial_id").val()  ;
         //    alert (elegido2);
            elegido=$(this).val();
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo4").html(data);
            // alert (data);
             
                 var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 //alert(str);
                 var combo = document.getElementById("modelo");
                  var selected = combo.options[combo.selectedIndex].text;
                  var atencion1 = selected.substring(selected.indexOf("$")+1,selected.indexOf("-"));
                    
                    var combo2 = document.getElementById("modelo2");
                  var selected2 = combo2.options[combo2.selectedIndex].text;
                  
                  if (selected2.length == 0 && selected2 === "") {
                    atencion2 = 0;
                    alert("Por favor ingresar la atencione 2 sin omitir la anterior.");
                  }else 
                   atencion2 = selected2.substring(selected2.indexOf("$")+1,selected2.indexOf("-"));
                  

                  var combo3 = document.getElementById("modelo3");
                  var selected3 = combo3.options[combo3.selectedIndex].text;
                 // var atencion3 = selected3.substring(selected3.indexOf("$")+1,selected3.indexOf("-"));
                  if (selected3.length == 0 && selected3 === "") {
                    atencion3 = 0;
                    alert("Por favor ingresar la atencione 3 sin omitir la anterior.");
                  }else 
                   atencion3 = selected3.substring(selected3.indexOf("$")+1,selected3.indexOf("-"));
               
                  var valor4 = parseFloat(str);
                  var valor3 = parseFloat(atencion3);
                  var valor2 = parseFloat(atencion2);
                  var valor1 = parseFloat(atencion1);
                  var total = valor1+valor2+valor3+valor4;

                 $("#price").val(total);
            
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


/// 55555  actualiza el coseguro estudio 555555555
$(document).ready(function(){
   $("#estudio5").change(function () {
       //alert ($(this).val()); 
      
       //alert ("modelos.php");
           $("#estudio5 option:selected").each(function () {
             elegido2= $("#osocial_id").val()  ;
         //    alert (elegido2);
            elegido=$(this).val();
            $.post("./core/modules/index/action/actiontest/action-default.php", { elegido: elegido,elegido2: elegido2 }, function(data){
            $("#modelo5").html(data);
            // alert (data);
             
                 var str = data.substring(data.indexOf("$")+1,data.indexOf("-"));
                 var combo = document.getElementById("modelo");
                  var selected = combo.options[combo.selectedIndex].text;
                  var atencion1 = selected.substring(selected.indexOf("$")+1,selected.indexOf("-"));
                    
                    var combo2 = document.getElementById("modelo2");
                  var selected2 = combo2.options[combo2.selectedIndex].text;
                  var atencion2 = selected2.substring(selected2.indexOf("$")+1,selected2.indexOf("-"));
                  if (selected2.length == 0 && selected2 === "") {
                    atencion2 = 0;
                    alert("Por favor ingresar la atencione 2 sin omitir la anterior.");
                  }else 
                   atencion2 = selected2.substring(selected2.indexOf("$")+1,selected2.indexOf("-"));
                  

                  var combo3 = document.getElementById("modelo3");
                  var selected3 = combo3.options[combo3.selectedIndex].text;
                  //var atencion3 = selected3.substring(selected3.indexOf("$")+1,selected3.indexOf("-"));
                  

                  if (selected3.length == 0 && selected3 === "") {
                    atencion3 = 0;
                    alert("Por favor ingresar la atencione 3 sin omitir la anterior.");
                  }else 
                   atencion3 = selected3.substring(selected3.indexOf("$")+1,selected3.indexOf("-"));
               

                  var combo4 = document.getElementById("modelo4");
                  var selected4 = combo4.options[combo4.selectedIndex].text;
                 // var atencion4 = selected4.substring(selected4.indexOf("$")+1,selected4.indexOf("-"));
                

                  if (selected4.length == 0 && selected4 === "") {
                    atencion4 = 0;
                    alert("Por favor ingresar la atencione 4 sin omitir la anterior.");
                  }else 
                   atencion4 = selected4.substring(selected4.indexOf("$")+1,selected4.indexOf("-"));
                

                  var valor5 = parseFloat(str);
                  var valor4 = parseFloat(atencion4);
                  var valor3 = parseFloat(atencion3);
                  var valor2 = parseFloat(atencion2);
                  var valor1 = parseFloat(atencion1);
                  var total = valor1+valor2+valor3+valor4+valor5;

                 $("#price").val(total);
            
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


// AJAX call for autocomplete 2 
$(document).ready(function(){
	$("#pacient_id").keyup(function(){
            elegido1= $("#datepicker").val()  ;
            elegido2= $("#time_at").val()  ;
            elegido3= $("#category_id").val()  ;
            elegido4= $("#estudio_id").val()  ;
            elegido= $("#dni").val()  ;
            
            paciente= $("#paciente").val()  ;
               // alert(paciente);
		$.ajax({
		type: "POST",
		
                url: "./core/modules/index/action/buscarpaciente/action-default.php?elegido="+elegido+"&paciente="+paciente+"&elegido1="+elegido1+"&elegido2="+elegido2+"&elegido3="+elegido3+"&elegido4="+elegido4,
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
 if (osocial_id.length <2 ) {
     var data =<?= json_encode($obras,
      JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
    ) ?>;
    
           /// $('#osocial_id').children().remove();
          
            $.each(data,function(key, registro) {
                console.log(registro);
        $("#osocial_id").append('<option value='+registro.id+'   selected>'+registro.nombre+'</option>');
      }); 
            
        
 }


var html="";
     
        for (var i = osocial_id.length - 1; i >= 0; --i) {
            if (osocial_id[i].value != cadena[0]&& osocial_id[i].value != cadena[1]&& osocial_id[i].value != cadena[2]&& osocial_id[i].value != 2222&& osocial_id[i].value != 22212) {
             // osocial_id.remove(i);
            }
        }
          
        
}



// AJAX call for autocomplete dni
$(document).ready(function(){
	$("#dni66").keyup(function(){
              var chars = $(this).val().length;
	
   //Comprobamos la longitud de caracteres
	if (chars >14){
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
                
                
                } 
	});
});
// AJAX call for autocomplete 2 medico solicitante
$(document).ready(function(){
	$("#paciente33").keyup(function(){
               // alert($(this).val());
              var chars = $(this).val().length;
	
   //Comprobamos la longitud de caracteres
	if (chars >3){
		
	
               
               
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
                
            }   
                
	});
});
//To select Paciente name




            </script>
        </div>

 


<div class="col-md-10">
<h1>Nuevo Turno  <?php echo " - ".$paciente->name." ".$paciente->lastname; ?></h1>

<form class="form-horizontal" role="form" method="post" autocomplete="off" action="./?action=addreservation">
<div class="col-lg-5">
        <input type="text" name="paciente" required class="hidden" id="inputEmail1"  placeholder="paciente" value=<?php echo $paciente->lastname." ".$paciente->name; ?>>
    
      <input type="text" name="title" required class="hidden" id="inputEmail1" placeholder="Asunto" value=<?php echo $paciente->lastname; ?>>
</div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-5 control-label">Paciente <?php echo $paciente->id." - ".$paciente->name." ".$paciente->lastname; ?></label>
    <div class="col-lg-5">
    <input type="hidden" name="pacient_id" required class="hidden" id="pacient_id" placeholder="pacient_id" value=<?php echo $paciente->id; ?> >
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
     // $minutos= date("H:i",strtotime(" - $min min "));
     if(isset($_GET["horaturno"]) && $_GET["horaturno"]!=""){
      $minutos= $_GET["horaturno"]; 
  }else
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
     //    ?> 
        
      <input type="time" name="time_at" step="60"    value="<?php echo $minutos;  ?>" required class="form-control" id="time_at" placeholder="Hora">
      
    
    </div>
  </div>
    
   
   
    
      <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Obra Social</label>
    <div class="col-lg-4">
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
 
     <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria </label>
    <div class="col-lg-4">
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria --</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->id==$_GET["category_id"]){ echo "selected"; }?> ><?php echo $p->name." - ".$p->id; ?></option>
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
    <option value="<?php echo $p->id; ?>" >      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
 
    <?php endforeach; ?>
</select>
    </div>
    <div class="col-lg-5"> 
       <select name="modelo" id="modelo"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>  

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 2</label>
    <div class="col-lg-5">
<select name="estudio2" id="estudio2"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>">      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="col-lg-5"> 
       <select name="modelo2" id="modelo2"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>  

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 3</label>
    <div class="col-lg-5">
<select name="estudio3" id="estudio3"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>">      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="col-lg-5"> 
       <select name="modelo3" id="modelo3"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>  

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 4</label>
    <div class="col-lg-5">
<select name="estudio4" id="estudio4"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>">      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
 <?php endforeach; ?>
</select>
    </div>
    <div class="col-lg-5"> 
       <select name="modelo4" id="modelo4"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>  


    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Atencion 5</label>
    <div class="col-lg-5">
<select name="estudio5" id="estudio5"  class="form-control" >
<option value="">-- SELECCIONE --</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>">      <?php echo $p->getCategory()->name." - ".$p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="col-lg-5"> 
       <select name="modelo5" id="modelo5"  class="form-control" >    
    <option value=""></option>
    
    </select>
      </div>  
    </div>  


      
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Profesional</label>
    <div class="col-lg-3">
<select name="medic_id" id="medic_id"  class="form-control" >

  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->lastname." ".$p->name." - ".$p->id; ?></option>
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
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-3">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"   <?php if($p->name=="Pagado"){ echo "selected"; }?> ><?php echo $p->name; ?></option>
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
    
    
    
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="price" id="price" placeholder="Costo">
</div>
    </div>
  </div>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" id="observacion_coseguro" name="observacion_coseguro" placeholder="observacion_coseguro">
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

    <input type="hidden" class="form-control" id="tipo" name="tipo" value="Ambulatorio">
    <input type="hidden" class="form-control" id="tecnico_id" name="tecnico_id" value="0">



         <button type="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Agregar Turno</button>
   
     
    </div>
  </div>
</form>

</div>
</div>