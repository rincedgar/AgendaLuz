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
<form class="form-horizontal">
    <legend><strong>Información Inicial</strong></legend> 
    <div class="control-group offset1">

        <label class="control-label">Fecha de la Sesión:</label>
        <!--                    <div class="controls">
                                <input type="text" class="span2" value="dd-mm-aaaa" data-date-format="dd-mm- yyyy" id="fecha" />
                                <a  class="btn btn-primary disabled" id="" href="#oculto">Aceptar</a>
                                <div data-date-format="dd-mm-yyyy" data-date="01-09-2012" id="dfecha" class="input-append date">
                                            <input type="text" readonly="readonly" id="fecha" value="dd-mm-yyyy" size="16" class="span2">
                                            <span class="add-on" id="ifecha"><i class="icon-th"></i></span>
                                </div>
                            
                            </div>-->
        <div class="controls">
            <div id="fecha" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php
$hoy = getdate();
echo $hoy['mday'] . '-' . $hoy['mon'] . '-' . $hoy['year'];
?>">
                <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16">
                <span class="add-on">
                    <i class="icon-calendar"></i>
                </span>
            </div>
        </div> 
    </div>
    <div hidden="hidden" id="oculto">
        <div class="control-group offset1" >
            <label class="control-label">Dependencia:</label>
            <div class="controls">
                <?php
                $depen = new Dependencias('', '');
                $dependencia = $depen->buscar();
                echo" 
                    <select>";
                for ($i = 0; $i < count($dependencia); $i++) {
                    echo"<option value={$dependencia[$i]['id_dependencia']}>{$dependencia[$i]['descripcion']}</option>";
                }echo "</select>";
                ?>
            </div>
        </div>
        <div class="control-group offset1" >
            <label class="control-label" >Tipo de Consejo:</label>
            <div class="controls">
                <?php
                $conse = new TipoConsejo("", "", "");
                $tipo = $conse->buscar();
                echo" 
                    <select>";
                for ($i = 0; $i < count($tipo); $i++) {
                    echo"<option value={$tipo[$i]['id_tipo_consejo']}>{$tipo[$i]['descripcion']}</option>";
                }echo "</select>";
                ?>
            </div>
        </div>
        <legend><strong>Participantes</strong></legend>
        <div class="control-group offset1" >

            <label class="control-label" >Preside:</label>
            <div class="controls">
                <div style="background-color: #f5f5f5;" class="bs-docs-example">

                    <input type="text" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php $conseje = new Consejero("", "");
                $consejero = $conseje->buscarTodos();
                for ($i = 0; $i < count($consejero); $i++) {
                    echo '"';
                    echo $consejero[$i]['apellido'];
                    echo " ";
                    echo $consejero[$i]['nombre'];
                    if ($i == count($consejero) - 1) {
                        echo '"';
                    } else echo '" ,';
                } ?>]'/>
                </div>    
            </div>
        </div>
        <div class="control-group offset1">
            <label class="control-label" >Secretario:</label>
            <div class="controls">
                <div style="background-color: #f5f5f5;" class="bs-docs-example">
                    <input type="text" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php for ($i = 0; $i < count($consejero); $i++) {
                    echo '"';
                    echo $consejero[$i]['apellido'];
                    echo " ";
                    echo $consejero[$i]['nombre'];
                    if ($i == count($consejero) - 1) {
                        echo '"';
                    } else echo '" ,';
                } ?>]'>
                </div>    
            </div>
        </div>

        <div class="control-group offset1" >
            <label class="control-label" >Consejeros:</label>
            <div class="controls">
                <select  multiple="multiple" id="sconsejeros">
                    <?php
                    for ($i = 0; $i < count($consejero); $i++) {
                        echo"<option value={$consejero[$i]['id_consejero']}>{$consejero[$i]['apellido']}, {$consejero[$i]['nombre']}</option>";
                    }
                    ?>	       
                </select>
                <span class="help-block">Presione "Ctrl" para seleccionar varios elemenos</span>
<!--                    <input type="button" id="nada" value="Ninguno"/>
                    <input type="button" id="todos" value="Todos"/>-->
            </div>
        </div>
        <legend><strong>Puntos</strong></legend>
        <div class="control-group offset1" >
            <textarea class="textarea" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>
            <input type="button" class="btn btn-primary" id="reset1" value="Limpiar"/>
                 
        </div>
            <div class="controls">
                
            </div>
        </div>
        
    </div><!--fin de div oculto -->

</form>

<?php
include ('pie.php');
?>
