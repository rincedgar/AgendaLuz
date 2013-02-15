<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('clases/Dependencia.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->

<div class="page-header" style="text-align: center">
    <h1>Asignar Dependencias</h1>
</div>
    
<form class="form-horizontal" id="fasignardep">
    <div class="control-group offset1">
        <label class="control-label"><b>Consejero:</b></label>
        <div class="controls">
            <select id="sel_consejero" class="chzn-select span3" name="sel_consejero">
                <option value="0">Seleccione</option>
                <?php
                    $conse= new Consejero();
                    $idConsejeros = $conse->buscarTodos();
                    for ($i=0; $i < count($idConsejeros) ; $i++) { 
                        $conse->setId($idConsejeros[$i]['id_consejero']);
                        $conse->buscar();
                        echo '<option value="'.$conse->getId().'">'.$conse->getApellido().', '.$conse->getNombre().'</option>';
                    }
                ?>
            </select>
        </div> 
    </div>    
    <div class="control-group offset1" id="dependencias">
        <label class="control-label"><b>Dependencias:</b></label>
        <div class="controls">
            <?php
            $depen = new Dependencias();
            $idepen = $depen->buscarTodos();
            for ($i=0; $i < count($idepen); $i++) { 
                $depen->setId($idepen[$i]['id_dependencia']);
                $depen->buscar();
                echo '<label class="checkbox">
                    <input type="checkbox" id="check_'.$depen->getId().'" name="dependencias[]" value="'.$depen->getId().'">'.$depen->getDescripcion().'
                </label>';
           
            }
        ?>
        </div> 
    </div>        
    <div id="resultado">

    </div>
    <div id="alertaAsignarDependencias" class="alert alert-warning hidden">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>¡Ups!</strong> hay campos vacios.
    </div>
    <div id="exitoAsignarDependencias" class="alert alert-success hidden">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>¡Excelente!</strong> dependencias asignadas correctamente.
    </div>
    <div id="errorAsignarDependencias" class="alert alert-danger hidden">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>¡Ups!</strong> ha ocurido un error.
    </div><br/><br/>
    <div style="text-align:center;" class='row'>
        <a class="btn" href="configuracion.php" id="cancelar">Cancelar</a>
        <input type="button" class="btn btn-large btn-primary" id="guardarAsignarDependencia" name="guardarAsignarDependencia" value="Asignar"/>
    </div>
</form>
<?php
include('pie.php');
?>
