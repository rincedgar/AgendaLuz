<?php 
	include ('../clases/Punto.class.php');
	include ('../clases/Observacion.class.php');
	include ('../clases/Consejero.class.php');
	include ('../clases/Agenda.class.php');


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
				$consejero = new Consejero(1,'','','','');
				$consejero->buscar();
				echo '<div class="media well">
                    <a class="pull-left" ><img class="media-object" width="64px" heigth="64px" src="'.$consejero->getImagen().'"></a>
                    <div class="media-body">
                        <h4 class="media-heading"> '.$consejero->getNombre().' '.$consejero->getApellido().':</h4>'.$obs->getDescripcion().'
                    </div>
                </div>';
			break;
			case '3':  						//cerrar
				$agenda = new Agenda($_POST['id']);
				$agenda->finalizarConsejo();
				$agenda->desactivar();
				echo '<div id="exito" class="alert alert-success">
			    	<button type="button" class="close" data-dismiss="alert">×</button>
			   		<strong>Excelente!</strong> Agenda cerrada exitosamente.
				</div>';
			break;
	}	
?>
