<script src="./js/utilidades.js"></script>

<div class="modal-header span5">
   <h3>Está a punto de postponer consejo</h3>
</div>
<div class="modal-body" style="text-align:center; min-height:100px">
    <form class="form" id="fpostponer" >
        <div class="control-group">
            <label class="control-label"><b>Fecha nueva para la sesión:</b></label>
            <div class="controls">
                <div id="fechaPost" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d\-m\-Y');?>">
                    <input class="span2" type="text" readonly="" value="dd-mm-yyyy" size="16" id="dia" name="dia"/>
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span> 
                </div>
                <div id="errorFecha" class="alert alert-error hidden">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Ups!</strong> Debe seleccionar una fecha mayor al dia de hoy.
                </div>
                <div id="exitoPostponer" class="alert alert-success hidden">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>excelente!</strong> ha postpuesto exitosamente esta sesión.
                </div>
            </div> 
        </div>
        <input class='hidden' id='agenda' name='agenda' value=<?php echo $_GET['id'];?>></input>
        <button id="salirModal" class="btn" >Salir</button>&nbsp;&nbsp;&nbsp;        
        <button  class="btn btn-large btn-primary" disabled="disabled" id="postponerConsejo" name="postponerConsejo"><i class="icon-time icon-white"> </i> Postponer</button>
    </form>    
</div>
