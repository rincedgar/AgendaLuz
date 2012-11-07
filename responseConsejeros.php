<?php

include_once 'clases/Consejero.class.php';

$opcion = $_POST['opcion'];
$op = explode('_',$opcion);
$nombre = (empty($_POST['nombre']))?"":$_POST['nombre'];
$apellido = (empty($_POST['apellido']))?"":$_POST['apellido'];
$desde = (empty($_POST['desde']))?"":$_POST['desde'];
$hasta = (empty($_POST['hasta']))?"":$_POST['hasta'];

switch ($op[1]) {
    
    case 'Consejeros':
        $consejero = new Consejero($nombre,$apellido,$desde,$hasta);     
        switch ($op[0]) {
            case 'buscar':
             
                $resultado = $consejero->$op[0]();               
                echo json_encode($resultado);
		
                break;

            case 'insertar':
                 $resultado = $consejero->$op[0]();              
                              
                 echo json_encode($resultado);
                
                break;

            case 'actualizar':
                break;

            case 'eliminar':
                break;

            default:
                break;
        }

        break;
    /*
    case 'Agenda':
        
        switch ($op[0]) {
            case 'buscar':
             //   echo "entrebuscar";           
                $resultado = $agenda->$op[0]();
                //header("Content-type:text/javascript");
               // print_r($resultado);
                echo json_encode($resultado);
		//echo $resultado;
               
                break;

            case 'insertar':
                 $resultado = $agenda->$op[0]();              
                              
                 echo json_encode($resultado);
                
                break;

            case 'actualizar':
                break;

            case 'eliminar':
                break;
        }
        
        break;*/
    
    default:
        echo 'no entre';
        break;
}
?>

