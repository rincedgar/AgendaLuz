<?php
include ('cabecera.php');
include ('clases/Campo.class.php');
include ('menuIzquierda.php');

?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Agregar Campos</h1>
</div>
<form class="form-horizontal" id="fnuevoCampo">
    <div class="control-group offset1">
        <label class="control-label"><b>Nombre:</b></label>
        <div class="controls">
            <input type="text" id="campo" class="span3" name="campo" placeholder="Nombre del campo nuevo">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <a class="btn span3 offset1" onclick="javascript:window.open('camposActuales.php','Campos Actuales','alwaysRaised=yes,width=400,height=500')">Consultar Campos Existentes</a>
        </div>
    </div>
</form> 
<div hidden="hidden" id="resultado"></div>
<div id="errorCampo" class="alert alert-error hidden">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ops!</strong> Ha ocurrido un problema al agregar el campo
</div>
<div id="alertaCampo" class="alert alert-warning hidden">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ops!</strong> debe ingresar un nombre
</div>

<div style="text-align:center;" class='row'>
    <a class="btn" href="configuracion.php" id="cancelar">Cancelar</a>
    <input type="button" class="btn btn-large btn-primary" id="guardarCampo" name="guardarCampo" value="Guardar"/>
</div>
<?php
include ('pie.php');
?>

