<?php
include ('cabecera.php');
//include ('punto.php');
include ('clases/Agenda.class.php');
include ('clases/Punto.class.php');
include ('clases/Asunto.class.php');
include ('clases/Subasunto.class.php');
include ('clases/Participantes.class.php');
include ('clases/Consejero.class.php');
include ('clases/Rol.class.php');
include ('menuIzquierda.php');
//$idUsuario = $_GET['u'];
?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Consultar Agendas</h1>
</div>
<form class="form-horizontal">
    <div class="control-group offset1">
        <label class="control-label">Buscar por:</label>
        <div class="controls">
            <select class="span3" id="filtro">
                <option value="0">Seleccione</option>
                <option value="1">Identificador</option>
                <option value="2">Fecha</option>
            </select>
        </div>
    </div>
</form>

<form class="form-horizontal hidden" id="ffecha">
    <div class="control-group offset1">

        <label class="control-label">Fecha de la Sesión:</label>
        <div class="controls">
            <div id="fecha" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php $hoy = getdate();
echo $hoy['mday'] . '-' . $hoy['mon'] . '-' . $hoy['year']; ?>">
                <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16"/>
                <span class="add-on">
                    <i class="icon-calendar"></i>
                </span>
            </div>
            <br/><br/>
            <input type="submit" value="Aceptar" class="btn btn-primary">
            <button class="btn">Cancelar</button>
        </div> 
    </div>
</form>
<form class="form-horizontal hidden" id="fidentificador">
    <div class="control-group offset1">
        <label class="control-label">Identificador</label>
        <div class="controls">
            <input type="text" name="identificador"><br/><br/>
            <input type="submit" value="Aceptar" class="btn btn-primary">
            <button class="btn">Cancelar</button>
        </div>
    </div>
</form>

<div id="resultados" class="hidden"></div>
<?php
include ('pie.php');
?>

