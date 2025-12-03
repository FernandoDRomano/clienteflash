<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	use Config\Elementos as Elementos;
	
?>

<style>
	.control-label.Active{
		background: none;
	}
	#TablaDeResultados{
		display: contents;
	}
	.CajaDeGrupos{
		border: 1px solid rgba(0, 0, 0, .2);
	}
	#TableroDeGestiones{
		//zoom: 70%;
	}
</style>

<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
<div id="ConsultaSinRetorno" class="number" hidden></div>

<div >
	<div class="col-md-12 CajaDeGrupos" style="background: aliceblue;">
		<?php
			//Titulo
			Elementos::CrearLeftTitulo("Generacion De Codigos De Barra");
			//Elementos Para Consulta
		?>
		<div class="col-md-12" >
			<svg id="barcode" style="display: contents;"></svg> <!--  style="width: 90%;" -->
		</div>
		<?php
			Elementos::StartHide("Oculto");
			Elementos::CrearImput("NombreBarcodeDesde","text","Codigo De Barra Desde:","4",'value="1000000"');
			Elementos::CrearImput("NombreBarcodeHasta","text","Codigo De Barra Hasta:","4",'value="1000000"');
			Elementos::CrearImput("CantidadBarcode","number","Cantidad De Repeticiones De Codigos De Barra:","6",'value="1"');
			Elementos::EndHide("Oculto");
			
			Elementos::CrearImput("CantidadDeCodigosDeBarra","number","Cantidad De Codigos De Barra","3",'min="0" step="1" value="1"');
			echo('<hr class="size1 hideline">');
			//Elementos::CrearImput("Margen","number","Margen Entre Codigos De Barra:","4",'min="0" step="1" value="130"');
			
			Elementos::StartHide("Oculto");
			Elementos::CrearImput("Ancho","number","Ancho De Codigos De Barra,Solo Para Vista:","3",'min="0" step="1" value="130"');
			Elementos::CrearImput("Alto","number","Alto De Codigos De Barra,Solo Para Vista:","3",'min="0" step="1" value="100"');
			
			Elementos::CrearImput("PapelXmm","number","Ancho De Papel En MiliMetros","3",'min="0" step="1" value="40"');
			Elementos::CrearImput("PapelYmm","number","Alto De Papel En MiliMetros","3",'min="0" step="1" value="20"');
			Elementos::EndHide("Oculto");
			
			Elementos::CrearBoton("CrearBarcodes();","4","Crear Barcodes","<br>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearBoton("DescargarPDFDeCodigosDeBarra();","4","Descargar PDF","<br>");
			Elementos::CrearBoton("CodigosDeBarraAStock();","4","Poner Piezas En Stock","<br>");
			Elementos::CrearBoton("LimpiarPantalla();","4","Limpiar Pantalla","<br>");
			//Elementos::CrearBoton("SetMargen();","4","Poner Margen","");
			//Elementos::CrearBoton("printdiv('Print');","4","Imprimir","");
			
			
		?>
	</div>
	<div class="col-md-12 CajaDeGrupos" style="background: aliceblue;width: min-content;">
		<div id="Print" type="application/pdf">
			<div id="LinkBotonCodigoDeBarra" >
			</div>
		</div>
	</div>
</div>










