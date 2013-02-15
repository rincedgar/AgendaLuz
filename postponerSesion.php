<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('clases/Agenda.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->
<div class="row">
<div class="page-header" style="text-align: center">
    <h1>Postponer Sesión</h1>
</div>
        <?php
        $fecha = date('Y\-m\-d');
        $agenda = new Agenda();
        $sesiones = $agenda->buscarCreadasPendientes($_SESSION['usuario']);
        if (count($sesiones) > 0 ){
            echo '<table class="table-condensed span7" style="margin: 0 10%">
            <thead>
                <tr>
                    <td><b>N°</b></td>
                    <td><b>Proximas sesiones:</b></td>
                </tr>
            </thead>
            <tbody>';
            for ($i = 0; $i < count($sesiones); $i++) {
                $agenda->setId($sesiones[$i]['id_agenda']);
                $resul = $agenda->obtenerDatos();
                $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);
                echo'
                    <tr>
                        <td>'.($i+1).'</td>
                        <td class="btn-group">
                            <a class="btn'; if ($i%2 == 0)echo' btn-info'; echo'" href="agenda.php?id='.$agenda->getId().'"><b>'.$resul[0]['dependencia'].'</b> - '.$resul[0]['descripcion'].': '.$resul[0]['siglas'].'-'.$consecutivo[0]['consecutivo'].'-'.$resul[0]['anio']; if($resul[0]['extraordinaria']) echo' (Sesión Extraordinaria)'; echo ' / '.$resul[0]['fecha'].'</a>
                            <a class="btn';  if ($i%2 == 0)echo' btn-info'; echo ' postponer" id="'.$agenda->getId().'"><i class="icon-share-alt'; if ($i%2 == 0)echo' icon-white'; echo '"> </i></a>
                        </td>
                    </tr>';
            }
            echo'</tbody>
            </table>';
        }
        else
            echo '<div class="offset1"><h3>No tiene sesiones para postponer</h3></div>';
        ?>
</div>
<?php
include('pie.php');
?>
