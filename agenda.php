<?php
include ('cabecera.php');
include ('clases/Agenda.class.php');
include ('clases/Punto.class.php');
include ('clases/Asunto.class.php');
include ('clases/Subasunto.class.php');
include ('clases/Participantes.class.php');
include ('clases/Consejero.class.php');
include ('clases/TipoSolicitud.class.php');
include ('clases/CamposPunto.class.php');
include ('clases/Estatus.class.php');
include ('clases/Observacion.class.php');
include ('clases/Campo.class.php');
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
$consejero = new Consejero(1,'','','','');
$consejero->buscar();
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
                if ($punto->getSubasunto() == $subasunto->getId()) {//si el punto pertenece al subasunto
                    ?>
                    <div class="row punto" id="<?php echo "{$idPuntos[$k]['id_punto']}" ?>">
                        <div class="span6">
                            <span class="badge badge-info">Punto <?php echo $k + 1; ?></span>
                            <br />
                            <br />
                            <?php
                                $cp = new CamposPunto('','','');

                                if($punto->getSolicitud()==NULL){
                                    $cp->setPunto($punto->getId());
                                    $data = $cp->buscar();
                                    echo'<h4>Asunto:</h4>
                                        <p>'.$data[0]['contenido'].'</p>';
                                }
                                else{
                                    $ts = new TipoSolicitud($punto->getSolicitud(),'');
                                    $ts->buscar();
                                    echo '<h4>'.$ts->getDescripcion().':</h4>';
                                    $cp->setPunto($punto->getId());
                                    $data = $cp->buscar();
                                    $campo = new Campo('','');
                                    echo '<p>';
                                    for ($i=0; $i < count($data); $i++) { 
                                        $campo->setId($data[$i]['id_campo']);
                                        $campo->buscar();
                                        echo ' <b>'.$campo->getDescripcion().':</b> '.$data[$i]['contenido'];

                                    }
                                    echo '</p>';

                                }
                            ?>
                            <br />
                            <div class="span6" style="margin-left: 0px">
                                <?php
                                if($punto->getDetalle()!='')
                                    echo '<h4>Detalles:</h4>
                                <p>'.$punto->getDetalle().'</p>';
                                
                                ?>
                                <?php 
                                        $obs = new Observacion ($consejero->getId(),$punto->getId(),'');
                                        $obs->buscar();
                                        $o = $obs->getDescripcion();
                                        echo'<div id="observaciones_'.$punto->getId().'">';
                                        if($o!=''){   
                                            echo '<div class="well">
                                                    <h5>Comentarios:</h5>
                                                    <b>'.$consejero->getNombre().' '.$consejero->getApellido().': </b>'.$obs->getDescripcion().
                                                '</div>';
                                        }
                                        echo '</div>';
                                ?>
                                <?php echo '<div id="obs_'.$punto->getId().'" hidden="hidden">
                                    <div class="well form">
                                        <div id="t_area_'.$punto->getId().'">';
                                            echo '<h4>Comentarios de '.$consejero->getNombre().' '.$consejero->getApellido().':</h4>'?>
                                            <br />
                                            <textarea <?php echo'id="observacion_'.$punto->getId().'" name="observacion_'.$punto->getId().'"';?>class="span5" placeholder="Inserte su observaci&oacute;n..."></textarea>
                                            <button type="reset" class="btn">Limpiar</button>
                                            <button id="cerrar" class="btn pull-right">Cancelar</button>
                                            <button <?php echo'id="comentar_'.$punto->getId().'" name="comentar_'.$punto->getId().'"';?>type="submit" class="btn btn-primary pull-right comentar"><i class="icon-comment icon-white"></i> Comentar</button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo '<div id="dec_'.$punto->getId().'" class="well" hidden="hidden">';
                                    echo '<div class=" form-inline" id="formd_'.$punto->getId().'">';?>
                                    <?php 
                                        echo '<select id="decidir_'.$punto->getId().'" class="chzn-select">';
                                        $est = new Estatus ('','');
                                        $estatus = $est->buscarTodos();
                                        for ($i=0; $i < count($estatus); $i++) { 
                                                echo '<option value="'.$estatus[$i]['id_estatus'].'">'.$estatus[$i]['descripcion'].'</option>';
                                            }    
                                        echo '    
                                        </select>
                                        <button type="input" class="btn pull-right cdecidir">Cancelar</button>									
                                        <button type="submit" id="decidir_'.$punto->getId().'" class="btn btn-primary pull-right decidir">Decidir</button>';?>
                                    </div>
                                </div>
                                 <div <?php echo 'id="exito_'.$punto->getId().'"';?> class="alert alert-success hidden exito">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Excelente!</strong> Operacion realizada exitosamente
                                </div>
                            </div>
                        </div>
                        <div class="well span2 opciones">
                            <h5>Estatus:</h5>
                            <?php
                            $est = new Estatus($punto->getEstatus(),'');
                            $est->buscar();
                            switch ($est->getDescripcion()) {
                                case 'Ninguno':
                                    echo '<h5 class="btn span2 disabled" ><i class="icon-minus"></i> Ninguno</h5>';
                                    break;
                                case 'Aprobado':
                                    echo '<h5 class="btn btn-success span2 disabled" ><i class="icon-ok icon-white"></i> Aprobado</h5>
';
                                    break;
                                case 'Negado':
                                    echo '<h5 class="btn btn-danger span2 disabled" ><i class="icon-remove icon-white"></i> Negado</h5>';
                                    break;
                                case 'Diferido':
                                    echo '<h5 class="btn btn-info span2 disabled" ><i class="icon-share-alt icon-white"></i> Diferido</h5>';
                                    break;
                                case 'Informado':
                                    echo '<h5 class="btn btn-warning span2 disabled" ><i class="icon-info-sign icon-white"></i> Informado</h5>';
                                    break;
                                case 'Otro':
                                    echo '<h5 class="btn btn-inverse span2 disabled" ><i class=" icon-asterisk icon-white"></i> Otro</h5>';
                                    break;
                                default:
                                    break;
                            }   
                            echo '<br/><br/><div id="opcionesP_'.$idPuntos[$k]['id_punto'].'" style="margin-top:10%;">
                                        
                                        <h6> Opciones: </h6>                                                              
                                        <a id="b_observacion_'.$idPuntos[$k]['id_punto'].'" class="b_observacion btn span2">Comentar</a>
                                        <input type="button" id="b_decision_'.$idPuntos[$k]['id_punto'].'" class="b_decision btn btn-info span2" value="Decidir"/>
                                        <a id="b_editar_'.$idPuntos[$k]['id_punto'].'" class="btn btn-primary span2">Editar</a>
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
