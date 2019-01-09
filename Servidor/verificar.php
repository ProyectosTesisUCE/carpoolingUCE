<?php
require 'cn.php';
mysqli_set_charset($conexion,"utf8");
$codigo = htmlspecialchars($_GET["cod"], ENT_QUOTES);
$sql = "SELECT con_email FROM confirmar WHERE con_codigo = '$codigo'";
if($result=mysqli_query($conexion,$sql)){
	if(mysqli_num_rows($result)>0){		
		while($row = mysqli_fetch_assoc($result)){
			$insert = "UPDATE usuario SET confirmado=1 WHERE correo='$row[con_email]'";
			if(mysqli_query($conexion,$insert)){
				echo "Su correo ha sido verificado exitosamente, por favor ingrese a la app y logueese";
			}else{				
				echo "Ha ocurrido un error.";
			}
		}
	}else{
		echo "No se encuentra el codigo ingresado";
	}
}else{
	echo "Ha ocurrido un error";
}