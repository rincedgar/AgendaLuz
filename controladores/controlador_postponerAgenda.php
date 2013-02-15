<?php 
	include ('../clases/Agenda.class.php');

	$agenda = new Agenda($_POST['agenda'],$_POST['dia']);
	$agenda->postponer();
?>
