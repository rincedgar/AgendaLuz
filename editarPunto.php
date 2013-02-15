<?php   
include ('./clases/Subasunto.class.php');
include ('./clases/TipoSolicitud.class.php');
$idSubasunto = $_GET['sub'];
?>

<script src="./js/utilidades.js"></script>

<div class="modal-header span8">
    <?php
        $subasunto = new Subasunto($idSubasunto,'');
        echo '<h3>Editar Punto - <b>'.$subasunto->obtenerDescripcion().'</b></h3>';
    ?>
</div>
<div class="modal-body" id="asunto" min-height="300px">
    <div class="row span8">
        <form id="f_editar_punto" class="form-horizontal ">
            <div id="editable">
            </div>        
        </form>
        <div class=" row span5">    
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
               <strong>Excelente!</strong> El punto agregado exitosamente
            </div>
        </div>
    </div>   
</div>
<div class="modal-footer">    
    <button id="salirModal" class="btn" >Salir</button>
    <button  class="btn btn-large btn-primary" id="editarPunto" name="editarPunto">Editar</button>
</div>