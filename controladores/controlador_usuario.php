<?php
include ('../clases/Consejero.class.php');

$carpeta = '../img/usuarios/';
$url = $carpeta . basename($_FILES['imagen']['name']);

$tipo_archivo = $_FILES['imagen']['type'];
$tamano_archivo = $_FILES['imagen']['size'];
if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 300000))) {
	echo '<div id="alertaSolicitud" class="alert alert-warning">
    		<button type="button" class="close" data-dismiss="alert">×</button>
    		<strong>Ops!</strong> solo se permiten archivos menores a <b>300 kb</b> y de imagen <b>(PNG, JPG)</b>.
		</div>';
}
else{
	if (move_uploaded_file($_FILES['imagen']['tmp_name'], $url)) {
    echo '<div id="exito" class="alert alert-success">
			    <button type="button" class="close" data-dismiss="alert">×</button>
			    <strong>¡Excelente!</strong> Imagen cargada correctamente.
			</div>';
			$consejero = new Consejero($_POST['consejero'],'','','','','','','./img/usuarios/'.basename($_FILES['imagen']['name']));
			$consejero->cambiarImagen();
	} else {
	    echo '<div id="errorSolicitud" class="alert alert-error">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>¡Ups!</strong> Ha ocurrido un problema al subir el archivo '.$_FILES['imagen']['error'].'
				</div>';
	}

}



?> 