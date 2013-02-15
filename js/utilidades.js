

$(document).ready(function() {

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ GENERAL
if($('#info').height() > 600){
    $('#subir').removeClass('hidden');
}

$('.chzn-select').chosen();

$('.typeahead').typeahead();

$('#cerrarModal').click(function (w){
    $.colorbox.close();
});

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
    if (x<y){
        $('#dia').reset();    
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

function resetForm(id) {
        $('#'+id).each(function(){
                this.reset();
        });
    }

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ AGENDA
  
       
    $('.b_observacion').unbind("click").click(function (e){
        var id = $(this).attr('id').split('_');
        if ($('#observaciones_'+id[2]).html()==' ') {
           $('#obs_'+id[2]).slideToggle('fast');
        }
        else{
            $('#error_'+id[2]).parent().children('.error').removeClass('hidden').fadeIn(3000).delay(3000).fadeOut('fast');  
        }
    });
    
    $('.b_decision').unbind("click").click(function (e){
         var id = $(this).attr('id').split('_');
         $('#dec_'+id[2]).slideToggle('fast');
    });

    $('.cerrar_obs').unbind("click").click(function (e){
         var id = $(this).attr('id').split('_');
         $('#obs_'+id[2]).slideUp('fast');
         $('#observacion_'+id[2]).val(' ');
    });

    $('.decidir').click(function (e){ 
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

    $('.comentar').click(function (e){ 
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

    $('a[id^="cerrar"]').unbind("click").click(function (e){ //Cerrar Agenda  - Modal
       var id = $(this).attr('id').split('_');
       var url = './cerrarAgenda.php?id='+id[1];
       $.colorbox({
            type:'ajax',
            href:url,
            onComplete: function() {
                $('#cboxClose').remove();
            }
        });
    });

    $('#cerrarConsejo').click(function (e){ 
        var datos='operacion=3&'+$('#fcerrar').serialize();

        $.ajax({
            type: 'POST',
            dataType: "html",
            url: 'controladores/controlador_agenda.php',
            data: datos,
            success: function(datos){
                $.colorbox.close();
                $('#respuesta').append(datos).show().delay(3000).fadeOut('fast');
            }
        });
    });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ INSERTAR AGENDA
        
    
    /*$('.Modal').colorbox({

    });*/

    

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
        var dep = $('#sel_dependencia').val();
        if(idAsunto!='0'){
            var url = './nuevoPunto.php?dep='+dep+'&sub='+idAsunto;
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
            $('#sindep').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
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
                    $('#exitoPunto').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                    $('#resul_solicitud').slideDown('slow'); 
                    $('#resul_solicitud').removeClass('hidden');
                    $('#pdetalle').hide('slow');
                    $('#regreso').hide('slow');
                    $('#detalle').removeClass('hidden');  
                    $('.campo').val('');
                    $('#det_punto').val('');
                    $.colorbox.resize(); 
                },
                error: function (e){
                    $('#errorPunto').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                    $.colorbox.resize(); 
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

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ACTIVAR AGENDA

    $('.activar').unbind("click").click(function (e){ //Siguiente Punto --Mostrar tabla
       var id = $(this).attr('id').split('_');
       var url = './activarAgenda.php?id='+id[0]+'&dependencia='+id[1];
       $.colorbox({
            type:'ajax',
            href:url,
            onComplete: function() {
                $('#cboxClose').remove();

            }
        });
    });

    $('#asignarAccidental').unbind("click").click(function (e){
        $('#faccidentales').slideDown('fast');
        $.colorbox.resize({height:"70%"});
    });

    $('#iniciarConsejo').unbind("click").click(function(){
            var datos= $('#faccidentales').serialize();    
                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: 'controladores/controlador_activarAgenda.php',
                    data: datos,
                    success: function(datos){
                        $.colorbox.close();
                    }
                });
        });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ POSTPONER AGENDA
    $('.postponer').unbind("click").click(function (e){ //Siguiente Punto --Mostrar tabla
       var url = './postponerAgenda.php?id='+$(this).attr('id');
       $.colorbox({
            type:'ajax',
            href:url,
            onComplete: function() {
                $('#cboxClose').remove();

            }
        });
    });

    $('#fechaPost').datepicker().on('show', function(ev){
        $('.datepicker').css('z-index','20000')
    }).on('changeDate', function(ev){
        var dias = $('#dia').val();
        var hoys = $('#fechaPost').attr('data-date');
        var dia = dias.split('-');
        var hoy = hoys.split('-');
        var x=new Date();
        x.setFullYear(dia[2],dia[1],dia[0]);
        var y=new Date();
        y.setFullYear(hoy[2],hoy[1],hoy[0]);
        $('#oculto').slideUp('fast');  
        if (x<y){   
            $('#errorFecha').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
            $('#postponerConsejo').attr('disabled','disabled');
        }
        else
        {
            $('#postponerConsejo').removeAttr('disabled');
        }
        $('#fechaPost').datepicker('hide');
    });

    $('#postponerConsejo').unbind("click").click(function(){
            var datos= $('#fpostponer').serialize();  
                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: 'controladores/controlador_postponerAgenda.php',
                    data: datos,
                    success: function(datos){
                        $.colorbox.close();
                        window.location='bienvenido.php';
                    },
                    onClosed: function(e){
                        $('.datepicker').remove();
                    }
                });
        });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CONFIGURACIONES

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CAMPOS NUEVOS

    $('#guardarCampo').unbind("click").click(function(){
        if( $('#campo').val() != ''){   
            var datos= $('#fnuevoCampo').serialize();    
            $('#resultado').empty();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevoCampo.php',
                data: datos,
                success: function(datos){
                    $('#resultado').append(datos).show().delay(3000).fadeOut('fast');

                    $('#campo').val('');
                },
                error: function (e){
                    $('#errorCampo').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                }
            });
        }
        else 
             $('#alertaCampo').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
    });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ TIPOS DE SOLICITUDES NUEVAS

    $('#guardarSolicitud').unbind("click").click(function(){
        if( $('#solicitud').val() != ''){   
            var datos= $('#fnuevoSolicitud').serialize();    
            $('#resultado').empty();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_nuevoSolicitud.php',
                data: datos,
                success: function(datos){
                    $('#resultado').append(datos).show().delay(3000).fadeOut('fast');
                    $('#solicitud').val('');
                },
                error: function (e){
                    $('#errorSolicitud').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                }
            });
        }
        else 
             $('#alertaSolicitud').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
    });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ASIGNAR NUEVOS PERIODOS

    $('#guardarPeriodos').unbind("click").click(function(){
            var datos= $('#fperiodos').serialize();    
            $('#resultado').empty();
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_periodos.php',
                data: datos,
                success: function(datos){
                    $('#resultado').append(datos).show().delay(3000).fadeOut('fast');
                },
                error: function (e){
                    $('#errorPeriodos').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                }
            });
    });

    $('#todos').unbind("click").click(function(){
        $(':checkbox').attr('checked', true);
    });

    $('#ninguno').unbind("click").click(function(){
         $(':checkbox').attr('checked', false);
    });

    $('.todos').unbind("click").click(function(){
       var id = $(this).attr('id').split('_');
       $('#control_'+id[1]+' :checkbox').attr('checked', true);
    });

    $('.ninguno').unbind("click").click(function(){
        var id = $(this).attr('id').split('_');
       $('#control_'+id[1]+' :checkbox').attr('checked', false);
    });

    $('#fechaInicio').datepicker().on('changeDate', function(ev){
        $(this).datepicker('hide');
    });

    $('#fechaFin').datepicker().on('changeDate', function(ev){
        var fin = $('#fin').val().split('-');
        var inicio = $('#inicio').val().split('-');
        var x=new Date();
        x.setFullYear(inicio[2],inicio[1],inicio[0]);
        var y =new Date();
        y.setFullYear(fin[2],fin[1],fin[0]);
        if (x<y){   
            $('#guardarPeriodos').removeAttr('disabled');
        }
        else
        {
           $('#guardarPeriodos').attr('disabled','disabled');
           $('#errorFecha').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
        }
        $(this).datepicker('hide');
    });

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ASIGNAR DEPENDENCIAS

    $('#sel_consejero').change(function (e){ //Siguiente Punto --Mostrar tabla
            var consejero = $(this).attr('value');
            var datos='opcion=1&sel_consejero='+consejero;
                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: 'controladores/controlador_asignarDependencias.php',
                    data: datos,
                    success: function(datos){
                        $(':checkbox').attr('checked',false);
                        var idepen = datos.split('_');
                        for (var i = idepen.length - 1; i >= 0; i--) {
                            $('#check_'+idepen[i]).attr('checked',true);
                        };
                    }
                });          
        });

    $('#guardarAsignarDependencia').click(function(){
        var conse = $('#sel_consejero').val();
        var depen = $(' :checked').length;
        if((conse!= 0)&&(depen>1)) {   
            var datos= 'opcion=2&'+$('#fasignardep').serialize();    
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'controladores/controlador_asignarDependencias.php',
                data: datos,
                success: function(datos){
                    $('#exitoAsignarDependencias').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                },
                error: function (e){
                    $('#errorAsignarDependencias').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
                }
            });
        }
        else 
             $('#alertaAsignarDependencias').removeClass('hidden').fadeIn('slow').delay(3000).fadeOut('fast');
    });
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ USUARIO

    $('input[type=file]').change(function() {
        $(this).upload('./controladores/controlador_usuario.php',$('#fimagen').serialize() ,function(res) {
            $(res).insertAfter(this);
        }, 'html');
    });

});