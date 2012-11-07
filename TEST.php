
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Boceto de Agendas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Agendas LUZ">
        <meta name="author" content="Edgar Rincon">

        <!-- Estilos -->
        <link href="./css/agenda.css" rel="stylesheet">
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href="./css/bootstrap-responsive.css" rel="stylesheet">
        <link href="./css/datepicker.css" rel="stylesheet">
        <!-- JavaScrips -->
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap-datepicker.js"></script>
        <script src="./js/bootstrap.js"></script>
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
                            <div class="input-append">
                                <input type="text" class="search-query" >
                                <button type="submit" class="btn">Buscar</button>
                            </div>
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


            <!-- Menu Izquierda ================================================== -->
            <div id="menuf" class="span3 hidden-phone" style="margin-left: 0px;">
                <div class="label well">
                    <ul class="nav nav-list menu">
                        <li>
                            <a href="bienvenido.php"><i class="icon-home"> </i>Inicio</a>
                        </li>
                        <li class="nav-header">
                            Menu de Agenda
                        </li>
                        <li>
                            <a href="nuevaAgenda.php"><i class="icon-list-alt"> </i>Crear Agenda</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-search"> </i>Consultar Agendas</a>
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
            <div id="info">
                <div class="span9" padding="0px;">
                    <div class="well" style="min-height:450px; text-align:justify;">

                        <!-- info ================================================== -->
                        <div class="page-header" style="text-align: center">
                            <h1>Nueva Agenda</h1>
                        </div>
                        <form class="form-horizontal">
                            <div class="control-group">
                                <legend>Informacion Inicial</legend>
                                <label class="control-label" for="inputEmail">Email</label>
                                <div class="controls">
                                    <input type="text" class="span2" value="30-08-2012" data-date-format="dd-mm- yyyy" id="fecha"/>
                                </div>
                                <button type="submit" class="btn">Aceptar</button>
                                <div/>
                        </form>
                        <script type="text/javascript">
                            $('#fecha').datepicker();
                        </script>
                        <a href="#cuerpo" class="btn btn-info pull-right"><i class="icon-arrow-up icon-white"></i>Subir</a>
                        </div><!--fin de well -->
                </div><!--fin de span9 -->
            </div><!--fin de info -->
            <div class="progress span12 hidden-phone" style="margin-left: 0">
                <div class="bar" style="width: 100%;"></div>
            </div>
        </div> <!-- Fin Cuerpo -->
        <footer class="form-actions" style="text-align: center; bottom: 0; width: 100%">
            <h6>&copy; Universidad del Zulia 2012, Derechos Reservados. Maracaibo, Venezuela.</h6>
        </footer>
    </body>
</html>