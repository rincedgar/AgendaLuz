<?php
include ('cabecera.php');
//include ('punto.php');
include ('clases/Punto.class.php');
include ('clases/Asunto.class.php');
include ('clases/Subasunto.class.php');
include ('clases/Participantes.class.php');
include ('clases/Consejero.class.php');
include ('clases/TipoConsejo.class.php');
include ('clases/Dependencia.class.php');
include ('menuIzquierda.php');
?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Nueva Agenda</h1>
</div>
<div class="hidden-desktop" style="text-align: center">
    <legend>Esta página no esta disponible para dispositivos móviles o smartphones</legend>
    <img src="./img/alert.png" alt="alerta">
</div>
<form class="form-horizontal visible-desktop" id="fagenda">
    <legend><strong>Información Inicial</strong></legend> 
    <div class="control-group offset1">
        <label class="control-label"><b>Fecha de la Sesión:</b></label>
        <div class="controls">
            <div id="fecha" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php
$hoy = getdate();
echo $hoy['mday'] . '-' . $hoy['mon'] . '-' . $hoy['year'];
?>">
                <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16" id="dia" name="dia"/>
                <span class="add-on">
                    <i class="icon-calendar"></i>
                </span>
                
            </div>
        </div> 
    </div>
    <div id="errorFecha" class="alert alert-error hidden">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Ops!</strong> Debe seleccionar una fecha mayor al dia de hoy.
    </div>
    <div hidden="hidden" id="oculto">
        <div class="control-group offset1" >
            <label class="control-label"><b>Dependencia:</b></label>
            <div class="controls">
                <?php 
                $depen = new Dependencias('', '');
                $dependencia = $depen->buscar();
                echo'<select id="sel_dependencia" class="chzn-select span3" name="sel_dependencia">';
                echo'<option value=0>Seleccione</option>';
                for ($i = 0; $i < count($dependencia); $i++) {
                    echo"<option value={$dependencia[$i]['id_dependencia']}>{$dependencia[$i]['descripcion']}</option>";
                }echo "</select>";
                ?>
            </div>
        </div>
        <div class="control-group offset1" >
            <label class="control-label" ><b>Tipo de Consejo:</b></label>
            <div class="controls">
                <?php
                $conse = new TipoConsejo("", "", "");
                $tipo = $conse->buscar();
                echo '<select id="sel_tipo" class="chzn-select span3" name="sel_tipo">';
                echo'<option value=0>Seleccione</option>';
                for ($i = 0; $i < count($tipo); $i++) {
                    echo"<option value={$tipo[$i]['id_tipo_consejo']}>{$tipo[$i]['descripcion']}</option>";
                }echo "</select>";
                ?>
            </div>
        </div>
        
        <div class="hidden" id="dparticipantes">
            <!-- DIV PARA SELECTS DEPENDIENTES-->
        </div>
        <div class="hidden" id="dpuntos">
            <legend><strong>Puntos</strong></legend>
            <div class="control-group offset1" >
                <label class="control-label" ><b>Asuntos:</b></label>
                <div class="controls">
                    <?php
                    $asun = new Asunto('', '');
                    $asuntos = $asun->buscarTodos();
                    echo '<select id="sel_asuntos" class="chzn-select span3" name="sel_asuntos">';
                    echo'<option value=0>Seleccione</option>';
                    for ($i = 0; $i < count($asuntos); $i++) {
                        echo "<optgroup label={$asuntos[$i]['descripcion']}>";
                        $idSubasuntos = $asun->obtenerSubasuntos($asuntos[$i]['id_asunto']); //subasuntos que estan dentro de este asunto
                        for ($j = 0; $j < count($idSubasuntos); $j++) {
                            $subasunto = new Subasunto($idSubasuntos[$j]['id_subasunto']);
                            echo'<option value=' . $subasunto->getId() . '>' . $subasunto->obtenerDescripcion() . '</option>';
                        }
                        echo "</optgroup>";
                    }echo "</select>";
                    ?>
                </div>
                <div class="controls-group controls ">
                    <a id="agregar_punto" class="btn btn-success span2"><i class="icon-plus icon-white"></i> Agregar Puntos</a>
                </div>    
            </div>
        </div>
        <div class='control-group row'>
             <div id="tablaPuntos" class="hidden"></div>
        </div>   
        <div id="resultado">

        </div>
        <div style="text-align:center;" class='row'>
            <input type="button" class="btn" id="cancelarAgenda" value="Cancelar"/>
            <input type="button" class="btn btn-large btn-primary" id="guardarAgenda" name="guardarAgenda" value="Guardar Agenda"/>
        </div>
    </div><!--fin de div oculto -->

</form>
<?php
include ('pie.php');
?>
