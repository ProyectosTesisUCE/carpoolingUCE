function validar() 
{
    var nombre, apellido, fecha, telefono, sector, rol, sexo ,correo, clave, reclave;
    var expresion= /\w+@\uce+\.+\edu+\.+\ec+$/;

    var validarcel=/^09[\d]{8}$/;
    nombre= document.getElementById("nombre").value;
    apellido= document.getElementById("apellido").value;
    fecha= document.getElementById("fecha_nac").value;
    telefono= document.getElementById("telefono").value;
    sector= document.getElementById("sector").value;
    rol= document.getElementById("rol").value;
	sexo= document.getElementById("sexo").value;
    correo= document.getElementById("correo").value;
    clave= document.getElementById("clave").value;
    reclave= document.getElementById("reclave").value;
	
    


    if (nombre === "" || apellido ==="" || fecha ==="" || telefono ==="" || correo ==="" || clave ==="" || reclave ==="")
	{
        alert ("TODOS LOS CAMPOS SON OBLIGATORIOS");
        return false;
    }else if (nombre.length>30){
        alert ("El campo Nombres excedió el límite de caracteres");
        return false;
    }else if (apellido.length>30){
        alert ("El campo Apellidos excedió el límite de caracteres");
        return false;
    }else if (telefono.length>10 || telefono.length<10){
        alert ("Número de celular debe constar de 10 caracteres");
        return false;
    }else if (!validarcel.test(telefono)){
        alert ("Número de celular invalido. Debe ingresar un número con el formato correcto - 09******* ");
        return false;
    }else if (sector === ""){
        alert ("Elija un Sector v\u00e1lido");
        return false;
    }else if (rol === ""){
        alert ("Elija un Rol Universitario v\u00e1lido");
        return false;
    }else if (sexo === ""){
        alert ("Elija Género v\u00e1lido");
        return false;
    }else if (correo.length>100){
        alert ("El campo Correo excedió el límite de caracteres");
        return false;
    }else if (!expresion.test(correo)){
        alert ("Correo inválido. Solo se podrá registrar con su correo institucional - usuario@uce.edu.ec");
        return false;
    }else if (clave.length>20){
        alert ("La contraseña debe tener máximo 20 caracteres");
        return false;
    }else if (clave !== reclave) {
        alert ("Las contraseñas no coinciden");
        return false;
	}else{ 	
		
		return true;
	}
} 

