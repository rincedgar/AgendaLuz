<?php include ('clases/Subasunto.class.php');?>
<link href="./css/bootstrap-wysihtml5.css" rel="stylesheet"/>
<script src="./js/wysihtml5-0.3.0.min.js"></script>
<script src="./js/bootstrap-wysihtml5.js"></script>
<script src="./js/utilidades.js"></script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        ×
    </button>
    <h3>Crear Punto</h3>
</div>
<div class="modal-body" id="asunto" data-asunto="">
    <div class="row span8">
        <div class="control-group" >
            <label class="control-label" >Tipo de Consejo:</label>
            <div class="controls">
                <?php
                $sub = new Subasunto("", "", "");
                $subasuntos = $sub->buscar(4);
                echo '<select class="span3">';
                for ($i = 0; $i < count($subasuntos); $i++) {
                    echo"<option value={$subasuntos[$i]['id_subasunto']}>{$subasuntos[$i]['descripcion']}</option>";
                }echo "</select>";
                ?>
            </div>
        </div>
        <div class="control-group" id="pdescripcion" >
            <label class="control-label" >Descripcion:</label>
            <div class="controls">
                <textarea class="textarea" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>
                <br/><br/>
                <input type="button" class="btn btn-primary" id="detalle" value="Detalle"/>

            </div>               
        </div>
        <div class="control-group hidden" id="pdetalle">
            <label class="control-label" >Detalles:</label>
            <div class="controls">
                <textarea class="textarea" placeholder="Escriba la descripción del punto ..." style="width: 512px; height: 200px"></textarea>
                <br/><br/>
                <button type="button" class="btn btn-primary" id="regreso"><i class="icon-chevron-left icon-white"></i>Volver</button>
            </div>               
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#menuh').hide();
</script>
<div class="modal-footer">
    <a href="#" class="btn btn-primary">Aceptar</a>
    <a href="#" class="btn btn" data-dismiss="modal">Salir</a>
</div>