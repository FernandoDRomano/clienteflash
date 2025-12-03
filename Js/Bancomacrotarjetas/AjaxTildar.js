filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
var Config = JSON.parse(`
{
	"SelectId":"IdOBarcode",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxIdBarcode.php"
}`);
SelectDesdeConsulta(Config);

filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
var Config = JSON.parse(`
{
	"SelectId":"IdOBarcodeSuba",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxIdBarcode.php"
}`);
SelectDesdeConsulta(Config);

$(document).ready(function() {
});

function SubaPiezasTildadas(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["IdOBarcode"];
	var Objetos = ["IdOBarcodeSuba"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxSubaPiezasTildadasBancoMacro.php"
	}`);
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);//JsonElementosAJsonValores FlameBase
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));//jsonConcat FlameBase
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));//jsonConcat FlameBase
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}
	if(CagarDataXLSXAJson(DivContenedor)){
		if(DivContenedor.JsonData.length > 500){
			PostDataSend(DivContenedor,PostData,Config.Ajax);
		}else{
			for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
				PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);
				CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Config.Ajax);
			}
			EndLoading();
		}
	}
	
}

function TildarPiezas(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["IdOBarcode"];
	var Objetos = ["IdOBarcode"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxTildarPiezasBancoMacro.php"
	}`);
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);//JsonElementosAJsonValores FlameBase
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));//jsonConcat FlameBase
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));//jsonConcat FlameBase
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}
	if(CagarDataXLSXAJson(DivContenedor)){
		if(DivContenedor.JsonData.length > 500){
			PostDataSend(DivContenedor,PostData,Config.Ajax);
		}else{
			for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
				PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);
				CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Config.Ajax);
			}
			EndLoading();
		}
	}
	
}
	
	
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


async function PostDataSend(DivContenedor,PostData,Ajax) {
	for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
		if(CountLoading>500){await sleep(30000);}
		
		PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);//jsonConcat FlameBase
		//console.log(PostData);
		CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Ajax);
	}
	EndLoading();
}

