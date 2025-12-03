function MandarEstado(){
	if(! Needed("EstadoPieza","1")){return;}
	if(! Needed("MotivoPieza","1")){return;}
	if(! Needed("FechaEstadoPieza","1")){return;}
	if(! Needed("DatoPieza","1")){return;}
	if(! Needed("HDR","1")){return;}
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["EstadoPieza","MotivoPieza","FechaEstadoPieza","DatoPieza","HDR","URL","Metodo"];
	var Objetos = ["EstadoPieza","MotivoPieza","FechaEstadoPieza","DatoPieza","HDR","URL","Metodo"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"Elemento":"Respuesta",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxConsultasWebsEstados.php"
	}`);
	ValorDesdeConsulta(Config);
}

function MandarPiezaYEstado(){
	//if(! Needed("EstadoPieza","1")){return;}
	if(! Needed("MotivoPieza","1")){return;}
	if(! Needed("FechaEstadoPieza","1")){return;}
	if(! Needed("DatoPieza","1")){return;}
	if(! Needed("HDR","1")){return;}
	
	if(! Needed("ApellidoYNombre","1")){return;}
	if(! Needed("Apellido","1")){return;}
	if(! Needed("Nombre","1")){return;}
	if(! Needed("DNI","1")){return;}
	if(! Needed("Domicilio","1")){return;}
	if(! Needed("Ciudad","1")){return;}
	if(! Needed("Provincia","1")){return;}
	if(! Needed("SucursalRadicacion","1")){return;}
	if(! Needed("sucursale_id","1")){return;}
	if(! Needed("DomicilioSucursal","1")){return;}
	if(! Needed("TipoTarjeta","1")){return;}
	if(! Needed("MarcaTarjeta","1")){return;}
	if(! Needed("NumPiezaBanco","1")){return;}
	if(! Needed("NumPiezaCorreo","1")){return;}
	if(! Needed("DatoBanco","1")){return;}
	if(! Needed("EstadoDefinitivo","1")){return;}
	//if(! Needed("flash_sucursal_id","1")){return;}
	//if(! Needed("flash_servicio_id","1")){return;}
	//if(! Needed("rescatada_at","1")){return;}
	//if(! Needed("rescatada_user_id","1")){return;}
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["EstadoPieza","MotivoPieza","FechaEstadoPieza","DatoPieza","HDR",
	"ApellidoYNombre","Apellido","Nombre","DNI","Domicilio",
	"Ciudad","Provincia","SucursalRadicacion","sucursale_id","DomicilioSucursal",
	"TipoTarjeta","MarcaTarjeta","NumPiezaBanco","NumPiezaCorreo","DatoBanco",
	"EstadoDefinitivo","URL","Metodo"];
	var Objetos = ["EstadoPieza","MotivoPieza","FechaEstadoPieza","DatoPieza","HDR",
	"ApellidoYNombre","Apellido","Nombre","DNI","Domicilio",
	"Ciudad","Provincia","SucursalRadicacion","sucursale_id","DomicilioSucursal",
	"TipoTarjeta","MarcaTarjeta","NumPiezaBanco","NumPiezaCorreo","DatoBanco",
	"EstadoDefinitivo","URL","Metodo"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"Elemento":"Respuesta",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxConsultasWebsPiezas.php"
	}`);
	ValorDesdeConsulta(Config);
}

