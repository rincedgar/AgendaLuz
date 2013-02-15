<?php

include ('clases/Consejero.class.php');
include ('clases/Pertenencia.class.php');
include ('clases/Dependencia.class.php');
include ('clases/Permisos.class.php');
include ('cabecera.php');
include ('menuIzquierda.php');

$consejero = new Consejero($_SESSION['usuario']);
$consejero->buscar();
$permisos = new Permisos($consejero->getPermiso(),''); 
$permisos->buscar();
$pertenece = new Pertenencia('',$consejero->getId());
$idepen = $pertenece->buscarDependencias(); 
$dependencia = new Dependencias('','');
?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Opciones de Usuario</h1>
</div>
<legend><strong>Datos Personales</strong></legend>
<form id="fimagen" class="form-horizantal" action="#" method="POST">
    <div class="row"> 
        <div class="span5">
            <div class="control-group">
                <label class="control-label"><b>Nombre(s):</b></label>
                <div class="controls"> 
                    <p><?php echo $consejero->getNombre();?></p>
                </div>        
            </div>
            <div class="control-group">
                <label class="control-label"><b>Apellido(s):</b></label>
                <div class="controls"> 
                   <p><?php echo $consejero->getApellido();?></p>
                </div>        
            </div>
            <div class="control-group">
                <label class="control-label"><b>E-mail:</b></label>
                <div class="controls"> 
                   <p><?php echo $consejero->getEmail();?></p>
                </div>        
            </div>
            <div class="control-group">
                <label class="control-label"><b>Tipo de Usuario:</b></label>
                <div class="controls"> 
                   <p><?php echo $permisos->getDescripcion();?></p>
                </div>        
            </div>
        </div>  
        <div class="thumbnail span3">
            <?php echo '<img class="img-polaroid" src="'.$consejero->getImagen().'"  width="140px" height="140px">';?>
            <div class="caption" style="text-align: center">
                <p>Seleccione  una imagen para cambiarla</p>
                <input name="imagen" type="file" /><br/><br/>
                <input class='hidden' id='consejero' name='consejero' value=<?php echo $consejero->getId();?>></input>
            </div>
        </div>
    </div>
    <legend><strong>Dependencias Asociadas</strong></legend> 
    <div class="control-group">
        <div class="controls"> 
            <?php 
                for ($i=0; $i < count($idepen) ; $i++) { 
                $dependencia->setId($idepen[$i]['id_dependencia']);
                $dependencia->buscar();
                echo '<blockquote>
                         <p>'.$dependencia->getDescripcion().'</p>
                    </blockquote>';
                }
            ?>
        </div>
    </div>  
</form>
<?php
include ('pie.php');
?>

