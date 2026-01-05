<?php
	header("Access-Control-Allow-Origin: *");
	
	// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
	require_once __DIR__ . '/../../Config/bootstrap.php';

	use Helpers\LogManager;
	use Models\PiezaNovedad;
	use Models\PiezaTracking;

	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);

	// Instanciar LogManager
	$logger = new LogManager();
	$logger->info('Inicio de AjaxCartaDocumento', 'Procesando carta documento', [
		'request' => $_REQUEST
	]);
	
	function MSJDeErroresParaMostrar($Columna,$Valor,$Long,$Pedido){
		$logger = new LogManager();
		$logger->error('Error de validación de campo', 'El campo ' . $Columna . ' contiene ' . strlen($Valor) . ' dígitos, el máximo admitido es ' . $Long, [
			'columna' => $Columna,
			'valor' => $Valor,
			'longitud_maxima' => $Long,
			'pedido_numero' => $Pedido
		]);

	    if($Pedido>0){
        	$RespuestaJsonAjax = array('');
        	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:<p>El Campo $Columna Contiene (<b>" . strlen($Valor) . "</b> Digitos)</p><p>El Maximo Admitido Es $Long </p><p>El Data Suministrado " . $Valor . "Es Muy Largo </p>" . "<p>Verifique El Pedido Numero (<b>" .$Pedido . "</b>) Dentro Del Excel</p>", $RespuestaJsonAjax);
        	if($RespuestaJsonAjax[0] == ""){
        		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
        	}
        	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	    }else{
	        $RespuestaJsonAjax = array('');
        	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:<p>El Campo $Columna Contiene (<b>" . strlen($Valor) . "</b> Digitos)</p><p>El Maximo Admitido Es $Long </p><p>El Data Suministrado " . $Valor . "Es Muy Largo </p>", $RespuestaJsonAjax);
        	if($RespuestaJsonAjax[0] == ""){
        		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
        	}
        	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	    }
	}
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
			//Suplantado Dado Que Impide Que Arme Tabla Desde Este Formato
			//$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . "|" . $String;
		}
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		if(isset ($_GET['callback'])){
			//header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($RespuestaJsonAjax).")";
		}else{
			if(isset ($_POST['callback'])){
				echo $_POST['callback']."(".json_encode($RespuestaJsonAjax).")";
			}else{
				
			}
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
	
	$ServicioId = issetornull('servicio_id');
	$ServicioId = "4477";//4477 4050
	$User=0;
	$ClienteId = issetornull('Cliente');
	$ArraydPiezas = issetornull('Piezas');
	$Formulario = issetornull('textBox');
	
	$CantidadDePiezas = count($ArraydPiezas);
	
    $req_dump = print_r($_REQUEST, TRUE);
    $fp = fopen('request.log', 'a');
    fwrite($fp, $req_dump);
    fclose($fp);
    
	//Cansulta Para Error 1
	$IdUsuario = issetornull('IdUsuario');
	
	for($i=0;$i<count($ArraydPiezas);$i++){
	    
	    $nombres = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$apellidos = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$tipo_documento = issetornullinarrayd('Piezas',$i,'tipo_documento');
		$documento = issetornullinarrayd('Piezas',$i,'documento');
		$codigo_postal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$provincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$localidad_ciudad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$calle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$numero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$piso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$depto = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$DestinatarioNombre = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$DestinatarioApellido = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$DestinatarioCodigoPostal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$DestinatarioProvincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$DestinatarioLocalidad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$DestinatarioCalle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$DestinatarioNumero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$DestinatarioPiso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$DestinatarioDepartamento = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
		$RemitenteNombre = issetornullinarrayd('Piezas',$i,'RemitenteNombre');
		$RemitenteCodigoPostal = issetornullinarrayd('Piezas',$i,'RemitenteCodigoPostal');
		$RemitenteProvincia = issetornullinarrayd('Piezas',$i,'RemitenteProvincia');
		$RemitenteLocalidad = issetornullinarrayd('Piezas',$i,'RemitenteLocalidad');
		$RemitenteCalle = issetornullinarrayd('Piezas',$i,'RemitenteCalle');
		$RemitenteNumero = issetornullinarrayd('Piezas',$i,'RemitenteNumero');
		$RemitentePiso = issetornullinarrayd('Piezas',$i,'RemitentePiso');
		$RemitenteDepartamento = issetornullinarrayd('Piezas',$i,'RemitenteDepartamento');
		$RemitenteEmail = issetornullinarrayd('Piezas',$i,'RemitenteEmail');
		$RemitenteCelular = issetornullinarrayd('Piezas',$i,'RemitenteCelular');
		$RemitenteObservaciones = issetornullinarrayd('Piezas',$i,'RemitenteObservaciones');
		$RemitenteNombreApoderado = issetornullinarrayd('Piezas',$i,'RemitenteNombreApoderado');
		$RemitenteApellidoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteApellidoApoderado');
		$RemitenteDNITipoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDNITipoApoderado');
		$RemitenteDocumentoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDocumentoApoderado');
		$Destinatario = $apellidos . " " . $nombres;
		if($piso != "" and $depto != ""){$Domicilio = $calle . " " .  $numero . " " . $piso . " " . $depto;}
		if($piso != "" and $depto == ""){$Domicilio = $calle . " " .  $numero . " " . $piso;}
		if($piso == "" and $depto == ""){$Domicilio = $calle . " " .  $numero;}
    	
		//Pieza
		if(strlen($Destinatario)>150){
    		MSJDeErroresParaMostrar("Nombre De Destinatario",$Destinatario,150,$i);exit;
		}
		if(strlen($Domicilio)>150){
    		MSJDeErroresParaMostrar("Domicilio formado por calle numero y piso",$Domicilio,150,$i);exit;
		}
		if(strlen($codigo_postal)>150){
    		MSJDeErroresParaMostrar("Codigo Postal",$codigo_postal,150,$i);exit;
		}
		if(strlen($localidad_ciudad)>150){
    		MSJDeErroresParaMostrar("Localidad",$localidad_ciudad,150,$i);exit;
		}
		
		//Pieza_cd
		if(strlen($RemitenteCodigoPostal)>11){
    		MSJDeErroresParaMostrar("RemitenteCodigoPostal",$RemitenteCodigoPostal,11,$i);exit;
		}
		if(strlen($RemitenteProvincia)>150){
    		MSJDeErroresParaMostrar("RemitenteProvincia",$RemitenteProvincia,150,$i);exit;
		}
		if(strlen($RemitenteLocalidad)>150){
    		MSJDeErroresParaMostrar("RemitenteLocalidad",$RemitenteLocalidad,150,$i);exit;
		}
		if(strlen($RemitenteCalle)>150){
    		MSJDeErroresParaMostrar("RemitenteCalle",$RemitenteCalle,150,$i);exit;
		}
		if(strlen($RemitenteNumero)>150){
    		MSJDeErroresParaMostrar("RemitenteNumero",$RemitenteNumero,150,$i);exit;
		}
		if(strlen($RemitentePiso)>150){
    		MSJDeErroresParaMostrar("RemitentePiso",$RemitentePiso,150,$i);exit;
		}
		if(strlen($RemitenteDepartamento)>150){
    		MSJDeErroresParaMostrar("",$RemitenteDepartamento,150,$i);exit;
		}
		if(strlen($RemitenteEmail)>150){
    		MSJDeErroresParaMostrar("RemitenteEmail",$RemitenteEmail,150,$i);exit;
		}
		if(strlen($RemitenteCelular)>150){
    		MSJDeErroresParaMostrar("RemitenteCelular",$RemitenteCelular,150,$i);exit;
		}
		if(strlen($RemitenteObservaciones)>150){
    		MSJDeErroresParaMostrar("RemitenteObservaciones",$RemitenteObservaciones,150,$i);exit;
		}
		if(strlen($RemitenteNombreApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteNombreApoderado",$RemitenteNombreApoderado,150,$i);exit;
		}
		if(strlen($RemitenteApellidoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteApellidoApoderado",$RemitenteApellidoApoderado,150,$i);exit;
		}
		if(strlen($RemitenteDNITipoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteDNITipoApoderado",$RemitenteDNITipoApoderado,150,$i);exit;
		}
		if(strlen($RemitenteDocumentoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteDocumentoApoderado",$RemitenteDocumentoApoderado,150,$i);exit;
		}
		if(strlen($DestinatarioNombre)>150){
    		MSJDeErroresParaMostrar("DestinatarioNombre",$DestinatarioNombre,150,$i);exit;
		}
		if(strlen($DestinatarioApellido)>150){
    		MSJDeErroresParaMostrar("DestinatarioApellido",$DestinatarioApellido,150,$i);exit;
		}
		if(strlen($DestinatarioCodigoPostal)>11){
    		MSJDeErroresParaMostrar("DestinatarioCodigoPostal",$DestinatarioCodigoPostal,150,$i);exit;
		}
		if(strlen($DestinatarioProvincia)>150){
    		MSJDeErroresParaMostrar("DestinatarioProvincia",$DestinatarioProvincia,150,$i);exit;
		}
		if(strlen($DestinatarioLocalidad)>150){
    		MSJDeErroresParaMostrar("DestinatarioLocalidad",$DestinatarioLocalidad,150,$i);exit;
		}
		if(strlen($DestinatarioCalle)>150){
    		MSJDeErroresParaMostrar("DestinatarioCalle",$DestinatarioCalle,150,$i);exit;
		}
		if(strlen($DestinatarioNumero)>150){
    		MSJDeErroresParaMostrar("DestinatarioNumero",$DestinatarioNumero,150,$i);exit;
		}
		if(strlen($DestinatarioPiso)>150){
    		MSJDeErroresParaMostrar("DestinatarioPiso",$DestinatarioPiso,150,$i);exit;
		}
		if(strlen($DestinatarioDepartamento)>150){
    		MSJDeErroresParaMostrar("DestinatarioDepartamento",$DestinatarioDepartamento,150,$i);exit;
		}
	}
	
	
	
	$GPIdUsuario = "";
	$Columnas = array("id");
	$Consulta="
		SELECT cfc.SispoId as 'id' FROM sispoc5_correoflash.cliente as cfc WHERE cfc.Id = '$IdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	/*
	if($IdUsuario=="12"){
	    $Resultado=false;
	}
	*/
	if($Resultado){
		$GPIdUsuario = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["GPIdUsuario"]= $GPIdUsuario;
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	//Cansulta Para Error 2
	$Columnas = array("firma");
	$Consulta="
		SELECT cfc.URLFirma as 'firma' FROM sispoc5_correoflash.cliente as cfc WHERE cfc.Id = '$IdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$FirmaDelCliente = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["FirmaDelCliente"]= $FirmaDelCliente;
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:La Firma Requiere Ser Cargada Antes Del Pedido.",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	//Cansulta Para Error 3
	$Columnas = array("email");
	$Consulta="
		SELECT fcc.emails as 'email' 
		FROM sispoc5_gestionpostal.flash_clientes_contactos as fcc
		WHERE fcc.cliente_id = '$GPIdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$EmailDeCliente = "";
	if($Resultado){
		$EmailDeCliente = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["FirmaDelCliente"]= $FirmaDelCliente;
	}else{
		$EmailDeCliente = "correflash2017@gmail.com";
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El Usuario No Tiene Agregado Un Mail."  ,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	//Cansulta Para Error 4
	$Columnas = array("id");
	$Consulta="
		SELECT id as 'id'
		FROM sispoc5_gestionpostal.flash_clientes_departamentos
		WHERE cliente_id = '" . $GPIdUsuario . "'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$departamento_id = "";
	if($Resultado){
		$departamento_id = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["departamento_id"]= $departamento_id;
	}else{
		$logger->error('Error: No se encontró el departamento del cliente', [
			'cliente_id' => $GPIdUsuario,
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Encontro El Departamento Del Cliente",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	
	// si da error de consulta?
	GenerarComprobanteDeIngreso:
	$numero = "" . $GPIdUsuario . GenerateRandomNumber();
	$Columnas = array("numero");
	$Consulta="
		SELECT numero
		FROM sispoc5_gestionpostal.flash_comprobantes_ingresos_generados
		WHERE numero='" . $numero . "'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		goto GenerarComprobanteDeIngreso;
	}else{
		$ComprobanteDeIngreso = $numero;
		$_REQUEST["ComprobanteDeIngreso"]= $ComprobanteDeIngreso;
	}
	
	
	//Cansulta Para Error 5
	$Columnas = array("");
	$Consulta="
		INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos_generados(
			talonario_id, numero, estado, flash_comprobantes_ingresos_generados.create, flash_comprobantes_ingresos_generados.update, create_user_id, update_user_id
		)
		VALUES (
			'1'
			, '$numero'
			, '1'
			, CURRENT_TIMESTAMP
			, NULL
			, NULL
			, NULL
		);
	";
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobanteDeIngreso_generadoInsertado="";
	if($Resultado){
		$ComprobanteDeIngreso_generadoInsertado=$ClaseMaster->Insertado;
		$_REQUEST["ComprobanteDeIngreso_generadoInsertado"]= $ComprobanteDeIngreso_generadoInsertado;
	}else{
		$logger->error('Error al insertar comprobante de ingreso generado', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	//Cansulta Para Error 6
	$Columnas = array("");
	$Consulta="
	INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos
	(
		empresa_id
		, sucursal_id
		, cliente_id
		, departamento_id
		, numero
		, estado
		, fecha_pedido
		, cantidad
		, `create`
		, `update`
	)
	VALUES
	(
		null
		,'4'
		,'" . $GPIdUsuario . "'
		,'" . $departamento_id . "'
		,'" . $numero . "'
		,'0'
		,'" . date('Y-m-d') . "'
		,'1'
		,'" . date("Y-m-d H:i:s") . "'
		,'" . date("Y-m-d H:i:s") . "'
	)
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobanteDeIngresoInsertado="";
	if($Resultado){
		$ComprobanteDeIngresoInsertado=$ClaseMaster->Insertado;
		$_REQUEST["ComprobanteDeIngresoInsertado"]= $ComprobanteDeIngresoInsertado;
	}else{
		$logger->error('Error al insertar comprobante de ingreso', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	//Cansulta Para Error 7
	$Columnas = array("");
	$Consulta="
		INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios
		(
			comprobante_ingreso_id
			, servicio_id
			, cantidad
			, disponible
			, remito
			, `create`
			, `update`
		)
		VALUES
		(
			'" . $ComprobanteDeIngresoInsertado . "'
			,'" . $ServicioId . "'
			,'" . $CantidadDePiezas . "'
			,'0'
			,'0'
			,'" . date("Y-m-d H:i:s") . "'
			,'" . date("Y-m-d H:i:s") . "'
		)
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobantesIngresosServicios="";
	if($Resultado){
		$ComprobantesIngresosServicios=$ClaseMaster->Insertado;
		$_REQUEST["ComprobantesIngresosServicios"]= $ComprobantesIngresosServicios;
		
	}else{
		$logger->error('Error al insertar comprobante de ingreso en servicio', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso En Servicio", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	
	
	for($i=0;$i<count($ArraydPiezas);$i++){
		$nombres = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$apellidos = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$tipo_documento = issetornullinarrayd('Piezas',$i,'tipo_documento');
		$documento = issetornullinarrayd('Piezas',$i,'documento');
		$codigo_postal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$provincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$localidad_ciudad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$calle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$numero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$piso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$depto = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
		
		$codigo_externo = "";

        //SANITIZAR FORMULARIO
        $nombres = str_replace("'","´", $nombres);
        $apellidos = str_replace("'","´", $apellidos);
        $tipo_documento = str_replace("'","´", $tipo_documento);
        $documento = str_replace("'","´", $documento);
        $codigo_postal = str_replace("'","´", $codigo_postal);
        $provincia = str_replace("'","´", $provincia);
        $localidad_ciudad = str_replace("'","´", $localidad_ciudad);
        $calle = str_replace("'","´", $calle);
        $numero = str_replace("'","´", $numero);
        $piso = str_replace("'","´", $piso);
        $depto = str_replace("'","´", $depto);

		$Destinatario = $apellidos . " " . $nombres;
		
		if($piso != "" and $depto != ""){$Domicilio = $calle . " " .  $numero . " " . $piso . " " . $depto;}
		if($piso != "" and $depto == ""){$Domicilio = $calle . " " .  $numero . " " . $piso;}
		if($piso == "" and $depto == ""){$Domicilio = $calle . " " .  $numero;}
		
		$Columnas = array("");
		$Consulta="
			INSERT INTO sispoc5_gestionpostal.flash_piezas
			(
				usuario_id
				, servicio_id
				, tipo_id
				, sucursal_id
				, estado_id
				, cantidad
				, comprobante_ingreso_id
				, barcode_externo
				, destinatario
				, domicilio
				, codigo_postal
				, localidad
				, `create`
				, `update`
				
			)
			VALUES 
			(
				'2'
				,'" . $ComprobantesIngresosServicios . "'
				,'2'
				,'4'
				,'1'
				,'1'
				,'" . $ComprobanteDeIngresoInsertado . "'
				,'" . $codigo_externo . "'
				,'" . $Destinatario . "'
				,'" . $Domicilio . "'
				,'" . $codigo_postal . "'
				,'" . $localidad_ciudad . "'
				,'" . date("Y-m-d H:i:s") . "'
				,'" . date("Y-m-d H:i:s") . "'
			)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$PiezaIngrezada="";
		if($Resultado){
			$PiezaIngrezada=$ClaseMaster->Insertado;
			$_REQUEST["PiezaIngrezada"][$i]= $PiezaIngrezada;
		}else{
			$logger->error('Error al insertar pieza', [
				'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza", $RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		$DestinatarioNombre = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$DestinatarioApellido = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$DestinatarioCodigoPostal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$DestinatarioProvincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$DestinatarioLocalidad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$DestinatarioCalle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$DestinatarioNumero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$DestinatarioPiso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$DestinatarioDepartamento = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
		
		$RemitenteNombre = issetornullinarrayd('Piezas',$i,'RemitenteNombre');
		$RemitenteCodigoPostal = issetornullinarrayd('Piezas',$i,'RemitenteCodigoPostal');
		$RemitenteProvincia = issetornullinarrayd('Piezas',$i,'RemitenteProvincia');
		$RemitenteLocalidad = issetornullinarrayd('Piezas',$i,'RemitenteLocalidad');
		$RemitenteCalle = issetornullinarrayd('Piezas',$i,'RemitenteCalle');
		$RemitenteNumero = issetornullinarrayd('Piezas',$i,'RemitenteNumero');
		$RemitentePiso = issetornullinarrayd('Piezas',$i,'RemitentePiso');
		$RemitenteDepartamento = issetornullinarrayd('Piezas',$i,'RemitenteDepartamento');
		$RemitenteEmail = issetornullinarrayd('Piezas',$i,'RemitenteEmail');
		$RemitenteCelular = issetornullinarrayd('Piezas',$i,'RemitenteCelular');
		$RemitenteObservaciones = issetornullinarrayd('Piezas',$i,'RemitenteObservaciones');
		
		$RemitenteNombreApoderado = issetornullinarrayd('Piezas',$i,'RemitenteNombreApoderado');
		$RemitenteApellidoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteApellidoApoderado');
		$RemitenteDNITipoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDNITipoApoderado');
		$RemitenteDocumentoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDocumentoApoderado');
		
		//SANITIZAR FORMULARIO
        $Formulario = str_replace("'","´", $Formulario);

        $DestinatarioNombre = str_replace("'","´", $DestinatarioNombre);
        $DestinatarioApellido = str_replace("'","´", $DestinatarioApellido);
        $DestinatarioCodigoPostal = str_replace("'","´", $DestinatarioCodigoPostal);
        $DestinatarioProvincia = str_replace("'","´", $DestinatarioProvincia);
        $DestinatarioLocalidad = str_replace("'","´", $DestinatarioLocalidad);
        $DestinatarioCalle = str_replace("'","´", $DestinatarioCalle);
        $DestinatarioNumero = str_replace("'","´", $DestinatarioNumero);
        $DestinatarioPiso = str_replace("'","´", $DestinatarioPiso);
        $DestinatarioDepartamento = str_replace("'","´", $DestinatarioDepartamento);

        $RemitenteNombre = str_replace("'","´", $RemitenteNombre);
        $RemitenteCodigoPostal = str_replace("'","´", $RemitenteCodigoPostal);
        $RemitenteProvincia = str_replace("'","´", $RemitenteProvincia);
        $RemitenteLocalidad = str_replace("'","´", $RemitenteLocalidad);
        $RemitenteCalle = str_replace("'","´", $RemitenteCalle);
        $RemitenteNumero = str_replace("'","´", $RemitenteNumero);
        $RemitentePiso = str_replace("'","´", $RemitentePiso);
        $RemitenteDepartamento = str_replace("'","´", $RemitenteDepartamento);
        $RemitenteEmail = str_replace("'","´", $RemitenteEmail);
        $RemitenteCelular = str_replace("'","´", $RemitenteCelular);
        $RemitenteObservaciones = str_replace("'","´", $RemitenteObservaciones);

        $RemitenteNombreApoderado = str_replace("'","´", $RemitenteNombreApoderado);
        $RemitenteApellidoApoderado = str_replace("'","´", $RemitenteApellidoApoderado);
        $RemitenteDNITipoApoderado = str_replace("'","´", $RemitenteDNITipoApoderado);
        $RemitenteDocumentoApoderado = str_replace("'","´", $RemitenteDocumentoApoderado);
		
		$Columnas = array("");
		$Consulta="
			INSERT INTO sispoc5_gestionpostal.flash_piezas_cd
			(
				IdFlashPieza
                , RemitenteNombre, RemitenteApellido
				, RemitenteCodigoPostal, RemitenteProvincia, RemitenteLocalidad
				, RemitenteCalle, RemitenteNumero, RemitentePiso, RemitenteDepartamento

				, DestinatarioNombre, DestinatarioApellido
				, DestinatarioCodigoPostal, DestinatarioProvincia, DestinatarioLocalidad
				, DestinatarioCalle, DestinatarioNumero, DestinatarioPiso, DestinatarioDepartamento

				, RemitenteEmail, RemitenteCelular, RemitenteObservaciones

				, ApoderadoNombre, ApoderadoApellido
				, ApoderadoDNITipo, ApoderadoDocumento
				, ApoderadoFirma, Formulario, URLPDF
			)
			VALUES
			(
				'$PiezaIngrezada'
				, '$RemitenteNombre', ''
				, '$RemitenteCodigoPostal', '$RemitenteProvincia', '$RemitenteLocalidad'
				, '$RemitenteCalle', '$RemitenteNumero', '$RemitentePiso', '$RemitenteDepartamento'

				, '$DestinatarioNombre', '$DestinatarioApellido'
				, '$DestinatarioCodigoPostal', '$DestinatarioProvincia', '$DestinatarioLocalidad'
				, '$DestinatarioCalle', '$DestinatarioNumero', '$DestinatarioPiso', '$DestinatarioDepartamento'

				, '$RemitenteEmail', '$RemitenteCelular', '$RemitenteObservaciones'

				, '$RemitenteNombreApoderado', '$RemitenteApellidoApoderado'
				, '$RemitenteDNITipoApoderado', '$RemitenteDocumentoApoderado'

				, '$FirmaDelCliente'
				, '$Formulario'
				, ''
			)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		$PiezaCDIngrezada="";
		if($Resultado){
			$PiezaCDIngrezada=$ClaseMaster->Insertado;
			$_REQUEST["PiezaCDIngrezada"][$i]= $PiezaCDIngrezada;
		}
		else{
			$logger->error('Error al insertar pieza cd', [
				'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza CD",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}

		//Insertar tracking
		$trackingModel = new PiezaTracking();
		$trackingId = $trackingModel->crear([
			'piezaId' => $PiezaIngrezada,
		]);

		if($trackingId){
			$_REQUEST["PiezaTrackingId"][$i]= $trackingId;
		}else{
			$logger->error('Error al insertar tracking de la pieza', [
				'pieza_id' => $PiezaIngrezada,
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Tracking De La Pieza",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}

		//Insertar Pieza Novedad
		$piezaNovedadModel = new PiezaNovedad();
		$novedadId = $piezaNovedadModel->crear([
			'piezaId' => $PiezaIngrezada
		]);

		if($novedadId){
			$_REQUEST["PiezaNovedadId"][$i]= $novedadId;
		}else{
			$logger->error('Error al insertar novedad de la pieza', [
				'pieza_id' => $PiezaIngrezada,
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Novedad De La Pieza",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
	}
	
	$logger->info('Final de AjaxCartaDocumento', 'Se finalizó el procesamiento de carta documento', [
		'request' => $_REQUEST
	]);
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//Mensajeria Mail
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com";//$_POST['us_mail'];
	
	
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}
	
    $mail = new PHPMailer(true);
	try {
		$body = '<p>Estimado cliente,</p>' .
		'<p>Su Carta Documento esta siendo procesada.</p>' .
		'<p>Recibirás en el transcurso del día un mail con el Codigo de Seguimiento donde podra conocer el estado de su Carta Documento en la pagina web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' .
		'<p>Email del cliente </p>' . $emailCliente ;

		//Server settings
		$mail->SMTPDebug = 0;                      
		$mail->isSMTP();                                            
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = getenv('MAIL_ENCRYPTION');
		$mail->Host = getenv('MAIL_HOST');
		$mail->Port = getenv('MAIL_PORT');
		$mail->Username = getenv('MAIL_USERNAME');
		$mail->Password = getenv('MAIL_PASSWORD'); 
		$mail->SetFrom( getenv('MAIL_USERNAME'), getenv('MAIL_FROM'), 0);
        $mail->CharSet = 'UTF-8';
		$mail->Timeout = 10;
		$mail->IsHTML(true);
		//Recipients
		$Emails = explode( ',', $EmailDeCliente);
		for($i=0;$i<count($Emails);$i++){
			$mail->addAddress($Emails[$i]);     // Add a recipient
		}

		// Content
		$mail->isHTML(true);                                 
		$mail->Subject = html_entity_decode('Su Envio De Carta Documento');
		$mail->Body = html_entity_decode($body);
		
		$mail->send();
		//echo 'Message has been sent';
	} catch (Exception $e) {
		$logger->exception('Error al enviar mail con el estado del pedido', $e, [
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Pudo Enviar Mail Con El Estado Del Pedido",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////

		
	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente,</p> <p>Su Carta Documento está siendo procesada.</p> <p>Recibirás en el transcurso del día un mail con el Código de Seguimiento donde podrá conocer el estado de su Carta Documento en la página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>'  . "</b>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

?>