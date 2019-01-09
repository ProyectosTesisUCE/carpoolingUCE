function validarAuto() 
{
    var placa_auto, marca_auto, modelo_auto, color_auto, tipo_auto, capacidad_auto;
   

    var validarPlaca=/^([A-Z]{3}-\d{3,4})$/;
    placa_auto= document.getElementById("placa_auto").value;
    marca_auto= document.getElementById("marca_auto").value;
    modelo_auto= document.getElementById("modelo_auto").value;
    color_auto= document.getElementById("color_auto").value;
    
    
   
	
    


    if (placa_auto === "" || modelo_auto ==="" || color_auto ==="")
	{
        alert ("TODOS LOS CAMPOS SON OBLIGATORIOS");
        return false;
    }else if (!validarPlaca.test(placa_auto)){
        alert ("N\u00famero de placa inv\u00e1lido. Ingrese un formato v\u00e1lido: ABC-123 o ABC-1234");
        return false;
   
	}else if (marca_auto === ""){
        alert ("Elija una Marca de Auto v\u00e1lida");
        return false;
    }else if (modelo_auto.length>20){
        alert ("El campo Modelo excedi\u00f3 el l\u00edmite de caracteres");
        return false;
    }else if (color_auto.length>20){
        alert ("El campo Color excedi\u00f3 el l\u00edmite de caracteres");
        return false;
    }else {
		//alert ("Datos validados exitosamente");
		return true;
	}
} 