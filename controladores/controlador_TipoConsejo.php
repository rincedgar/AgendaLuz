<?php

include_once 'clases/TipoConsejo.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$id = (empty($_POST['id'])) ? "" : $_POST['id'];
$descripcion = (empty($_POST['descripcion'])) ? "" : $_POST['descripcion'];
$siglas = (empty($_POST['siglas'])) ? "" : $_POST['siglas'];

if ($op[1] == 'TipoConsejo') {

    $tipoConsejo = new TipoConsejo($id, $descripcion, $siglas);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $tipoConsejo->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $tipoConsejo->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $tipoConsejo->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $tipoConsejo->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>