<?php
include('cabecera.php');
include ('clases/Consejero.class.php');
include ('menuIzquierda.php');
?>


<!-- info ================================================== -->
            <div class="page-header" style="text-align: center">
                <h1>Bienvenido</h1>
            </div>
            <br />
            <div>
                <table class="table span7" style="margin: 0 10%">
                    <thead>
                        <tr>
                            <td>Proximas sesiones</td>
                            <td>Fecha</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $consejero = new Consejero(); 
                            $resul=$consejero->proximasAgendas(1);//$usuario
                                     
                            	
                        for ($i = 0; $i < count($resul); $i++) {
                            $consecutivo=$consejero->generarCodigo($resul[$i]['id_dependencia'],$resul[$i]['id_tipo_consejo'],$resul[$i]['fecha'],$resul[$i]['anio']);
                            
                             echo"
                            <tr>
                                <td>
                                    <a class='btn btn-success' href='agenda.php?id=".$resul[$i]['id_agenda']."'><strong>Agenda de ".$resul[$i]['descripcion'].": ".$resul[$i]['siglas']."-".$consecutivo[0]['consecutivo']."-".$resul[$i]['anio']."</strong></a></td>
                                <td>
                                    <p>
                                       ".$resul[$i]['fecha']."
                                    </p></td>
                            </tr>";
                        }
                        ?>
                        <!--
                <table class="table span6" style="margin: 0 10%">
                    <thead>
                        <tr>
                            <th>
                                Últimas sesiones <th>Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a class="btn" href="#">Agenda de Consejo Tecnico: CT-003-2012</a></td>
                            <td>
                                <p>
                                    06/04/2012
                                </p></td>
                        </tr>
                        <tr>
                            <td><a class="btn" href="#">Agenda de Consejo Academico: CA-005-2012</a></td>
                            <td>
                                <p>
                                    06/05/2012
                                </p></td>
                        </tr>
                        <tr>
                            <td><a class="btn" href="#">Agenda de Consejo Tecnico: CT-004-2012</a></td>
                            <td>
                                <p>
                                    06/07/2012
                                </p></td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
<?php
include('pie.php');
?>
