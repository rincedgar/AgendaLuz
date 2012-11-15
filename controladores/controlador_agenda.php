<?php 
	include ('../clases/Punto.class.php');
	include ('../clases/Observacion.class.php');
	include ('../clases/Consejero.class.php');


	//POST : operacion, id, value
	$operacion = (!isset($_POST['operacion'])?0:$_POST['operacion']); 
		switch ($operacion) {
			case '1': 						// Decidir
				$punto = new Punto($_POST['id'],'',$_POST['value']);
				$punto->decidir();
			break;
			case '2':						// Comentar
				$obs = new Observacion (1,$_POST['id'],$_POST['observacion']);
				$obs->insertar();
				$conse = new Consejero(1,'','','','');
				$conse->buscar();
				echo '<div class="well">
                        <h5>Comentarios:</h5><b>'.$conse->getNombre().' '.$conse->getApellido().': </b>'.$obs->getDescripcion().
                       '</div>';
			break;
			case '3':

			break;
	}	
?>
