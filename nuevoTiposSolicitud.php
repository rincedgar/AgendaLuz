<?php
include ('cabecera.php');
include ('clases/Campo.class.php');
include ('clases/Dependencia.class.php');
include ('menuIzquierda.php');
?>

<!-- info ================================================== -->
<div class="page-header" style="text-align: center">
    <h1>Agregar Tipos de Solicitud</h1>
</div>
<form class="form-horizontal" id="fnuevoSolicitud">
	<legend><strong>Nombre de la Solicitud</strong></legend>
    <div class="control-group">
        <label class="control-label"><b>Nombre:</b></label>
        <div class="controls">
        	<input type="text" class="span4" id="solicitud"  name="solicitud" placeholder="Nombre del nuevo tipo de solicitud">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <a class="btn span3" onclick="javascript:window.open('tipoSolicitudActuales.php','tipos de Solicitud Actuales','width=400,height=500')">Consultar Solicitudes Existentes</a>
        </div>
    </div>
     <legend><strong>Campos de la Solicitud</strong></legend>
     <div class="control-group">
    		<?php
			$campo= new Campo();
			$idcampos = $campo->buscarTodos();
			$filas=0;
			for ($i=0; $i < count($idcampos) ; $i++) { 
				$campo->setId($idcampos[$i]['id_campo']);
				$campo->buscar();
				$filas=$filas+1;
				if($i%10 == 0) {echo '<div class="span3">'; $filas=1;}
				echo '<label class="checkbox">
							<input type="checkbox" name="campos[]" value="'.$campo->getId().'">'.$campo->getDescripcion().'
						</label>';
				if($filas == 10) echo '</div>';
			}
			if($filas!=0)echo '</div>';
		?>
    </div>
    <legend><strong>Dependencias Asociadas</strong></legend>
     <div class="control-group">
    		<?php
			$dependencia= new Dependencias();
			$idDependencia = $dependencia->buscarTodos();
			$filas=0;
			$columnas=-1;
			for ($i=0; $i < count($idDependencia) ; $i++) { 
				$dependencia->setId($idDependencia[$i]['id_dependencia']);
				$dependencia->buscar();
				$filas=$filas+1;
				$columnas = $columnas+1;
				if($columnas%20 == 0) {echo '<div class="row">'; $columnas=0;}
				if($i%10 == 0) {echo '<div class="span4">'; $filas=1;}
				echo '<label class="checkbox">
							<input type="checkbox" name="dependencias[]" value="'.$dependencia->getId().'">'.$dependencia->getDescripcion().'
						</label>';
				if($filas == 10) echo '</div>';
				if($columnas == 20) echo '</div>';
			}
			if($filas!=0)echo '</div>';
			if($columnas!=0)echo '</div>';
		?>
    </div>
</form>	
<div hidden="hidden" id="resultado"></div>
<div id="errorSolicitud" class="alert alert-error hidden">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ops!</strong> Ha ocurrido un problema al agregar el campo
</div>
<div id="alertaSolicitud" class="alert alert-warning hidden">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ops!</strong> debe ingresar un nombre
</div>

<div style="text-align:center;" class='row'>
    <a class="btn" href="configuracion.php" id="cancelar">Cancelar</a>
    <input type="button" class="btn btn-large btn-primary" id="guardarSolicitud" name="guardarSolicitud" value="Guardar"/>
</div>
<?php
include ('pie.php');
?>

