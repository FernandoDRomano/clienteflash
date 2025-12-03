<?php
	$RespuestaJsonAjax = array('');
	
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		//ob_end_clean();
		//echo($RespuestaJsonAjax[0]);
		$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;//'1' => array('fullName' => 'Test 2', 'fullAdress' => 'Paris'),
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		if(isset ($_GET['callback'])){
			//header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($RespuestaJsonAjax).")";
		}
		exit;
	}
	
	require('../FuncionesGenerales.php');
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	require('../FuncionesHorarias.php');
	$horaPasada = date("Y-m-d H:i:s", strtotime('2020-02-25 00:00:00'));
	$HoraBusqueda = date('Y-m-d H:i:s', strtotime($horaPasada. $DiferenciaHoraria));
	
	$Barra = issetornull('Barra');
	$BarraDeBaseSinId = $Barra;
	$IdOBarcode = issetornull('IdOBarcode');
	if($IdOBarcode == '0'){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El IDentificador De La Pieza Es Incorrecto:",$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	$ColumnaSispo;
	if($IdOBarcode == 'Id'){
		$ColumnaSispo = 'id';
	}
	if($IdOBarcode == 'Barcode'){
		$ColumnaSispo = 'barcode_externo';
	}
	
	$DiferenciaHoraria = dateDifference($HoraSQL,$HoraFinal," + '%h:%I' HOUR_MINUTE");
	
	$Columnas = array("id","Tarjeta");
	$Consulta= "
		SELECT TD.id as 'id', TD.Tarjeta  as 'Tarjeta'
		FROM sispoc5_Banco.tarjetasDeDebito as TD 
		WHERE TD.Tarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				INSERT INTO sispoc5_Banco.tarjetasDeDebito
				(
					Tarjeta, Nombre, Domicilio, Localidad, CodigoPostal
					, TipoDeTarjetaEmbosado, Recibo, CodigoDeSucursal, TipoDeEmision, TipoDeProducto
					, TipoDeDocumento, NumeroDeDocumento, Secuencia, FechaDeProceso, ColorDeEmbosado
					, CodigoDeEmision, PermicionariaEnCodigoDeEmision, Grupo, MarcaCardCarrier, CodigoEnsobrado
					, DistribucionDeTarjeta, DestinoSegunCodigoDeEmision, TelefonoDeCliente, EmisionDeTarjetasDeDatosUtiles, EmisionDeTarjetasDeDebito
					, cero, Filler, FechaDeCargaSistemaFlash, LoteImpreso, MarcaSistemaFlash
				)
				SELECT 
					REPLACE('$BarraDeBaseSinId','cf',''), Nombre, Domicilio, Localidad, CodigoPostal
					, TipoDeTarjetaEmbosado, Recibo, CodigoDeSucursal, TipoDeEmision, TipoDeProducto
					, TipoDeDocumento, NumeroDeDocumento, Secuencia, FechaDeProceso, ColorDeEmbosado
					, CodigoDeEmision, PermicionariaEnCodigoDeEmision, Grupo, MarcaCardCarrier, CodigoEnsobrado
					, DistribucionDeTarjeta, 'AL CLIENT', TelefonoDeCliente, EmisionDeTarjetasDeDatosUtiles, EmisionDeTarjetasDeDebito
					, cero, Filler, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $DiferenciaHoraria ) , concat(DATE_FORMAT(CURRENT_TIMESTAMP, '%d%m%y'),'Y'), MarcaSistemaFlash
				FROM sispoc5_Banco.tarjetasDeDebito
				WHERE Tarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				LIMIT 1
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Pieza:" . $BarraDeBaseSinId,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("id","Tarjeta");
	$Consulta= "
		SELECT TI.Id as 'id', TI.NumeroDeTarjeta  as 'Tarjeta'
		FROM sispoc5_Banco.TarjetasImpresas as TI
		WHERE TI.NumeroDeTarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				INSERT INTO sispoc5_Banco.TarjetasImpresas
				(
					TipoDeRegistro, NumeroDeTarjeta, NumeroDeICA, FechaVigenciaDesde, FechaVigenciaHasta
					, CodigoLimiteDeCompra, ImporteLimiteDeCompra, ImprteLimiteDeCredito, DatoNoValidable, ApellidoYNombre
					, DatoNoValidable2, CodigoDeLaEntidad, CodigoDeLaSucursal, FechaDeAlta, CalleYAltua
					, Piso, Departamento, CodigoPostal, Localidad, CodigoProvincia
					, Empresa, GrupoDeAfinidad, NombreDeGrupoDeAfinidad, DatoNoValidable3, TipoDeProceso
					, CodigoDeDestino, CodigoDeMovimiento, Clase, Cuenta, Autorizado
					, DatoNoValidable4, DigitoVerificador, Marca, CodigoDeMarca, Pais
					, NumeroDeTargetaAnterior, Telefono, DatoNoValidable5, FechaDeCargaSistemaFlash, LoteImpreso, MarcaSistemaFlash
				)
				SELECT
					TipoDeRegistro, REPLACE('$BarraDeBaseSinId','cf',''), NumeroDeICA, FechaVigenciaDesde, FechaVigenciaHasta
					, CodigoLimiteDeCompra, ImporteLimiteDeCompra, ImprteLimiteDeCredito, DatoNoValidable, ApellidoYNombre
					, DatoNoValidable2, CodigoDeLaEntidad, CodigoDeLaSucursal, FechaDeAlta, CalleYAltua
					, Piso, Departamento, CodigoPostal, Localidad, CodigoProvincia
					, Empresa, GrupoDeAfinidad, NombreDeGrupoDeAfinidad, DatoNoValidable3, TipoDeProceso
					, CodigoDeDestino, CodigoDeMovimiento, Clase, Cuenta, Autorizado
					, DatoNoValidable4, DigitoVerificador, Marca, CodigoDeMarca, Pais
					, NumeroDeTargetaAnterior, Telefono, DatoNoValidable5, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $DiferenciaHoraria ), concat(DATE_FORMAT(CURRENT_TIMESTAMP, '%d%m%y'),'Y'), MarcaSistemaFlash
				FROM sispoc5_Banco.TarjetasImpresas
				WHERE NumeroDeTarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				LIMIT 1
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Pieza:" . $BarraDeBaseSinId,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("id","Tarjeta");
	$Consulta= "
		SELECT TG.Id as 'id', TG.SecuenciaDeTargeta  as 'Tarjeta'
		FROM sispoc5_Banco.TarjetasSinChipEMV as TG
		WHERE TG.SecuenciaDeTargeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				INSERT INTO sispoc5_Banco.TarjetasSinChipEMV
				(
					NumeroDeComprobante, CardCarrier, SecuenciaDeTargeta, NumeroDeCuenta, NumeroDeProceso
					, SucursalDeRadicacionDeLaCuenta, Categoria, TipoDeTarjeta, TipoDeOperacion, FechaHasta
					, Blancos, GrupoDeAfinidad, FechaDeAlta, FechaDeEmbozado, DenominacionDelUsuario
					, Calle, Puerta, Piso, NumeroDeDepartamento, Localidad
					, UsoReservado1, CodigoDeEntrega, Distribucion, NumeroDeSecuencia, CodigoPostal
					, Telefono, UsoReservado2, UsoReservado3, NumeroDeSolicitud, FechaDeCargaSistemaFlash
					, LoteImpreso, MarcaSistemaFlash
				)
				SELECT
					NumeroDeComprobante, CardCarrier, REPLACE('$BarraDeBaseSinId','cf',''), NumeroDeCuenta, NumeroDeProceso
					, SucursalDeRadicacionDeLaCuenta, Categoria, TipoDeTarjeta, TipoDeOperacion, FechaHasta
					, Blancos, GrupoDeAfinidad, FechaDeAlta, FechaDeEmbozado, DenominacionDelUsuario
					, Calle, Puerta, Piso, NumeroDeDepartamento, Localidad
					, UsoReservado1, CodigoDeEntrega, Distribucion, NumeroDeSecuencia, CodigoPostal
					, Telefono, UsoReservado2, UsoReservado3, NumeroDeSolicitud, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $DiferenciaHoraria )
					, concat(DATE_FORMAT(CURRENT_TIMESTAMP, '%d%m%y'),'Y'), MarcaSistemaFlash
				FROM sispoc5_Banco.TarjetasSinChipEMV
				WHERE SecuenciaDeTargeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				LIMIT 1
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Pieza:" . $BarraDeBaseSinId,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	
	
	
	if($RespuestaJsonAjax == array('')){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("",$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
?>













