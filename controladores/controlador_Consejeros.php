<?php

include_once 'clases/Consejero.class.php';

$opcion = $_POST['opcion'];
$op = explode('_',$opcion);
$nombre = (empty($_POST['nombre']))?"":$_POST['nombre'];
$apellido = (empty($_POST['apellido']))?"":$_POST['apellido'];
$desde = (empty($_POST['desde']))?"":$_POST['desde'];
$hasta = (empty($_POST['hasta']))?"":$_POST['hasta'];

if($op[1]=='Consejeros') {

        $consejero = new Consejero($nombre,$apellido,$desde,$hasta);     
        switch ($op[0]) {
            case 'buscar':
            case 'insertar':
            case 'actualizar':
            case 'eliminar':
            case 'proximasAgendas':
                $resultado = $consejero->$op[0]();               
                echo json_encode($resultado);
		
                break;

            default:
                echo 'no entre';
                break;            
        }
}
?>

