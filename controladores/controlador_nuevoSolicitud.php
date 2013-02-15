<?php 
	include ('../clases/TipoSolicitud.class.php');
	include ('../clases/CampoSolicitud.class.php');
	include ('../clases/DependenciaSolicitud.class.php');

	$solicitud =  new TipoSolicitud ('',$_POST['solicitud']);
	$existe = $solicitud->buscarDescripcion();
	if(isset($existe[0]))
		echo '<div id="errorCampo" class="alert alert-error">
			    <button type="button" class="close" data-dismiss="alert">×</button>
			    <strong>Ops!</strong> La solicitud ya existe.
			</div>';
	else{
		$idSolicitud = $solicitud->insertar();
		echo 'Solicitud= '.$idSolicitud;
		$cs = new CampoSolicitud ($idSolicitud,'');
		for ($i=0; $i < count($_POST['campos']) ; $i++) { 
			$cs->setCampo($_POST['campos'][$i]);
			echo 'campo= '.$_POST['campos'][$i];
			$cs->insertar();
		}
		$ds = new DependenciaSolicitud('',$idSolicitud);
		for ($i=0; $i < count($_POST['dependencias']) ; $i++) { 
			$ds->setDependencia($_POST['dependencias'][$i]);
			echo 'dependencia= '.$_POST['dependencias'][$i];
			$ds->insertar();
		}
		echo '<div id="existe" class="alert alert-success">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		   <strong>Excelente!</strong> El nuevo tipo de solicitud se ha agregado exitosamente.
		</div>';
	}

	
?>
