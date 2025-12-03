	<?php
		$Objeto = json_encode($_REQUEST);
		$Post = json_decode($Objeto, false);
		$InicioDeAnio = "InicioDeAnio";
		$Fecha = "Fecha";
		use Config\Elementos as Elementos;
		
	?>


	<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">

	<script>
		
	</script>
	<style>
		#ModalDatos ::-webkit-scrollbar {
		width: 16px;
		}
		#ModalDatos ::-webkit-scrollbar-track {
		background: #00F0F0; 
		}
		#ModalDatos ::-webkit-scrollbar-thumb {
		background: #00B0B0;
		}
		#ModalDatos ::-webkit-scrollbar-thumb:hover {
		background: #00A0A0; 
		}
		.form-control:focus {
			box-sizing: border-box;
			box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25) !important;
		}
		.card-header {
			color: #fff;
			background-color: #292d57;
			border-bottom: 1px solid #292d57;
			padding: .75rem 1.25rem;
		}
	</style>

	<style>
		ul.pagination li a.active{
			background: #CDDC39;
		}
		#ParaTabla{
			overflow-x: scroll !important;
			margin: 0 auto;
			white-space: nowrap;
		}
	</style>

	<style>
		.btn-secondary {
			color: #fff !important;
			background-color: #6c757d;
			border-color: #6c757d;
		}
	</style>

	<style>
		.control-label.Active{
			background: none;
		}
		#TablaDeResultados{
			display: contents;
		}
		#TableroDeGestiones{
			//zoom: 70%;
		}
	</style>

	<?php
		//Titulo
		Elementos::CrearDesplegableConTitulo("Buscar access-token","1");
		Elementos::CrearImput("ApiKey","ApiKey","ApiKey:","6","value='bacfdf03ce9dea8a108f601aa8a27289'");
		Elementos::CrearImput("SecretKey","SecretKey","SecretKey:","6","value='4836df3b972892c22ea9034c96116772'");
		echo('<hr class="size2 hideline">');
		Elementos::CrearBoton("SacarAccessToquen();","12","Buscar Access Toquen","");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("AccessToken","AccessToken","AccessToken:","12","value='' readonly");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		Elementos::CrearDesplegableConTitulo("Buscar Pieza","2");
		Elementos::CrearImput("Pieza","Pieza","Pieza:","12","value='cf004517646620406007'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("BuscarPieza();","12","Buscar Pieza","");
		echo('<hr class="size2 hideline">');
		Elementos::CrearImput("Estado","Estado","Estado:","6","value='' readonly");
		Elementos::CrearImputDeFecha("datetimepicker1","FechaDeEstado","Fecha De Estado","6","readonly");
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		?>
		<!--
		<div class="" style="display: -ms-flexbox;display: flex;">
			<span class="input-group-text" style="display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;padding: 0.375rem 0.75rem;margin-bottom: 0;font-size: 0.875rem;font-weight: 400;line-height: 1.5;color: #555;text-align: center;white-space: nowrap;background-color: #f0f0f0;border: 1px solid #ced4da;">cm
			</span>
			<input type="number" id="tancho[]" name="tancho[]" onfocus="this.select();" onchange="calc_tm3();" class="form-control" placeholder="Ancho" min="0" max="5000" step=".10" oninput="validity.valid||(value='');" style="" required="">
		</div>
		-->
		<?php
		
		Elementos::CrearDesplegableConTitulo("Crear Pedido De Pieza","3");
		Elementos::StartHide("");
		//	Elementos::CrearImput("sucursal_origen","sucursal_origen","sucursal_origen:","3","value='4'");
		//	Elementos::CrearImput("sucursal_destino","Sucursal Destino","Sucursal Destino:","3","value='4'");
			Elementos::CrearImput("codigo_externo","Codigo Externo","Codigo Externo:","12","value='9'");
		//	Elementos::CrearImput("descripcion_paquete","Descripcion Paquete","Descripcion Paquete:","3","value='9'");
		//	Elementos::CrearImput("dimensiones","Dimensiones","Dimensiones:","3","value='9'");
		//	Elementos::CrearImput("peso","Peso","Peso:","3","value='9'");
		//	Elementos::CrearImput("bultos","Bultos","Bultos:","3","value='1'");
		//	Elementos::CrearImput("dias_entrega","Dias Entrega","Dias Entrega:","3","value='9'");
		Elementos::EndHide();
		
		Elementos::CrearImput("nombres","Nombres","Nombres:","3","value='Ruben TEST'");
		Elementos::CrearImput("apellidos","Apellidos","Apellidos:","3","value='Farias Test'");
		Elementos::CrearImput("tipo_documento","Tipo DE Documento","Tipo DE Documento:","3","value='DNI'");
		Elementos::CrearImput("documento","Documento","Documento:","3","value='32601828'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("codigo_postal","Codigo Postal","Codigo Postal:","4","value='4000'");
		Elementos::CrearImput("provincia","Provincia","Provincia:","4","value='Tucuman'");
		Elementos::CrearImput("localidad_ciudad","Localidad","Localidad:","4","value='San Miguel De Tucuman'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("calle","Calle","Calle:","3","value='Combate De Las Piedras'");
		Elementos::CrearImput("numero","Numero","Numero:","3","value='1284'");
		Elementos::CrearImput("piso","Piso","Piso:","3","value='9'");
		Elementos::CrearImput("depto","Depto","Depto:","3","value='9'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("telefono","Telefono","Telefono:","6","value='381000000000'");
		Elementos::CrearImput("mail","Mail","Mail:","6","value='correflash2017@gmail.com'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("referencia_domicilio","Referencia Domicilio","Referencia Domicilio:","12","value='9'");
		Elementos::CrearImput("servicio_id","Id De Servicio","Id De Servicio:","12","value='33'");
		
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("InsertarPieza();","12","Insertar Pieza","");
		//Botones
		echo('<hr class="size1 hideline">');
		
		Elementos::CrearImput("ClienteId","Cliente Numero","Cliente Numero:","3","value='' readonly");
		Elementos::CrearImput("DepartamentoId","Cliente Numero De Departamento","Cliente Numero De Departamento:","3","value=''readonly");
		Elementos::CrearImput("ComprobanteDeIngreso","Comprobante De Ingreso","Comprobante De Ingreso:","3","value='' readonly");
		Elementos::CrearImput("ComprobanteDeIngresoIngresado","Comprobante De Ingreso Ingresado","Comprobante De Ingreso Ingresado:","3","value='' readonly");
		Elementos::CrearImput("ComprobantesIngresosServicios","Comprobantes Ingresos Servicios","Comprobantes Ingresos Servicios:","3","value='' readonly");
		
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("PiezaId","id","id:","4","value=''readonly");
		Elementos::CrearTabladashboard("PiezaId",4,"Pieza Id","",false,100,"display: none", "display: none",false);
		Elementos::CrearImput("PiezaBarcode","barcode","barcode:","4","value=''readonly");
		
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		/*
		//Tablero
		Elementos::Creardashboard("","PiezasEnBase","Piezas En Base Sispo","6","Uncolor","SizablePiezasEnBase");
		Elementos::Creardashboard("","PiezasEnBaseDeBanco","Piezas En Base BancoMacro","6","Uncolor","SizablePiezasEnBaseDeBanco");
		echo('<hr class="size1 hideline">');
		//Tablas De Tableros
		Elementos::CrearTabladashboard("PiezasEnBase","3","Piezas En Base Sispo");
		Elementos::CrearTabladashboard("PiezasEnBaseDeBanco","3","Piezas En Base BancoMacro");
		*/
	?>







