function peticion_circulacion(cartero, fecha){
	//console.log(cartero + ' / ' + fecha);

	let url_peticion = "https://ruteo.intranetflash.com/api/recorrido_cartero?fCartero=" + cartero + "&fFecha=" + fecha;
	let objeto_resultado;

	const sendGetRequest = async () => {
	    try {
	    	Loading();

			var requestOptions = {
			  method: 'GET',
			  redirect: 'follow'
			};

			fetch(url_peticion, requestOptions)
				.then(response => response.text())
				.then (function(result){
					
					objeto_resultado = JSON.parse(result);
					//console.log(objeto_resultado);

					if(objeto_resultado.status){
					
					//carga en mapa
						if(objeto_resultado.recorrido.length > 0){
							let recorridoMap = objeto_resultado.recorrido.map((lugar, index) => {
				                return {
				                    'orden': index,
				                    'lat': lugar.Latitude,
				                    'lng': lugar.Longitude,
				                    'hora': lugar.tiempo,
				                    'id': lugar.id
				                }
				            });

				            cargar_recorrido_cartero(recorridoMap);
						}

					}
					else{
						alert('Aviso:\n.No se encontraron datos de Circulacion.');
					}	

					EndLoading();			

				})
				.catch(error => console.log('error', error));

	    } catch (err) {
	        // Handle Error Here
	        console.error(err);        
	        alert('Aviso:\nOcurrio un error al consultar los datos. Por favor actualice la pagina y realice nuevamente la busqueda..');
	    }
	};	

	sendGetRequest();
}



function cargar_recorrido_cartero(recorrido) {
    if (recorrido == "") {
        alert('No se encontraron datos para la solicitud')
    } else {
        // pin de bandera
        var pinImageF = new google.maps.MarkerImage("https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png");
        var icon_blue = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/icons/blue-dot.png");

        var mapProp = {
            zoom: 16,
            center: new google.maps.LatLng(recorrido[0].lat, recorrido[0].lng)
        };

        // Agregando el mapa al tag de id googleMap
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        //necesario para mostrar la informacion de los puntos
        var infowindow = new google.maps.InfoWindow();

        //default marker
        var mowerWayCoordinates = [];
        var marker = [];

        for (var i = 0; i < recorrido.length; i++) {
            mowerWayCoordinates[i] = new google.maps.LatLng(recorrido[i].lat, recorrido[i].lng);

            marker[i] = new google.maps.Marker({
                position: mowerWayCoordinates[i],
                map: map,
                icon: icon_blue
            });

            //mostrar la info de cada marcados
            google.maps.event.addListener(marker[i], 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent("Orden de recorrido: " + recorrido[i]["orden"] + "<br>" +
                        "Hora: " + recorrido[i]["hora"]); //puede ser contenido HTML
                    infowindow.open(map, marker);                  
                }
            })(marker[i], i));
            

        }


        let flightPath = new google.maps.Polyline({
            path: mowerWayCoordinates,
            geodesic: true,
            strokeColor: '#00aae4',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        flightPath.setMap(map);
    }
}

//todo lo de abajo se debe controlar que no se utilice nada, y borrar nomas




/*
	var Config = JSON.parse(`{
		"Elemento":"BarcodeExterno",
		"ElementoTexto":"BoltTextBarcodeExterno",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	var Config = JSON.parse(`{
		"Elemento":"Documento",
		"ElementoTexto":"BoltTextDocumento",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	var Config = JSON.parse(`{
		"Elemento":"ApellidoYNombre",
		"ElementoTexto":"BoltTextApellidoYNombre",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	
	
	jQuery(document).ready(function() {
		$("#SalirDeModal").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		$("#SalirDeModal2").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
	});
	*/
	/*
	function Buscar(){

		
		filtro=["User","time","UserId"];
		filtroX=["1",Math.random(),UserId];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto

		var Indices=["BarcodeExterno","Documento","ApellidoYNombre","FechaI","FechaF"];
		var Objetos = ["BarcodeExterno","Documento","ApellidoYNombre","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

		var EsconderElementos=["1","14","15"];
		
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` + EsconderElementos + `],
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasSolicitadasPorCliente.php"
			
		}`);
		TablaDesdeConsulta(Config);

	}
	*/
