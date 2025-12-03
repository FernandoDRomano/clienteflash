

var ScriptAceptarPiezasPorHDR =`
	AjaxArraidToSelectSync("Cartero","Banco/AjaxGetCarteos.php",false);
	var Config = JSON.parse(\`
	{
		"Reactivo":"Cartero",
		"Reactor":"HDR",
		"TextoReactor":"BoltTextCartero",
		"TextoFail":"Seleccione Uno",
		"TextoSusses":"",
		"TextoInicial":"",
		"Ajax":"Banco/AjaxGetHDRByCartero.php"
	}\`);
	ChangeCompleteSelect(Config);
	var pagina = 0;
	var Config = JSON.parse(\`
	{
		"Reactivo":"HDR",
		"HijoDeReactivo":"PiezasDeHDR",
		"Reactor":"MainTabla",
		"MaximoDeFilas":5000,
		"hidden":false,
		"shortT":false,
		"CheckBox":true,
		"MaximizeBox":true,
		"MaximizeElement":"MaximizeBox",
		"TextoCheckbox":"Aceptar Pieza",
		"Paginador":"DivPaginador",
		"Pagina":"\` + pagina + \`",
		
		"Ajax":"Banco/AjaxGetPiezasByHDR.php"
	}\`);
	
	ChangeCompleteTableCheckbox(Config);
	
	function Buscar(){
		if( Needed("Cartero",1) && Needed("HDR",1)){
			//var Config = JSON.parse('{"MaximizeBox":true,"MaximizeElement":"MaximizeBox","TextoCheckbox":"Aceptar Pieza"}');
			//TablaCheckBoxToAjaxLoading("MainTabla","Banco/Ajax.php","LoadBar","Aceptando Piezas Banco Macro",Config);
		//}
			var pagina = 0;
			filtro=["UserId","Fecha"];
			filtroX=[0,"2019-01-01"];
			var Parametros = ArraidNameValueToJSON(filtro,filtroX);
			if(Parametros == undefined){return;}
			var Config = JSON.parse(\`
			{
				"Reactivo":null,
				"HijoDeReactivo":"NombreDeTabla",
				"Reactor":"MainTabla",
				"DivDeCarga":"LoadBar",
				"TextoDeDivDeCarga":"Mandando Filas",
				"Parametros":\` + Parametros + \`,
				"MaximizeBox":"true",
				"MaximizeElement":"MaximizeBox",
				"TextoCheckbox":"Aceptando Piezas Banco Macro",
				"Paginador":"Paginador",
				"Pagina":\` + pagina + \`,
				"Ajax":"Banco/Ajax.php"
			}\`);
			TablaCheckBoxToAjaxLoading(Config);
		}else{
		}
	}
`;




var ScriptEntregadoEnSucursalPiezasPorHDR =`
	//ChangeValue("HDR","BoltTextHDR",1,"Seleccione HDR");
	var Config = JSON.parse(\`
	{
		"ElementId":"HDR",
		"ElementTexto":"BoltTextHDR",
		"Value":"1",
		"TextoInicial":"Seleccione HDR"
	}\`);
	//ChangeValue("Rendicion","BoltTextRendicion",1,"Seleccione N° De Rendicion");
	ChangeValue(Config);
	AjaxArraidToSelectSync("Cartero","Banco/AjaxGetCarteos.php",false);
	
	var Config = JSON.parse(\`
	{
		"Reactivo":"Cartero",
		"Reactor":"HDR",
		"TextoReactor":"BoltTextHDR",
		"TextoFail":"Seleccione Uno",
		"TextoSusses":"",
		"TextoInicial":"",
		"Ajax":"Banco/AjaxGetHDRByCartero.php"
	}\`);
	ChangeCompleteSelect(Config);
	/*
	Elementos=["HDR"];
	ElementosTextos=["BoltTextHDR"];
	var Config = JSON.parse('{"MaximizeBox":true,"MaximizeElement":"MaximizeBox","TextoCheckbox":"Pieza Reclamada Por El Cliente"}');
	ChangeCompleteTableCheckbox("HDR","Banco/AjaxGetPiezasByHDR.php","PiezasDeHDR","MainTabla",Config);//post (id) ElementId(select) Ajax(Ajax.php) Hijo(id De Tabla A Crear) Padre(id del div)
	*/
	var pagina = 0;
	var Config = JSON.parse(\`
	{
		"Reactivo":"HDR",
		"HijoDeReactivo":"PiezasDeHDR",
		"Reactor":"MainTabla",
		"MaximoDeFilas":5000,
		"hidden":false,
		"shortT":false,
		"CheckBox":true,
		"MaximizeBox":true,
		"MaximizeElement":"MaximizeBox",
		"TextoCheckbox":"Entregado En Sucursal",
		"Paginador":"DivPaginador",
		"Pagina":"\` + pagina + \`",
		
		"Ajax":"Banco/AjaxGetPiezasByHDR.php"
	}\`);
	ChangeCompleteTableCheckbox(Config);
	
	function Buscar(){
		if( Needed("Cartero",1) && Needed("HDR",1)){
			var pagina = 0;
			filtro=["UserId","Fecha"];
			filtroX=[0,"2019-01-01"];
			var Parametros = ArraidNameValueToJSON(filtro,filtroX);
			if(Parametros == undefined){return;}
			
			var Config = JSON.parse(\`
			{
				"Reactivo":null,
				"HijoDeReactivo":"NombreDeTabla",
				"Reactor":"MainTabla",
				"DivDeCarga":"LoadBar",
				"TextoDeDivDeCarga":"Mandando Filas",
				"Parametros":\` + Parametros + \`,
				"MaximizeBox":"true",
				"MaximizeElement":"MaximizeBox",
				"TextoCheckbox":"Aceptando Piezas Banco Macro",
				"Paginador":"Paginador",
				"Pagina":\` + pagina + \`,
				"Ajax":"Banco/AjaxSetEntregadoSOL.php"
			}\`);
			TablaCheckBoxToAjaxLoading(Config);
		}
	}
`;
	

