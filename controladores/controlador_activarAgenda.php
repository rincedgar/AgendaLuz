<?php 
	include ('../clases/Agenda.class.php');
	include ('../clases/Participantes.class.php');

	if(isset($_POST['sel_preside'])&&($_POST['sel_preside'])!= '0'){
		$preside = new Participantes($_POST['agenda'],$_POST['sel_preside'],'5');
		$preside->insertar();
	}

	if(isset($_POST['sel_secretario'])&&($_POST['sel_secretario'])!='0'){
		$secretario = new Participantes($_POST['agenda'],$_POST['sel_secretario'],'6');
		$secretario->insertar();
	}
	
	$agenda = new Agenda($_POST['agenda']);
	$agenda->activar();
	$agenda->iniciarConsejo();
?>
