<?php

include_once 'clases/Dependencia.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$id = (empty($_POST['id'])) ? "" : $_POST['id'];
$descripcion = (empty($_POST['descripcion'])) ? "" : $_POST['descripcion'];

if ($op[1] == 'Dependencia') {

    $depen = new Dependencias($id,$descripcion);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $depen->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $depen->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $depen->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $depen->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>
