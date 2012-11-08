<?php
include ('cabecera.php');
include ('clases/Agenda.class.php');
include ('clases/Punto.class.php');
include ('clases/Asunto.class.php');
include ('clases/Subasunto.class.php');
include ('clases/Participantes.class.php');
include ('clases/Consejero.class.php');
include ('clases/Estatus.class.php');
include ('clases/Rol.class.php');
include ('menuIzquierda.php');
$idAgenda = $_GET['id'];
//$idUsuario = $_GET['u'];
?>


<!-- info ================================================== -->

<?php
$agenda = new Agenda($idAgenda);
//$usuario = new Consejero($idUsuario);
$resul = $agenda->obtenerDatos();
$consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio']);
?>
<div class="page-header" style="text-align: center">
    <h2 style="text-align: center">Agenda de <?php echo $resul[0]['descripcion'] ?></h2>
    <h3 style="text-align: center"><?php echo $resul[0]['dependencia'] ?></h3>
</div>
<h4 class="pull-left"><?php echo $resul[0]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[0]['anio'] ?></h4>
<h4 class="pull-right">Fecha: <?php echo $resul[0]['fecha'] ?></h4>
<br />
<br />
<h4 style="text-align: left">Asuntos a tratar</h4>
<br />
<?php
$asun = new Asunto('', '');
$asuntos = $asun->buscarTodos();
$idPuntos = $agenda->obtenerPuntos();
for ($i = 0; $i < count($asuntos); $i++) {
    $idSubasuntos = $asun->obtenerSubasuntos($asuntos[$i]['id_asunto']); //subasuntos que estan dentro de este asunto
    echo '<div class="asuntos">';
    echo '<h2>' . ($i + 1) . '.-';
    echo "{$asuntos[$i]['descripcion']}.</h2>";                         //Asuntos
    echo "<span class='label label-info span8'></span>";
    for ($j = 0; $j < count($idSubasuntos); $j++) {                     //Subasuntos
        $subasunto = new Subasunto($idSubasuntos[$j]['id_subasunto']);
        if (count($subasunto->obtenerPuntos($idAgenda)) > 0) {//si el subasunto tiene por lo menos un punto
            echo '<h3>' . ($i + 1) . '.' . ($j + 1) . '.-' . $subasunto->obtenerDescripcion() . '</h3>';
            echo '<span class="label label-inverse span8"></span>';

            for ($k = 0; $k < count($idPuntos); $k++) {                 //Puntos
                $punto = new Punto($idPuntos[$k]['id_punto']);
                $punto->obtenerDatos();                
                if ($punto->getIdSubasunto() == $subasunto->getId()) {//si el punto pertenece al subasunto
                    ?>
                    <div class="row punto" id="<?php echo "{$idPuntos[$k]['id_punto']}" ?>">
                        <div class="span6">
                            <span class="badge badge-info">Punto <?php echo $k + 1; ?></span>
                            <br />
                            <br />
                            <h4>Descripción:</h4>
                            <h5> <?php echo $punto->getDescripcion(); ?></h5>
                            <br />
                            <div class="span6" style="margin-left: 0px">
                                <?php
                                if($punto->getObservacion()!='')
                                    echo '<h4>Observaciones:</h4>
                                <p>'.$punto->getObservacion().'</p>';
                                    ?>
                                
                                <?php echo '<div id="obs_'.$idPuntos[$k]['id_punto'].'" hidden="hidden">';?>
                                    <form class="well form">
                                        <h4>Usuario1:</h4>
                                        <br />
                                        <textarea class="span5" placeholder="Inserte su observaci&oacute;n..."></textarea>
                                        <button type="reset" class="btn">
                                            Limpiar
                                        </button>
                                        <button id="cerrar" class="btn pull-right">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Agregar
                                        </button>

                                    </form>
                                </div>
                                <?php echo '<div id="dec_'.$idPuntos[$k]['id_punto'].'" class="well" hidden="hidden">';?>
                                    <form class=" form-inline">
                                    <?php echo '<select id="select_'.$idPuntos[$k]['id_punto'].'" class="chzn-select">';?>
                                            <option>Aprobado</option>
                                            <option> Negado</option>
                                            <option>Diferido</option>
                                            <option> Informado</option>
                                            <option> Otro</option>
                                        </select>
                                        <button type="input" class="btn pull-right">
                                            Cancelar
                                        </button>									
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Aceptar
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="span2 opciones">
                            <?php
                            $est = new Estatus($punto->getEstatus(),'');
                            $est->buscarDescripcion();
                            switch ($est->getDescripcion()) {
                                case 'Ninguno':
                                    echo '<h5 class="estatus ninguno span2" ><i class="icon-minus"></i> Ninguno</h5>';
                                    break;
                                case 'Aprobado':
                                    echo '<h5 class="estatus aprobado span2" ><i class="icon-ok icon-white"></i> Aprobado</h5>
';
                                    break;
                                case 'Negado':
                                    echo '<h5 class="estatus negado span2" ><i class="icon-remove icon-white"></i> Negado</h5>';
                                    break;
                                case 'Diferido':
                                    echo '<h5 class="estatus diferido span2" ><i class="icon-share-alt icon-white"></i> Diferido</h5>';
                                    break;
                                case 'Informado':
                                    echo '<h5 class="estatus informado span2" ><i class="icon-info-sign icon-white"></i> Informado</h5>';
                                    break;
                                case 'Otro':
                                    echo '<h5 class="estatus otro span2" ><i class=" icon-asterisk icon-white"></i> Otro</h5>';
                                    break;
                                default:
                                    break;
                            }   
                            echo '<div id="opcionesP_'.$idPuntos[$k]['id_punto'].'" class="well span2" style="margin-top:10%; margin-left:12%">
                                        <h6> Opciones: </h6>                                
                                        <a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>                                
                                        <a id="b_observacion_'.$idPuntos[$k]['id_punto'].'" class="b_observacion btn span2">Agregar Observaci&oacute;n</a>
                                        <a id="b_decision_'.$idPuntos[$k]['id_punto'].'" class="b_decision btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
                                        <a id="b_editar_'.$idPuntos[$k]['id_punto'].'" class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
                                </div>';
                            ?>
                        </div>
                    </div>

                    <?php
                    echo "<span class='label span8'></span>";
                }//fin if si el punto pertenece al subasunto
            }//for puntos   
        }// fin if si el subasunto tiene por lo menos un punto
    }//for subasuntos
    echo "</div><!--fin de div asuntos -->";
}//for asuntos
?>  
<br />
<span class="label label-info span8"></span>
<br />
<div class="row">
    <div class="span4">
        <h4>Participantes:</h4><br />
        <?php
        $par = new Participantes('', '', '');
        $participantes = $par->buscar($idAgenda);
        for ($i = 0; $i < count($participantes); $i++) {
            $con = new Consejero($participantes[$i]['id_consejero']);
            $con->buscar();
            $rol = new Rol($participantes[$i]['id_rol'],'');
            $rol->buscar();

           echo '<strong>'.$rol->getDescripcion().':</strong>
                <p>
                   '.$con->getApellido().', '.$con->getNombre().'
                </p>';
        }
        ?></div>

</div>

<?php
include ('pie.php');
?>
