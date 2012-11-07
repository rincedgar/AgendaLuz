
<?php
include_once 'respose.php';



while($rs=$empleados->fetchObject()){
    echo "Nombre: ".$rs->nombre;
    echo "<br/>";
}

?>
