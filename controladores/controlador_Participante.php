<?php

include_once 'clases/Participante.class.php';

$opcion = $_POST['opcion'];
$op = explode('_', $opcion);
//echo "respodse".$opcion;
$agenda = (empty($_POST['agenda'])) ? "" : $_POST['agenda'];
$consejero = (empty($_POST['consejero'])) ? "" : $_POST['consejero'];
$rol = (empty($_POST['rol'])) ? "" : $_POST['rol'];

if ($op[1] == 'Participante') {

    $participante = new Participante($agenda, $consejero, $rol);
    switch ($op[0]) {
        case 'buscar':
            //   echo "entrebuscar";           
            $resultado = $participante->$op[0]();
            //header("Content-type:text/javascript");
            // print_r($resultado);
            echo json_encode($resultado);
            //echo $resultado;

            break;

        case 'insertar':
            $resultado = $participante->$op[0]();
            
            echo json_encode($resultado);

            break;

        case 'actualizar':
            $resultado = $participante->$op[0]();

            echo json_encode();

            break;

        case 'eliminar':
            $resultado = $participante->$op[0]();

            echo json_encode($resultado);

            break;
        default:
            echo 'no entre';
    }
}
?>