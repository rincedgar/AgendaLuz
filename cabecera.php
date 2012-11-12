<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistema de Agendas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Agendas LUZ">
        <meta name="author" content="Edgar Rincon">
        <link rel="shortcut icon" href="favicon.ico" >
        <!-- Estilos -->
        <link href="./css/agenda.css" rel="stylesheet">
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href="./css/bootstrap-responsive.css" rel="stylesheet">
        <link href="./css/datepicker.css" rel="stylesheet">
        <link href="./css/chosen.css" rel="stylesheet">
        <link href="./colorbox/colorbox.css" rel="stylesheet" media="screen">

        <!-- JavaScrips -->
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap-datepicker.js"></script>
        <script src="./js/utilidades.js"></script>
        <script src="./js/bootstrap.js"></script>
        <script src="./js/chosen.jquery.js"></script>
        <script src="./js/jquery.colorbox.js"></script>
        
        
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
                    <h1 style="color:#00539F; text-align: center">Sistema de Agendas de la Facultad Experimental de Ciencias</h1>
                </div>
            </div>

            <!-- CABECERA TABLETS Y ESCRITORIO ============================ -->
            <header style="text-align: center;">
                <div class="row span12 hidden-desktop" style=" margin-top: 100px"></div>
                <div class="container">
                    <div class="row hidden-phone">
                        <div class="span3" id="logo"><img src="./img/logo_luz.png" width="90" height="105" alt="Logo LUZ">
                        </div>

                        <div class="span6">
                            <h2 style="color:#00539F">Sistema de Agendas</h2>
                            <h2 style="color:#00539F">Facultad Experimental de Ciencias</h2>
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
                <div class="hidden-phone row">
                    <ul class="nav nav-pills span8">
                        <li class="active">
                            <a id="op1" href="#">Opcion1</a>
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
                                <input type="text" class="search-query" placeholder="Busqueda en Agendas">
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
            