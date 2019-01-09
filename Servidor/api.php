<?php
header('Access-Control-Allow-Origin: *');
require 'cn.php';
mysqli_set_charset($conexion,"utf8");
date_default_timezone_set('America/Guayaquil');
$accion = htmlspecialchars($_POST["accion"], ENT_QUOTES);

$json = array();
/*////////////////////GENERAR UN CÓDIGO DE CONFIRMACIÓN DE CORREO ///////////////////////////////////// */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
/*/////////////////////////////////SERVICIOS WEB DE LA APLICACION////////////////////////////////////////// */
switch ($accion)
{
/*////////////////////SERVICIO PARA LOGUEAR UN USUARIO YA REGISTRADO //////////////*/
    case 'login':{
        $user = htmlspecialchars($_POST["user"], ENT_QUOTES);
        $pass = md5(htmlspecialchars($_POST["pass"], ENT_QUOTES));
        $sql = "SELECT id, nombre, apellido, fecha_nac, telefono, sector, rol, sexo, foto FROM usuario WHERE correo = '$user' AND clave = '$pass' AND confirmado = 1";
        if($result=mysqli_query($conexion,$sql)){
			
            if(mysqli_num_rows($result)>0){
                $json["flag"] = "si";
                while($row = mysqli_fetch_assoc($result)){
                    $json["usuario"] = $row;
                }
            }else{
                $json["flag"] = "no";
				
            }
        }else{
            $json["flag"] = "error";
        }
        break;
/*////////////////////SERVICIO PARA REGISTRAR UN USUARIO //////////////////////////*/
    }case 'registrar':{
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES);
        $apellido = htmlspecialchars($_POST["apellido"], ENT_QUOTES);
        $fecha_nac = htmlspecialchars($_POST["fecha_nac"], ENT_QUOTES);
        $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES);
        $sector = htmlspecialchars($_POST["sector"], ENT_QUOTES);
        $rol = htmlspecialchars($_POST["rol"], ENT_QUOTES);
		$sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES);
        $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES);
        $clave =  md5(htmlspecialchars($_POST["clave"], ENT_QUOTES));
        $sql = "SELECT id FROM usuario WHERE correo = '$correo'";
		
        if($result=mysqli_query($conexion,$sql)){
		
            if(mysqli_num_rows($result)=== 0){
				
                $insertar = "INSERT INTO usuario(nombre, apellido, fecha_nac, telefono, sector, rol, sexo, correo, clave) VALUES ('$nombre',
                            '$apellido', '$fecha_nac', '$telefono', '$sector', '$rol', '$sexo', '$correo', '$clave')";
				if(mysqli_query($conexion,$insertar)){

                    $codigoConfirmar = generateRandomString(10);
                    $insertarConf = "INSERT INTO confirmar(con_email, con_codigo) VALUES ('$correo', '$codigoConfirmar')";
                    mysqli_query($conexion,$insertarConf);
					$json['flag'] = "si";
					$json['url'] = "http://gmoncayoresearch.com/carpoolingUCE/Servidor/verificar.php?cod=$codigoConfirmar";
					
                    
                    $email_subject = "SE HA REGISTRADO CON EXITO";
                    $email_message = "Se ha registrado exitosamente en la aplicación CarpoolingUCE por favor dirigirse a esta dirección para terminar con el proceso \n http://gmoncayoresearch.com/carpoolingUCE/Servidor/verificar.php?cod=$codigoConfirmar";

                    $headers = "From: carpoolinguce@mgsoftware.com\r\n".
                    "Reply-To: carpoolinguce@mgsoftware.com \r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    if(mail($correo, $email_subject, utf8_decode($email_message), $headers)){
                        $json['flag'] = "si";
                    }else{
                        $json["flag"]="error1";
                    }
                }else{
                    $json["flag"] = "error2";
                    $json["sql"] = $insertar;
					
                }
            }else{
				
                $json["flag"] = "mailusado";
				
            }
        }else{
            $json["flag"] = "error3";
        }
        break;
