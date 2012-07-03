<?php
include ('cabecera.php');
?>
<div class="modal hide fade in" id="punto">
	<?php
	include ('punto.php');
	?>
</div>
<!-- Menu Izquierda ================================================== -->
<div id="menuf" class="span3 hidden-phone" style="margin-left: 0px; top: ;">
	<div class="label well">
		<ul class="nav nav-list menu">
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
	<div class="span9" padding: 0px;">
		<div class="well" style="min-height:450px; text-align:justify;">
			<h1 style="text-align: center">Consejo T&eacute;cnico Docente </h1>
			<br />
			<h3 class="pull-left">CT-040-2012</h3>
			<h3 class="pull-right">Fecha: 16-05-2012</h3>
			<br />
			<br />
			<h2 style="text-align: center">Asuntos a tratar</h2>
			<br />
			<br />
			<div class="dependencia">
				<h3>Departamento de Computaci&oacute;n</h3>
				<span class="label label-info span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 1 / DC-040-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
						<div class=" observaciones span6" style="margin-left: 0px">
							<h4>Observaciones:</h4>
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
							</p>
							<div id="obs1" class="hide">
								<form class="well form">
									<h4>Usuario1:</h4>
									<br />
									<textarea class="input-xxlarge" placeholder="Inserte su observaci&oacute;n..."></textarea>
									<button type="reset" class="btn">
										Limpiar
									</button>
									<button type="submit" class="btn btn-primary pull-right">
										Agregar
									</button>
									<button id="cerrar" class="btn pull-right">
										Cancelar
									</button>
								</form>
							</div>
							<div id="decision1" class="well hide">
								<form class=" form-inline">
									<select id="selectp1">
										<option>Aprobado</option>
										<option> Negado</option>
										<option>Diferido</option>
										<option> Informado</option>
										<option> Otro</option>
									</select>									
									<button type="submit" class="btn btn-primary pull-right">
										Aceptar
									</button>
									<button type="input" class="btn pull-right">
										Cancelar
									</button>
								</form>
							</div>
						</div>
					</div>
					<div class="span2 opciones">
						<h5 class="estatus aprobado span2" ><i class="icon-ok icon-white"></i> Aprobado</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a id="bobs1" class="btn span2">Agregar Observaci&oacute;n</a>
							<a id="btd1" class="btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
						</div>
					</div>
				</div>
				<span class="label span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 2 / DC-041-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
						<h4>Observaciones:</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
						</p>
					</div>
					<div class="span2 opciones">
						<h5 class="estatus diferido span2" ><i class="icon-share-alt icon-white"></i> Diferido</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a class="btn span2">Agregar Observaci&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
						</div>
					</div>
				</div>
			</div><!--fin de dependencia -->
			<div class="dependencia">
				<h3 >Departamento de Biolog&iacute;a</h3>
				<span class="label label-info span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 3 / DC-042-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
					</div>
					<div class="span2 opciones">
						<h5 class="estatus negado span2" ><i class="icon-remove icon-white"></i> Negado</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a class="btn span2">Agregar Observaci&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
						</div>
					</div>
				</div>
				<span class="label span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 4 / DC-043-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
						<h4>Observaciones:</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
						</p>
					</div>
					<div class="span2 opciones">
						<h5 class="estatus informado span2" ><i class="icon-info-sign icon-white"></i> Informado</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a class="btn span2">Agregar Observaci&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
						</div>
					</div>
				</div>
				<span class="label span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 5 / DC-044-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
						<h4>Observaciones:</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
						</p>
					</div>
					<div class="span2 opciones">
						<h5 class="estatus otro span2" ><i class=" icon-asterisk icon-white"></i> Otro</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a class="btn span2">Agregar Observaci&oacute;n</a>
						</div>
					</div>
				</div>
				<span class="label span8"></span>
				<div class="row punto">
					<div class="span6">
						<span class="badge badge-info">Punto 6 / DC-045-2012</span>
						<br />
						<br />
						<h4>Asunto:</h4>
						<h5> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </h5>
						<br />
						<h4>Observaciones:</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
						</p>
					</div>
					<div class="span2 opciones">
						<h5 class="estatus ninguno span2" ><i class="icon-minus"></i> Ninguno</h5>
						<div class="well span2" style="margin-top:10%; margin-left:12%">
							<h6> Opciones: </h6>
							<a class="btn span2" data-toggle="modal" href="punto.php" data-target="#punto"> Ver detalle</a>
							<a class="btn span2">Agregar Observaci&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Tomar decisi&oacute;n</a>
							<a class="btn btn-primary span2" data-toggle="modal" href="punto.php">Editar punto</a>
						</div>
					</div>
				</div>
			</div><!--fin de dependencia -->
			<br />
			<span class="label label-info span8"></span>
			<br />
			<div class="row">
				<div class="span4">
					<h4>Participantes:</h4>
					<br />
					<strong>Preside:</strong>
					<p>
						UsuarioP
					</p>
					<strong>Secretario(a):</strong>
					<p>
						UsuarioS
					</p>
				</div>
				<div class="span4">
					<br />
					<strong>Consejeros:</strong>
					<ul>
						<li>
							Usuario1
						</li>
						<li>
							Usuario2
						</li>
						<li>
							Usuario3
						</li>
						<li>
							Usuario4
						</li>
					</ul>
				</div>
			</div>
			<a href="#cuerpo" class="btn btn-info pull-right"><i class="icon-arrow-up icon-white"></i>Subir</a>
		</div><!--fin de well -->

	</div><!--fin de span9 -->

</div><!--fin de info -->

<?php
include ('pie.php');
?>
