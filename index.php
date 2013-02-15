<?php
include ('cabecera.php');
?>
<!-- Informacion ================================================== -->
<div id="informacion">
    <div class="span9" padding="0px">
        <div id="info">
<div class="row span4 offset4" style="min-height: 170px; margin-top:2%; margin-bottom:2%">
	<form class="well" style="min-height:170px; text-align: left" action="#" method="post">
		<h3 style="text-align: center">Inicio de Sesi&oacute;n</h3>

		<div class="input-prepend" style="text-align: center">
			<span class="add-on"><i class="icon-user"></i></span>
			<input id="usuario" class="span3" type="text" size="16" autofocus="autofocus" placeholder="Ingrese su Usuario" >
		</div>
		<br />
		<div class="input-prepend" style="text-align: center">
			<span class="add-on"><i class="icon-lock"></i></span>
			<input id="contraseña" class="span3" type="password" size="16" placeholder="Ingrese su Contraseña" >
		</div>

		<a href="bienvenido.php">Olvide mi contrase&ntilde;a</a>
		<input type="button" class="btn btn-primary pull-right" value="Ingresar"/>
	</form>
</div>

<?php
	include ('pie.php');
?>

<script type="text/javascript">
         $('#menuh').hide();
</script>
