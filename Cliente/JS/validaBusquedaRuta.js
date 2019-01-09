function validarBusquedaRuta() 
{
	
    var fechaParaBuscar, hora, hoy;
	
	hora= document.getElementById("hora").value;
	hoyvar= document.getElementById("hoyvar").value;
	fechaParaBuscar= document.getElementById("buscarXFecha").value;
	
	
	// guardar fecha  de hoy en milisegundos
	var ahoramili=new Date();
	var nowmili=ahoramili.getTime();
	// guardar fecha del vaije ingresada por el usuario, para validar q no sea una fecha pasada
	var ecogido= new Date(fechaParaBuscar);
	var escogidomili=new Date(ecogido.getTime()+24*60*60*1000); //suma de un día 
	var escogidoFinal=escogidomili.getTime();
  
	var y = ahoramili.getFullYear();
	//Mes
	var m = ahoramili.getMonth() + 1;
	//Día
	var d = ahoramili.getDate();
	
	//fecha del actual día 
	var fechaFormato = y + "-" + m + "-" + d ;
  
    
    if(escogidoFinal<nowmili) {
			
        alert ("Fecha inv\u00e1lida. No se puede escoger una fecha anterior al d\u00eda de hoy :" + fechaFormato + hora + hoyvar);
		return false;
		
	}else{
			
        //alert ("Datos validados exitosamente");
			return true; 
	}
} 