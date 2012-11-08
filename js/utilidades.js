

$(document).ready(function() {
 
    $('#fecha').datepicker().on('changeDate', function(ev){
            var dias = $('#dia').val();
            var hoys = $('#fecha').attr('data-date');
            var dia = dias.split('-');
            var hoy = hoys.split('-');
            var x=new Date();
            x.setFullYear(dia[2],dia[1],dia[0]);
            var y=new Date();
            y.setFullYear(hoy[2],hoy[1],hoy[0]);
            if (x<y)
                {
                    $('#errorFecha').removeClass('hidden').fadeIn(1000, function callback() {$(this).fadeOut(5000);});
                }
            else
            {
                $('#oculto').slideDown('slow');        
                $('#subir').removeClass('hidden');
            }
            $('#fecha').datepicker('hide');
    });
    
    $('.chzn-select').chosen();
    
    $('.Modal').fancybox({
        type: 'ajax',
        autoSize:true,
        autoResize:true,
        autoCenter:true,
        scrollOutside:true
    });

    function resetForm(id) {
        $('#'+id).each(function(){
                this.reset();
        });
    }

    $('#regreso').click(function(){       
        $('#aread').slideDown('slow'); 
        $('#aread').removeClass('hidden');
        $('#pdetalle').hide('slow');
        $('#regreso').hide('slow'); 
    });
    
    $('#detalle').click(function(){       
        $('#pdetalle').slideDown('slow'); 
        $('#pdetalle').removeClass('hidden');
        $('#aread').hide('slow');
        $('#regreso').show();
    });
    
    $('.typeahead').typeahead();
    
   
    $('#sel_dependencia').change(function (e){ //Siguiente Punto --Mostrar tabla
        var dependencia = $(this).attr('value');
        var datos='operacion=1&dependencia='+dependencia;
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevaAgenda.php',
                data: datos,
                success: function(datos){
                    $('#dparticipantes').empty();
                    $('#dparticipantes').append(datos);
                    $('.chzn-select').chosen();
                    $('#dparticipantes').removeClass('hidden').slideDown('slow');
                    $('#dpuntos').removeClass('hidden').slideDown('slow');
                }
            });          
    });
    
    $('#agregar_punto').click(function(e){
        
        var idAsunto = $('#sel_asuntos').val();
        if(idAsunto!='0'){
            var url = './nuevoPunto.php?sub='+idAsunto;
            $('#agregar_punto').attr('href',url);
            $('#agregar_punto').fancybox({
                type: 'ajax',
                fitToView:true,
                autoSize:true,
                autoCenter:true,

            });
        }
        else{
            alert('Debe seleccionar una dependencia');
        }
    });
    
    $('#sel_solicitud').change(function (e){ //Siguiente Punto --Mostrar tabla
        var datos='tipo_solicitud='+$(this).attr('value');
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_solicitudes.php',
                data: datos,
                success: function(datos){
                    $('#resul_solicitud').empty();
                    $('#resul_solicitud').append(datos);
                }
            });          
    });
    
     $('#siguientePunto').click(function (e){ //Siguiente Punto -- Guardar en arreglo temp
        var datos='operacion=1&'+$('#form').serialize();
        var punto = $("#desc_punto").val();
        var detalle = $("#det_punto").val();
        if(punto != ''){
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'controladores/controlador_nuevoPunto.php',
                data: datos,
                success: function(datos){
                    $('#aread').empty().html('<textarea class="textarea" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>');
                    $('#areadt').empty().html('<textarea class="textarea" id="det_punto" name="det_punto" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>');
                    $('#pdescripcion').slideDown('slow'); 
                    $('#pdescripcion').removeClass('hidden');
                    $('#pdetalle').hide('slow');
                    $('#regreso').hide('slow'); 
                    $('#exitoPunto').removeClass('hidden').fadeIn(1000, function callback() {$(this).fadeOut(3000);});
                },
                error: function (e){
                    $('#errorPunto').removeClass('hidden').fadeIn(1000, function callback() {$(this).fadeOut(3000);});
                }
            });          
        }
        else {
            alert("Debe escribir una descripcion del punto");
        }
    });     
    
    $('#guardarPunto').click(function (e){ //Siguiente Punto --Mostrar tabla
        var datos='operacion=2&'+$('#form').serialize();
        var punto = $("#desc_punto").val();       
        if(punto != ''){
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevoPunto.php',
                data: datos,
                success: function(datos){
                 
                    parent.$.fancybox.close();    
                    $("#tablaPuntos").empty();
                    $('#tablaPuntos').append(datos);
                    $('#tablaPuntos').removeClass('hidden'); 
                    $('#tablaPuntos').slideDown('slow'); 

                }
            });
        }
        else {
                alert("Debe escribir una descripcion del punto");
            }        
            
    });

    $('#cancelarAgenda').click(function (e){ //Siguiente Punto --Mostrar tabla
        var datos='operacion=3&'+$('#form').serialize();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevoAgenda.php',
                data: datos,
                success: function(datos){
                 window.location='bienvenido.php'; 
                }
            });        
            
    });

    $('#guardarAgenda').unbind("click").click(function(){
        var datos='operacion=2&'+$('#fagenda').serialize();     
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevaAgenda.php',
                data: datos,
                success: function(datos){
                    $('#resultado').empty();
                    $("#tablaPuntos").empty();
                    $('#resultado').append(datos);
                    if($('#resul').attr('name')=='exito'){
                        window.location='nuevaAgenda.php';
                    }
                }
            });
    });


   
    $('.b_observacion').click(function (e){
         var id = $(this).attr('id').split('_');
         $('#obs_'+id[2]).toggle();
    });
    
    $('.b_decision').click(function (e){
         var id = $(this).attr('id').split('_');
         $('#dec_'+id[2]).toggle();
    });
    
    
    
    $('#filtro').change(function() {
        var opcion = $("#filtro").val();
        switch(opcion){
            case '1':
                $('#ffecha').addClass('hidden');
                $('#fidentificador').removeClass('hidden');
                break;
            case '2':
                $('#fidentificador').addClass('hidden');
                $('#ffecha').removeClass('hidden');
                break;
        }
    });

   
});
