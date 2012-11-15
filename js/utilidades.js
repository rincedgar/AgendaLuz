

$(document).ready(function() {

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ GENERAL

$('.chzn-select').chosen();

$('.typeahead').typeahead();

$('#cerrarModal').click(function (w){
    $.colorbox.close();
});

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ AGENDA
  
       
    $('.b_observacion').unbind("click").click(function (e){
         var id = $(this).attr('id').split('_');
         $('#obs_'+id[2]).slideToggle('fast');
    });
    
    $('.b_decision').unbind("click").click(function (e){
         var id = $(this).attr('id').split('_');
         $('#dec_'+id[2]).slideToggle('fast');
    });

    $('.decidir').click(function (e){ //Siguiente Punto --Mostrar tabla
        var id = $(this).attr('id').split('_');       
        var datos='operacion=1&id='+id[1]+'&value='+$('#decidir_'+id[1]).attr('value');
        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_agenda.php',
            data: datos,
            success: function(datos){
                $('#formd_'+id[1]).parent().addClass('hidden').slideUp('fast');
                $('#exito_'+id[1]).parent().children('.exito').removeClass('hidden').fadeIn(3000).delay(3000).fadeOut('fast');              
            }
        });
    });

    $('.comentar').click(function (e){ //Siguiente Punto --Mostrar tabla
        var id = $(this).attr('id').split('_');       
        var datos='operacion=2&id='+id[1]+'&observacion='+$('#observacion_'+id[1]).attr('value');
        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_agenda.php',
            data: datos,
            success: function(datos){
                $('#exito_'+id[1]).parent().children('.exito').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');             
                $('obs_'+id[1]).addClass('hidden');
                $('#t_area_'+id[1]).parent().addClass('hidden').fadeOut('slow');
                $('#observaciones_'+id[1]).append(datos).removeClass('hidden').delay(2000).fadeIn('slow');
            }
        });
    });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ INSERTAR AGENDA
    $('#fecha').datepicker().on('changeDate', function(ev){
            var dias = $('#dia').val();
            var hoys = $('#fecha').attr('data-date');
            var dia = dias.split('-');
            var hoy = hoys.split('-');
            var x=new Date();
            x.setFullYear(dia[2],dia[1],dia[0]);
            var y=new Date();
            y.setFullYear(hoy[2],hoy[1],hoy[0]);
            $('#oculto').slideUp('fast');  
            if (x<y)
                {
                    $('#errorFecha').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                }
            else
            {
                $('#oculto').removeClass('hidden');
                $('#oculto').slideDown('fast');        
                $('#subir').removeClass('hidden');
            }
            $('#fecha').datepicker('hide');
    });
    
    
    
    /*$('.Modal').colorbox({

    });*/

    function resetForm(id) {
        $('#'+id).each(function(){
                this.reset();
        });
    }

    $('#regreso').click(function(){       
        $('#resul_solicitud').slideDown('fast'); 
        $('#resul_solicitud').removeClass('hidden');
        $('#pdetalle').hide('slow');
        $('#regreso').hide('slow');
        $('#detalle').removeClass('hidden'); 
    });
    
    $('#detalle').click(function(){       
        $('#pdetalle').slideDown('slow'); 
        $('#pdetalle').removeClass('hidden');
        $('#resul_solicitud').hide('slow');
        $('#regreso').show();
        $('#detalle').addClass('hidden');
    });
    
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
    
    $('#agregar_punto').unbind("click").click(function (e){   
        var idAsunto = $('#sel_asuntos').val();
        if(idAsunto!='0'){
            var url = './nuevoPunto.php?sub='+idAsunto;
            $.colorbox({
                type:'ajax',
                overlayClose:false, 
                escKey:false,
                href:url,
                scrolling:false,
                onComplete: function() {
                    $('#cboxClose').remove();
                    $.colorbox.resize();
                },
                onClosed:function(datos){
                    var datos='operacion=3';
                    $.ajax({
                        type: 'POST',
                        dataType: "html",
                        url: 'controladores/controlador_nuevoPunto.php',
                        data: datos,
                        success: function(f){
                            parent.$.colorbox.close();
                        }
                    });          
                }
            });
        }
        else{
            alert('Debe seleccionar una dependencia');
        }
    });

    $('#salirModal').unbind('click').click(function (e){ 
        parent.$.colorbox.close();
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
                    $.colorbox.resize();
                }
            });          
    });
    
     $('#siguientePunto').unbind("click").click(function (e){ //Siguiente Punto -- Guardar en arreglo temp
        var vacio=false;
        $('.campo').each(function (i){
            if($(this).val()==''){
                alert($(this).attr('name')+'='+$(this).val());
                vacio = true;
            }
        });
        if(!vacio){
            var datos='operacion=1&'+$('#f_crear_punto').serialize();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevoPunto.php',
                data: datos,
                success: function(datos){
                    $("#sel_solicitud option[value="+'otro'+"]").attr("selected",true);
                    $('#resul_solicitud').empty().html('<label class="control-label campo" >Descripción:</label><div class="controls" id="aread"><textarea class="textarea span5" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="height: 200px"></textarea></div> ');
                    $('#areadt').empty().html('<textarea class="textarea" id="det_punto" name="det_punto" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>');
                    $('#resul_solicitud').slideDown('slow'); 
                    $('#resul_solicitud').removeClass('hidden');
                    $('#pdetalle').hide('slow');
                    $('#regreso').hide('slow'); 
                    $('#exitoPunto').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                    parent.$.colorbox.resize(); 
                },
                error: function (e){
                    $('#errorPunto').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                    parent.$.colorbox.resize(); 
                }
            });
        }
        else{
            $('#vacioPunto').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
            parent.$.colorbox.resize(); 
        }
    });     
    
    $('#guardarPunto').unbind("click").click(function (e){ //Siguiente Punto --Mostrar tabla
        var datos='operacion=2&'+$('#f_crear_punto').serialize();
        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_nuevoPunto.php',
            data: datos,
            success: function(datos){
                parent.$.colorbox.close();    
                $("#tablaPuntos").empty();
                $('#tablaPuntos').append(datos);
                $('#tablaPuntos').removeClass('hidden'); 
                $('#tablaPuntos').slideDown('slow'); 

            }
        });
    });

    $('#editarPunto').unbind("click").click(function (e){ 
        var datos='operacion=2&'+$('#f_editar_punto').serialize();
        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_editarPunto.php',
            data: datos,
            success: function(datos){
                parent.$.colorbox.close();    
                var datos1='operacion=2&sel_solicitud=0&desc_punto=1';
                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: 'controladores/controlador_nuevoPunto.php',
                    data: datos1,
                    success: function(datos1){
                        parent.$.colorbox.close();    
                        $("#tablaPuntos").empty();
                        $('#tablaPuntos').append(datos1);
                        $('#tablaPuntos').removeClass('hidden'); 
                        $('#tablaPuntos').slideDown('slow'); 

                    }
                });
            }
        });
    });
    
    $('#eliminarPunto').unbind("click").click(function (e){ 
        var datos='operacion=3&'+$('#f_eliminar_punto').serialize();
        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_editarPunto.php',
            data: datos,
            success: function(datos){
                parent.$.colorbox.close();    
                var datos1='operacion=2&sel_solicitud=0&desc_punto=1';
                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: 'controladores/controlador_nuevoPunto.php',
                    data: datos1,
                    success: function(datos1){
                        parent.$.colorbox.close();    
                        $("#tablaPuntos").empty();
                        $('#tablaPuntos').append(datos1);
                        $('#tablaPuntos').removeClass('hidden'); 
                        $('#tablaPuntos').slideDown('slow'); 

                    }
                });
            }
        });
    });

    $('#cancelarAgenda').unbind("click").click(function (e){ //Siguiente Punto --Mostrar tabla
        var datos='operacion=3&'+$('#form').serialize();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevaAgenda.php',
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


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ BUSCAR AGENDA
       
    
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

