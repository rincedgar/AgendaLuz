<?php 
	include ('../clases/Campo.class.php');

	$campo =  new Campo ('',$_POST['campo']);
	$existe = $campo->buscarDescripcion();
	if(isset($existe[0]))
		echo '<div id="errorCampo" class="alert alert-error">
			    <button type="button" class="close" data-dismiss="alert">×</button>
			    <strong>Ops!</strong> El campo ya existe.
			</div>';
	else{
		$campo->insertar();
		echo '<div id="existe" class="alert alert-success">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		   <strong>Excelente!</strong> El campo se ha agregado exitosamente.
		</div>';
	}

	
?>
