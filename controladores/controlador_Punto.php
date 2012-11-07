<?php

include_once 'clases/Punto.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$id = (empty($_POST['id'])) ? "" : $_POST['id'];
$agenda = (empty($_POST['agenda'])) ? "" : $_POST['agenda'];
$estatus = (empty($_POST['estatus'])) ? "" : $_POST['estatus'];
$dependencia = (empty($_POST['dependencia'])) ? "" : $_POST['dependencia'];
$descripcion = (empty($_POST['descripcion'])) ? "" : $_POST['descripcion'];
$detalle = (empty($_POST['detalle'])) ? "" : $_POST['detalle'];



if ($op[1] == 'punto') {

    $punto = new Punto($id, $agenda, $estatus, $dependencia, $descripcion, $detalle);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $punto->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $punto->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $punto->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $punto->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>