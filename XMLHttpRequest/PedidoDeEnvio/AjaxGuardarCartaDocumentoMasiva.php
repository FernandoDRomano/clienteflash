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
	$logger->info('Inicio de AjaxGuardarCartaDocumentoMasiva', 'Procesando solicitud de guardado masivo de cartas documentos', [
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
        	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:<p>El Campo $Columna Contiene (<b>" . strlen($Valor) . "</b> Digitos)</p><p>El Maximo Admitido Es $Long </p><p>El Data Suministrado " . $Valor . " Es Muy Largo </p>" . "<p>Verifique El Pedido Numero (<b>" .$Pedido . "</b>) Dentro Del Excel</p>" ,$RespuestaJsonAjax);
        	if($RespuestaJsonAjax[0] == ""){
        		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
        	}
        	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	    }else{
	        $RespuestaJsonAjax = array('');
        	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:<p>El Campo $Columna Contiene (<b>" . strlen($Valor) . "</b> Digitos)</p><p>El Maximo Admitido Es $Long </p><p>El Data Suministrado " . $Valor . " Es Muy Largo </p>",$RespuestaJsonAjax);
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
	
	$CantidadDeDatosDeDestinaario = count($ArraydPiezas[0]["Destinatario-Nombre"]);
	
	$Formulario = issetornull('textBox');
	$ArrayDeFormularios = array();
	
	$PosI=0;
	$PosF=0;
	for($i=0,$j=0; $i<strlen($Formulario) ; $i++){
		$PosI = strpos ($Formulario,'[',$i);
		if($PosI !== false){
			$PosF = strpos ($Formulario,']',$PosI);
			if($PosF !== false){
				$Ofsets = ($PosF-$PosI)-1;
				$ArrayDeFormularios[$j] = substr($Formulario,$PosI+1,$Ofsets);
				$j++;
				$i=$PosF;
			}else{
				$i=strlen($Formulario);
			}
		}else{
			$i=strlen($Formulario);
		}
	}
	//print_r($ArrayDeFormularios);
	
	
	$CantidadDePiezas = count($ArraydPiezas[0]["Destinatario-Nombre"]);
	
	$IdUsuario = issetornull('IdUsuario');
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El Usuario No Tiene Agregado Un Mail."  ,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
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
	
	$Arraydnombres = issetornullinarraydgatarray('Piezas',0,'Destinatario-Nombre');
	$Arraydapellidos = issetornullinarraydgatarray('Piezas',0,'Destinatario-Apellido');
	$Arraydprovincia = issetornullinarraydgatarray('Piezas',0,'Destinatario-Provincia');
	$Arraydlocalidad_ciudad = issetornullinarraydgatarray('Piezas',0,'Destinatario-Localidad');
	$Arraydcodigo_postal = issetornullinarraydgatarray('Piezas',0,'Destinatario-CodigoPostal');
	$Arraydcalle = issetornullinarraydgatarray('Piezas',0,'Destinatario-Calle');
	$Arraydnumero = issetornullinarraydgatarray('Piezas',0,'Destinatario-Numero');
	
	$Arraydpiso = issetornullinarraydgatarray('Piezas',0,'Destinatario-Piso');
	$Arrayddepto = issetornullinarraydgatarray('Piezas',0,'Destinatario-Departamento');
	
	$ArraydPiezas[0][$key]=str_replace("'","\\'",$value);

    $dataCartasDocumentos = [];
	
	for($i=0;$i<$CantidadDePiezas;$i++){
		$Formulario = issetornull('textBox');
		$FormularioFinal=$Formulario;
		//print_r($_REQUEST);
		
		for($DatosEnFormularios=0 ; $DatosEnFormularios<count($ArrayDeFormularios) ;$DatosEnFormularios++){
			$temp = issetornullinarraydgatarray('Piezas',0,$ArrayDeFormularios[$DatosEnFormularios]);
			$FormularioFinal = str_replace("[".$ArrayDeFormularios[$DatosEnFormularios]."]", $temp[$i], $FormularioFinal);
		}

		$DestinatarioNombre = $Arraydnombres[$i];
		$DestinatarioApellido = $Arraydapellidos[$i];
		$DestinatarioCodigoPostal = $Arraydcodigo_postal[$i];
		$DestinatarioProvincia = $Arraydprovincia[$i];
		$DestinatarioLocalidad = $Arraydlocalidad_ciudad[$i];
		$DestinatarioCalle = $Arraydcalle[$i];
		$DestinatarioNumero = $Arraydnumero[$i];
        $DestinatarioPiso = $Arraydpiso[$i];
        $DestinatarioDepartamento = $Arrayddepto[$i];
		
		$RemitenteNombre = issetornullinarrayd('Piezas',0,'RemitenteNombre');
		$RemitenteCodigoPostal = issetornullinarrayd('Piezas',0,'RemitenteCodigoPostal');
		$RemitenteProvincia = issetornullinarrayd('Piezas',0,'RemitenteProvincia');
		$RemitenteLocalidad = issetornullinarrayd('Piezas',0,'RemitenteLocalidad');
		$RemitenteCalle = issetornullinarrayd('Piezas',0,'RemitenteCalle');
		$RemitenteNumero = issetornullinarrayd('Piezas',0,'RemitenteNumero');
		$RemitentePiso = issetornullinarrayd('Piezas',0,'RemitentePiso');
		$RemitenteDepartamento = issetornullinarrayd('Piezas',0,'RemitenteDepartamento');
		$RemitenteEmail = issetornullinarrayd('Piezas',0,'RemitenteEmail');
		$RemitenteCelular = issetornullinarrayd('Piezas',0,'RemitenteCelular');
		$RemitenteObservaciones = issetornullinarrayd('Piezas',0,'RemitenteObservaciones');
		
		$RemitenteNombreApoderado = issetornullinarrayd('Piezas',0,'RemitenteNombreApoderado');
		$RemitenteApellidoApoderado = issetornullinarrayd('Piezas',0,'RemitenteApellidoApoderado');
		$RemitenteDNITipoApoderado = issetornullinarrayd('Piezas',0,'RemitenteDNITipoApoderado');
		$RemitenteDocumentoApoderado = issetornullinarrayd('Piezas',0,'RemitenteDocumentoApoderado');
		
        $dataCartasDocumentos[] = [
            'created_user_id' => $IdUsuario,
            'cliente_id' => $SispoClienteId,
            'destinatario_nombre' => str_replace("'","´", $DestinatarioNombre),
            'destinatario_apellido' => str_replace("'","´", $DestinatarioApellido),
            'destinatario_provincia' => null,
            'destinatario_provincia_nombre' => str_replace("'","´", $DestinatarioProvincia),
            'destinatario_localidad' => null,
            'destinatario_localidad_nombre' => str_replace("'","´", $DestinatarioLocalidad),
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
            'origen_modulo' => CartaDocumento::MODULO_CARTA_DOCUMENTO_MASIVA
        ];
	}

    //Validaciones sobre campos
    foreach($dataCartasDocumentos as $index => $cartaDocumento){
       	$nombres = $cartaDocumento['destinatario_nombre'];
		$apellidos = $cartaDocumento['destinatario_apellido'];
		$tipo_documento = $cartaDocumento['firmante_tipo_documento'];
		$documento = $cartaDocumento['firmante_documento'];
		$codigo_postal = $cartaDocumento['destinatario_cp'];
		$provincia = $cartaDocumento['destinatario_provincia'];
		$localidad_ciudad = $cartaDocumento['destinatario_localidad'];
		$calle = $cartaDocumento['destinatario_calle'];
		$numero = $cartaDocumento['destinatario_numero'];
		$piso = $cartaDocumento['destinatario_piso'];
		$depto = $cartaDocumento['destinatario_departamento'];

        $DestinatarioNombre = $cartaDocumento['DestinatarioNombre'];
		$DestinatarioApellido = $cartaDocumento['DestinatarioApellido'];
		$DestinatarioCodigoPostal = $cartaDocumento['DestinatarioCodigoPostal'];
		$DestinatarioProvincia = $cartaDocumento['DestinatarioProvincia'];
		$DestinatarioLocalidad = $cartaDocumento['DestinatarioLocalidad'];
		$DestinatarioCalle = $cartaDocumento['DestinatarioCalle'];
		$DestinatarioNumero = $cartaDocumento['DestinatarioNumero'];
		$DestinatarioPiso = $cartaDocumento['DestinatarioPiso'];
		$DestinatarioDepartamento = $cartaDocumento['DestinatarioDepartamento'];
		$RemitenteNombre = $cartaDocumento['RemitenteNombre'];
		$RemitenteCodigoPostal = $cartaDocumento['RemitenteCodigoPostal'];
		$RemitenteProvincia = $cartaDocumento['RemitenteProvincia'];
		$RemitenteLocalidad = $cartaDocumento['RemitenteLocalidad'];
		$RemitenteCalle = $cartaDocumento['RemitenteCalle'];
		$RemitenteNumero = $cartaDocumento['RemitenteNumero'];
		$RemitentePiso = $cartaDocumento['RemitentePiso'];
		$RemitenteDepartamento = $cartaDocumento['RemitenteDepartamento'];
		$RemitenteEmail = $cartaDocumento['RemitenteEmail'];
		$RemitenteCelular = $cartaDocumento['RemitenteCelular'];
		$RemitenteObservaciones = $cartaDocumento['RemitenteObservaciones'];
		$RemitenteNombreApoderado = $cartaDocumento['RemitenteNombreApoderado'];
		$RemitenteApellidoApoderado = $cartaDocumento['RemitenteApellidoApoderado'];
		$RemitenteDNITipoApoderado = $cartaDocumento['RemitenteDNITipoApoderado'];
		$RemitenteDocumentoApoderado = $cartaDocumento['RemitenteDocumentoApoderado'];
		$Destinatario = $apellidos . " " . $nombres;
		if($piso != "" and $depto != ""){$Domicilio = $calle . " " .  $numero . " " . $piso . " " . $depto;}
		if($piso != "" and $depto == ""){$Domicilio = $calle . " " .  $numero . " " . $piso;}
		if($piso == "" and $depto == ""){$Domicilio = $calle . " " .  $numero;}

		if(strlen($Destinatario)>150){
    		MSJDeErroresParaMostrar("Nombre De Destinatario",$Destinatario,150,($index + 1));exit;
		}
		if(strlen($Domicilio)>150){
    		MSJDeErroresParaMostrar("Domicilio formado por calle numero y piso",$Domicilio,150,($index + 1));exit;
		}
		if(strlen($codigo_postal)>150){
    		MSJDeErroresParaMostrar("Codigo Postal",$codigo_postal,150,($index + 1));exit;
		}
		if(strlen($localidad_ciudad)>150){
    		MSJDeErroresParaMostrar("Localidad",$localidad_ciudad,150,($index + 1));exit;
		}
		if(strlen($RemitenteCodigoPostal)>11){
    		MSJDeErroresParaMostrar("RemitenteCodigoPostal",$RemitenteCodigoPostal,11,($index + 1));exit;
		}
		if(strlen($RemitenteProvincia)>150){
    		MSJDeErroresParaMostrar("RemitenteProvincia",$RemitenteProvincia,150,($index + 1));exit;
		}
		if(strlen($RemitenteLocalidad)>150){
    		MSJDeErroresParaMostrar("RemitenteLocalidad",$RemitenteLocalidad,150,($index + 1));exit;
		}
		if(strlen($RemitenteCalle)>150){
    		MSJDeErroresParaMostrar("RemitenteCalle",$RemitenteCalle,150,($index + 1));exit;
		}
		if(strlen($RemitenteNumero)>150){
    		MSJDeErroresParaMostrar("RemitenteNumero",$RemitenteNumero,150,($index + 1));exit;
		}
		if(strlen($RemitentePiso)>150){
    		MSJDeErroresParaMostrar("RemitentePiso",$RemitentePiso,150,($index + 1));exit;
		}
		if(strlen($RemitenteDepartamento)>150){
    		MSJDeErroresParaMostrar("",$RemitenteDepartamento,150,($index + 1));exit;
		}
		if(strlen($RemitenteEmail)>150){
    		MSJDeErroresParaMostrar("RemitenteEmail",$RemitenteEmail,150,($index + 1));exit;
		}
		if(strlen($RemitenteCelular)>150){
    		MSJDeErroresParaMostrar("RemitenteCelular",$RemitenteCelular,150,($index + 1));exit;
		}
		if(strlen($RemitenteObservaciones)>150){
    		MSJDeErroresParaMostrar("RemitenteObservaciones",$RemitenteObservaciones,150,($index + 1));exit;
		}
		if(strlen($RemitenteNombreApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteNombreApoderado",$RemitenteNombreApoderado,150,($index + 1));exit;
		}
		if(strlen($RemitenteApellidoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteApellidoApoderado",$RemitenteApellidoApoderado,150,($index + 1));exit;
		}
		if(strlen($RemitenteDNITipoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteDNITipoApoderado",$RemitenteDNITipoApoderado,150,($index + 1));exit;
		}
		if(strlen($RemitenteDocumentoApoderado)>150){
    		MSJDeErroresParaMostrar("RemitenteDocumentoApoderado",$RemitenteDocumentoApoderado,150,($index + 1));exit;
		}
		if(strlen($DestinatarioNombre)>150){
    		MSJDeErroresParaMostrar("DestinatarioNombre",$DestinatarioNombre,150,($index + 1));exit;
		}
		if(strlen($DestinatarioApellido)>150){
    		MSJDeErroresParaMostrar("DestinatarioApellido",$DestinatarioApellido,150,($index + 1));exit;
		}
		if(strlen($DestinatarioCodigoPostal)>11){
    		MSJDeErroresParaMostrar("DestinatarioCodigoPostal",$DestinatarioCodigoPostal,150,($index + 1));exit;
		}
		if(strlen($DestinatarioProvincia)>150){
    		MSJDeErroresParaMostrar("DestinatarioProvincia",$DestinatarioProvincia,150,($index + 1));exit;
		}
		if(strlen($DestinatarioLocalidad)>150){
    		MSJDeErroresParaMostrar("DestinatarioLocalidad",$DestinatarioLocalidad,150,($index + 1));exit;
		}
		if(strlen($DestinatarioCalle)>150){
    		MSJDeErroresParaMostrar("DestinatarioCalle",$DestinatarioCalle,150,($index + 1));exit;
		}
		if(strlen($DestinatarioNumero)>150){
    		MSJDeErroresParaMostrar("DestinatarioNumero",$DestinatarioNumero,150,($index + 1));exit;
		}
		if(strlen($DestinatarioPiso)>150){
    		MSJDeErroresParaMostrar("DestinatarioPiso",$DestinatarioPiso,150,($index + 1));exit;
		}
		if(strlen($DestinatarioDepartamento)>150){
    		MSJDeErroresParaMostrar("DestinatarioDepartamento",$DestinatarioDepartamento,150,($index + 1));exit;
		}
    }

    $erroresInsercion = [];

    //Guardar Cartas Documentos
    foreach($dataCartasDocumentos as $index => $data){
        try {
            $cartaDocumento = new CartaDocumento();
            $id = $cartaDocumento->crear($data);

            if(!$id){
                $erroresInsercion[] = "No se pudo guardar la Carta Documento para la fila " . ($index + 1);
                $logger->error('Error al guardar Carta Documento', 'Fallo en inserción para fila ' . ($index + 1), [
                    'usuario_id' => $IdUsuario,
                    'fila' => $index + 1,
                    'data' => $data
                ]);
            } else {
                $logger->info('Carta Documento creada', 'Se creó carta documento ID: ' . $id, [
                    'carta_documento_id' => $id,
                    'usuario_id' => $IdUsuario,
                    'data' => $data
                ]);
            }
        } catch (Exception $e) {
            $erroresInsercion[] = "Error en fila " . ($index + 1) . ": " . $e->getMessage();
            $logger->exception('Excepción al guardar Carta Documento', $e, [
                'usuario_id' => $IdUsuario,
                'fila' => $index + 1,
				'data' => $data
            ]);
        }
    }

    if(count($erroresInsercion) > 0){
        $mensajeError = implode("<br>", $erroresInsercion);
        $RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Se encontraron los siguientes errores al guardar las Cartas Documentos:<br>" . $mensajeError,$RespuestaJsonAjax);
        if($RespuestaJsonAjax[0] == ""){
            $RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
        }
        functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
    }

	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente.</p><p>Sus Cartas Documentos fueron almacenadas con éxito. Las mismas deben ser autorizadas para ser enviadas a nuestro sistema POSTAL.</p>', $RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;