/*////////SERVICIO PARA GUARDAR UNA FOTO DEL USUARIO EN LA BASE DE DATOS EN EL CAMPO FOTO ////// */
    }case 'subirFoto':{
		$id = htmlspecialchars($_POST["id"], ENT_QUOTES);		
		$target_dir = "uploads/";
		$ext = pathinfo($_FILES['FotoUsuario']['name'], PATHINFO_EXTENSION);
		$nombreFoto = rand() .".";
		$target_file = $target_dir . $nombreFoto;		
		if (move_uploaded_file($_FILES["FotoUsuario"]["tmp_name"], $target_file)) {			
			$sql = "UPDATE usuario SET foto='http://gmoncayoresearch.com/carpoolingUCE/Servidor/uploads/$nombreFoto' WHERE id=$id";
			if(mysqli_query($conexion,$sql)){
				$json["flag"] = "si";
				$json["foto"] = "http://gmoncayoresearch.com/carpoolingUCE/Servidor/uploads/$nombreFoto";
			}else{
				$json["flag"] = "error";
			}
		} else {
			$json["flag"] = "no";
		}			
		break;
/*////////// SERVICIO PARA AGREGAR UN AUTO EN UNA CUENTA DE USUARIO YA LOGUEADO///////////////  */ 	
    }case 'agregarAuto':{
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);		
		$placa_auto=  htmlspecialchars($_POST["placa_auto"], ENT_QUOTES);	
		$marca_auto=  htmlspecialchars($_POST["marca_auto"], ENT_QUOTES);	
		$modelo_auto=  htmlspecialchars($_POST["modelo_auto"], ENT_QUOTES);	
		$color_auto=  strtoupper(htmlspecialchars($_POST["color_auto"], ENT_QUOTES));	
		$tipo_auto=  htmlspecialchars($_POST["tipo_auto"], ENT_QUOTES);	
		$capacidad_auto=  htmlspecialchars($_POST["capacidad_auto"], ENT_QUOTES);	
		
		$errorFoto = false;
		$foto = "";
		if(isset($_FILES)){
/*////////////////CARGAR UNA FOTO DEL AUTOMOVIL REGISTRADO POR EL USUARIO/////////////////*/				
			$target_dir = "autosUploads/";
			$ext = pathinfo($_FILES['FotoAutoUsuario']['name'], PATHINFO_EXTENSION);
			$nombreFoto = rand() .".";
			$target_file = $target_dir . $nombreFoto;		
			if (move_uploaded_file($_FILES["FotoAutoUsuario"]["tmp_name"], $target_file)) {			
				$foto = "http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/$nombreFoto";			
				
			} else {
				$errorFoto = true;
			}			
		}
		if(!$errorFoto){			 	
			$sql = "SELECT id_auto FROM auto WHERE id_usuario = $id_usuario";
			if($result=mysqli_query($conexion,$sql)){				
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						$sqlUpdate = "UPDATE auto SET placa_auto='$placa_auto',marca_auto='$marca_auto',modelo_auto='$modelo_auto'
						,color_auto='$color_auto',tipo_auto='$tipo_auto',capacidad_auto='$capacidad_auto',foto_auto='$foto' 
						WHERE id_auto=$row[id_auto]";
						if(mysqli_query($conexion,$sqlUpdate)){
							$json["flag"] = "si";							
							$json["foto"] = $foto;
						}else{
							$json["flag"] = "error";
						}
					}
				}else{					
					$sqlInsert = "INSERT INTO auto(id_usuario, placa_auto, marca_auto, modelo_auto, color_auto, tipo_auto, capacidad_auto, foto_auto) 
					VALUES ($id_usuario, '$placa_auto','$marca_auto','$modelo_auto','$color_auto','$tipo_auto','$capacidad_auto', '$foto')";
					if(mysqli_query($conexion,$sqlInsert)){
						$json["flag"] = "si";							
						$json["foto"] = $foto;
					}else{
						$json["flag"] = "error";
					}					
				}
			}else{
				$json["flag"] = "error";				
			}			
		}else{
			$json["flag"] = "errorFoto";	
		}
		break;
