function ponerpanel(direccion) {
	$(".right_col").load(direccion);
}
function imprimirdocumento(ruta) {
	$("#pdf-iframe").attr("src",ruta);
	window.setTimeout(imrpimir,1000);
}
function ponerdocumento(ruta) {
	$("#pdf-iframe").attr("src",ruta);
}
function convertir_fecha(e,obj,long) { 
    var valor = obj.value.replace(/\D/g, "").replace(/([0-9])$/, '$1');
    var cadena = valor.split("");
    var cadenaF = "";
    for (var i = 0; i < cadena.length; i++) {
        if(i==1){
            cadenaF = cadenaF+cadena[i]+"/";   
        }else if(i==3){
            cadenaF = cadenaF+cadena[i]+"/";
        }else{
            cadenaF = cadenaF+cadena[i];
        }
        
    }
    cadenaF= cadenaF.substr(0,long);
    $(obj).val(cadenaF);
}
function filtrar_comprobantes() {
    var fechainicio = $("#fechainicio-id").val();
    var fechafin = $("#fechafin-id").val();
    var otros = "0";
    var data = "fechainicio="+fechainicio+"&fechafin="+fechafin+"&otros="+otros;
    $.ajax({
        url: "lista_comprobantes.php",
        type: "POST",
        data: data,
        success:function (response) {
            
            if(response.length > 0){
                $("#campos_tabla").html(response); 
                $('#mensaje-alerta').html("");
            }else{
                $('#mensaje-alerta').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Comprobante no econtrado!</strong> Verifique los datos Ingresados.</div>');
            }
        }
    }); 
}
function filtrar_retenciones() {
    var fechainicio = $("#fechainicio-id").val();
    var fechafin = $("#fechafin-id").val();
    var otros = "0";
    var data = "fechainicio="+fechainicio+"&fechafin="+fechafin+"&otros="+otros;
    $.ajax({
        url: "lista_retenciones.php",
        type: "POST",
        data: data,
        success:function (response) {
            
            if(response.length > 0){
                $("#campos_tabla").html(response); 
                $('#mensaje-alerta').html("");
            }else{
                $('#mensaje-alerta').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Comprobante no econtrado!</strong> Verifique los datos Ingresados.</div>');
            }
        }
    }); 
}
function filtrar_percepciones() {
    var fechainicio = $("#fechainicio-id").val();
    var fechafin = $("#fechafin-id").val();
    var otros = "0";
    var data = "fechainicio="+fechainicio+"&fechafin="+fechafin+"&otros="+otros;
    $.ajax({
        url: "lista_percepciones.php",
        type: "POST",
        data: data,
        success:function (response) {
            
            if(response.length > 0){
                $("#campos_tabla").html(response); 
                $('#mensaje-alerta').html("");
            }else{
                $('#mensaje-alerta').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Comprobante no econtrado!</strong> Verifique los datos Ingresados.</div>');
            }
        }
    }); 
}
function filtrar_otros(controlador) {
    var txtDocumento =$("#txtDocumento").val();
    var txtRsocial = $("#txtRsocial").val();
    var txtSerie = $("#txtSerie").val();
    var txtNumero = $("#txtNumero").val();
    var txtMoneda = $("#txtMoneda").val();
    var otros = "1";
    var data = "txtDocumento="+txtDocumento+"&txtRsocial="+txtRsocial+"&txtSerie="+txtSerie+"&txtNumero="+txtNumero+"&txtMoneda="+txtMoneda+"&otros="+otros;
    $.ajax({
        url: controlador,
        type: "POST",
        data: data,
        success:function (response) {
            
            if(response.length > 0){
                $("#campos_tabla").html(response); 
                $('#mensaje-alerta').html("");
            }else{
                $('#mensaje-alerta').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Comprobante no econtrado!</strong> Verifique los datos Ingresados.</div>');
            }
        }
    }); 
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}
function numero(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;
    return /\d/.test(String.fromCharCode(keynum));
}

function imrpimir() {
	document.getElementById('pdf-iframe').contentWindow.print();
}
function descargar_xml(ruta) {
	var data = "?descargar-xml="+1+"&ruta_xml="+ruta;
	window.open("descarga.php"+data, '_blank'); 
}
function descargar_pdf(ruta,token) {
	var data = "?descargar-pdf="+1+"&ruta_pdf="+ruta;
	window.open("descarga.php"+data, '_blank');
}