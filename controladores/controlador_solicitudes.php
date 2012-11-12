<?php

include ('../clases/Campo.class.php');
include ('../clases/CampoSolicitud.class.php'); 

if($_POST['tipo_solicitud']=='otro'){
	echo'<label class="control-label" >Descripcion:</label>
            <div class="controls" id="aread">
                <textarea class="textarea span5" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="height: 200px"></textarea>
            </div>';
}
else{
	$cs = new CampoSolicitud($_POST['tipo_solicitud'],'');
	$idCampos = $cs->buscarCampos();
	$campo = new Campo('','');
	for ($i=0; $i < count($idCampos) ; $i++) { 
		$campo->setId($idCampos[$i]['id_campo']);
		$campo->buscar();
		echo'<div class="control-group">
				<label class="control-label" >'.$campo->getDescripcion().':</label>
				<div class="controls offset1" id="aread">
					 <input class="span3" type="text" name="campo_'.$campo->getId().'"/>
				</div>
			</div>';
	}
}

?>