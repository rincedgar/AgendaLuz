<?php
include('cabecera.php');
?>

<!-- Menu Izquierda ================================================== -->
<div class="span3 hidden-phone" style="margin-left: 0px;">
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header">
				Menu de Agenda
			</li>
			<li>
				<a href="#"><i class="icon-list-alt"> </i> Consultar Agendas</a>
			</li>
			<li class="nav-header">
				Configuraci&oacute;n
			</li>
			<li>
				<a href="#"><i class="icon-user"> </i>Usuario</a>
			</li>
			<li>
				<a href="#"><i class="icon-cog"> </i>Opciones</a>
			</li>
			<li class="divider"><li>
			<li>
				<a data-toggle="modal" href="#myModal"><i class="icon-off"></i> Cerrar Sesi&oacute;n</a>
			</li>
		</ul>
	</div>
</div>
<!-- info ================================================== -->
<div id="info">
	<div class="span9" style="margin-left:1%; padding: 0px;">
		<div class="well" style="min-height:450px; text-align: justify ">
			<div class="page-header" style="text-align: center">
				<h1>Bienvenido</h1>
			</div>
			
			<br />
			<div>
				<table class="table span6" style="margin: 0 10%">
					<thead>
						<tr>
							<td>Proximas sesiones</td>
							<td>Fecha</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a class="btn btn-success" href="agenda.php"><strong>Agenda de Consejo Tecnico: CT-003-2012</strong></a></td>
							<td>
							<p>
								06/04/2012
							</p></td>
						</tr>
						<tr>
							<td><a class="btn btn-info" href="#">Agenda de Consejo Academico: CA-005-2012</a></td>
							<td>
							<p>
								06/05/2012
							</p></td>
						</tr>
						<tr>
							<td><a class="btn btn-info" href="#">Agenda de Consejo Tecnico: CT-004-2012</a></td>
							<td> 
								06/07/2012
							</p></td>
						</tr>
					</tbody>
				</table>

				<table class="table span6" style="margin: 0 10%">
					<thead>
						<tr>
							<th>
							<br/>
							Últimas sesiones <th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a class="btn" href="#">Agenda de Consejo Tecnico: CT-003-2012</a></td>
							<td>
							<p>
								06/04/2012
							</p></td>
						</tr>
						<tr>
							<td><a class="btn" href="#">Agenda de Consejo Academico: CA-005-2012</a></td>
							<td>
							<p>
								06/05/2012
							</p></td>
						</tr>
						<tr>
							<td><a class="btn" href="#">Agenda de Consejo Tecnico: CT-004-2012</a></td>
							<td>
							<p>
								06/07/2012
							</p></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--fin de info -->
<a href="#cuerpo" class="btn btn-primary pull-right visible-phone"><i class="icon-arrow-up icon-white"></i>Subir</a>

	<?php
	include('pie.php');
	?>
