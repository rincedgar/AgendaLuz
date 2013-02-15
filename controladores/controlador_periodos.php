<?php 
	include ('../clases/Consejero.class.php');
	if(isset($_POST['consejeros'][0])){
		$consejeros =  new Consejero ();
		for ($i=0; $i < count($_POST['consejeros']) ; $i++) { 
			$consejeros->setId($_POST['consejeros'][$i]);
			$consejeros->setDesde($_POST['inicio']);
			$consejeros->setHasta($_POST['fin']);
			$consejeros->nuevoPeriodo();
		}
		echo '<div id="existe" class="alert alert-success">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>¡Excelente!</strong> ha asigando exitosamente los nuevos periodos.
		</div>';
	}
	else
		echo '<div id="existe" class="alert alert-danger">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		   <strong>Ups!</strong> Debe seleccionar algún consejero
		</div>';
?>