var ScriptSolicitadaPorClientePiezasPorHDR =`
	AjaxArraidToSelectSync("Cartero","Banco/AjaxGetCarteos.php",false);
	var Config = JSON.parse(\`
	{
		"Reactivo":"Cartero",
		"Reactor":"HDR",
		"TextoReactor":"BoltTextCartero",
		"TextoFail":"Seleccione Uno",
		"TextoSusses":"",
		"TextoInicial":"",
		"Ajax":"Banco/AjaxGetHDRByCartero.php"
	}\`);
	ChangeCompleteSelect(Config);
	var pagina = 0;
	var Config = JSON.parse(\`
	{
		"Reactivo":"HDR",
		"HijoDeReactivo":"PiezasDeHDR",
		"Reactor":"MainTabla",
		"MaximoDeFilas":5000,
		"hidden":false,
		"shortT":false,
		"CheckBox":true,
		"MaximizeBox":true,
		"MaximizeElement":"MaximizeBox",
		"TextoCheckbox":"Pieza Reclamada Por El Cliente",
		"Paginador":"DivPaginador",
		"Pagina":"\` + pagina + \`",
		
		"Ajax":"Banco/AjaxGetPiezasByHDR.php"
	}\`);
	
	ChangeCompleteTableCheckbox(Config);
	
	function Buscar(){
		
		if( Needed("Cartero",1) && Needed("HDR",1)){
			var pagina = 0;
			filtro=["UserId","Fecha"];
			filtroX=[0,"2019-01-01"];
			var Parametros = ArraidNameValueToJSON(filtro,filtroX);
			if(Parametros == undefined){return;}
			
			var Config = JSON.parse(\`
			{
				"Reactivo":null,
				"HijoDeReactivo":"NombreDeTabla",
				"Reactor":"MainTabla",
				"DivDeCarga":"LoadBar",
				"TextoDeDivDeCarga":"Mandando Filas",
				"Parametros":\` + Parametros + \`,
				"MaximizeBox":"true",
				"MaximizeElement":"MaximizeBox",
				"TextoCheckbox":"Poniendo Estado Solicitado Por Cliente",
				"Paginador":"Paginador",
				"Pagina":\` + pagina + \`,
				"Ajax":"Banco/AjaxSetSOL.php"
			}\`);
			TablaCheckBoxToAjaxLoading(Config);
			/*
			var Config = JSON.parse('{"MaximizeBox":true,"MaximizeElement":"MaximizeBox","TextoCheckbox":"Pieza Reclamada Por El Cliente"}');
			TablaCheckBoxToAjaxLoading("MainTabla","Banco/AjaxSetSOL.php","LoadBar","Aceptando Piezas Banco Macro",Config);
			*/
		}
	}
`;

