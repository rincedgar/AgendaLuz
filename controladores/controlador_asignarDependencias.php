<?php 

	include ('../clases/Pertenencia.class.php');

	switch ($_POST['opcion']) {
		case '1':															//BUSCAR DEPENDENCIAS
			$pertenencia = new Pertenencia('', $_POST['sel_consejero']);
			$dependencias = $pertenencia->buscarDependencias();
			for ($i=0; $i < count($dependencias) ; $i++) { 
				if ($i == 0)
					$cadena = $dependencias[$i]['id_dependencia'];
				else
					$cadena = $cadena.'_'.$dependencias[$i]['id_dependencia'];
			}
			echo $cadena;
		break;
		case '2': 															//GUARDAR
			$pertenencia = new Pertenencia('', $_POST['sel_consejero']);
			for ($i=0; $i < count($_POST['dependencias']) ; $i++) { 
				$pertenencia->setDependencia($_POST['dependencias'][$i]); 
				$pertenencia->insertar();
			}
		break;
	}

	
	
?>
