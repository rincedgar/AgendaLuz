<?php

include_once 'clases/Agenda.class.php';

$opcion = $_POST['opcion'];
$op = explode('_',$opcion);
//echo "respodse".$opcion;

$fecha = (empty($_POST['fecha']))?"":$_POST['fecha'];

switch ($op[1]) {
        
    case 'Agenda':
        $agenda = new Agenda($fecha);
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
        
        break;
    
    default:
        echo 'no entre';
        break;
}
?>