/*//////////////////SERVICIO PARA OBTENER LOS DATOS del auto DE UN USUARIO REGISTRADO//////////////////////////*/		
    }case 'obtenerAuto':{
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);		
		
		
		$obtenerAuto = "SELECT placa_auto, marca_auto, modelo_auto, color_auto, tipo_auto, capacidad_auto, foto_auto FROM auto WHERE id_usuario = '$id_usuario'";
		
		 
		if ($resultado=mysqli_query($conexion, $obtenerAuto)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
                while($row = mysqli_fetch_assoc($resultado)){
                    $json["autoOb"] = $row;
                }
            }else{
                $json["flag"] = "no";
				
            }

		}else {
			$json['flag'] = "error";
		}
		break;
	/*///////////////ENLISTAR LOS SECTORES DE LA CIUDAD DESDE LA BASE A UN CAMPO SELECT EN LA APLICACION*/
	}case 'sectores':{
		$sectores="SELECT pos_sector, id_sector, nombre_sector FROM sectores";		 
		if($resultado=mysqli_query($conexion, $sectores)){		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
                while($row = mysqli_fetch_assoc($resultado)){
                    $json['sectores'][$row["pos_sector"]][] = $row;
                }
            }else{
                $json["flag"] = "no";				
            }
		}else {
			$json['flag'] = "error";
		}
		
		break;
	/*///////////////CREACIÓN DE UNA RUTA POR UN USUARIO QUE TENGA UN AUTO REGISTRADO*/	
	}case 'crearRuta':{
		
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$sectorDestRutaCrear = htmlspecialchars($_POST["sectorDestRutaCrear"], ENT_QUOTES);
		
		$latitud_origen= htmlspecialchars($_POST["latitud_origen"], ENT_QUOTES);
		$longitud_origen= htmlspecialchars($_POST["longitud_origen"], ENT_QUOTES);
        $latitud_destino = htmlspecialchars($_POST["latitud_destino"], ENT_QUOTES);
        $longitud_destino = htmlspecialchars($_POST["longitud_destino"], ENT_QUOTES);
		$pdEncuentroRutaCrear = htmlspecialchars($_POST["pdEncuentroRutaCrear"], ENT_QUOTES);
		$direccion_destino = htmlspecialchars($_POST["direccion_destino"], ENT_QUOTES);
        $horaRutaCrear = htmlspecialchars($_POST["horaRutaCrear"], ENT_QUOTES);
        $disponibleRutaCrear = htmlspecialchars($_POST["disponibleRutaCrear"], ENT_QUOTES);
		$fechaRutaCrear = htmlspecialchars($_POST["fechaRutaCrear"], ENT_QUOTES);
		
      
        $sql = "SELECT id_auto FROM auto WHERE id_usuario = '$id_usuario'";
		
        if($result=mysqli_query($conexion,$sql)){
		
            if(mysqli_num_rows($result)>0){
				
				$sqlIdSiguiente="SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'gmoncayo_bd_carpoolinguce' AND  TABLE_NAME = 'ruta';";
				$resultado=mysqli_query($conexion,$sqlIdSiguiente);
					if($row = mysqli_fetch_array($resultado)){
							$varIdRuta=$row["0"];
				}
			
				$insertar = "INSERT INTO ruta(latitud_origen, longitud_origen, latitud_destino, longitud_destino, pd_encuentro, direccion_destino, hora_ruta, disponibilidad_ruta, fecha_ruta, estado_ruta)
				VALUES ('$latitud_origen', '$longitud_origen', '$latitud_destino', '$longitud_destino', '$pdEncuentroRutaCrear', '$direccion_destino', '$horaRutaCrear', '$disponibleRutaCrear', '$fechaRutaCrear', 'Activa')";
				
				if(mysqli_query($conexion,$insertar)){
					// $varIdRuta= mysqli_insert_id($conexion)
					/*tabla de rompimiento entre usuario, ruta y sectores*/
					$insertTablaUnion= "INSERT INTO usuario_ruta_sector (id_usuario, id_ruta, id_sector)
					VALUES ('$id_usuario','$varIdRuta','$sectorDestRutaCrear')";
					
					mysqli_query($conexion,$insertTablaUnion);
					 $json["flag"] = "si";
						 
						
                }else{
                    $json["flag"] = "error2";
                    $json["sql"] = $insertar;
					
                }
            }else{
				
                $json["flag"] = "nocarro";
				
            }
        }else{
            $json["flag"] = "error3";
        }
        break;
	/*SERVICIO PARA ENLISTAR LAS RUTAS DISPONIBLES PARA LA ACTUAL FECHA Y HORA, CON PARÁMETRO DE BUSQUEDA NOMBRE SECTOR*/
    }case 'obtenerRutasXSector':{
		$buscarXSector = htmlspecialchars($_POST["buscarXSector"], ENT_QUOTES);	
		$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);		
		$hora = htmlspecialchars($_POST["hora"], ENT_QUOTES);	
		
		$fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
		
		
		
		$obtenerRutaXSector = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta, direccion_destino
								FROM usuario, usuario_ruta_sector, ruta, sectores
								WHERE usuario.id = usuario_ruta_sector.id_usuario
								AND usuario_ruta_sector.id_ruta = ruta.id_ruta
								AND usuario_ruta_sector.id_sector = sectores.id_sector
								AND usuario_ruta_sector.id_sector ='$buscarXSector'
								AND ruta.fecha_ruta ='$hoyvar'
								AND ruta.hora_ruta >='$hora'
								AND ruta.estado_ruta='Activa'
								ORDER BY ruta.hora_ruta";
		
		 
		if ($resultado=mysqli_query($conexion, $obtenerRutaXSector)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
				while($array = mysqli_fetch_assoc($resultado)){
						
							$json["rutas"][] = $array;
						}
				$totalFilas= $resultado->num_rows;
				$json["filas"] = $totalFilas;
							
            }else{
                $json["flag"] = "no";
				
            }

		}else {
			$json['flag'] = "error";
		}
		break;
	/*/////////SERVICIO PARA ENLISTAR TODAS LAS RUTAS ENCONTRADAS DESDE EL ACTUAL DÍA EN ADELANTE*/
	} case 'obtenerTodasRutas':{
			
		$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);		
	
		$fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
		
		$obtenerTodasRutas = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta, direccion_destino
								FROM usuario, usuario_ruta_sector, ruta, sectores
								WHERE usuario.id = usuario_ruta_sector.id_usuario
								AND usuario_ruta_sector.id_ruta = ruta.id_ruta
								AND usuario_ruta_sector.id_sector = sectores.id_sector
								AND ruta.fecha_ruta >='$hoyvar'
								AND ruta.estado_ruta='Activa'
								ORDER BY ruta.fecha_ruta ASC, ruta.hora_ruta ASC" ;
								
								
		 
		if ($resultado=mysqli_query($conexion, $obtenerTodasRutas)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
													
						while($array = mysqli_fetch_assoc($resultado)){
						
							$json["rutas"][] = $array;
						}
						
						
							
            }else{
                $json["flag"] = "no";
				
            }
		}else {
			$json['flag'] = "error";
		}
		break;
	/*/////////SERVICIO PARA ENLISTAR TODAS LAS RUTAS CREADAS DESDE EL ACTUAL DÍA EN ADELANTE DEL USUARIO LOGUEADO*/		
	}case 'obtenerRutasUsuarioLog':{
		
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);		
		
		$fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
		
		
		$obtenerRutaCreadasXUsuarioLog = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta
								FROM usuario, usuario_ruta_sector, ruta, sectores
								WHERE usuario.id = usuario_ruta_sector.id_usuario
								AND usuario_ruta_sector.id_ruta = ruta.id_ruta
								AND usuario_ruta_sector.id_sector = sectores.id_sector
								AND ruta.fecha_ruta >='$hoyvar'
								AND usuario.id='$id_usuario'
								AND ruta.estado_ruta='Activa'
								ORDER BY ruta.fecha_ruta ASC, ruta.hora_ruta ASC";
		
		 
		if ($resultado=mysqli_query($conexion, $obtenerRutaCreadasXUsuarioLog)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
													
						while($array = mysqli_fetch_assoc($resultado)){
						
							$json["rutas"][] = $array;
						}
							
            }else{
                $json["flag"] = "no";
				
            }
		}else {
			$json['flag'] = "error";
		}
		break;	
	/*/////////SERVICIO PARA ELIMINAR UNA RUTA CREADA POR EL USUARIO LOGUEADO*/		
	}case 'cancelarRuta':{	
		$id_ruta = htmlspecialchars($_POST["id_ruta"], ENT_QUOTES);
		
		$revisarReservas="SELECT id_reservado FROM reservados WHERE id_ruta='$id_ruta'";
		if($resultado = mysqli_query($conexion, $revisarReservas)){
			if(mysqli_num_rows($resultado)===0){
				$json["flag"] = "si";
				$eliminarRutaSeleccionada = "UPDATE ruta SET estado_ruta='Cancelada' WHERE id_ruta='$id_ruta'";	
				mysqli_query($conexion, $eliminarRutaSeleccionada);
							
			}else {
				$json['flag'] = "existenreservas";
			}
		}else{
			$json['flag'] = "error";
		}
	
		break;	
	/*/////////SERVICIO PARA VER LOS DATOS DEL DUEÑO DE LA RUTA*/		
	}case 'descripcionRuta':{
		$idRuta = htmlspecialchars($_POST["idRuta"], ENT_QUOTES);		
		$descripcionDuenoDeRuta = "SELECT foto, ruta.id_ruta, nombre, apellido, rol, fecha_nac, telefono, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta, pd_encuentro,
									  direccion_destino, latitud_destino, longitud_destino, placa_auto, marca_auto, modelo_auto, color_auto, tipo_auto, foto_auto
								FROM usuario, usuario_ruta_sector, ruta, sectores, auto
								WHERE usuario.id = usuario_ruta_sector.id_usuario
								AND usuario_ruta_sector.id_ruta = ruta.id_ruta
								AND auto.id_usuario = usuario.id
								AND usuario_ruta_sector.id_sector = sectores.id_sector
								AND ruta.id_ruta = $idRuta";
		
		 
		if ($resultado=mysqli_query($conexion, $descripcionDuenoDeRuta)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
				while($array = mysqli_fetch_assoc($resultado)){
						
							$json["rutas"] = $array;
						}
				$totalFilas= $resultado->num_rows;
				$json["filas"] = $totalFilas;
							
            }else{
                $json["flag"] = "no";
				
            }

		}else {
			$json['flag'] = "error";
		}
		break;
	/*/////////SERVICIO PARA RESERVAR EN UNA RUTA Y VALIDAR QUE NO HAYA RESERVADO ANTES*/
	}case 'reservaRuta':{
		
		$idUser = htmlspecialchars($_POST["idUser"], ENT_QUOTES);
		$idRuta = htmlspecialchars($_POST["idRuta"], ENT_QUOTES);
			
		$verifReserva= "SELECT id_reservado FROM reservados WHERE id_usuario = $idUser AND id_ruta= $idRuta";
							
		if ($resultado=mysqli_query($conexion, $verifReserva)){		
				$totalFilas=0;
				$totalFilas= $resultado->num_rows;
				$json["filas"] = $totalFilas;		
				if(mysqli_num_rows($resultado)<=0){
					 $json["reservo"] = "nohareservado";
					 $verifDisponibilidad= "SELECT disponibilidad_ruta FROM ruta WHERE id_ruta= $idRuta";
					 $resultado2=mysqli_query($conexion, $verifDisponibilidad);
						 if($row = mysqli_fetch_array($resultado2)){
								$puestosDisp=$row["0"];
						}
					 
						 if($puestosDisp>0){
							$json["espacio"] = "sihayespacio";
							$puestosDispFin=$puestosDisp-1;
							$restarDisponibilidad= "UPDATE ruta SET disponibilidad_ruta=$puestosDispFin WHERE id_ruta= $idRuta";
							$realizarReserva= "INSERT INTO reservados(id_usuario, id_ruta) VALUES('$idUser', '$idRuta')";
							
							mysqli_query($conexion, $restarDisponibilidad);
							mysqli_query($conexion, $realizarReserva);
							$json["flag"] = "reservahecha";
						 }else{
							$json["flag"] = "autolleno"; 
						 }
					 
				}else{
					 $json["flag"] = "yareservo";
				}			
		}else{
			 $json["flag"] = "noentro";
		}
		
		break;
	/*/////////////// SERVICO PARA VER MIS RESERVAS //////////////////////////*/
	}case 'misReservas':{
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);		
		$hora = htmlspecialchars($_POST["hora"], ENT_QUOTES);		
		
	    $fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
			
		
		$misReservas = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta 
								FROM reservados, ruta, usuario_ruta_sector, usuario, auto, sectores
								WHERE reservados.id_usuario= $id_usuario
								AND ruta.fecha_ruta >='$hoyvar'
								AND ruta.id_ruta=reservados.id_ruta
								AND ruta.id_ruta=usuario_ruta_sector.id_ruta
								AND usuario_ruta_sector.id_usuario=usuario.id
								AND usuario_ruta_sector.id_usuario=auto.id_usuario
								AND usuario_ruta_sector.id_sector = sectores.id_sector
								AND ruta.estado_ruta='Activa'
								ORDER BY ruta.fecha_ruta ASC, ruta.hora_ruta ASC";
		
		 
		if ($resultado=mysqli_query($conexion, $misReservas)){
		
            if(mysqli_num_rows($resultado)>0){
                $json["flag"] = "si";
													
						while($array = mysqli_fetch_assoc($resultado)){
						
							$json["rutas"][] = $array;
						}
							
            }else{
                $json["flag"] = "no";
				
            }
		}else {
			$json['flag'] = "error";
		}
		break;
	/*/////////////////////////////////////CANCELAR UNA RESERVA REALIZADA////////////////////////////////*/
	}case 'cancelarReserva':{
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$id_ruta = htmlspecialchars($_POST["id_ruta"], ENT_QUOTES);
		
		$eliminarReservaSeleccionada = "DELETE FROM reservados WHERE id_usuario='$id_usuario' AND id_ruta='$id_ruta'";	
		if (mysqli_query($conexion, $eliminarReservaSeleccionada)){		
			$json["flag"] = "si";
			 $verifDisponibilidad= "SELECT disponibilidad_ruta FROM ruta WHERE id_ruta= $id_ruta";
					 $resultado2=mysqli_query($conexion, $verifDisponibilidad);
						 if($row = mysqli_fetch_array($resultado2)){
								$puestosDisp=$row["0"];
								
						}
						$puestosDispFin=$puestosDisp+1;
							$sumarDisponibilidad= "UPDATE ruta SET disponibilidad_ruta=$puestosDispFin WHERE id_ruta= $id_ruta";
							mysqli_query($conexion, $sumarDisponibilidad);
							
					 
		}else {
			$json['flag'] = "error";
		}
		break;	
	/*/////////////////////////////////////CALIFICAR LA RUTA USADA////////////////////////////////*/	
	}case 'calificarRuta':{
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$id_ruta = htmlspecialchars($_POST["id_ruta"], ENT_QUOTES);
		$calificacionRuta = htmlspecialchars($_POST["calificacionRuta"], ENT_QUOTES);
		
		$verifCalificacion= "SELECT id_calif_ruta FROM calificacion_ruta WHERE id_usuario = $id_usuario AND id_ruta= $id_ruta";
		
		if ($resultado=mysqli_query($conexion, $verifCalificacion)){		
							
			if ((mysqli_num_rows($resultado)===0)){		
					$json["flag"] = "si";
					 $guardarCalificacionRuta= "INSERT INTO calificacion_ruta (id_usuario, id_ruta, calificacion) VALUES ('$id_usuario','$id_ruta','$calificacionRuta')";
						
					 mysqli_query($conexion, $guardarCalificacionRuta);	 
					
			
				}else {
					$json['flag'] = "yacalifico";
				}
		}else{
			$json["flag"] = "error";
		}
		break;
   /*///////////HISTORIAL DE RUTAS EJECUTADAS DEL USUARIO, SIN CALIFICAR////////////////////////////////*/
    }case 'historialRutasUsuario':{
		
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$id_ruta = htmlspecialchars($_POST["id_ruta"], ENT_QUOTES);
    	$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);
    	
		$fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
		
		
      $obtenerRutaCreadasEjecutadasXUsuarioLog = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta, direccion_destino, calif.id_ruta as existe
        FROM usuario
        LEFT JOIN usuario_ruta_sector ON  usuario.id = usuario_ruta_sector.id_usuario
        LEFT JOIN ruta ON usuario_ruta_sector.id_ruta = ruta.id_ruta
        LEFT JOIN sectores ON usuario_ruta_sector.id_sector = sectores.id_sector
        LEFT JOIN (SELECT id_ruta FROM calificacion_ruta WHERE id_usuario ='$id_usuario')calif ON calif.id_ruta = ruta.id_ruta
        WHERE ruta.fecha_ruta <='$hoyvar'
        AND usuario.id='$id_usuario'
        AND ruta.estado_ruta='Ejecutada'
        ORDER BY ruta.fecha_ruta ASC, ruta.hora_ruta ASC";
      
        if ($resultado=mysqli_query($conexion, $obtenerRutaCreadasEjecutadasXUsuarioLog)){
		   
            if(mysqli_num_rows($resultado)>0){
                    
               
                while($array= mysqli_fetch_assoc($resultado)){
                    if($array["existe"] == null){
                        $json["flag"] = "si";
                         $json["rutas"][] = $array;   
                    }
                }
                  
            }else{
                $json["flag"] = "no";
				
            }
		}else {
			$json['flag'] = "error";
		}
		
	
		

		
		break;
	  /*///////////HISTORIAL DE RESERVAS EJECUTADAS DEL USUARIO, SIN CALIFICAR////////////////////////////////*/	
	}case 'historialReservasUsuario':{
		
		$id_usuario = htmlspecialchars($_POST["id_usuario"], ENT_QUOTES);	
		$id_ruta = htmlspecialchars($_POST["id_ruta"], ENT_QUOTES);
    	$hoyvar = htmlspecialchars($_POST["hoyvar"], ENT_QUOTES);
    	
		$fechaAct = date("Y-m-d H:i:s");
		
		$sqlActualizar = "UPDATE ruta SET estado_ruta='Ejecutada' WHERE estado_ruta = 'Activa' AND concat(fecha_ruta,' ',hora_ruta)<='$fechaAct'";
        mysqli_query($conexion, $sqlActualizar);
		

	$miHistorialReservasEjecutadas = "SELECT  foto, ruta.id_ruta, nombre, apellido, nombre_sector, fecha_ruta, hora_ruta, disponibilidad_ruta, estado_ruta, direccion_destino, calif.id_ruta as existe
        FROM reservados
        LEFT JOIN ruta ON ruta.id_ruta=reservados.id_ruta 
        LEFT JOIN usuario_ruta_sector ON ruta.id_ruta=usuario_ruta_sector.id_ruta
        LEFT JOIN usuario ON usuario_ruta_sector.id_usuario=usuario.id
        LEFT JOIN auto ON usuario_ruta_sector.id_usuario=auto.id_usuario
        LEFT JOIN sectores ON usuario_ruta_sector.id_sector = sectores.id_sector
        LEFT JOIN (SELECT id_ruta FROM calificacion_ruta WHERE id_usuario ='$id_usuario')calif ON calif.id_ruta = ruta.id_ruta
        WHERE reservados.id_usuario=  $id_usuario
        AND ruta.fecha_ruta <='$hoyvar'
        AND ruta.estado_ruta='Ejecutada'
        ORDER BY ruta.fecha_ruta ASC, ruta.hora_ruta ASC";
							
	
		if ($resultado=mysqli_query($conexion, $miHistorialReservasEjecutadas)){
		   
		  
		
            if(mysqli_num_rows($resultado)>0){
                
              
                     
						while($array = mysqli_fetch_assoc($resultado)){
						      if($array["existe"] == null){
						          $json["flag"] = "si";
						         $json["rutas"][] = $array;
						      }else{
						         $json["flag"] = "todascalificadas";  
						      }
						    
						}
							
            }else{
                $json["flag"] = "no";
				
            }
		}else {
			$json['flag'] = "error";
		}
		
		break;
	}				

}
mysqli_close($conexion);
header('Content-type: application/json');
echo json_encode($json);
