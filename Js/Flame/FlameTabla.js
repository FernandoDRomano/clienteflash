
function TablaDesdeConsulta(Config = false){
	var x = document.getElementById(Config.DivContenedor);
	if(x == null){
		if(typeof $.bootstrapGrowl === "function") {
			$.bootstrapGrowl("El Elemento " + Config.DivContenedor + " No Existe",{
				type: 'danger',
				align: 'center',
				width: 'auto'
			});
		}
		return;
	}
	Loading();
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);//JsonElementosAJsonValores FlameBase
		var PostData = {};
		//console.log( JSON.parse(jsonValoresDirectos));
		//console.log( JSON.parse(Config.DataAjax));
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));//jsonConcat FlameBase
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));//jsonConcat FlameBase
		//console.log(jsonValoresDirectos);
		//console.log(PostData);
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
		//console.log(PostData);
	}
	
	var loading = document.getElementById("loading");
	var div = document.createElement("div");
	div.className="progress";
	div.setAttribute("style","height: 10px; margin-bottom: 2px;");
	var divLoading = document.createElement("div");
	divLoading.id="BarraDeCarga_"+Config.DivContenedor;
	//alert(divLoading.id);
	divLoading.className="progress-bar progress-bar-striped active";
	divLoading.setAttribute("role","progressbar");
	divLoading.setAttribute("aria-valuenow", "1");
	divLoading.setAttribute("aria-valuemin", "0");
	divLoading.setAttribute("aria-valuemax", "100");
	divLoading.setAttribute("style", "width:1%");
	divLoading.setAttribute("style","height: 10px; margin-bottom: 2px; background-color: #0068a9;");
	div.appendChild(divLoading);
	loading.appendChild(div);
	
	$.ajax({
		type:"GET",
		url:Config.Ajax,
		data: PostData,
		success:function(Resultado){
			percentComplete = parseInt( (100), 10);
			$('#BarraDeCarga_'+Config.DivContenedor).data("aria-valuenow",percentComplete);
			$('#BarraDeCarga_'+Config.DivContenedor).css("width",percentComplete+'%');
			var Resultado = Resultado.trim();
			if(Resultado=="NULL" || Resultado==""){
				if(Config.MensajeEnFail){
					if(typeof $.bootstrapGrowl === "function") {
						$.bootstrapGrowl(Config.TextoEnFail,{
							type: 'danger',
							align: 'center',
							width: 'auto'
						});
					}
				}
				var DivDeTabla =  document.getElementById(Config.DivContenedor);
				DivDeTabla.Config = undefined;
				var Paginador = DivDeTabla.getElementsByClassName('Paginador')[0];
				Paginador.innerHTML = "";
				//console.log(DivDeTabla);
				
				if( typeof(DivDeTabla) == 'undefined' || DivDeTabla == null ){//#1231243466676856364224
					//console.log("DivDeTabla No Encontrado");
					EndLoading;
					return;
				}
				
				var tabla = DivDeTabla.getElementsByTagName('table')[0];
				//var tabla = document.getElementById(DivDeTabla.Config.Tabla);
				var ElementosDeTabla = tabla.getElementsByTagName("tr");
				var SaltarElemento = 0;
				
				if( typeof(ElementosDeTabla) != 'undefined' && ElementosDeTabla != null ){
					//console.log("DivDeTabla.Config != null");
					while(ElementosDeTabla.length > SaltarElemento){
						if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
						else{ElementosDeTabla[SaltarElemento].remove();}
					}
				}
				//console.log("1");
				/*
				Tablas = DivDeTabla.getElementsByTagName('TABLE');
				while(Tablas.length > 0){
					Tablas[0].remove();
				}
				var tabla = document.getElementById(DivDeTabla.Config.Tabla);
				*/
				/*
				var ElementosDeTabla = tabla.getElementsByTagName("tr");
				var SaltarElemento = 0;
				if(DivDeTabla.Config != null){
					while(ElementosDeTabla.length > SaltarElemento){
						if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
						else{ElementosDeTabla[SaltarElemento].remove();}
					}
				}
				*/
				
				
				if( typeof(ElementosDeTabla) != 'undefined' && ElementosDeTabla != null ){
					//alert("");
					while(ElementosDeTabla.length > 0){
						ElementosDeTabla[0].remove();
					}
				}
				
				
				//DivDeTabla.innerHTML = "";
				//DivDeTabla.value = "";
				EndLoading();
			}else{
				//console.log("Else");
				var NuevoMetodoDeTabla = false;
				if(Resultado.split("(;)").length > 1 && Resultado.split("(|)").length > 1){
					NuevoMetodoDeTabla = true;
				}
				
				if(NuevoMetodoDeTabla){
					var Arrayd1D = Resultado.split("(;)");
				}else{
					var Arrayd1D = Resultado.split(";");
				}
				
				var Arrayd2D = new Array();
				for(var i = 0 ; i < Arrayd1D.length ; i++ ){
					if(NuevoMetodoDeTabla){
						Arrayd2D[i] = Arrayd1D[i].split("(|)");
					}else{
						Arrayd2D[i] = Arrayd1D[i].split("|");
					}
					
				}
				var ObjJSON = JSON.parse(JSON.stringify(Arrayd2D));
				Config.Resultado = ObjJSON;
				//console.log(Config);
				FormatearDatosParaTabla(Config);
				/*
				var Elemento = document.getElementById(Config.DivContenedor);
				Elemento.innerHTML = Resultado;
				Elemento.value = Resultado;
				*/
				EndLoading();
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState == 4) {
				if(typeof $.bootstrapGrowl === "function") {
					$.bootstrapGrowl("Error" + XMLHttpRequest.status + " (" + XMLHttpRequest.statusText + ")",{
						type: 'danger',
						align: 'center',
						width: 'auto'
					});
				}
				EndLoading();
			}else{
				if (XMLHttpRequest.readyState == 0) {
					$.ajax(this);
					console.clear();
					return;
				}
				else {
				}
			}
		},
		dataType: "text" // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
	})
}

