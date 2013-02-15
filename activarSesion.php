<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('clases/Agenda.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->
<div class="row">
<div class="page-header" style="text-align: center">
    <h1>Activar Sesión</h1>
</div>
        <?php
        $fecha = date('Y\-m\-d');
        $agenda = new Agenda();
        $sesiones = $agenda->buscarDesactivadas($fecha,$_SESSION['usuario']);
        if (count($sesiones) > 0 ){
            echo '<table class="table" style="margin: 0 10%">
            <thead>
                <tr>
                    <td><b>Sesiones del día de hoy:</b></td>
                </tr>
            </thead>
            <tbody>';
            for ($i = 0; $i < count($sesiones); $i++) {
                $agenda->setId($sesiones[$i]['id_agenda']);
                $resul = $agenda->obtenerDatos();
                $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);
                echo'
                    <tr>
                        <td class="btn-group">
                            <a class="btn btn-inverse" href="agenda.php?id='.$agenda->getId().'"><b>'.$resul[0]['dependencia'].'</b> - '.$resul[0]['descripcion'].': '.$resul[0]['siglas'].'-'.$consecutivo[0]['consecutivo'].'-'.$resul[0]['anio']; if($resul[0]['extraordinaria']) echo' (Sesión Extraordinaria)'; echo '</a>
                            <a class="btn btn-inverse activar" id="'.$agenda->getId().'_'.$resul[0]['id_dependencia'].'"><i class="icon-play icon-white"> </i></a>
                        </td>
                    </tr>';
            }
            echo'</tbody>
            </table>';
        }
        else
            echo '<div class="offset1"><h3>No hay sesiones para el día de hoy</h3></div>';
        ?>
</div>
<?php
include('pie.php');
?>
