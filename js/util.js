/*function validar(boton)
{
    
    var id = $(this).attr("id");
    alert("atr:"+id);
    switch (boton) {
        case 'Insertar':

            document.getElementById("opcion").value='insertar'+document.getElementById("opcion").value;

            var datos = $("#form").serialize(); 
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'respose.php',
                data: datos,
                success: function(datos){
                    alert(datos);

                }

            });
            break;

        case 'Buscar':
            document.getElementById("opcion").value='buscar'+document.getElementById("opcion").value;
            var datos = $("#form").serialize();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'respose.php',
                data: datos,
                success: function(datos){
                    alert(datos);

                    $("div#resultados").show();
                    for(var i=0;i<datos.length;i++)
                    {
                        $("div#resultados").append("<br/><b>&nbsp;&nbsp; Nombre:</b> "+datos[i].nombre);
                        $("div#resultados").append("<b>&nbsp;&nbsp; Apellido:</b> "+datos[i].apellido);
                        $("div#resultados").append("<b>&nbsp;&nbsp; Desde:</b> "+datos[i].desde+"<br/>");
                        $("div#resultados").append("<b>&nbsp;&nbsp; Hasta:</b> "+datos[i].hasta);

                    }

                }

            });
            break;

    }
                    
}*/

$().ready(function() {
     
     
    $(".boton").click(function (e) {
      //  alert('class');
        var id = $(this).attr("id");
        alert("atr:"+id);
        u=document.getElementById("opcion").value=id+document.getElementById("opcion").value;
        alert(u);
        var datos = $("#form").serialize();
        //var id=document.getElementById("form").value;
        //alert("datos "+datos);
        url='/controladores/controlador'+document.getElementById("url").value+'.php';
        alert(url);
      //  alert(document.getElementById("url").value);
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: url,
            data: datos,
            success: function(datos){
                
                switch(document.getElementById("url").value)
                {
                    case '_Consejeros':
                        switch(id)
                        {
                            case 'buscar':
                                $("div#resultados").show();
                                for(var i=0;i<datos.length;i++)
                                {
                                    $("div#resultados").append("<br/><b>&nbsp;&nbsp; Nombre:</b> "+datos[i].nombre);
                                    $("div#resultados").append("<b>&nbsp;&nbsp; Apellido:</b> "+datos[i].apellido);
                                    $("div#resultados").append("<b>&nbsp;&nbsp; Desde:</b> "+datos[i].desde+"<br/>");
                                    $("div#resultados").append("<b>&nbsp;&nbsp; Hasta:</b> "+datos[i].hasta);
                	
                                }
                                break;
                                
                            case 'insertar':
                                alert("Registro Insertado con exito");                                
                                break; 
                                
                        }
                        break;
                        
                    case '_Agenda':
                        switch(id)
                        {
                            case 'buscar':
                                $("div#resultados").show();
                                for(var i=0;i<datos.length;i++)
                                {
                                    $("div#resultados").append("<br/><b>&nbsp;&nbsp; id:</b> "+datos[i].id_agenda);
                                    $("div#resultados").append("<b>&nbsp;&nbsp; Agenda:</b> "+datos[i].fecha);                               
                                }
                                break;
                                
                            case 'insertar':
                                alert("Registro Insertado con exito");                                
                                break; 
                                
                        }
                        break;
                }
              
                    		
            }
            
        });

    });
});
