
	
	
function BuscarTarjetasEnBaseDeDatos(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	//console.log(Parametros);
	var Indices=[
		"Tarjeta","IdSispo","HojaDeRuta","ComprobanteDeIngreso","Servicio"
		,"UltimoEstado","FechaInicialDeUltimoEstado","FechaFinalDeUltimoEstado","FechaInicialDeCargaLogica","FechaFinalDeCargaLogica"
		,"FechaInicialDeCargaFisica","FechaFinalDeCargaFisica","Destinatario","Documento","Sucursal"
		,"Localidad","CodigoPostal","Calle","Tipo","Marca"
		,"Destino","Grupo"
		,"TipoDeFiltrosispoc5_Banco","TipoDeFiltrosispoc5_consultasweb","TipoDeFiltrosispoc5_gestionpostal"
	];
	var Objetos = [
		"Tarjeta","IdSispo","HojaDeRuta","ComprobanteDeIngreso","Servicio"
		,"UltimoEstado","FechaInicialDeUltimoEstado","FechaFinalDeUltimoEstado","FechaInicialDeCargaLogica","FechaFinalDeCargaLogica"
		,"FechaInicialDeCargaFisica","FechaFinalDeCargaFisica","Destinatario","Documento","Sucursal"
		,"Localidad","CodigoPostal","Calle","Tipo","Marca"
		,"Destino","Grupo"
		,"TipoDeFiltrosispoc5_Banco","TipoDeFiltrosispoc5_consultasweb","TipoDeFiltrosispoc5_gestionpostal"
	];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"Elemento":"DivResultadosDeBusqueda",
		"ElementoTexto":"",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":true,
		"TextoEnFail":"",
		"CrearAlCargarDatos":true,
		"Reload":false,
		"Ajax":"` + Boveda + `/public/api/VerificacionDePiezas"
	}`);
	//"Elemento":"DivResApi",
	ElementoDesdeApi(Config); 
	
}

