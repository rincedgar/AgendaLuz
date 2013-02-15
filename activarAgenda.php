<?php   
include ('./clases/Agenda.class.php');
include ('./clases/Pertenencia.class.php');
include ('./clases/Consejero.class.php');
    $pertenecen = new Pertenencia ($_GET['dependencia'],'');
    $idConsejeros = $pertenecen->buscarConsejeros(date('Y\-m\-d'));
?>

<script src="./js/utilidades.js"></script>

<div class="modal-header span5">
   <h3>Está a punto de dar inicio al consejo</h3>
</div>
<div class="modal-body" style="text-align:center; min-height:100px">
    <button  class="btn btn-large" id="asignarAccidental">¿Desea asiganar roles accidentales?</button>
    <form class="form-inline" hidden="hidden" id="faccidentales">
         <input class='hidden' id='agenda' name='agenda' value=<?php echo $_GET['id'];?>></input>
        <div class="control-group " >
            <label class="control-label"><b>Preside Accidental:</b></label>
            <div class="controls">
                <select id="sel_preside" class="chzn-select span3" name="sel_preside">
                    <option value="0">Seleccione</option>
                    <?php
                        for ($i=0; $i < count($idConsejeros) ; $i++) { 
                            $consejero = new Consejero($idConsejeros[$i]['id_consejero'],'','','','');
                            $consejero->buscar();
                            echo '<option value='.$consejero->getId().'>'.$consejero->getApellido().', '.$consejero->getNombre().'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>   
        <div class="control-group" >
            <label class="control-label"><b>Secretario Accidental:</b></label>
            <div class="controls">
                <select id="sel_secretario" class="chzn-select span3" name="sel_secretario">
                    <option value="0">Seleccione</option>
                    <?php
                        for ($i=0; $i < count($idConsejeros) ; $i++) { 
                            $consejero = new Consejero($idConsejeros[$i]['id_consejero'],'','','','');
                            $consejero->buscar();
                            echo '<option value='.$consejero->getId().'>'.$consejero->getApellido().', '.$consejero->getNombre().'</option>';
                        }
                    ?>
                </select>
            </div>
        </div> 
    </form>    
</div>
<div class="modal-footer" style="text-align:center">    
    <button id="salirModal" class="btn" >Salir</button>
    <button  class="btn btn-large btn-primary" id="iniciarConsejo" name="iniciarConsejo"><i class="icon-play icon-white"> </i> Iniciar</button>
</div>