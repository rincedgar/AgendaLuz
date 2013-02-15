
<link href="./css/bootstrap.css" rel="stylesheet">
<?php   
include ('./clases/Campo.class.php');
$campos =  new Campo ();
$id = $campos->buscarTodos();
?>
<div class="container span5">
	<div class="modal-header row span5">
	    <h4>Campos Actuales</h4>
	</div>
	<div class="modal-body row span5">
	    	<?php
	    		for ($i=0; $i < count($id); $i++) { 
	    		 	$campos->setId($id[$i]['id_campo']);
	    		 	$campos->buscar();
	    		 	echo '<blockquote><p class="text-info">'.$campos->getDescripcion().'</p></blockquote><br/>';
	    		 } 
		    ?>
	</div>
</div>