<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	use Config\Elementos as Elementos;
	
?>

<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
<style>
	.tituloFormulario{
		font-size: 12px;
	}
	.control-label{
		font-size: 12px;
	}
</style>
<?php
	//Titulo
	
	Elementos::CrearDesplegableConTitulo("Panel De Verificacion De Piezas","1");
		Elementos::CrearIniRow("9");
			Elementos::CrearLeftTitulo("Identificadores De Piezas");
			Elementos::CrearImput("Tarjeta","text","Numero De Tarjeta:","6",false,true,false);
			Elementos::CrearImput("IdSispo","text","Id Sispo:","6",false,true,false);
			Elementos::CrearImput("HojaDeRuta","text","Hoja De Ruta:","6",false,true,false);
			Elementos::CrearImput("ComprobanteDeIngreso","text","Comprobante De Ingreso:","6",false,true,false);
			Elementos::CrearSelectt2("Servicio","Servicio","12");
			echo('<hr class="size2 hideline">');
			
			Elementos::CrearLeftTitulo("Estado De Las Piezas");
			Elementos::CrearImput("UltimoEstado","text","Ultimo Estado:","12",false,true,false);
			Elementos::CrearImputDeFecha("datetimepicker1","FechaInicialDeUltimoEstado","Fecha Inicial De Ultimo Estado","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaFinalDeUltimoEstado","Fecha Final De Ultimo Estado","6");
			echo('<hr class="size1 hideline">');
			
			Elementos::CrearImputDeFecha("datetimepicker1","FechaInicialDeCargaLogica","Fecha Inicial De Fecha De Carga Logica","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaFinalDeCargaLogica","Fecha Final De Fecha De Carga Logica","6");
			echo('<hr class="size2 hideline">');
			
			Elementos::CrearImputDeFecha("datetimepicker1","FechaInicialDeCargaFisica","Fecha Inicial De Fecha De Carga Fisica","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaFinalDeCargaFisica","Fecha Final De Fecha De Carga Fisica","6");
			echo('<hr class="size2 hideline">');
			
			Elementos::CrearLeftTitulo("Datos De Destino De Piezas");
			Elementos::CrearImput("Destinatario","text","Destinatario:","6",false,true,false);
			Elementos::CrearImput("Documento","text","Documento:","6",false,true,false);
			echo('<hr class="size1 hideline">');
			
			Elementos::CrearSelectt2("Sucursal","Sucursal","12");
			echo('<hr class="size1 hideline">');
			
			Elementos::CrearImput("Localidad","text","Localidad:","6",false,true,false);
			Elementos::CrearImput("CodigoPostal","text","Codigo Postal:","6",false,true,false);
			Elementos::CrearImput("Calle","text","Calle:","6",false,true,false);
			echo('<hr class="size1 hideline">');
		Elementos::CrearFinRow();
		
		Elementos::CrearIniRow("3");
			Elementos::CrearLeftTitulo("Identificadores De Tipo De Pieza");
			Elementos::CrearSelectt2("Tipo","Tipo","12");
			echo('<hr class="size1 hideline">');
			Elementos::CrearSelectt2("Marca","Marca","12");
			echo('<hr class="size1 hideline">');
			Elementos::CrearSelectt2("Destino","Destino","12");
			echo('<hr class="size1 hideline">');
			Elementos::CrearSelectt2("Grupo","Grupo","12");
			echo('<hr class="size1 hideline">');
		Elementos::CrearFinRow();
		
		echo('<hr class="size2 hideline">');
		
		Elementos::CrearIniRow("12");
			Elementos::CrearLeftTitulo("Filtrar Los Datos Sin Estado En Las Bases De Datos");
			Elementos::CrearIniRow("4");
				Elementos::CrearLeftTitulo("sispoc5_Banco");
				$CheckArray= array(
				"Logico"
				,"Fisico"
				,"Final Entregado"
				,"Final No Se Pudo Entregar"
				,"Final En Gestion"
				);
				Elementos::CrearFormularioCheck("TipoDeFiltrosispoc5_Banco","12","Filtrar Por","Indique Un Filtro Para Buscar","ClasseDelRadioGroup",$CheckArray,false);
				echo('<hr class="size1 hideline">');
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("4");
				Elementos::CrearLeftTitulo("sispoc5_consultasweb");
				$CheckArray= array(
				"Logico"
				,"Fisico"
				,"Final Entregado"
				,"Final No Se Pudo Entregar"
				,"Final En Gestion"
				);
				Elementos::CrearFormularioCheck("TipoDeFiltrosispoc5_consultasweb","12","Filtrar Por","Indique Un Filtro Para Buscar","ClasseDelRadioGroup",$CheckArray,false);
				echo('<hr class="size1 hideline">');
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("4");
				Elementos::CrearLeftTitulo("sispoc5_gestionpostal");
				$CheckArray= array(
				"Ingreso"
				,"Final Entregado"
				,"Final No Se Pudo Entregar"
				,"Final En Gestion"
				);
				Elementos::CrearFormularioCheck("TipoDeFiltrosispoc5_gestionpostal","12","Filtrar Por","Indique Un Filtro Para Buscar","ClasseDelRadioGroup",$CheckArray,false);
				echo('<hr class="size1 hideline">');
			Elementos::CrearFinRow();
		Elementos::CrearFinRow();
		
		Elementos::CrearIniRow("12");
			Elementos::CrearBoton("BuscarTarjetasEnBaseDeDatos();","6","Buscar","");//Para Banco Macro
			echo('<hr class="size1 hideline">');
			Elementos::Creardashboard("","ResultadosDeBusqueda","Piezas Debito","6","Uncolor","SizableResultadosDeBusqueda");
			Elementos::CrearTabladashboard("ResultadosDeBusqueda","3","Resultados De Busqueda");
		Elementos::CrearFinRow();
		
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
?>
</div>







