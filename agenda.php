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





//<!-- info ================================================== -->

if(isset($_SESSION['usuario'])){
    $agenda = new Agenda($idAgenda);
    //$usuario = new Consejero($idUsuario);
    $resul = $agenda->obtenerDatos();
    $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);

    echo'<div class="page-header" style="text-align: center">
            <h3>Agenda de '.$resul[0]['descripcion'].'</h3>
            <h4>en sesión '; if(!$resul[0]['extraordinaria']) echo 'Ordinaria de:'; else echo 'Extraordinaria de:'; echo'</h3>
            <h3>'.$resul[0]['dependencia'].'</h4>
            <h4 class="pull-left"><'.$resul[0]['siglas']."-".$consecutivo[0]['consecutivo']."-".$resul[0]['anio'].'</h4>
            <h4 class="pull-right">Fecha:'.$resul[0]['fecha'].'</h4>
        </div>
        <div class="row">
            <div class="span9">
                <h4 >Participantes:</h4><br />';
                $par = new Participantes($agenda->getId(), '', '');
                $participantes = $par->buscar();
                for ($i = 0; $i < count($participantes); $i++) {
                    $con = new Consejero($participantes[$i]['id_consejero']);
                    $con->buscar();
                    $rol = new Rol($participantes[$i]['id_rol'],'');
                    $rol->buscar();
                   echo '<div class="span2"><strong>'.$rol->getDescripcion().':</strong>
                            <p>'.$con->getApellido().', '.$con->getNombre().'</p>
                        </div>';
                }
            echo'</div>
        </div>
        <br />
        <h4 style="text-align: left">Asuntos a tratar</h4>
        <br />';
    $asun = new Asunto('', '');
    $asuntos = $asun->buscarTodos();
    $consejero = new Consejero($_SESSION['usuario']);
    $consejero->buscar();
    $par->setConsejero($consejero->getId());
    $rol= $par->obtenerRol();
    $idPuntos = $agenda->obtenerPuntos();
    for ($i = 0; $i < count($asuntos); $i++) {                              //Asuntos
        $idSubasuntos = $asun->obtenerSubasuntos($asuntos[$i]['id_asunto']); //subasuntos que estan dentro de este asunto
        echo '<div class="asuntos">';
            echo '<h2>'.($i + 1).'.-'; echo $asuntos[$i]['descripcion'].'</h2>';                         
            echo '<span class="label label-info span8"></span>';
            for ($j = 0; $j < count($idSubasuntos); $j++) {                     //Subasuntos
                $subasunto = new Subasunto($idSubasuntos[$j]['id_subasunto']);
                if (count($subasunto->obtenerPuntos($idAgenda)) > 0) {//si el subasunto tiene por lo menos un punto
                    echo '<h3>'.($i+1).'.'.($j+1).'.-'.$subasunto->obtenerDescripcion().'</h3>';
                    echo '<span class="label label-inverse span8"></span>';
                    for ($k = 0; $k < count($idPuntos); $k++) {                 //Puntos
                        $punto = new Punto($idPuntos[$k]['id_punto']);
                        $punto->obtenerDatos();                
                        if ($punto->getSubasunto() == $subasunto->getId()) {//si el punto pertenece al subasunto
                            echo '<div class="row punto" id="'.$idPuntos[$k]['id_punto'].'">                              
                                <div class="span6">                                                 <!-- descripcion del punto-->
                                    <span class="badge badge-info">Punto'.($k+1).'</span>
                                    <br />
                                    <br />';
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
                                        for ($h=0; $h < count($data); $h++) { 
                                            $campo->setId($data[$h]['id_campo']);
                                            $campo->buscar();
                                            echo ' <b>'.$campo->getDescripcion().':</b> '.$data[$h]['contenido'];
                                        }
                                        echo '</p>';
                                    }
                                    echo'<br />
                                    <div class="span6" style="margin-left: 0px">';
                                        if($punto->getDetalle()!='')
                                        echo '<h4>Detalles:</h4>
                                        <p>'.$punto->getDetalle().'</p>';
                                        if($punto->getDecision()!='')
                                            echo '<h4>Decision:</h4>
                                            <p>'.$punto->getDecision().'</p>';
                                        $obs = new Observacion ($consejero->getId(),$punto->getId(),'');
                                        $obs->buscar();
                                        echo'<div id="observaciones_'.$punto->getId().'"> ';
                                            if($obs->getDescripcion()!=''){   
                                                echo '<b>Comentarios:</b>
                                                <div class="media well">
                                                    <a class="pull-left"><img class="media-object" width="64px" heigth="64px" src="'.$consejero->getImagen().'"></a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"> '.$consejero->getNombre().' '.$consejero->getApellido().':</h4>'.$obs->getDescripcion().'
                                                    </div>
                                                </div>';
                                            }               
                                        echo '</div>
                                        <div id="obs_'.$punto->getId().'" hidden="hidden">
                                            <div class="well form">
                                                <div id="t_area_'.$punto->getId().'">
                                                    <h4>Comentarios de '.$consejero->getNombre().' '.$consejero->getApellido().':</h4><br />
                                                    <a class="pull-left" ><img class="media-object" width="64px" heigth="64px" src="'.$consejero->getImagen().'"></a>
                                                    <textarea id="observacion_'.$punto->getId().'" name="observacion_'.$punto->getId().'"class="span4" placeholder="Inserte su observaci&oacute;n..."></textarea>
                                                    </br>
                                                    <button type="reset" class="btn">Limpiar</button>
                                                    <button id="cerrar_obs_'.$punto->getId().'" class="btn pull-right cerrar_obs">Cancelar</button>
                                                    <button id="comentar_'.$punto->getId().'" name="comentar_'.$punto->getId().'"type="submit" class="btn btn-primary pull-right comentar"><i class="icon-comment icon-white"></i> Comentar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dec_'.$punto->getId().'" class="well" hidden="hidden">
                                            <div class=" form-inline" id="formd_'.$punto->getId().'">
                                                <select id="decidir_'.$punto->getId().'" class="chzn-select">';
                                                    $est = new Estatus ('','');
                                                    $estatus = $est->buscarTodos();
                                                    for ($m=0; $m < count($estatus); $m++) { 
                                                        echo '<option value="'.$estatus[$m]['id_estatus'].'">'.$estatus[$m]['descripcion'].'</option>';
                                                    }    
                                                echo '</select>
                                                <button type="input" class="btn pull-right cdecidir">Cancelar</button>									
                                                <button type="submit" id="decidir_'.$punto->getId().'" class="btn btn-primary pull-right decidir">Decidir</button>
                                            </div>
                                        </div>
                                        <div id="exito_'.$punto->getId().'" class="alert alert-success hidden exito">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Excelente!</strong> Operacion realizada exitosamente
                                        </div>
                                        <div id="error_'.$punto->getId().'" class="alert alert-danger hidden error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Este punto ya está comentado.
                                        </div>
                                    </div>
                                </div>                                                         <!-- FIN Descripcion del punto-->                                                           
                                <div class="well span2 opciones">                                   <!-- Opciones del punto-->
                                    <h5>Estatus:</h5>';
                                    $est = new Estatus($punto->getEstatus(),'');
                                    $est->buscar();
                                    switch ($est->getDescripcion()) {
                                        case 'Ninguno':
                                            echo '<h5 class="btn span2 disabled" ><i class="icon-minus"></i> Ninguno</h5>';
                                            break;
                                        case 'Aprobado':
                                            echo '<h5 class="btn btn-success span2 disabled" ><i class="icon-ok icon-white"></i> Aprobado</h5>';
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
                                    if($resul[0]['en_sesion']){
                                        echo '<br/><br/>
                                        <div id="opcionesP_'.$idPuntos[$k]['id_punto'].'" style="margin-top:10%;">
                                            <h6> Opciones: </h6>                                                              
                                            <a id="b_observacion_'.$idPuntos[$k]['id_punto'].'" class="b_observacion btn span2">Comentar</a>';
                                            if(count($rol!=0)){
                                                for ($l=0; $l < count($rol) ; $l++){ 
                                                    if(($rol[$l]['id_rol']=='2')||($rol[$l]['id_rol']=='6')||($consejero->getPermiso() == '1')){
                                                        echo'   <a id="b_decision_'.$idPuntos[$k]['id_punto'].'" class="b_decision btn btn-info span2">Decidir<a/>
                                                        <a id="b_editar_'.$idPuntos[$k]['id_punto'].'" class="btn btn-primary span2">Editar</a>';
                                                    break;
                                                    }
                                                }
                                            }
                                        echo'</div>';                                                                       
                                    }
                                echo'</div>                                                     <!-- FIN Opciones del punto-->
                            </div>
                            <span class="label span8"></span>';
                        }//fin if si el punto pertenece al subasunto
                    }//for puntos   
                }// fin if si el subasunto tiene por lo menos un punto
            }//for subasuntos
        echo '</div><!--fin de div asuntos -->';
    }//for asuntos
    if($resul[0]['en_sesion']){
        if(count($rol!=0)){
            for ($l=0; $l < count($rol) ; $l++){
                if(($rol[$l]['id_rol']=='2')||($rol[$l]['id_rol']=='6')||($consejero->getPermiso() == '1')){ 
                    echo'<a class="btn btn-large offset2 disabled" id="'.$resul[0]['id_agenda'].'">Generar Acta</a>&nbsp&nbsp&nbsp;';
                    echo'<a class="btn btn-large btn-primary" id="cerrar_'.$resul[0]['id_agenda'].'">Cerrar Consejo</a><div id="respuesta"></div>';
                    break;
                }
            }
        }
    }    
    echo'<br/><br/><span class="label label-info span8"></span><br/>';
}
else{
    echo 'Debe iniciar sesion';  
}
include ('pie.php');
?>
