<?php

include_once 'clases/TipoAgenda.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$agenda = (empty($_POST['agenda'])) ? "" : $_POST['agenda'];
$dependencia= (empty($_POST['dependencia'])) ? "" : $_POST['dependencia'];
$tipo = (empty($_POST['tipo'])) ? "" : $_POST['tipo'];

if ($op[1] == 'TipoAgenda') {

    $tipoAgenda = new TipoAgenda($agenda, $dependencia, $tipo);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $tipoAgenda->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $tipoAgenda->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $tipoAgenda->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $tipoAgenda->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>