function FormatearDatosParaTabla(Config = false){
	//console.log(Config);
	var DivDeTabla =  document.getElementById(Config.DivContenedor);
	if( typeof(DivDeTabla) == 'undefined' || DivDeTabla == null ){//#1231243466676856364224
		EndLoading;
		//console.log("DivDeTabla No Encontrado");
		return;
	}else{
	}
	
	var tabla = DivDeTabla.getElementsByTagName('table')[0];
	//var tabla = document.getElementById(DivDeTabla.Config.Tabla);
	var ElementosDeTabla = tabla.getElementsByTagName("tr");
	/*
	var SaltarElemento = 0;
	if(DivDeTabla.Config != null){
		while(ElementosDeTabla.length > SaltarElemento){
			if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
			else{ElementosDeTabla[SaltarElemento].remove();}
		}
	}
	*/
	
	if(DivDeTabla.Config != null){
		while(ElementosDeTabla.length > 0){
			ElementosDeTabla[0].remove();
		}
	}
	
	/*
	var tabla = DivDeTabla.getElementsByTagName('table')[0];
	if (typeof(tabla) != 'undefined' && tabla != null){
		tabla.remove();
		Config.Tabla = tabla.id;
	}else{
	}
	*/
	
	var Paginador = DivDeTabla.getElementsByClassName('Paginador')[0];
	if( typeof(Paginador) == 'undefined' || Paginador == null ){
		Config.Paginador = "";
		ConPaginado = false;
	}else{
		Config.Paginador = Paginador.id;
		Config.ConPaginado = true;
		//console.log(Config);
	}
	
	var DivMaximoDeFilas = DivDeTabla.getElementsByClassName('MaximoDeFilas')[0];
	if( typeof(DivMaximoDeFilas) == 'undefined' || DivMaximoDeFilas == null ){
		//alert("MaximoDeFilas No");
		Config.Paginador = "";
		ConPaginado = false;
		Config.MaximoDeFilas = 0;
	}else{
		//alert("MaximoDeFilas Si");
		var MaximoDeFilas = DivMaximoDeFilas.getElementsByTagName('input')[0];
		Config.ElementoMaximoDeFilas = MaximoDeFilas.id;
		Config.ConPaginado = true;
		Config.MaximoDeFilas = 1;
		//console.log(Config);
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////
	// Creo Config En Div
	Config.Titulos = Config.Resultado[0];
	Config.Resultado.shift();
	DivDeTabla.Config = CopiarObjeto(Config);
	DivDeTabla.Config.ValoresDeInputs = {};
	//console.log(DivDeTabla.Config);
	////////////////////////////////////////////////////////////////////////////////////////////////
	
	if( !(typeof(MaximoDeFilas) == 'undefined' || MaximoDeFilas == null) ){
		MaximoDeFilas.onkeyup = function(){
			var DivDeTabla = this.parentElement.parentElement;
			DivDeTabla.Config.MaximoDeFilas = this.value;
			
			var tabla = DivDeTabla.getElementsByTagName('table')[0];
			//var tabla = document.getElementById(DivDeTabla.Config.Tabla);
			var ElementosDeTabla = tabla.getElementsByTagName("tr");
			
			var SaltarElemento = 0;
			if(DivDeTabla.Config != null){
				while(ElementosDeTabla.length > SaltarElemento){
					if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
					else{ElementosDeTabla[SaltarElemento].remove();}
				}
				//CrearTabla(DivDeTabla.Config);
				//Config.Pagina = 1;
				DivDeTabla.Config.Pagina = 1;
				ActualizarTabla(Config.DivContenedor);
			}
			/*
			if(DivDeTabla.Config != null){
				while(ElementosDeTabla.length > 0){
					else{ElementosDeTabla[SaltarElemento].remove();}
				}
				//console.log(DivDeTabla.Config);
			}
			*/
		};
	}
	if(Config.CrearAlCargarDatos){
		Config.Pagina = 1;
		CrearTabla(Config);
		/*
		var Padre = DivDeTabla.parentElement;
		if(typeof(Padre) != 'undefined' && Padre != null){
			if(Padre.className.includes("portlet")){
				var tabla = document.getElementById(Config.Tabla);
				var ElementosDeTabla = tabla.getElementsByTagName("tr");
				
				var SaltarElemento = 0;
				if(DivDeTabla.Config != null){
					while(ElementosDeTabla.length > SaltarElemento){
						if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
						else{ElementosDeTabla[SaltarElemento].remove();}
					}
				}
				
			}else{
			}
		}else{
		}
		*/
	}
}

function FiltroEnTabla(Config){
	//console.log(Config);
	var DivDeTabla =  document.getElementById(Config.DivContenedor);
	//var tabla = document.getElementById(Config.Tabla);
	
	var tabla = DivDeTabla.getElementsByTagName('table')[0];
	/*
	//var tabla = document.getElementById(DivDeTabla.Config.Tabla);
	var ElementosDeTabla = tabla.getElementsByTagName("tr");
	if(DivDeTabla.Config != null){
		while(ElementosDeTabla.length > 0){
			else{ElementosDeTabla[SaltarElemento].remove();}
		}
	}
	*/
	//var div = document.createElement("div");
	
	var Titulo = document.createElement("TR");
	Titulo.className = "Escaner";
	Titulo.setAttribute("id", "Escaner");
	
	for(var j = 0;j<Config.Titulos.length;j++){
		var Columna = document.createElement("TD");
		if(Config.EsconderElementos != undefined){
			if(Config.EsconderElementos.find(element => element === j) != undefined){
				Columna.style.display="none";
			}
		}
		
		//Columna.style = "background: #292d57;color: white;";
		Columna.setAttribute("id", "Escaner"+j);
		var input = document.createElement("input");
		input.type="text";
		
		input.className="form-control form-control-sm";
		input.placeholder=Config.Titulos[j];
		input.Columna = j;
		input.setAttribute("id", "Input_Escaner"+j);
		if(Config.ConfigFiltro != 'undefined' && Config.ConfigFiltro != null ){
			for(var k = 0 ; k < Config.ConfigFiltro.ArraydDeFiltros.length ; k++ ){
				if(j==Config.ConfigFiltro.ArraydDeFiltros[k]){
					input.value = Config.ConfigFiltro.ArraydDeFiltrosValores[k];
				}
			}
		}
		
		var label = document.createElement("label");
		var span = document.createElement("span");
		var b = document.createElement("b");
		label.className="control-label";
		span.className="info";
		span.setAttribute("aria-required", "true");
		b.innerHTML = Config.Titulos[j];
		span.appendChild(b);
		label.appendChild(span);
		Columna.appendChild(label);
		
		//TD_0
		Columna.appendChild(input);
		Titulo.onkeyup = function(){
			
			
			var ArraydDeFiltros = new Array();
			var ArraydDeFiltrosValores = new Array();
			inputs = this.getElementsByTagName('input');
			for(var i = 0 ; i < inputs.length ; i++){
				if(inputs[i].value != ""){
					ArraydDeFiltros.push(inputs[i].Columna);
					ArraydDeFiltrosValores.push(inputs[i].value);
				}
			}
			var Filtro = ArraidNameValueToJSON(ArraydDeFiltros,ArraydDeFiltrosValores);
			//const ConfigFiltro = new Object;
			//ConfigFiltro.ArraydDeFiltros = ArraydDeFiltros;
			//ConfigFiltro.ArraydDeFiltrosValores = ArraydDeFiltrosValores;
			DivDeTabla.Config.Filtrado = true;
			DivDeTabla.Config.Filtro = Filtro;
			
			//console.log(DivDeTabla.Config);
			//console.log(Filtro);
			//CrearTabla(DivDeTabla.Config);
			
			
			DivDeTabla.Config.Pagina = 1;
			ActualizarTabla(DivDeTabla.Config.DivContenedor)
			//console.log(DivDeTabla.Config);
			
			// *
			//Config.RuFiltrado = true;
			//Config.RuInicio = false;
			//Config.ConfigFiltro = ConfigFiltro;
			//RuAutoTabla(Config,"");
			// * /
		};
		Titulo.appendChild(Columna);
	}
	
	DivDeTabla.Config.FiltroIniciado = true;
	tabla.appendChild(Titulo);
	DivDeTabla.appendChild(tabla);

}

function CrearPaginador(Config){
	//Config.ResultadoFiltrado
	var Config = CopiarObjeto(Config);
	if(Config.Paginador != undefined && Config.Paginador != ""){
		var DivPaginador = document.getElementById(Config.Paginador);
		//DivPaginador.style.display="block";
		DivPaginador.innerHTML = "";
		var Ul = document.createElement("ul");
		Ul.id="Paginador";
		Ul.classList.add("pagination");
		var ContadorTemporal=1;
		if(Config.Filtrado){
			var NumeroDeFilas = Config.ResultadoFiltrado.length;
		}else{
			var NumeroDeFilas = Config.Resultado.length;
		}
		
		if(true){
			var CantidadDePaginas = (NumeroDeFilas/Config.MaximoDeFilas*1);
			///////////////////////////////////////////////////////////////////////////////////
			var li = document.createElement("li");
			li.id = 1;
			li.style = "display:contents" ;
			var ElementA = document.createElement("a");
			ElementA.innerHTML = "&Lang;";
			ElementA.Item = 1;
			ElementA.onclick = function() {
				var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
				DivDeTabla.Config.Pagina = this.Item*1;
				var idDiv = this.parentElement.parentElement.id;
				var lis = this.parentElement.parentElement.getElementsByTagName("li");
				//console.log(lis);
				for( var i = 0 ; i < lis.length ; i++ ){
					if( !(i > (1 - 5) && i < (1 + 5)) && (i > 0) && (i < lis.length*1 -1)){
						lis[i].style = "display:none" ;
					}else{
						lis[i].style = "display:contents" ;
					}
				}
				$("#"+idDiv+">li.active").removeClass("active");
				var li = this.parentElement;
				if(li.id = DivDeTabla.Config.Pagina){
					li.className ="active";
				}
				//li.classList.toggle("active");
				//li.className ="active";
				//li.removeClass("active");
				Config.RuInicio = false;
				ActualizarTabla(Config.DivContenedor);
			};
			li.appendChild(ElementA);
			Ul.appendChild(li);
			///////////////////////////////////////////////////////////////////////////////////
			
			
			
			for(var i = 1; (i*1)-NumeroDeFilas <= 0 ; i+=(Config.MaximoDeFilas*1), ContadorTemporal++){
				
				//console.log( (i*1)-NumeroDeFilas );
				//console.log(0);
				//console.log( i+ (Config.MaximoDeFilas*1) );
				
				var li = document.createElement("li");
				li.id = ContadorTemporal;
				if( !(ContadorTemporal > (Config.Pagina*1 - 5) && ContadorTemporal < (Config.Pagina*1 + 5)) ){
					li.style = "display:none" ;
				}else{
					li.style = "display:contents" ;
				}
				
				var ElementA = document.createElement("a");
				ElementA.innerHTML = ContadorTemporal;
				ElementA.Item = ContadorTemporal;
				ElementA.Config = Config;
				ElementA.onclick = function() {
					var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
					DivDeTabla.Config.Pagina = this.Item*1;
					var idDiv = this.parentElement.parentElement.id;
					var lis = this.parentElement.parentElement.getElementsByTagName("li");
					//console.log(lis);
					for( var i = 0 ; i < lis.length ; i++ ){
						if( !(i > (this.Item*1 - 5) && i < (this.Item*1 + 5)) && (i > 0) && (i < lis.length*1 -1)){
							lis[i].style = "display:none" ;
						}else{
							lis[i].style = "display:contents" ;
						}
					}
					$("#"+idDiv+">li.active").removeClass("active");
					var li = this.parentElement;
					//li.classList.toggle("active");
						//li.className = "active";
					//li.classList.toggle("active");
					Config.RuInicio = false;
					
					/*
					RuAutoTabla(ConfigT,"");
					*/
					ActualizarTabla(Config.DivContenedor);
				};
				/*
				if(i == Config.Pagina){
					//li.className ="active";
					//li.classList.toggle("active");
				}
				*/
				if(li.id == Config.Pagina){
					//alert(li.id + " == " + Config.Pagina);
					li.className = "active";
					//li.classList.toggle("active");
				}
				li.appendChild(ElementA);
				Ul.appendChild(li);
			}
			
			///////////////////////////////////////////////////////////////////////////////////
			var li = document.createElement("li");
			li.id = ContadorTemporal;
			li.style = "display:contents" ;
			var ElementA = document.createElement("a");
			ElementA.innerHTML = "&Rang;";
			ElementA.Item = ContadorTemporal;
			ElementA.onclick = function() {
				var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
				var idDiv = this.parentElement.parentElement.id;
				var lis = this.parentElement.parentElement.getElementsByTagName("li");
				DivDeTabla.Config.Pagina = lis.length-2;
				//console.log(lis);
				for( var i = 0 ; i < lis.length ; i++ ){
					if( !(i > ( (lis.length-2) - 5) && i < ( (lis.length-2) + 5)) && (i > 0) && (i < lis.length -2)){
						lis[i].style = "display:none" ;
					}else{
						lis[i].style = "display:contents" ;
					}
				}
				$("#"+idDiv+">li.active").removeClass("active");
				var li = this.parentElement;
				if(li.id = DivDeTabla.Config.Pagina){
					li.className ="active";
				}
				//li.className ="active";
				//li.classList.toggle("active");
				Config.RuInicio = false;
				ActualizarTabla(Config.DivContenedor);
			};
			li.appendChild(ElementA);
			Ul.appendChild(li);
			///////////////////////////////////////////////////////////////////////////////////
			
			DivPaginador.appendChild(Ul);
		}
	}
}



function ActualizarTabla(div){
	var DivDeTabla =  document.getElementById(div);
	if( typeof(DivDeTabla) == 'undefined' || DivDeTabla == null ){//#1231243466676856364224
		EndLoading;
		alert("Reporte Este Error: ActualizarTabla - typeof(DivDeTabla) == 'undefined'");
		return;
	}
	Config = DivDeTabla.Config;
	
	if(Config.ConFiltro && Config.FiltroIniciado === undefined){
		FiltroEnTabla(Config);
	}else{
		if(Config.Filtrado){
			
			var Llaves = new Array;
			var Valores = new Array;
			var ResultadoFiltrado = new Array;
			var FilasResultadosDeFiltros = new Array;
			for(var i = 0 ; i < jQuery.parseJSON(Config.Filtro).length ; i++){
				Llaves[i] = Object.keys( jQuery.parseJSON(Config.Filtro)[i] )[0]*1;
				Valores[i] = jQuery.parseJSON(Config.Filtro)[i][Llaves[i]];
			}
			var Encontrado;
			var Encontrados = 0;
			for(var i = 0 ; i < Config.Resultado.length ; i++){
				Encontrado = true;
				for(var j = 0 ; j < Llaves.length ; j++){
					if(Config.Resultado[i][Llaves[j]].toLowerCase().indexOf(""+Valores[j].toLowerCase()) == -1){
						Encontrado = false;
					}
				}
				if(Encontrado){
					FilasResultadosDeFiltros[Encontrados] = i;
					ResultadoFiltrado[Encontrados] = Config.Resultado[i];
					Encontrados++;
				}
			}
			
			Config.ResultadoFiltrado = ResultadoFiltrado;
			Config.FilasResultadosDeFiltros=FilasResultadosDeFiltros;
			//console.log(Config.ResultadoFiltrado);
		}
	}
	
	var tabla = DivDeTabla.getElementsByTagName('table')[0];
	var ElementosDeTabla = tabla.getElementsByTagName("tr");
	var SaltarElemento = 0;
	if(DivDeTabla.Config != null){
		while(ElementosDeTabla.length > SaltarElemento){
			if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
			else{ElementosDeTabla[SaltarElemento].remove();}
		}
	}
	var Titulos = document.createElement("TR");
	for(var i = 0 ; i <Config.Titulos.length ; i++ ){
		var Columna = document.createElement("TH");
		Columna.setAttribute("id", "Titulos_TH"+i);
		Columna.Numero = i;
		if(Config.EsconderElementos != undefined){
			if(Config.EsconderElementos.find(element => element === i) != undefined){
				Columna.style.display="none";
			}
		}
		var Texto = document.createTextNode(Config.Titulos[i]);
		Columna.appendChild(Texto);
		Titulos.appendChild(Columna);
		
		if(Config.AddImput && i+1 == Config.Titulos.length){
			var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
			for(var t = 0; t<ArrayTitulosInputs.length;t++){
				var Columna = document.createElement("TH");
				Columna.setAttribute("id", "Titulos_TH"+i+"-"+t);
				Columna.Numero = i;
				if(Config.EsconderElementos != undefined){
					if(Config.EsconderElementos.find(element => element === t) != undefined){
						Columna.style.display="none";
					}
				}
				var Texto = document.createElement("P");
				Texto.innerHTML = ArrayTitulosInputs[t];
				Columna.appendChild(Texto);
				Titulos.appendChild(Columna);
			}
		}
	}
	tabla.appendChild(Titulos);
	
	//Crea Paginado
	if(Config.ConPaginado){
		if(Config.MaximoDeFilas>0){
			var DivPaginador = document.getElementById(Config.Paginador);
			DivPaginador.innerHTML = "";
			var MaximoDeFilas = document.getElementById(Config.ElementoMaximoDeFilas).value;
			Config.MaximoDeFilas = MaximoDeFilas;
			if(Config.ResultadoFiltrado != undefined){
				var CantidadDeFilas = Config.ResultadoFiltrado.length;
			}else{
				var CantidadDeFilas = Config.Resultado.length;
				Config.Filtrado = false;
			}
			
			CrearPaginador(Config);
		}else{
			Config.MaximoDeFilas = 100000;
			if(Config.ResultadoFiltrado != undefined){
				var CantidadDeFilas = Config.ResultadoFiltrado.length;
			}else{
				var CantidadDeFilas = Config.Resultado.length;
				Config.Filtrado = false;
			}
			CrearPaginador(Config);
		}
	}
	
	if(Config.ConPaginado){
		if(Config.Filtrado){
			//Config.ResultadoFiltrado
			for(var i = (Config.Pagina - 1)*Config.MaximoDeFilas ; i <Config.ResultadoFiltrado.length && i < (Config.Pagina)*Config.MaximoDeFilas ; i++ ){
				var fila = document.createElement("TR");
				for(var j = 0;j<Config.ResultadoFiltrado[i].length;j++){
					if( Config.ResultadoFiltrado[i][j].search("EmergenteEnTabla=") == 0 ){
					}
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_"+i);
					if(Config.EsconderElementos != undefined){
						if(Config.EsconderElementos.find(element => element === j) != undefined){
							Columna.style.display="none";
						}
					}
					var Texto = document.createTextNode(Config.ResultadoFiltrado[i][j]);
					Columna.appendChild(Texto);
					fila.appendChild(Columna);
					
					if(Config.AddImput && j+1 == Config.Resultado[i].length){
						var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
						for(var t = 0; t<ArrayTitulosInputs.length;t++){
							var Columna = document.createElement("TD");
							Columna.setAttribute("id", "TD_Imput"+Config.FilasResultadosDeFiltros[i]+"-"+t);
							var Input = document.createElement("INPUT");
							Input.className= "form-control form-control-sm";
							//var Texto = document.createTextNode(Config.Resultado[i][j]);
							if(Config.ValoresDeInputs["TD_Imput"+Config.FilasResultadosDeFiltros[i]+"-"+t] != undefined ){
								Input.value = Config.ValoresDeInputs["TD_Imput"+i+"-"+t];
							}
							Input.onkeyup = function() {
								//alert(this.value);
								var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
								//DivDeTabla.Config.ValoresDeInputs = {};
								var idx = this.parentElement.id;
								var idxvalue = this.value;
								DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
								//console.log(DivDeTabla.Config);
							};
							Columna.appendChild(Input);
							fila.appendChild(Columna);
						}
					}
					
					if(Config.BotonParaFuncion != null && j+1 == Config.Resultado[i].length){
						//alert("Tabla Con Boton De Funciones");
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_Boton"+i);
						var Boton = document.createElement("BUTTON");
						//btn btn-secondary mx-1 my-1 px-1 py-1 align-middle
						//Boton.className= "btn btn-large btn-block btn-tertiary";
						
						
						Boton.className= Config.ClasseDeBotonParaFuncion;
						//Boton.innerHTML = "" + Config.TextoDeBotonParaFuncion;
						var TextoDeBoton = document.createTextNode("" + Config.TextoDeBotonParaFuncion);
						Boton.id = "Boton-" + Config.FilasResultadosDeFiltros[i];
						Boton.Data = Config.FilasResultadosDeFiltros[i];
						//Boton.className= "form-control form-control-sm";
						//var Texto = document.createTextNode(Config.Resultado[i][j]);
						Boton.onclick = function(){
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//alert(Config.BotonParaFuncion);
							eval(Config.BotonParaFuncion)(this);
							//console.log(DivDeTabla.Config);
							//console.log(this);
							/*
							//alert(this.value);
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//DivDeTabla.Config.ValoresDeInputs = {};
							var idx = this.parentElement.id;
							var idxvalue = this.value;
							DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
							//console.log(DivDeTabla.Config);
							*/
						};
						var Icono = document.createElement("I");
						Icono.className= "" + Config.ClasseDeIconoParaFuncion;
						Icono.style="" + Config.EstiloDeIconoParaFuncion;
						//<i class="fas fa-eye" style="font-size: 24px;color: #333333;"></i>
						Boton.appendChild(Icono);
						Boton.appendChild(TextoDeBoton);
						Columna.appendChild(Boton);
						fila.appendChild(Columna);
						
					}
				}
				tabla.appendChild(fila);
			}
		}else{
			for(var i = (Config.Pagina - 1)*Config.MaximoDeFilas ; i <Config.Resultado.length && i < (Config.Pagina)*Config.MaximoDeFilas ; i++ ){
				var fila = document.createElement("TR");
				for(var j = 0;j<Config.Resultado[i].length;j++){
					if( Config.Resultado[i][j].search("EmergenteEnTabla=") == 0 ){
					}
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_"+i);
					if(Config.EsconderElementos != undefined){
						if(Config.EsconderElementos.find(element => element === j) != undefined){
							Columna.style.display="none";
						}
					}
					var Texto = document.createTextNode(Config.Resultado[i][j]);
					Columna.appendChild(Texto);
					fila.appendChild(Columna);
					
					if(Config.AddImput && j+1 == Config.Resultado[i].length){
						var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
						for(var t = 0; t<ArrayTitulosInputs.length;t++){
							var Columna = document.createElement("TD");
							Columna.setAttribute("id", "TD_Imput"+i+"-"+t);
							var Input = document.createElement("INPUT");
							Input.className= "form-control form-control-sm";
							//var Texto = document.createTextNode(Config.Resultado[i][j]);
							
							if(Config.ValoresDeInputs["TD_Imput"+i+"-"+t] != undefined ){
								Input.value = Config.ValoresDeInputs["TD_Imput"+i+"-"+t];
							}
							Input.onkeyup = function() {
								//alert(this.value);
								var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
								//DivDeTabla.Config.ValoresDeInputs = {};
								var idx = this.parentElement.id;
								var idxvalue = this.value;
								DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
								//console.log(DivDeTabla.Config);
							};
							Columna.appendChild(Input);
							fila.appendChild(Columna);
						}
					}
					
					if(Config.BotonParaFuncion != null && j+1 == Config.Resultado[i].length){
						//alert("Tabla Con Boton De Funciones");
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_Boton"+i);
						if(Config.EsconderElementos != undefined){
							if(Config.EsconderElementos.find(element => element === j) != undefined){
								Columna.style.display="none";
							}
						}
						var Boton = document.createElement("BUTTON");
						Boton.className= Config.ClasseDeBotonParaFuncion;
						//Boton.innerHTML = "" + Config.TextoDeBotonParaFuncion;
						var TextoDeBoton = document.createTextNode("" + Config.TextoDeBotonParaFuncion);
						Boton.id = "Boton-" + i;
						Boton.Data = i;
						//Boton.className= "form-control form-control-sm";
						//var Texto = document.createTextNode(Config.Resultado[i][j]);
						Boton.onclick = function(){
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//alert(Config.BotonParaFuncion);
							eval(Config.BotonParaFuncion)(this);
							
							/*
							//alert(this.value);
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//DivDeTabla.Config.ValoresDeInputs = {};
							var idx = this.parentElement.id;
							var idxvalue = this.value;
							DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
							//console.log(DivDeTabla.Config);
							*/
						};
						var Icono = document.createElement("I");
						Icono.className= "" + Config.ClasseDeIconoParaFuncion;
						Icono.style="" + Config.EstiloDeIconoParaFuncion;
						//<i class="fas fa-eye" style="font-size: 24px;color: #333333;"></i>
						Boton.appendChild(Icono);
						Boton.appendChild(TextoDeBoton);
						Columna.appendChild(Boton);
						fila.appendChild(Columna);
						
					}
				}
				tabla.appendChild(fila);
			}
		}
	}else{
		for(var i = 0 ; i <Config.Resultado.length ; i++ ){
			var fila = document.createElement("TR");
			for(var j = 0;j<Config.Resultado[i].length;j++){
				if( Config.Resultado[i][j].search("EmergenteEnTabla=") == 0 ){
				}
				var Columna = document.createElement("TD");
				Columna.setAttribute("id", "TD_"+i);
				if(Config.EsconderElementos != undefined){
					if(Config.EsconderElementos.find(element => element === j) != undefined){
						Columna.style.display="none";
					}
				}
				var Texto = document.createTextNode(Config.Resultado[i][j]);
				Columna.appendChild(Texto);
				fila.appendChild(Columna);
			}
			tabla.appendChild(fila);
		}
	}
	//console.log(Config);
}


function CrearTabla(Config){
	var DivDeTabla =  document.getElementById(Config.DivContenedor);
	DivDeTabla.Config.Pagina = 1;
	if( typeof(DivDeTabla) == 'undefined' || DivDeTabla == null ){
		EndLoading;
		return;
	}
	//Borra Elementas De La Tabla
	var tabla = DivDeTabla.getElementsByTagName('table')[0];
	var ElementosDeTabla = tabla.getElementsByTagName("tr");
	var SaltarElemento = 0;
	if(DivDeTabla.Config != null){
		while(ElementosDeTabla.length > SaltarElemento){
			if(ElementosDeTabla[SaltarElemento].className == "Escaner"){SaltarElemento++;}
			else{ElementosDeTabla[SaltarElemento].remove();}
		}
	}
	
	//Crea El Elemento Para Filtro.
	if(Config.ConFiltro && Config.FiltroIniciado === undefined){
		//console.log(Config);
		FiltroEnTabla(Config);
	}else{
		
	}
	
	//Crea Paginado
	if(Config.ConPaginado){
		if(Config.MaximoDeFilas>0){
			var DivPaginador = document.getElementById(Config.Paginador);
			var MaximoDeFilas = document.getElementById(Config.ElementoMaximoDeFilas).value;
			Config.MaximoDeFilas = MaximoDeFilas;
			var CantidadDeFilas = Config.Resultado.length;
			CrearPaginador(Config);
		}else{
			Config.MaximoDeFilas = 100000;
			var CantidadDeFilas = Config.Resultado.length;
			CrearPaginador(Config);
		}
	}
	
	//Crea Los Titulos
	var Titulos = document.createElement("TR");
	//console.log(Config);
	//console.log(Config.EsconderElementos);
	for(var i = 0 ; i <Config.Titulos.length ; i++ ){
		if(Config.EsconderElementos != undefined){
			if(Config.EsconderElementos.find(element => element === i) != undefined){
				//console.log(Config.EsconderElementos.find(element => element === i));
				var Columna = document.createElement("TH");
				Columna.setAttribute("id", "Titulos_TH"+i);
				Columna.Numero = i;
				Columna.style.display="none";
				var Texto = document.createTextNode(Config.Titulos[i]);
				Columna.appendChild(Texto);
				Titulos.appendChild(Columna);
			}else{
				var Columna = document.createElement("TH");
				Columna.setAttribute("id", "Titulos_TH"+i);
				Columna.Numero = i;
				var Texto = document.createTextNode(Config.Titulos[i]);
				Columna.appendChild(Texto);
				Titulos.appendChild(Columna);

			}
		}else{
			var Columna = document.createElement("TH");
			Columna.setAttribute("id", "Titulos_TH"+i);
			Columna.Numero = i;
			var Texto = document.createTextNode(Config.Titulos[i]);
			Columna.appendChild(Texto);
			Titulos.appendChild(Columna);
		}
		if(Config.AddImput && i+1 == Config.Titulos.length){
			var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
			for(var t = 0; t<ArrayTitulosInputs.length;t++){
				if(Config.EsconderElementos != undefined){
					if(Config.EsconderElementos.find(element => element === t) != undefined){
						//console.log(Config.EsconderElementos.find(element => element === t));
						var Columna = document.createElement("TH");
						Columna.setAttribute("id", "Titulos_TH"+i+"-"+t);
						Columna.Numero = i;
						Columna.style.display="none";
						var Texto = document.createElement("P");
						Texto.innerHTML = ArrayTitulosInputs[t];
						Columna.appendChild(Texto);
						Titulos.appendChild(Columna);
					}else{
						var Columna = document.createElement("TH");
						Columna.setAttribute("id", "Titulos_TH"+i+"-"+t);
						Columna.Numero = i;
						var Texto = document.createElement("P");
						Texto.innerHTML = ArrayTitulosInputs[t];
						Columna.appendChild(Texto);
						Titulos.appendChild(Columna);

					}
				}else{
					var Columna = document.createElement("TH");
					Columna.setAttribute("id", "Titulos_TH"+i+"-"+t);
					Columna.Numero = i;
					var Texto = document.createElement("P");
					Texto.innerHTML = ArrayTitulosInputs[t];
					Columna.appendChild(Texto);
					Titulos.appendChild(Columna);
				}
				
				
			}
		}
		/*
		if(Config.AddImput && i+1 == Config.Titulos.length){
			var Columna = document.createElement("TH");
			Columna.setAttribute("id", "Titulos_TH"+i);
			Columna.Numero = i;
			var Texto = document.createElement("P");
			Texto.innerHTML = Config.ImputsAderidosTitulo;
			Columna.appendChild(Texto);
			Titulos.appendChild(Columna);
		}
		*/
	}
	tabla.appendChild(Titulos);
	
	//console.log(Config);
	//Crea Las Filas De La Pagina Actual o 
	if(Config.ConPaginado){
		for(var i = (Config.Pagina - 1)*Config.MaximoDeFilas ; i <Config.Resultado.length && i < (Config.Pagina)*Config.MaximoDeFilas ; i++ ){
			
			var fila = document.createElement("TR");
			for(var j = 0; j < Config.Resultado[i].length;j++){
				
				if( Config.Resultado[i][j].search("EmergenteEnTabla=") == 0 ){
				}
				if(Config.EsconderElementos != undefined){
					if(Config.EsconderElementos.find(element => element === j) != undefined){
						//console.log(Config.EsconderElementos.find(element => element === j));
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_"+i);
						Columna.style.display="none";
						var Texto = document.createTextNode(Config.Resultado[i][j]);
						Columna.appendChild(Texto);
						fila.appendChild(Columna);
					}else{
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_"+i);
						var Texto = document.createTextNode(Config.Resultado[i][j]);
						Columna.appendChild(Texto);
						fila.appendChild(Columna);
					}
				}else{
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_"+i);
					var Texto = document.createTextNode(Config.Resultado[i][j]);
					Columna.appendChild(Texto);
					fila.appendChild(Columna);
				}
				
				/*
				var Columna = document.createElement("TD");
				Columna.setAttribute("id", "TD_"+i);
				var Texto = document.createTextNode(Config.Resultado[i][j]);
				Columna.appendChild(Texto);
				fila.appendChild(Columna);
				*/
				
				if(Config.AddImput && j+1 == Config.Resultado[i].length){
					var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
					for(var t = 0; t<ArrayTitulosInputs.length;t++){
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_Imput"+i+"-"+t);
						var Input = document.createElement("INPUT");
						Input.className= "form-control form-control-sm";
						//var Texto = document.createTextNode(Config.Resultado[i][j]);
						Input.onkeyup = function() {
							//alert(this.value);
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//DivDeTabla.Config.ValoresDeInputs = {};
							var idx = this.parentElement.id;
							var idxvalue = this.value;
							DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
							//console.log(DivDeTabla.Config);
						};
						Columna.appendChild(Input);
						fila.appendChild(Columna);
					}
				}
				
				if(Config.BotonParaFuncion != null && j+1 == Config.Resultado[i].length){
					//alert("Tabla Con Boton De Funciones");
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_Boton"+i);
					var Boton = document.createElement("BUTTON");
					Boton.className= Config.ClasseDeBotonParaFuncion;
					//Boton.innerHTML = "" + Config.TextoDeBotonParaFuncion;
					var TextoDeBoton = document.createTextNode("" + Config.TextoDeBotonParaFuncion);
					Boton.id = "Boton-" + i;
					Boton.Data = i;
					//Boton.className= "form-control form-control-sm";
					//var Texto = document.createTextNode(Config.Resultado[i][j]);
					Boton.onclick = function(){
						var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
						//alert(Config.BotonParaFuncion);
						eval(Config.BotonParaFuncion)(this);
						
						/*
						//alert(this.value);
						var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
						//DivDeTabla.Config.ValoresDeInputs = {};
						var idx = this.parentElement.id;
						var idxvalue = this.value;
						DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
						//console.log(DivDeTabla.Config);
						*/
				};
				var Icono = document.createElement("I");
				Icono.className= "" + Config.ClasseDeIconoParaFuncion;
				Icono.style="" + Config.EstiloDeIconoParaFuncion;
				//<i class="fas fa-eye" style="font-size: 24px;color: #333333;"></i>
				Boton.appendChild(Icono);
				Boton.appendChild(TextoDeBoton);
					Columna.appendChild(Boton);
					fila.appendChild(Columna);
					
				}
				/*
				if(Config.AddImput && j+1 == Config.Resultado[i].length){
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_Imput"+i);
					var Input = document.createElement("INPUT");
					Input.className= "form-control form-control-sm";
					//var Texto = document.createTextNode(Config.Resultado[i][j]);
					
					Columna.appendChild(Input);
					fila.appendChild(Columna);
				}
				*/
			}
			tabla.appendChild(fila);
		}
	}else{
		for(var i = 0 ; i <Config.Resultado.length ; i++ ){
			var fila = document.createElement("TR");
			for(var j = 0;j<Config.Resultado[i].length;j++){
				if( Config.Resultado[i][j].search("EmergenteEnTabla=") == 0 ){
					
				}
				if(Config.EsconderElementos != undefined){
					if(Config.EsconderElementos.find(element => element === j) != undefined){
						//console.log(Config.EsconderElementos.find(element => element === j));
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_"+i);
						Columna.style.display="none";
						var Texto = document.createTextNode(Config.Resultado[i][j]);
						Columna.appendChild(Texto);
						fila.appendChild(Columna);
					}else{
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_"+i);
						var Texto = document.createTextNode(Config.Resultado[i][j]);
						Columna.appendChild(Texto);
						fila.appendChild(Columna);
					}
				}else{
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_"+i);
					var Texto = document.createTextNode(Config.Resultado[i][j]);
					Columna.appendChild(Texto);
					fila.appendChild(Columna);
				}
				
				if(Config.AddImput && j+1 == Config.Resultado[i].length){
					var ArrayTitulosInputs = Config.ImputsAderidosTitulo.split("(,)");
					for(var t = 0; t<ArrayTitulosInputs.length;t++){
						var Columna = document.createElement("TD");
						Columna.setAttribute("id", "TD_Imput"+i+"-"+t);
						var Input = document.createElement("INPUT");
						Input.className= "form-control form-control-sm";
						//var Texto = document.createTextNode(Config.Resultado[i][j]);
						Input.onkeyup = function() {
							//alert(this.value);
							var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
							//DivDeTabla.Config.ValoresDeInputs = {};
							var idx = this.parentElement.id;
							var idxvalue = this.value;
							DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
							//console.log(DivDeTabla.Config);
						};
						Columna.appendChild(Input);
						fila.appendChild(Columna);
					}
				}
				
				if(Config.BotonParaFuncion != null && j+1 == Config.Resultado[i].length){
					//alert("Tabla Con Boton De Funciones");
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_Boton"+i);
					var Boton = document.createElement("BUTTON");
					Boton.className= Config.ClasseDeBotonParaFuncion;
					//Boton.innerHTML = "" + Config.TextoDeBotonParaFuncion;
					var TextoDeBoton = document.createTextNode("" + Config.TextoDeBotonParaFuncion);
					Boton.id = "Boton-" + i;
					Boton.Data = i;
					//Boton.className= "form-control form-control-sm";
					//var Texto = document.createTextNode(Config.Resultado[i][j]);
					Boton.onclick = function(){
						var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
						//alert(Config.BotonParaFuncion);
						eval(Config.BotonParaFuncion)(this);
						
						/*
						//alert(this.value);
						var DivDeTabla = this.parentElement.parentElement.parentElement.parentElement;
						//DivDeTabla.Config.ValoresDeInputs = {};
						var idx = this.parentElement.id;
						var idxvalue = this.value;
						DivDeTabla.Config.ValoresDeInputs[idx] = idxvalue;
						//console.log(DivDeTabla.Config);
						*/
					};
					var Icono = document.createElement("I");
					Icono.className= "" + Config.ClasseDeIconoParaFuncion;
					Icono.style= "" + Config.EstiloDeIconoParaFuncion;
					
					//<i class="fas fa-eye" style="font-size: 24px;color: #333333;"></i>
					Boton.appendChild(Icono);
					Boton.appendChild(TextoDeBoton);
					Columna.appendChild(Boton);
					fila.appendChild(Columna);
					
				}
				/*
				if(Config.AddImput && j+1 == Config.Resultado[i].length){
					var Columna = document.createElement("TD");
					Columna.setAttribute("id", "TD_Imput"+i);
					var Input = document.createElement("INPUT");
					Input.className= "form-control form-control-sm";
					//var Texto = document.createTextNode(Config.Resultado[i][j]);
					
					Columna.appendChild(Input);
					fila.appendChild(Columna);
				}
				*/
			}
			tabla.appendChild(fila);
		}
	}
	DivDeTabla.appendChild(tabla);
}










