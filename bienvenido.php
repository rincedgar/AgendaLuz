<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->
<div class="row">
<div class="page-header" style="text-align: center">
    <h1>Bienvenido</h1>
</div>
<br />

<table class="table span7" style="margin: 0 10%">
    <thead>
        <tr>
            <td><b>Proximas sesiones</b></td>
            <td>Fecha</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $consejero = new Consejero();
        $resul = $consejero->proximasAgendas(1); //$usuario
        for ($i = 0; $i < count($resul); $i++) {
            $consecutivo = $consejero->generarCodigo($resul[$i]['id_dependencia'], $resul[$i]['id_tipo_consejo'], $resul[$i]['fecha'], $resul[$i]['anio']);
            echo"
                <tr>
                    <td>
                        <a class='btn btn-success' href='agenda.php?id=" . $resul[$i]['id_agenda'] . "'><strong>Agenda de " . $resul[$i]['descripcion'] . ": " . $resul[$i]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[$i]['anio'] . "</strong></a>
                    </td>
                    <td>
                    <p>".$resul[$i]['fecha']."</p>
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
            <td>Fecha</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $consejero = new Consejero();
        $resul = $consejero->agendasAnteriores(1); //$usuario
        for ($i = 0; $i < count($resul); $i++) {
            $consecutivo = $consejero->generarCodigo($resul[$i]['id_dependencia'], $resul[$i]['id_tipo_consejo'], $resul[$i]['fecha'], $resul[$i]['anio']);
            echo"
                <tr>
                    <td>
                        <a class='btn btn' href='agenda.php?id=" . $resul[$i]['id_agenda'] . "'><strong>Agenda de " . $resul[$i]['descripcion'] . ": " . $resul[$i]['siglas'] . "-" . $consecutivo[0]['consecutivo'] . "-" . $resul[$i]['anio'] . "</strong></a>
                    </td>
                    <td>
                    <p>".$resul[$i]['fecha']."</p>
                    </td>
                </tr>";
        }
        ?>
    </tbody>
</table>
</div>
<?php
include('pie.php');
?>
