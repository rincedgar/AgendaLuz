<?php 
	include ('../clases/Punto.class.php');
	include ('../clases/Subasunto.class.php');
	include ('../clases/CampoSolicitud.class.php');
	include ('../clases/TipoSolicitud.class.php');
	include ('../clases/Campo.class.php');
	session_start();
	$idSubasunto = (!isset($_POST['subasunto'])?0:$_POST['subasunto']);
	$descripcion = (!isset($_POST['desc_punto'])?0:$_POST['desc_punto']);
	$detalle = (!isset($_POST['det_punto'])?0:$_POST['det_punto']);
	$operacion = (!isset($_POST['operacion'])?0:$_POST['operacion']);
	$solicitud = (!isset($_POST['sel_solicitud'])?0:$_POST['sel_solicitud']);
	
		

		switch ($operacion) {
			case '1':
			case '2':
			//**********************************************************************************     INSERTAR EN ARREGLO TEMP
			//print_r($_SESSION['puntos']);
			if((($solicitud=='otro')&&($_POST['desc_punto']!=''))||(($solicitud!=0))) {
				$contador = (!isset($_SESSION['contador'])?0:$_SESSION['contador']+1); 			
				if($_POST['sel_solicitud']=='otro'){
					$punto= array('contador'=>$contador,'id'=>$idSubasunto,'descripcion'=>$descripcion,'detalle'=>$detalle,'otro' =>'true');//datos						   
				}
				else {
					$cs = new CampoSolicitud($_POST['sel_solicitud'],'');
					$idCampos = $cs->buscarCampos();
					$campo = new Campo('','');
					$punto = array();//datos							
					$cont = array('contador'=>$contador);
					$punto = $punto+$cont;	
					$id_sub = array('id'=>$_POST['subasunto']);	
					$punto=$punto+$id_sub;
					$otro = array('otro'=>'false');
					$punto=$punto+$otro;	
					for ($i=0; $i < count($idCampos) ; $i++) { 
						$campo->setId($idCampos[$i]['id_campo']); $campo->buscar();
						$ar_campo = array($campo->getDescripcion()=>$_POST['campo_'.$idCampos[$i]['id_campo']]);
						$punto = $punto + $ar_campo;
					}
					$ti_sol = array('id_tipo_solicitud' =>$_POST['sel_solicitud']);	
					$punto=$punto+$ti_sol;					
				}
				if (!isset($_SESSION['puntos_temp'])){
					$_SESSION['puntos_temp'] = array();
				}
				$_SESSION['contador']=$contador;
				array_push($_SESSION['puntos_temp'], $punto);	
				unset($punto);
			}	
			//print_r($_SESSION['puntos']);
	//**********************************************************************************     MOSTRAR LA TABLA
			if($operacion=='2') {   	//Mostrar array
				
				if(!isset($_SESSION['puntos'])){
					$_SESSION['puntos'] = array();
				}
				if(isset($_SESSION['puntos_temp'])){
					for ($i=0; $i < count($_SESSION['puntos_temp']) ; $i++) { 
					array_push($_SESSION['puntos'], $_SESSION['puntos_temp'][$i]);
					}
				}
				$sub = (!isset($_SESSION['sub'])?array():$_SESSION['sub']);  //subasuntos presentes
				$npuntos = array(); //numero de puntos por subasuntos
				for ($i=0; $i < count($_SESSION['puntos']) ; $i++) { 
					if($_SESSION['puntos']){							
						$existe = array_search($_SESSION['puntos'][$i]['id'], $sub);
						if($existe!==false){
							$valor =(!isset($npuntos[$existe])?0:$npuntos[$existe]);
							$npuntos[$existe]=$valor+1; 
						}
						else {
							array_push($sub,$_SESSION['puntos'][$i]['id']);
							array_push($npuntos,1);
						}//no esta en sub, hay q meterlo y sumar 1 a npuntos
					}
				}

				$_SESSION['sub'] = $sub;	//Array de Subasuntos
				$_SESSION['npuntos'] = $npuntos;  //Numero de puntos por subasunto
				
				echo '
				 	<script>
				 	$(".editar").unbind("click").click(function (e){  //Siguiente Punto --Mostrar tabla
				        var name=$(this).attr("name").split("_");
				        var url = "./editarPunto.php?sub="+name[0];
				        $(this).colorbox({
				            type:"ajax",
				            overlayClose:false, 
				            escKey:false,
				            href:url,
				            scrolling:false,
				            onComplete: function() {
				                $("#cboxClose").remove();
				                var datos="operacion=1&cont="+name[1];
				                $.ajax({
				                    type: "POST",
				                    dataType: "html",
				                    url: "controladores/controlador_editarPunto.php",
				                    data: datos,
				                    success: function(datos){
				                        $("#editable").append(datos);
				                        $.colorbox.resize();
				                    }
				                });           
				            }
				       });
				    }); 
					
					$(".eliminar").unbind("click").click(function (e){  //Siguiente Punto --Mostrar tabla
				        var name=$(this).attr("name").split("_");
				        var url = "./eliminarPunto.php";
				        $(this).colorbox({
				            type:"ajax",
				            overlayClose:false, 
				            escKey:false,
				            href:url,
				            scrolling:false,
				            onComplete: function() {
				                $("#cboxClose").remove();
				                $("#cont").attr("value",name[1]);				            				                
				            }
				       });
				    }); 
					</script>
				 	<table id="t_puntos" class="table table-bordered span8">
						<thead style="background-color:#0480BE; color:#FFF; font-weight:bold;">
						    <th class="span2">Dependencias</th>
						    <th colspan="2" class="span5">Puntos Nuevos</th>
						</thead>
					<tbody>';
				$subasunto = new Subasunto('','');
				$inicio=1;
				for ($i=0; $i < count($_SESSION['puntos']) ; $i++) { 
					
					$existe = array_search($_SESSION['puntos'][$i]['id'], $sub);
					$valor =(!isset($npuntos[$existe])?0:$npuntos[$existe]);
					$subasunto->setId($_SESSION['puntos'][$i]['id']);

					echo'<tr>';
					echo '<td ';
					if($inicio==1){
						echo '  background-color:#CEE3F6" rowspan="'.$_SESSION['npuntos'][$existe].'" class="span2">'.$subasunto->obtenerDescripcion().'</td><td';
					}
					if (isset($_SESSION['puntos'][$i]['descripcion'])){
					 	echo '>'.$_SESSION['puntos'][$i]['descripcion'].'</td>';
					} 
					else{
						$solicitud = new TipoSolicitud($_SESSION['puntos'][$i]['id_tipo_solicitud'],'');
						$solicitud->buscar();
						echo '>'.$solicitud->getDescripcion().':  '.$_SESSION['puntos'][$i]['Apellidos'].','.$_SESSION['puntos'][$i]['Nombres'].'</td>';
					}
					if (isset($_SESSION['puntos'][$i]['descripcion'])){
						echo '	<td class="span1">
						  		<a name="'.$_SESSION['puntos'][$i]['id'].'_'.$_SESSION['puntos'][$i]['contador'].'" class="editar btn btn-mini  "><i class="icon-edit"></i></a><br/>
		                    	<a name="'.$_SESSION['puntos'][$i]['id'].'_'.$_SESSION['puntos'][$i]['contador'].'"  class="eliminar btn btn-mini "><i class="icon-trash"></i></a>
		                	</td>';
		            }
					else{
						echo '	<td class="span1">
						  		<a name="'.$_SESSION['puntos'][$i]['id'].'_'.$_SESSION['puntos'][$i]['contador'].'" class="btn btn-mini editar "><i class="icon-edit"></i></a><br/>
		                    	<a name="'.$_SESSION['puntos'][$i]['id'].'_'.$_SESSION['puntos'][$i]['contador'].'"  class="btn btn-mini eliminar"><i class="icon-trash"></i></a>
		                	</td>';
		            }
		            echo'</tr>';

		            if($inicio == $valor) $inicio=0;
		            $inicio++;    
		        } 
		    	echo '</tbody></table>';
			}   
		break;
		case '3':
		//**********************************************************************************     CERRAR MODAL / LIMPIAR ARREGLO TEMP
			unset($_SESSION['puntos_temp']);				
		break;
	}

?>
