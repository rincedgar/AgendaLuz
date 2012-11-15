<?php
include ('../clases/Agenda.class.php');
include ('../clases/Consejero.class.php');
include ('../clases/Pertenencia.class.php');
include ('../clases/Dependencia.class.php');
include ('../clases/TipoConsejo.class.php');
include ('../clases/TipoAgenda.class.php');
include ('../clases/Participantes.class.php');
include ('../clases/Punto.class.php');
include ('../clases/Rol.class.php');
include ('../clases/Campo.class.php');
include ('../clases/CamposPunto.class.php');
include ('../clases/CampoSolicitud.class.php');
$opcion = $_POST['operacion'];
session_start();
//POST: opeacion, dia, dependencia, sel_dependencia, sel_tipo, sel_[roles], sel_asuntos

switch ($opcion) {
 //**********************************************************************************************************SELECTS DEPENDIENTES	
    case '1':
		$pertenecen = new Pertenencia ($_POST['dependencia'],'');
		$idConsejeros = $pertenecen->buscarConsejeros();
        $rol = new Rol('','');
        $idRoles = $rol->buscarTodos();
		echo '<div class="control-group" >
            <legend><strong>Participantes</strong></legend>';
        for ($i=0; $i < count($idRoles); $i++) {  
            $rol->setId($idRoles[$i]['id_rol']);
            $rol->buscar();

            
            echo '<div class="control-group offset1" >
            <label class="control-label" ><b>'.$rol->getDescripcion().'</b>: </label>
            <div class="controls">';
            if($rol->getDescripcion() == 'Consejero')
                echo '<select id="sel_consejeros" class="chzn-select span3" name="sel_Consejero[]" multiple data-placeholder="Seleccione los consejeros">';
            else
                echo '<select id="sel_'.$rol->getDescripcion().'" class="chzn-select span3" name="sel_'.$rol->getDescripcion().'">
                <option value=0>Seleccione</option>';

            for ($j = 0; $j < count($idConsejeros); $j++) {
                $consejero = new Consejero($idConsejeros[$j]['id_consejero'],'','','','');
                $consejero->buscar();
                echo '<option value='.$rol->getId().'_'.$consejero->getId().'>'.$consejero->getApellido().', '.$consejero->getNombre().'</option>';
            } 
            echo "</select>";
            if($rol->getDescripcion() == 'Consejero')
                echo '<br/><span class="help-block small">Seleccione todos los consejeros que participaran</span>';  
            echo "</div></div>";    
        }
		
		break;

 //**********************************************************************************************************GUARDAR AGENDA
	case '2':      
        if(($_POST['dia']!='')&&($_POST['sel_dependencia']!='')&&($_POST['sel_tipo']!='')&&(isset($_SESSION['puntos']))){
            
            $agenda = new Agenda('',$_POST['dia']);
            $idAgenda = $agenda->insertar();
            $tipoAgenda = new tipoAgenda($idAgenda,$_POST['sel_dependencia'],$_POST['sel_tipo']);
            $tipoAgenda->insertar();

            $punto = new punto('',$idAgenda,'1','','');
            $cp = new CamposPunto('','','');
            for ($i=0; $i < count($_SESSION['puntos']) ; $i++) { 
                $punto->setSubasunto($_SESSION['puntos'][$i]['id']);
                if ($_SESSION['puntos'][$i]['otro']=='false') {
                    $punto->setSolicitud($_SESSION['puntos'][$i]['id_tipo_solicitud']);
                    $punto->setOtro('false');
                    if (isset($_SESSION['puntos'][$i]['detalle'])) {
                        $punto->setDetalle($_SESSION['puntos'][$i]['detalle']);
                    }
                    $idPunto = $punto->insertar();
                    $cs = new CampoSolicitud($_SESSION['puntos'][$i]['id_tipo_solicitud'],'');
                    $idCampos= $cs->buscarCampos();
                    $campo = new Campo('','');
                    $cp->setPunto($idPunto);
                    for ($j=0; $j < count($idCampos); $j++) { 
                        $campo->setId($idCampos[$j]['id_campo']); $campo->buscar();
                        $cp->setCampo($idCampos[$j]['id_campo']);
                        $cp->setContenido($_SESSION['puntos'][$i][$campo->getDescripcion()]);
                        $cp->insertar();
                    }
                } 
                else{
                    if (isset($_SESSION['puntos'][$i]['detalle'])) {
                        $punto->setDetalle($_SESSION['puntos'][$i]['detalle']);
                    }
                    $punto->setOtro('true');
                    $punto->setSolicitud('NULL');
                    $idPunto = $punto->insertar();
                    $cp->setPunto($idPunto);
                    $cp->setCampo('7');
                    $cp->setContenido($_SESSION['puntos'][$i]['descripcion']);
                    $cp->insertar();
                }                          
            }

            $rol = new Rol('','');
            $idRoles = $rol->buscarTodos();
            $participantes = new Participantes('','','');
            $participantes->setAgenda($idAgenda);
            for ($i=0; $i < count($idRoles); $i++) {  
                $rol->setId($idRoles[$i]['id_rol']);
                $rol->buscar();
                if((($rol->getId()=='1')||($rol->getId()=='2')||($rol->getId()=='3'))&&(!empty($_POST['sel_'.$rol->getDescripcion()]))) { //si preside, secretario y consejeros NO estan vacios   
                    if($rol->getId()=='3'){ // si son Consejeros -- Select Multiple
                        $consejeros = $_POST['sel_'.$rol->getDescripcion()];
                        for ($j=0; $j < count($consejeros); $j++) { 
                            $rol_conse = explode('_', $_POST['sel_'.$rol->getDescripcion()][$j]);
                            $participantes->setConsejero($rol_conse[1]);
                            $participantes->setRol($rol_conse[0]);
                            $resultado=$participantes->insertar();
                            unset($rol_conse);
                        } 
                    }
                    else{
                        $rol_conse = explode('_', $_POST['sel_'.$rol->getDescripcion()]);
                        $participantes->setConsejero($rol_conse[1]);
                        $participantes->setRol($rol_conse[0]);
                        $resultado=$participantes->insertar();
                    }
                }   
            }
            if(isset($_SESSION['puntos']))
                unset($_SESSION['puntos']);
            if(isset($_SESSION['contador']))
                unset($_SESSION['contador']);
            if(isset($_SESSION['sub']))
                unset($_SESSION['sub']);
            if(isset($_SESSION['npuntos']))
                unset($_SESSION['npuntos']);
            echo '<div id="resul" name="exito" class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Excelente!</strong> Agenda guardada con exito!
                </div>';
        }
        else{
            echo '<div id="resul" name="fallo" class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Ups! Ha ocurrido un problema</strong>  Verifique que todos los datos esten llenos
            </div>';}
		break;

 //**********************************************************************************************************CANCELAR AGENDA
	case '3':
			//Limpiar arrays temporales
			if(isset($_SESSION['puntos']))
				unset($_SESSION['puntos']);
			if(isset($_SESSION['sub']))
				unset($_SESSION['sub']);
			if(isset($_SESSION['npuntos']))
				unset($_SESSION['npuntos']);
            if(isset($_SESSION['contador']))
                unset($_SESSION['contador']);
		break;

}
 ?> 