<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('clases/Pertenencia.class.php');
include ('clases/Dependencia.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->

<div class="page-header" style="text-align: center">
    <h1>Actualizar Periodos</h1>
</div>
    
    <form class="form" id="fperiodos">
                <div class="row" style="text-align:center">
                    <a class="btn btn-primary" id="todos">Seleccionar Todos</a>&nbsp;&nbsp;
                    <a class="btn" id="ninguno">Ninguno</a>
                </div><br/>
                <?php
                $depen = new Dependencias();
                $idepen = $depen->buscarTodos();
                $pertenecen = new Pertenencia();
                $consejeros= new Consejero();
                for ($i=0; $i < count($idepen); $i++) { 
                    $depen->setId($idepen[$i]['id_dependencia']);
                    $depen->buscar();
                    $pertenecen->setDependencia($idepen[$i]['id_dependencia']);
                    $idConsejeros = $pertenecen->buscarConsejerosPorDependencia();
                    if(count($idConsejeros)>0){
                        echo '
                        <br/>
                        <div class="control-group" id="control_'.$depen->getId().'">
                            <legend>'.$depen->getDescripcion().'</legend>
                        <div class="controls">';
                        $filas=0;
                        for ($j=0; $j < count($idConsejeros) ; $j++) { 
                            $consejeros->setId($idConsejeros[$j]['id_consejero']);
                            $consejeros->buscar();
                            $filas=$filas+1;
                            if($j%10 == 0) {echo '<div class="span3">'; $filas=1;}
                            echo '<label class="checkbox">
                                        <input type="checkbox" name="consejeros[]" value="'.$consejeros->getId().'">'.$consejeros->getApellido().', '.$consejeros->getNombre().'
                                    </label>';
                            if($filas == 10) echo '</div>';
                        }
                        if($filas!=0)echo '</div>';
                        echo '</div>
                            <div class="row" style="text-align:center">
                                <a class="btn btn-primary todos" id="todos_'.$depen->getId().'">Todos</a>&nbsp;&nbsp;
                                <a class="btn ninguno" id="ninguno_'.$depen->getId().'">Ninguno</a>
                            </div><br/>
                        </div>';
                    }
                }
            ?>
            <br/>
        <legend><strong>Nuevo Periodo</strong></legend>
        <div class="row">
            <div class="control-group span4" style="text-align:center">
                <label class="control-label"><b>Fecha de inicio:</b></label>
                <div class="controls">
                    <div id="fechaInicio" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d\-m\-Y');?>">
                        <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16" id="inicio" name="inicio"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span> 
                    </div>
                </div> 
            </div>
            <div class="control-group span4" style="text-align:center">
                <label class="control-label"><b>Fecha de fin:</b></label>
                <div class="controls">
                    <div id="fechaFin" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d\-m\-Y');?>">
                        <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16" id="fin" name="fin"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span> 
                    </div>
                </div> 
            </div>
        </div>
        <div id="errorFecha" class="alert alert-error hidden">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Ups!</strong> Debe seleccionar una fecha final mayor a la inicial.
        </div>
    
    <div id="resultado">

    </div>
    <div id="errorPeriodos" class="alert alert-danger hidden">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>¡Ups!</strong> ha ocurido un error.
    </div><br/><br/>
    <div style="text-align:center;" class='row'>
        <a class="btn" href="configuracion.php" id="cancelar">Cancelar</a>
        <input type="button" class="btn btn-large btn-primary" id="guardarPeriodos" name="guardarPeriodos" disabled="disabled" value="Asignar"/>
    </div>
</form>
<?php
include('pie.php');
?>
