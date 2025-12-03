


function SacarAccessToquen(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto

	var Indices=["ApiKey","SecretKey"];
	var Objetos = ["ApiKey","SecretKey"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"Elemento":"AccessToken",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxApicliente.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
}

function BuscarPieza(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["AccessToken","Pieza"];
	var Objetos = ["AccessToken","Pieza"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Elementos=["Estado","FechaDeEstado"];
	Elementos = JSON.stringify(Elementos);
	
	var Config = JSON.parse(`
	{
		"Elemento":"Estado",
		"Elementos":` + Elementos + `,
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxApiclienteBuscarPieza.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValoresAElementos(Config);
	//ValorDesdeConsulta(Config);
}


function InsertarPieza(){
	filtro=["UserId","User","time"];
	filtroX=[UserId,UserId,"0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=[
	"ApiKey","SecretKey","AccessToken","servicio_id"
	//,"sucursal_origen","sucursal_destino","descripcion_paquete","dimensiones","peso","bultos","dias_entrega"
	];
	var Objetos = [
	"ApiKey","SecretKey","AccessToken","servicio_id"
	//,"sucursal_origen","sucursal_destino","descripcion_paquete","dimensiones","peso","bultos","dias_entrega"
	];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Elementos=["ClienteId","DepartamentoId","ComprobanteDeIngreso","ComprobanteDeIngresoIngresado","ComprobantesIngresosServicios","TablaPiezaId","PiezaBarcode"];
	
	var ArraydJsonPostTitulo = "Piezas";
	var Indices=[
	"codigo_externo"
	,"nombres","apellidos","tipo_documento","documento"
	,"codigo_postal","provincia","localidad_ciudad","calle","numero","piso","depto"
	,"telefono","mail","referencia_domicilio"
	];
	var Objetos = [
	"codigo_externo"
	,"nombres","apellidos","tipo_documento","documento"
	,"codigo_postal","provincia","localidad_ciudad","calle","numero","piso","depto"
	,"telefono","mail","referencia_domicilio"
	];
	var ArraydJsonPost = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	
	
	Elementos = JSON.stringify(Elementos);
	
	var Config = JSON.parse(`
	{
		"Elemento":"Estado",
		"ArraydJsonPostTitulo":"` + ArraydJsonPostTitulo + `",
		"ArraydJsonPost":` + ArraydJsonPost + `,
		
		"Elementos":` + Elementos + `,
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxApiclienteCrearPieza.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValoresAElementos(Config);
	//ValorDesdeConsulta(Config);
}









