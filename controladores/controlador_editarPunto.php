<?php
	include ('../clases/CampoSolicitud.class.php');
	include ('../clases/TipoSolicitud.class.php');
	include ('../clases/Campo.class.php');
	session_start();
	$operacion = (!isset($_POST['operacion'])?0:$_POST['operacion']);

	switch ($operacion) {

	case '1':
		//**********************************************************************************     BUSCAR PUNTO Y CARGAR DATOS A EDITAR	
			for ($i=0; $i < count($_SESSION['puntos']); $i++) { 

				if ($_SESSION['puntos'][$i]['contador']==$_POST['cont']) {

					echo '<input class="hidden" id="cont" name="cont" value="'.$_POST['cont'].'"></input>';
					echo '<input class="hidden" id="sel_solicitud" name="sel_solicitud" value="0"></input>';
					if($_SESSION['puntos'][$i]['otro']=='true'){
						echo'<div class="control-group">
								<label class="control-label">Tipo de Solicitud:</label>
					            <div class="controls">
					                <h4>Otro</h4>
					                <input class="hidden" id="otro" name="otro" value="otro"></input>
					            </div>
					        </div>
							<div class="control-group">
								<label class="control-label" >Descripcion:</label>
					            <div class="controls" id="aread">
					                <textarea class="textarea span5 campo" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="height: 200px">'.$_SESSION['puntos'][$i]['descripcion'].'</textarea>
					            </div>
				            </div>';
					}
					else{
						$cs = new CampoSolicitud($_SESSION['puntos'][$i]['id_tipo_solicitud'],'');
						$idCampos = $cs->buscarCampos();
						$campo = new Campo('','');
						$solicitud = new TipoSolicitud($_SESSION['puntos'][$i]['id_tipo_solicitud'],'');
						$solicitud->buscar();
						echo '<div class="control-group">
									<label class="control-label" >tipo de Solicitud:</label>
						            <div class="controls">
						                <h4>'.$solicitud->getDescripcion().'</h4>
						                <input class="hidden" id="id_tipo_solicitud" name="id_tipo_solicitud" value='.$solicitud->getId().'></input>
						            </div>
					        	</div>
					        	';
						for ($j=0; $j < count($idCampos) ; $j++) { 
							$campo->setId($idCampos[$j]['id_campo']);
							$campo->buscar();
							echo'<div class="control-group">
									<label class="control-label" >'.$campo->getDescripcion().':</label>
									<div class="controls offset1" id="aread">
										<input class="span3 campo" type="text" name="campo_'.$campo->getId().'" value="'.$_SESSION['puntos'][$i][$campo->getDescripcion()].'"/>
									</div>
								</div>';
						}
					}
				}
			}
		break;

		case '2':
		//**********************************************************************************    BUSCAR Y EDITAR PUNTO
			for ($i=0; $i < count($_SESSION['puntos']); $i++) {	 

				if ($_SESSION['puntos'][$i]['contador']==$_POST['cont']) {
					if(isset($_POST['otro'])){
						$_SESSION['puntos'][$i]['descripcion'] = $_POST['desc_punto'];
						if (isset($_POST['det_punto'])) {
							$_SESSION['puntos'][$i]['detalle'] = $_POST['det_punto'];
						}

					}
					else{
						$cs = new CampoSolicitud($_POST['id_tipo_solicitud'],'');
						$idCampos = $cs->buscarCampos();
						$campo = new Campo('','');
						for ($j=0; $j < count($idCampos) ; $j++) { 
							$campo->setId($idCampos[$j]['id_campo']);
							$campo->buscar();
							$_SESSION['puntos'][$i][$campo->getDescripcion()]=$_POST['campo_'.$campo->getId()];
						}
					}	
				}
			}	
		break;
		case '3':
			for ($i=0; $i < count($_SESSION['puntos']); $i++) {	 
				if ($_SESSION['puntos'][$i]['contador']==$_POST['cont']) {
					unset($_SESSION['puntos'][$i]);
					$_SESSION['puntos']=array_values($_SESSION['puntos']);
				}
			}	
		break;
	}
?>