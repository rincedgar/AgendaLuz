<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Boceto de Agendas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Sistema de Agendas LUZ">
		<meta name="author" content="Edgar Rincon">

		<!-- Estilos -->
		<link href="./css/bootstrap.css" rel="stylesheet">
		<link href="./css/bootstrap-responsive.css" rel="stylesheet">

		<!-- JavaScrips -->
		<script src="./js/jquery.js"></script>
		<script src="./js/bootstrap.js"></script>
		<script src="./js/bootstrap-tab.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
				var top = $('#menuf').offset().top - parseFloat($('#menuf').css('marginTop').replace(/auto/, 0));
				$(window).scroll(function(event) {
					// what the y position of the scroll is
					var y = $(this).scrollTop();

					// whether that's below the form
					if (y >= top) {
						// if so, ad the fixed class
						$('#menuf').addClass('fixed');
					} else {
						// otherwise remove it
						$('#menuf').removeClass('fixed');

						$('#info').css("margin-left", "270px");
					}
				});
			});
		</script>
	</head>

	<body  style="margin-top:50px;">

		<!-- CUERPO ================================================== -->
		<!-- CABECERA TELEFONOS ====================================== -->
		<div class="container" id="cuerpo">
			<div class="row visible-phone" style="margin-top: 100px;">
				<div class="pull-left" style="width: 30%">
					<img src="./img/logo_luz.png" alt="Logo LUZ" width="60" height="70" style="padding:10px; ">
				</div>
				<div class="pull-right" style="width:70%" >
					<h1 style="color:#00539F; font-size:20px; text-align: center">Sistema de Agendas de la Facultad Experimental de Ciencias</h1>
				</div>
			</div>

			<!-- CABECERA TABLETS Y ESCRITORIO ============================ -->
			<header style="text-align: center;">
				<div class="row span12 hidden-desktop" style=" margin-top: 100px"></div>
				<div class="container">
					<div class="row-fluid hidden-phone">
						<div class="span3" id="logo"><img src="./img/logo_luz.png" width="90" height="105" alt="Logo LUZ">
						</div>

						<div class="span6">
							<h1 style="color:#00539F">Sistema de Agendas</h1>
							<br />
							<h1 style="color:#00539F">Facultad Experimental de Ciencias</h1>
						</div>
						<div class="span3 hidden-phone"><img src="./img/logo_fec.png" width="100" height="100" alt="Logo FEC">
							<br />
						</div>
					</div>
					<div class="progress span12 hidden-phone" style="margin-left: 0">
						<div class="bar" style="width: 100%;"></div>
					</div>
				</div>
				<br />
				<!-- Barra Navegacion ================================================== -->
				<div class="navbar navbar-fixed-top hidden-desktop" style="position:fixed;">
					<div class="navbar-inner">
						<div class="container">
							<a class="brand" href="index.php" style="padding-left:30px" >Sistema de Agendas de la F.E.C.</a>
							<div class="btn-group pull-right">
								<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="icon-user"></i> Usuario <span class="caret"></span> </a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">Opciones</a>
									</li>
									<li class="divider"></li>
									<li>
										<a data-toggle="modal" href="#myModal">Salir</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- Menu Horizontal ================================================== -->
			<div id="menuh">
				<div class="hidden-phone row-fluid">
					<ul class="nav nav-pills span9">
						<li class="active">
							<a id="op1" href="index.php"><strong>Inicio</strong></a>
						</li>
						<li>
							<a id="op2" href="#">Opcion2</a>
						</li>
						<li>
							<a id="op3" href="#">Opcion3</a>
						</li>
						<li>
							<a id="op4" href="#">Opcion4</a>
						</li>
					</ul>
					<div class="span3 visible-desktop">
						<form class="form-search">
							<input type="text" class="input-medium search-query" placeholder="Buscar en Agendas">
							<button type="submit" class="btn">
								<i class="icon-search"></i>
							</button>
						</form>
					</div>
				</div>
				<div class="visible-phone">
					<ul class="nav nav-tabs nav-stacked">
						<li class="active">
							<a id="opp1" href="#"><strong>Inicio</strong></a>
						</li>
						<li>
							<a id="opp2" href="#">Opcion2</a>
						</li>
						<li>
							<a id="opp3" href="#">Opcion3</a>
						</li>
						<li>
							<a id="opp4" href="#">Opcion4</a>
						</li>
					</ul>
				</div>
			</div>
