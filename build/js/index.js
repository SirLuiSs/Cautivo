
$('form.ajax').on('submit',function () {
    var that = $(this),
        url =  that.attr('action'),
        type = that.attr('method'),
        data = {};
    that.find('[name]').each(function (index,value) {
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
            data[name]=value;
    });
    $.ajax({
        url: url,
        type: type,
        data: data,
        success:function (response) {
            
            if(response.length > 0){
                $("#formulario-id").html(response); 
                   $('#mensaje-alerta').html("");
                   $(".btn-reset").click();
                }else{
                    $('#mensaje-alerta').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Comprobante no econtrado!</strong> Verifique los datos Ingresados.</div>');
                }
        }
    }); 
    return false;
});
function imprimirdocumento() {
    document.getElementById('pdf-iframe').contentWindow.print();
}