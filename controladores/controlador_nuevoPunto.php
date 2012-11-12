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
		

		switch ($operacion) {
			case '1':
			case '2':
			//print_r($_SESSION['puntos']);
				if((($_POST['sel_solicitud']=='otro')&&($_POST['desc_punto']!=''))||(($_POST['sel_solicitud']!='otro'))) {
								
					if($_POST['sel_solicitud']=='otro'){
						$punto= array('id'=>$idSubasunto,'descripcion'=>$descripcion,'detalle'=>$detalle,'otro' =>'true');//datos						    
					}
					else{
						$cs = new CampoSolicitud($_POST['sel_solicitud'],'');
						$idCampos = $cs->buscarCampos();
						$campo = new Campo('','');
						$punto = array();//datos							
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
					array_push($_SESSION['puntos_temp'], $punto);	
					unset($punto);
				}	
				//print_r($_SESSION['puntos']);
		//**********************************************************************************     MOSTRAR LA TABLA
				if($operacion=='2') 
				{   	//Mostrar array
					
					if(!isset($_SESSION['puntos'])){
						$_SESSION['puntos'] = array();
					}
					for ($i=0; $i < count($_SESSION['puntos_temp']) ; $i++) { 
						array_push($_SESSION['puntos'], $_SESSION['puntos_temp'][$i]);
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
							echo '	<td class="span1">
							  		<a id="editar_'.$i.'" class="btn btn-mini "><i class="icon-edit"></i></a><br/>
			                    	<a id="eliminar_'.$i.'"  class="btn btn-mini"><i class="icon-trash"></i></a>
			                	</td>';
			            echo'</tr>';

			            if($inicio == $valor) $inicio=0;
			            $inicio++;    
			        } 
			    	echo '</tbody></table>';	 
				}   
		break;
		case '3':				
				unset($_SESSION['puntos_temp']);				
			break;
		}	
?>
