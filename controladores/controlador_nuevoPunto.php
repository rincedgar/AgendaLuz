<?php 
	include ('../clases/Punto.class.php');
	include ('../clases/Subasunto.class.php');
	session_start();
	$idSubasunto = (!isset($_POST['subasunto'])?0:$_POST['subasunto']);
	$descripcion = (!isset($_POST['desc_punto'])?0:$_POST['desc_punto']);
	$detalle = (!isset($_POST['det_punto'])?0:$_POST['det_punto']);
	$operacion = (!isset($_POST['operacion'])?0:$_POST['operacion']); 
		
		switch ($operacion) {
			case '1':
			case '2':
				
				if(!isset($_SESSION['padres'])){	// Agrerar puntos al array temporal 				
				
					$formulario_2 = array();//datos							
					array_push($formulario_2,array(
							'id'=>$idSubasunto,
						    'descripcion'=>$descripcion,
						    'detalle'=>$detalle,				   
					)); 
					$_SESSION['padres']=$formulario_2;
				}
				else
				{
					array_push($_SESSION['padres'],array(
						'id'=>$idSubasunto,
					    'descripcion'=>$descripcion,
					    'detalle'=>$detalle,				   
					)); 					
				}
				
				function cmp($x, $y){               // Ordenar el arreglo segun los subasuntos
					if ( $x['id'] == $y['id'] )
						return 0;
					else if ( $x['id'] < $y['id'] )
						return -1;
					else
						return 1;
				}
				usort($_SESSION['padres'], "cmp");		

		//**********************************************************************************     MOSTRAR LA TABLA
				if($operacion=='2') {   	//Mostrar array
					$sub = (!isset($_SESSION['sub'])?array():$_SESSION['sub']);  //subasuntos presentes
					$npuntos = array(); //numero de puntos por subasuntos
					
					for ($i=0; $i < count($_SESSION['padres']) ; $i++) { 
						if($_SESSION['padres']){							
							$existe = array_search($_SESSION['padres'][$i]['id'], $sub);
							if($existe!==false){
								$valor =(!isset($npuntos[$existe])?0:$npuntos[$existe]);
								$npuntos[$existe]=$valor+1; 
							}
							else {
								array_push($sub,$_SESSION['padres'][$i]['id']);
								array_push($npuntos,1);
							}//no esta en sub, hay q meterlo y sumar 1 a npuntos
						}
					}

					$_SESSION['sub'] = $sub;			//Actualizar arreglos
					$_SESSION['npuntos'] = $npuntos;
					
					 echo '
					 	<table id="t_puntos" class="table table-bordered span8">
							<thead style="background-color:#0480BE; color:#FFF; font-weight:bold;">
							    <th class="span2">Dependencias</th>
							    <th colspan="2" class="span5">Puntos Nuevos</th>
							</thead>
						<tbody>';
							$subasunto = new Subasunto('','');
							$inicio=1;
							for ($i=0; $i < count($_SESSION['padres']) ; $i++) { 
								
								$existe = array_search($_SESSION['padres'][$i]['id'], $sub);
								$valor =(!isset($npuntos[$existe])?0:$npuntos[$existe]);
								$subasunto->setId($_SESSION['padres'][$i]['id']);

								echo'<tr>';
								echo '<td ';
									if($inicio==1)
									{
										echo '  background-color:#CEE3F6" rowspan="'.$_SESSION['npuntos'][$existe].'" class="span2">'.$subasunto->obtenerDescripcion().'</td><td';
									}
									echo '>'.$_SESSION['padres'][$i]['descripcion'].'</td>
										<td class="span1">
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
		}	
?>
