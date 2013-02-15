
<link href="./css/bootstrap.css" rel="stylesheet">
<?php   
include ('./clases/TipoSolicitud.class.php');
$solicitud =  new TipoSolicitud();
$id = $solicitud->buscarTodos();
?>
<div class="container span5">
	<div class="modal-header row span5">
	    <h4>Tipos de Solicitud Actuales</h4>
	</div>
	<div class="modal-body row span5">
	    	<?php
	    		for ($i=0; $i < count($id); $i++) { 
	    		 	$solicitud->setId($id[$i]['id_tipo_solicitud']);
	    		 	$solicitud->buscar();
	    		 	echo '<blockquote><p class="text-info">'.$solicitud->getDescripcion().'</p></blockquote><br/>';
	    		 } 
		    ?>
	</div>
</div>