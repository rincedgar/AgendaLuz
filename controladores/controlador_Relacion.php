<?php

include_once 'clases/Relacion.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$asunto = (empty($_POST['asunto'])) ? "" : $_POST['asunto'];
$subasunto= (empty($_POST['subasunto'])) ? "" : $_POST['subasunto'];

if ($op[1] == 'Relacion') {

    $relacion = new Relaciones($asunto, $subasunto);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $relacion->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $relacion->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $relacion->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $relacion->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>