/*
	function Reporte(){


		var Documento = $('#Documento').val();
		var ApellidoYNombre = $('#ApellidoYNombre').val();
		var FechaDesde = $('#FechaDesde').val();
		var FechaHasta = $('#FechaHasta').val();
		var BarcodeExterno = $('#BarcodeExterno').val();

		location.href = "http://clienteflash.sppflash.com.ar/reporte.php?UserId=" + UserId +
																	 "&ApellidoYNombre=" + ApellidoYNombre +
																	 "&FechaDesde=" + FechaDesde +
																	 "&FechaHasta=" + FechaHasta +
																	 "&BarcodeExterno=" + BarcodeExterno +
																	 "&Documento=" + Documento;

	}
	*/
	/*
	function VerDetallesDePiezas(e){
		var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;

		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('show');
		console.log(DivDeTabla.Config.Resultado[e.Data][0]);
		document.getElementById("DetalleDePiezaActual").innerHTML = DivDeTabla.Config.Resultado[e.Data][0];
		
		filtro=["User","time","PiezaId"];
		filtroX=["1",Math.random(),DivDeTabla.Config.Resultado[e.Data][0]];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		
	
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][5];                         
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][11];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][9];
		document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][12];
		document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][13];
		
		
		if(DivDeTabla.Config.Resultado[e.Data][15] != ""){ // o 15???
			document.getElementById("FotoAndroid").src = "http://sispo.com.ar/zonificacion/Android/Acusses/" + DivDeTabla.Config.Resultado[e.Data][15];
		}else{
			document.getElementById("FotoAndroid").src = "";
		}
		
		

		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`);
		TablaDesdeConsulta(Config);
		
	}
	*/
	/*
	function search(){
	    //alert("llega");
	    
		
		filtro=["User","time","UserId"];
		filtroX=["1",Math.random(),UserId];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto


		var Indices=["BarcodeExterno","Documento","ApellidoYNombre","FechaI","FechaF"];
		var Objetos = ["BarcodeExterno","Documento","ApellidoYNombre","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

		var EsconderElementos=["9","33","34","35","36"];
		
		//
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas2",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` + EsconderElementos + `],
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstados.php"
			
		}`);
		
	    TablaDesdeConsulta(Config);
	    
	    //console.log(Config);
	}
	*/
	
	/*
		function VerDetallesDePiezas2(e){
		var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;

		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('show');
		console.log(DivDeTabla.Config.Resultado[e.Data][0]);
		document.getElementById("DetalleDePiezaActual").innerHTML = DivDeTabla.Config.Resultado[e.Data][0];
		
		filtro=["User","time","PiezaId"];
		filtroX=["1",Math.random(),DivDeTabla.Config.Resultado[e.Data][0]];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		
	
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][3];
		document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][33];                        
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][34];//?
		document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][35];//?

		if(DivDeTabla.Config.Resultado[e.Data][36] != ""){
			document.getElementById("FotoAndroid").src = "http://sispo.com.ar/zonificacion/Android/Acusses/" + DivDeTabla.Config.Resultado[e.Data][36];
		}else{
			document.getElementById("FotoAndroid").src = "";
		}
		

		

		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`);
		TablaDesdeConsulta(Config);
		
	}
	*/
	/*
		function Reporte2(){
        console.log("Empezando la descarga")

		var Documento = $('#Documento').val();
		var ApellidoYNombre = $('#ApellidoYNombre').val();
		var FechaDesde = $('#FechaDesde').val();
		var FechaHasta = $('#FechaHasta').val();
		var BarcodeExterno = $('#BarcodeExterno').val();

        location.href = URLJS + "XMLHttpRequest/clientepiezassolicitadas/reporteIntra.php?UserId=" + UserId + "&ApellidoYNombre=" + ApellidoYNombre + "&FechaI=" + FechaDesde + "&FechaF=" + FechaHasta + "&BarcodeExterno=" + BarcodeExterno + "&Documento=" + Documento;
        console.log("Termino la descarga")
	}

*/






