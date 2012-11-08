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
$opcion = $_POST['operacion'];
session_start();
 
switch ($opcion) {
	case '1':		//Cargar select dependientes
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
	case '2':       //Guardar agenda
        if(($_POST['dia']!='')&&($_POST['sel_dependencia']!='')&&($_POST['sel_tipo']!='')&&(isset($_SESSION['padres']))){
            
            $agenda = new Agenda('',$_POST['dia']);
            $idAgenda = $agenda->insertar();
            $tipoAgenda = new tipoAgenda($idAgenda,$_POST['sel_dependencia'],$_POST['sel_tipo']);
            $tipoAgenda->insertar();

            $punto = new punto('',$idAgenda,1,'','','');
            for ($i=0; $i < count($_SESSION['padres']) ; $i++) { 
                $punto->setSubasunto($_SESSION['padres'][$i]['id']);
                $punto->setDescripcion($_SESSION['padres'][$i]['descripcion']);
                $punto->setObservacion($_SESSION['padres'][$i]['detalle']);
                $punto->insertar();
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
            if(isset($_SESSION['padres']))
            {
                session_unset($_SESSION['padres']);
            }
            if(isset($_SESSION['sub']))
            {
                session_unset($_SESSION['sub']);
            }
            if(isset($_SESSION['npuntos']))
            {
                session_unset($_SESSION['npuntos']);
            }
            echo '<div id="resul" name="exito" class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Excelente!</strong> Agenda guardada con exito!
                </div>';
        }
        else{
            echo '<div id="resul" name="fallo" class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Ops! Ha ocurrido un problema</strong>  Verifique que todos los datos esten completos
            </div>';}
		break;
	case '3':
			//Limpiar arrays temporales
			if(isset($_SESSION['padres']))
				session_unset($_SESSION['padres']);
			if(isset($_SESSION['sub']))
				session_unset($_SESSION['sub']);
			if(isset($_SESSION['npuntos']))
				session_unset($_SESSION['npuntos']);
		break;

}
 ?> 