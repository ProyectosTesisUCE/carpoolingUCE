function validarRuta() 
{
	
    var search_location, direccion_destino, latitud_destino, longitud_destino, fecha_ruta_crear, horaRutaCrear, pdEncuentro,sectorDestRutaCrear;
	var capacidadMax, capacidadEscogida;

	pdEncuentro= document.getElementById("pdEncuentroRutaCrear").value;
	sectorDestRutaCrear= document.getElementById("sectorDestRutaCrear").value;
	fecha_ruta_crear= document.getElementById("fechaRutaCrear").value;
	capacidadMax= document.getElementById("capacidadMax").value;
	capacidadEscogida= document.getElementById("disponibleRutaCrear").value;
	console.log(capacidadMax);
	console.log(capacidadEscogida);
	// guardar fecha  de hoy en milisegundos
	var ahoramili=new Date();
	var nowmili=ahoramili.getTime();
	// guardar fecha del vaije ingresada por el usuario, para validar q no sea una fecha pasada
	var ecogido= new Date(fecha_ruta_crear);
	var escogidomili=new Date(ecogido.getTime()+24*60*60*1000); //suma de un día 
	var escogidoFinal=escogidomili.getTime();
  
	var y = ahoramili.getFullYear();
	//Mes
	var m = ahoramili.getMonth() + 1;
	//Día
	var d = ahoramili.getDate();
	
	//fecha del actual día 
	var fechaFormato = y + "-" + m + "-" + d ;
	
	//crear una ruta en un rango de una semana desde el día actual
	var sigSemana=new Date(ahoramili.getTime()+((24*60*60*1000)*30));//suma de una semana
	var sigSemanamili=sigSemana.getTime();
    

    if (search_location === "" || direccion_destino ==="" || latitud_destino ==="" || longitud_destino ==="" || fecha_ruta_crear ==="" || horaRutaCrear ==="" )
	{
	
        alert ("TODOS LOS CAMPOS SON OBLIGATORIOS" + nowmili +" fffff"+ ahoramili);
		
        return false;
      
	
    }else if(pdEncuentro === "") {
			
        alert ("Elija un punto de encuentro v\u00e1lido para la ruta");
		return false;
		
	}else if(sectorDestRutaCrear === "") {
			
        alert ("Elija un sector de destino v\u00e1lido para la ruta");
		return false;
		
	}else if(escogidoFinal<nowmili) {
			
        alert ("Fecha inv\u00e1lida. No se puede escoger una fecha anterior al d\u00eda de hoy : " + fechaFormato);
		return false;
		
	}else if(escogidoFinal>sigSemanamili) {
			
        alert ("Escoger una fecha en el rango de 30 d\u00edas a partir del d\u00eda de hoy : " + fechaFormato);
		return false;
		
	}else if(capacidadMax === "0"){
			
        alert ("Para poder crear una ruta debe tener un auto registrado en su perfil");
		return false;
		
	}else if(capacidadEscogida>capacidadMax) {
			
        alert ("Capacidad excedida: Su auto registra una capacidad m\u00e1xima de " + capacidadMax + " pasajeros.");
		return false;
		
	}else{
			
        //alert ("Datos validados exitosamente");
			return true; 
	}
} 