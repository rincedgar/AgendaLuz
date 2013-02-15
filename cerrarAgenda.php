<script src="./js/utilidades.js"></script>

<div class="modal-header span5">
   <h3>¿Está seguro de cerrar este consejo?</h3>
</div>
<div class="modal-body" style="text-align:center; min-height:100px">
    <form class="form" id="fcerrar" >
        <input class='hidden' id='id' name='id' value=<?php echo $_GET['id'];?>></input>
        <button id="salirModal" class="btn" >Salir</button>&nbsp;&nbsp;&nbsp;        
        <a class="btn btn-large btn-primary" id="cerrarConsejo" name="cerrarConsejo">Si, cerrarlo</a>
    </form>    
</div>
