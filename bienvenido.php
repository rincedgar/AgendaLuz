<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('clases/Agenda.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->
<div class="row">
<div class="page-header" style="text-align: center">
    <h1>Bienvenido</h1><h3> al nuevo sistema de gestión de agendas de la FEC<h3>
</div>
<h4  style="margin-left:10%">Estas son sus agendas más recientes:</h4>
<table class="table span7" style="margin: 0 10%">
    <thead>
        <tr>
            <td><b>Sesiones Activas</b></td>
            <td>Fecha</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $consejero = new Consejero($_SESSION['usuario']);        
        $agenda = new Agenda('','','','','','');
        $activas = $consejero->agendasActivas();
        for ($i = 0; $i < count($activas); $i++) {
            $agenda->setId($activas[$i]['id_agenda']);
            $resul = $agenda->obtenerDatos();
            $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);
            echo"
                <tr>
                    <td>
                        <a class='btn btn-success btn-block' style='text-align:left; padding-left:10px' href='agenda.php?id=" . $agenda->getId() . "'><b>".$resul[0]['dependencia']."</b> - ".$resul[0]['descripcion'].": ". $resul[0]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[0]['anio']; if($resul[0]['extraordinaria']) echo' (Sesión Extraordinaria)'; echo "</a>
                    </td>
                    <td>
                    <p>".$resul[0]['fecha']."</p>
                    </td>
                </tr>";
        }
        ?>
    </tbody>
<table class="table span7" style="margin: 0 10%">
    <thead>
        <tr>
            <td><b>Proximas sesiones</b></td>
            <td> </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $consejero = new Consejero('1');        
        $agenda = new Agenda('','','','','','');
        $proximas = $consejero->proximasAgendas();
        for ($i = 0; $i < count($proximas); $i++) {
            $agenda->setId($proximas[$i]['id_agenda']);
            $resul = $agenda->obtenerDatos();
            $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);
            echo"
                <tr>
                    <td>
                        <a class='btn btn-info btn-block' style='text-align:left; padding-left:10px' href='agenda.php?id=" . $agenda->getId() . "'><b>".$resul[0]['dependencia']."</b> - ".$resul[0]['descripcion'].": ". $resul[0]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[0]['anio']; if($resul[0]['extraordinaria']) echo' (Sesión Extraordinaria)'; echo "</a>
                    </td>
                    <td>
                    <p>".$resul[0]['fecha']."</p>
                    </td>
                </tr>";
        }
        ?>
    </tbody>
</table>
<table class="table span7" style="margin: 0 10%">
    <thead>
        <tr>
            <td><b>Sesiones Anteriores</b></td>
            <td> </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $anteriores = $consejero->agendasAnteriores();
        for ($i = 0; $i < count($anteriores); $i++) {
            $agenda->setId($anteriores[$i]['id_agenda']);
            $resul = $agenda->obtenerDatos();
            $consecutivo = $agenda->consecutivo($resul[0]['id_dependencia'], $resul[0]['id_tipo_consejo'], $resul[0]['fecha'], $resul[0]['anio'], $resul[0]['extraordinaria']);
            echo"
                <tr>
                    <td>
                        <a class='btn btn-block' style='text-align:left; padding-left:10px' href='agenda.php?id=" .$agenda->getId() . "'><b>".$resul[0]['dependencia']."</b> - " . $resul[0]['descripcion'] . ": " . $resul[0]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[0]['anio']; if($resul[0]['extraordinaria']) echo' (Sesión Extraordinaria)'; echo "</a>
                    </td>
                    <td>
                    <p>".$resul[0]['fecha']."</p>
                    </td>
                </tr>";
        }
        ?>
    </tbody>
</table>
</div><br/>
<div>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <b>¡Atención!</b> si desea consultar otras agendas puede realizarlo desde la opción <code class="text-info">Buscar Agendas</code> del menú.
    </div>
</div>    
<?php
include('pie.php');
?>
