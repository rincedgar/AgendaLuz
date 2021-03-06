<?php   
include ('./clases/Subasunto.class.php');
include ('./clases/DependenciaSolicitud.class.php');
include ('./clases/TipoSolicitud.class.php');
$idSubasunto = $_GET['sub'];
$depSol = new DependenciaSolicitud($_GET['dep'],'');
$solicitudes = $depSol->buscarSolicitudes();
$sol = new TipoSolicitud();
?>

<script src="./js/utilidades.js"></script>

<div class="modal-header span8">
    <?php
        $subasunto = new Subasunto($idSubasunto,'');
        echo '<h3>Crear Punto - <b>'.$subasunto->obtenerDescripcion().'</b></h3>';
    ?>
    <button type="button" class="btn btn-success pull-right" id="siguientePunto" name="siguientePunto"><i class="icon-arrow-right icon-white"></i><b> Siguiente Punto</b></button> 
</div>
<div class="modal-body" id="asunto" min-height="300px">
    <div class="row span8">
        <form id="f_crear_punto" class="form-horizontal ">
                <div class="control-group" id="div_tipo_solicitud"><!--CARGA DE TIPOS DE SOLICITUD-->
                    <label class="control-label" ><b>Tipo de Solicitud:</b></label>
                    <div class="controls">
                        <select id="sel_solicitud" name="sel_solicitud" class="span4">
                            <?php
                                for ($i=0; $i < count($solicitudes)+1; $i++) { 
                                    if($i==count($solicitudes))
                                        echo '<option value="otro" selected="selected">Otro</option>';
                                    else {                               
                                        $sol->setId($solicitudes[$i]['id_tipo_solicitud']);
                                        $sol->buscar();
                                        echo '<option value="'.$sol->getId().'">'.$sol->getDescripcion().'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>              
                </div>
                <input class='hidden' id='subasunto' name='subasunto' value=<?php echo $_GET['sub'];?>></input>

                
                <div class="control-group" id="resul_solicitud">
                    <label class="control-label" >Descripción:</label>
                    <div class="controls" id="aread">
                        <textarea class="textarea span5 campo" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="height: 200px"></textarea>
                    </div>         
                </div> 


                <input type="button" class="btn btn-primary" id="detalle" value="Detalle"/> 
                <div class="control-group hidden" id="pdetalle">
                    <label class="control-label" >Detalles:</label>
                    <div class="controls" id="areadt">
                        <textarea class="textarea span5" id="det_punto" name="det_punto" placeholder="Escriba los detalles del punto ..." style="height: 200px"></textarea>
                    </div> 
                    <input type="button" class="btn btn-primary" id="regreso" value="Volver"/>               
                </div>
        </form>
        <div class=" row span7">    
            <div id="errorPunto" class="alert alert-error hidden">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Ops!</strong> Ha ocurrido un problema al agregar el punto
            </div>
            <div id="vacioPunto" class="alert alert-error hidden">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Ops!</strong> Verifique que todos los datos esten llenos
            </div>
            <div id="exitoPunto" class="alert alert-success hidden">
                <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>Excelente!</strong> El punto se ha agregado exitosamente
            </div>
        </div>
    </div>   
</div>
<div class="modal-footer">    
    <button id="salirModal" class="btn" >Salir</button>
    <button  class="btn btn-large btn-primary" id="guardarPunto" name="guardarPunto">Guardar</button>
</div>