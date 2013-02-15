<?php
include ('cabecera.php');

include ('clases/Agenda.class.php');
include ('clases/Punto.class.php');
include ('clases/Asunto.class.php');
include ('clases/Subasunto.class.php');
include ('clases/Participantes.class.php');
include ('clases/Consejero.class.php');
include ('clases/Rol.class.php');
include ('menuIzquierda.php');

?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Panel de Configuración</h1>
</div>
<div class="row">
    <table class="table table-bordered span4">
        <thead style="background-color:#333">
            <tr>
                <th style="text-align:center; color:white;">Configuraciones de Agendas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-left:10%"><a href="nuevoCampo.php"><i class="icon-align-justify"></i> Agregar Campos</a>
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><a href="nuevoTiposSolicitud.php"><i class="icon-th-list"></i> Agregar Tipos de Solicitudes</a>
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-folder-open"></i> Puntos Diferidos
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered span4">
        <thead style="background-color:#333">
            <tr>
                <th style="text-align:center; color:white;">Configuraciones de Usuarios</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-left:10%"><i class="icon-user"></i> Agregar Nuevos Usuarios
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><a href="periodos.php"><i class="icon-repeat"></i> Actualizar Periodos</a>
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><a href="asignarDependencias.php"><i class="icon-flag"></i> Asignar Dependencias</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row" style="text-align: center">
    <table class="table table-bordered span4">
        <thead style="background-color:#333">
            <tr>
                <th style="text-align:center; color:white;">Configuraciones del Sistema</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Estatus
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Dependencias
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Tipos de Consejo
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Roles
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Asuntos
                </td>
            </tr>
            <tr>
                <td style="padding-left:10%"><i class="icon-wrench"></i> Subasuntos
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include ('pie.php');
?>