var ScriptEstadosDePiezasPorHDR =`
	AjaxArraidToSelect("Afinidad","AjaxEstadosDeOtrosClientes/AjaxGetAfinidad.php",false);
	jQuery(document).ready(function() {
		var Config = JSON.parse(\`
		{
			"Elemento":"Recibio",
			"ElementoTexto":"BoltTextRecibio",
			"DigitosMinimos":"1",
			"TextoInicial":"Ponga Apellido Y Nombre De Quien Recibio",
			"TextoMenor":"1 Digitos Minimos"
		}\`);
		Texto(Config);
		Config = JSON.parse(\`
		{
			"Elemento":"Documento",
			"ElementoTexto":"BoltTexDocumento",
			"DigitosMinimos":"8",
			"TextoInicial":"Ponga Documento",
			"TextoMenor":"8 Digitos Minimos"
		}\`);
		Texto(Config);
	});
	AjaxArraidToSelectSync("Cartero","AjaxEstadosDeOtrosClientes/AjaxGetCarteos.php",false);
	AjaxArraidToSelectSync("Estado","AjaxEstadosDeOtrosClientes/AjaxGetEstados.php",false);
	var Config = JSON.parse(\`
	{
		"Reactivo":"Cartero",
		"Reactor":"HDR",
		"TextoReactor":"BoltTextCartero",
		"TextoFail":"Seleccione Uno",
		"TextoSusses":"",
		"TextoInicial":"",
		"Ajax":"AjaxEstadosDeOtrosClientes/AjaxGetHDRByCartero.php"
	}\`);
	ChangeCompleteSelect(Config);
	var pagina = 0;
	var Config = JSON.parse(\`
	{
		"Reactivo":"HDR",
		"HijoDeReactivo":"PiezasDeHDR",
		"Reactor":"MainTabla",
		"MaximoDeFilas":5000,
		"hidden":false,
		"shortT":false,
		"CheckBox":true,
		"MaximizeBox":true,
		"MaximizeElement":"MaximizeBox",
		"TextoCheckbox":"Poner Estado",
		"Paginador":"DivPaginador",
		"Pagina":"\` + pagina + \`",
		
		"Ajax":"AjaxEstadosDeOtrosClientes/AjaxGetPiezasByHDR.php"
	}\`);
	ChangeCompleteTableCheckbox(Config);
	
	function Buscar(){
		if( Needed("Cartero",1) && Needed("HDR",1) && Needed("Estado",1)){
			if(document.getElementById("Estado").value == 8){
				if( Needed("Afinidad",1) && Needed("Recibio",1) && Needed("Documento",8)){
					
				}else{
					EndLoading();
					return;
				}
				
			}
			var pagina = 0;
			var EstadoSeleccionado = document.getElementById("Estado").value;
			var ValorAfinidad = document.getElementById("Afinidad").value;
			var ValorRecibio = document.getElementById("Recibio").value;
			var ValorDocumento = document.getElementById("Documento").value;
			filtro=["UserId","Fecha","Estado","Afinidad","Recibio","Documento"];
			filtroX=[0,"2019-01-01",EstadoSeleccionado,ValorAfinidad,ValorRecibio,ValorDocumento];
			var Parametros = ArraidNameValueToJSON(filtro,filtroX);
			if(Parametros == undefined){return;}
			
			var Config = JSON.parse(\`
			{
				"Reactivo":null,
				"HijoDeReactivo":"NombreDeTabla",
				"Reactor":"MainTabla",
				"DivDeCarga":"LoadBar",
				"TextoDeDivDeCarga":"Mandando Filas",
				"Parametros":\` + Parametros + \`,
				"MaximizeBox":"true",
				"MaximizeElement":"MaximizeBox",
				"TextoCheckbox":"Poniendo Estado Solicitado Por Cliente",
				"Paginador":"Paginador",
				"Pagina":\` + pagina + \`,
				"Ajax":"AjaxEstadosDeOtrosClientes/AjaxHDRCarteroEstadosForzados.php"
			}\`);
			TablaCheckBoxToAjaxLoading(Config);
			/*
			var EstadoSeleccionado = document.getElementById("Estado").value;
			var Parametros = '"Parametros":[{"Estado":"' + EstadoSeleccionado + '"}]';
			var Config = JSON.parse('{"MaximizeBox":true,"MaximizeElement":"MaximizeBox","TextoCheckbox":"Pieza Reclamada Por El Cliente",' + Parametros + '}');
			//GlobalConfig = Config;
			TablaCheckBoxToAjaxLoading("MainTabla","Banco/HDRCarteroEstadosForzados.php","LoadBar","Aceptando Piezas Banco Macro",Config);
			*/
		}else{
				EndLoading();
				return;
		}
	}
`;
