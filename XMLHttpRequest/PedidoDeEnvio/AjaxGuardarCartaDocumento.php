<?php
	header("Access-Control-Allow-Origin: *");

	// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
	require_once __DIR__ . '/../../Config/bootstrap.php';

    use Models\CartaDocumento;
    use Models\PerfilCliente;
	use Helpers\LogManager;

	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);

	// Instanciar LogManager
	$logger = new LogManager();
	$logger->info('Inicio de AjaxGuardarCartaDocumento', 'Procesando solicitud de guardado de carta documento', [
		'request' => $_REQUEST
	]);
	
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

    // $RespuestaJsonAjax = functionRespuestaJsonAjax("<pre>". var_dump($_REQUEST) ."</pre>",$RespuestaJsonAjax);
	// if($RespuestaJsonAjax[0] == ""){
	// 	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	// }
	// functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

    // die;

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
    $PerfilId = issetornull('perfilId');
    $SispoClienteId = issetornull('sispoClienteId');


    //VALIDAR QUE EL USUARIO TENGA EL PERFIL PARA GUARDAR
    if($PerfilId != PerfilCliente::CREADOR){
        $RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Tiene Permisos Para Guardar Cartas Documentos.",$RespuestaJsonAjax);
        if($RespuestaJsonAjax[0] == ""){
            $RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
        }
        functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
    }

	
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
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
	}else{
		$EmailDeCliente = "correflash2017@gmail.com";
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $departamento_id,$RespuestaJsonAjax);
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Encontro El Departamento Del Cliente",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	for($i=0;$i<count($ArraydPiezas);$i++){

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
		
        $data = [
            'created_user_id' => $IdUsuario,
            'cliente_id' => $SispoClienteId,
            'destinatario_nombre' => str_replace("'","´", $DestinatarioNombre),
            'destinatario_apellido' => str_replace("'","´", $DestinatarioApellido),
            'destinatario_provincia' => str_replace("'","´", $DestinatarioProvincia),
            'destinatario_localidad' => str_replace("'","´", $DestinatarioLocalidad),
            'destinatario_cp' => str_replace("'","´", $DestinatarioCodigoPostal),
            'destinatario_calle' => str_replace("'","´", $DestinatarioCalle),
            'destinatario_numero' => str_replace("'","´", $DestinatarioNumero),
            'destinatario_piso' => str_replace("'","´", $DestinatarioPiso),
            'destinatario_departamento' => str_replace("'","´", $DestinatarioDepartamento),
            'remitente_nombre' => str_replace("'","´", $RemitenteNombre),
            'remitente_provincia' => str_replace("'","´", $RemitenteProvincia),
            'remitente_localidad' => str_replace("'","´", $RemitenteLocalidad),
            'remitente_cp' => str_replace("'","´", $RemitenteCodigoPostal),
            'remitente_calle' => str_replace("'","´", $RemitenteCalle),
            'remitente_numero' => str_replace("'","´", $RemitenteNumero),
            'remitente_piso' => str_replace("'","´", $RemitentePiso),
            'remitente_departamento' => str_replace("'","´", $RemitenteDepartamento),
            'remitente_email' => str_replace("'","´", $RemitenteEmail),
            'remitente_celular' => str_replace("'","´", $RemitenteCelular),
            'remitente_observaciones' => str_replace("'","´", $RemitenteObservaciones),
            'firmante_nombre' => str_replace("'","´", $RemitenteNombreApoderado),
            'firmante_apellido' => str_replace("'","´", $RemitenteApellidoApoderado),
            'firmante_tipo_documento' => str_replace("'","´", $RemitenteDNITipoApoderado),
            'firmante_documento' => str_replace("'","´", $RemitenteDocumentoApoderado),
            'firma_cliente' => $FirmaDelCliente,
            'contenido' => str_replace("'","´", $Formulario),
        ];

	}

    try {
		$cartaDocumento = new CartaDocumento();
		$id = $cartaDocumento->crear($data);

		if(!$id){
			$logger->error('Error al guardar la carta documento', 'No se pudo guardar la carta documento para el cliente', [
				'data' => $data
			]);
		}else{
			$logger->info('Carta documento guardada con éxito', 'La carta documento fue guardada correctamente', [
				'carta_documento_id' => $id,
				'data' => $data
			]);
		}
	} catch (Exception $e) {
		$logger->exception('Excepción al guardar Carta Documento', $e, [
			'usuario_id' => $IdUsuario,
			'data' => $data
		]);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error: No Se Pudo Guardar La Carta Documento.",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
		
	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente.</p><p>Su Carta Documento fue almacenada con éxito. La misma debe ser autorizada para ser enviada a nuestro sistema POSTAL.</p>', $RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

?>