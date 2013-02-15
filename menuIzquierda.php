<?php
//$idUsuario = $_GET['u'];
$consejero = new Consejero(1);
$consejero->buscar();
include_once ('clases/Consejero.class.php');
?>

<!-- Menu Izquierda ================================================== -->
<div id="menui" class="span3 hidden-phone" style="margin-left: 0px;">
    <div class="">
        <div class="progress" style="margin-left: 0; margin-bottom:0px">
            <div class="bar" style="width: 100%;"></div>
        </div>
        <ul class="nav nav-list menu well">
            <li>
                <a href="bienvenido.php"><i class="icon-home"> </i>Inicio</a>
            </li>
            <li class="nav-header">
                Menu de Agenda
            </li>
            <li>
                <a href="busqueda.php"><i class="icon-search"> </i>Buscar Agendas</a>
            </li>
            <?php
                if(($consejero->getPermiso() == 1)||($consejero->getPermiso() == 2))
                echo'<li>
                <a href="nuevaAgenda.php"><i class="icon-book"> </i>Crear Agenda</a>
                </li>
                <li>
                    <a href="busqueda.php"><i class="icon-pencil"> </i>Modificar Agenda</a>
                </li>
                <li class="nav-header">
                    Menu de Sesiones
                </li>
                <li>
                    <a href="activarSesion.php"><i class="icon-play-circle"> </i>Activar Sesión</a>
                </li>
                <li>
                    <a href="postponerSesion.php"><i class="icon-time"> </i>Postponer Sesión</a>
                </li>';
            ?>
            <li class="nav-header">
                Configuraci&oacute;n
            </li>
            <li>
                <a href="usuario.php"><i class="icon-user"> </i>Usuario</a>
            </li>
            <?php
                if($consejero->getPermiso() == 1)
                echo'<li>
                    <a href="configuracion.php"><i class="icon-wrench"> </i>Sistema</a>
                </li>';
            ?>
            
            <li class="divider"><li>
            <li>
                <a data-toggle="modal" href="#myModal"><i class="icon-off"></i> Cerrar Sesi&oacute;n</a>
            </li>
        </ul>
        <div class="progress" style="margin-left: 0">
            <div class="bar" style="width: 100%;"></div>
        </div>
    </div>
</div>
<div id="informacion">
    <div class="span9" padding="0px">
        <div class="well" id="info" style="min-height:250px; text-align:justify;">
