<?php

include_once 'clases/Observacion.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$id = (empty($_POST['id'])) ? "" : $_POST['id'];
$punto = (empty($_POST['punto'])) ? "" : $_POST['punto'];
$descripcion = (empty($_POST['descripcion'])) ? "" : $_POST['descripcion'];
$consejero = (empty($_POST['consejero'])) ? "" : $_POST['consejero'];

if ($op[1] == 'Observacion') {

    $observacion = new Observacion($id,$punto, $descripcion, $consejero);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $observacion->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $observacion->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $observacion->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $observacion->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>

