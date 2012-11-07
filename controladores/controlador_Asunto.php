<?php

	include_once 'clases/Asunto.class.php';

	$opcion = $_POST['opcion'];
	$op = explode('_', $opcion);
	//echo "respodse".$opcion;
	$id = (empty($_POST['id'])) ? "" : $_POST['id'];
	$descripcion = (empty($_POST['descripcion'])) ? "" : $_POST['descripcion'];

	if ($op[1] == 'Asunto')
	{

		$asunto = new Asunto($id,$descripcion);
		switch ($op[0]) 
		{
			case 'buscar':
			case 'insertar':
			case 'actualizar':
			case 'eliminar':
				//   echo "entrebuscar";           
				$resultado = $asunto->$op[0]();
				//header("Content-type:text/javascript");
				// print_r($resultado);
				echo json_encode($resultado);
				//echo $resultado;
				break;	
			default:
				echo 'no entre';
		}
	}
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
