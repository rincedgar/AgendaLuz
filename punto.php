<link href="./css/bootstrap-wysihtml5.css" rel="stylesheet"/>
<script src="./js/wysihtml5-0.3.0.min.js"></script>
<script src="./js/bootstrap-wysihtml5.js"></script>
<script src="./js/utilidades.js"></script>
<div class="modal-header">
    <h3>Crear Punto</h3>
</div>
<div class="modal-body" id="asunto" data-asunto="">
    <div class="row span9">
        <form id="form">
            <div class="span6">
                <input hidden='hidden' id='subasunto' name='subasunto' value=<?php echo $_GET['sub'];?>></input>
                <div class="control-group" id="pdescripcion" >
                    <label class="control-label" >Descripcion:</label>
                    <div class="controls">
                        <textarea class="textarea" id="desc_punto" name="desc_punto" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>
                        <br/><br/>
                        <input type="button" class="btn btn-primary" id="detalle" value="Detalle"/>

                    </div>               
                </div>
                <div class="control-group hidden" id="pdetalle">
                    <label class="control-label" >Detalles:</label>
                    <div class="controls">
                        <textarea class="textarea" id="det_punto" name="det_punto" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>
                        <br/><br/>
                        <input type="button" class="btn btn-primary" id="regreso" value="Volver"/>
                    </div>               
                </div>
            </div>
            <div class="row span2 well">
                <button type="button" class="btn btn-success" id="sig_punto"><i class="icon-arrow-right icon-white"></i><b> Siguiente Punto</b></button> 
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#menuh').hide();
</script>
<div class="modal-footer">
    <a href="#" class="btn btn-large btn-primary">Aceptar</a>
    <a href="#" class="btn btn" data-dismiss="modal">Salir</a>
</div>