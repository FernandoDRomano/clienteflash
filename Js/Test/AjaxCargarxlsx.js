function SubirPiezas(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Cliente"];
	var Objetos = ["Cliente"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	//console.log(Parametros);
	//console.log(ValoresDirectos);
	
	//alert("DescargarXLSXUnificados");
	/*
	if(CagarDataXLSXAJson(DivContenedor)){
		for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
			CargaDeXLSX(DivContenedor.JsonData[i],DivContenedor.JsonData.length,i,URLJS + "XMLHttpRequest/BaseDeControlPostal/AjaxBaseDeControlPostal.php");
		}
		EndLoading();
	}
	*/
	//JsonAFicheroUnificado(DivContenedor);
	//console.log(DivContenedor.JsonData);
	
}
