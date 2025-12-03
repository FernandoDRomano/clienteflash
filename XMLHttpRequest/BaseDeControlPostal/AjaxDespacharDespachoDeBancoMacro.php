<?php
	header("Access-Control-Allow-Origin: *");
	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);
	function ColumaEnArrayAArray($Arg = ",",$ArraydStr,$Columna){
		$Tstr = array();
		for($i = 0; $i<count($ArraydStr);$i++){
			$Tstr[$i] = $ArraydStr[$i][$Columna];
		}
		return $Tstr;
	}
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		if(isset ($_GET['callback'])){
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

	$DespachosActivos = issetornull('DespachosActivos');
	
	/*
	$Consulta= "#Rutina DespacharDespachoDeBancoMacro Activo = false
		UPDATE sispoc5_Banco.PiezasEstados
		SET PiezasEstados.Activo = false
		where PiezasEstados.Barcode = '$BcExterno'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$Consulta= "#Rutina DespacharDespachoDeBancoMacro Activo true
		UPDATE sispoc5_Banco.PiezasEstados
		inner join (
			select max(Fecha) as 'Fecha', id as 'id'
			from sispoc5_Banco.PiezasEstados 
			where PiezasEstados.Barcode = '$BcExterno'
			GROUP BY PiezasEstados.Barcode
		) as max
		SET PiezasEstados.Activo = true
		where max.id = PiezasEstados.id and PiezasEstados.Barcode = '$BcExterno'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	*/
	
	
	
	
	
	$Columnas = array("Barcode");
	$Consulta="
	SELECT pd.id as 'Despacho', fs.nombre as 'Sucursal De Origen', fsd.nombre as 'Sucursal De Destino', fp.comprobante_ingreso_id as 'Comprobante De Ingreso', fp.id as 'Pieza Id', fp.barcode_externo as 'Barcode', peApp.NombreDeEstado as 'Estado'
		, case pe.Activo
		when '0' then 'No'
		when '1' then  'Si'
		else ''
		END as 'Estado Activo'
		FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
		inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
		inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
		inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
		inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
		inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo= pe.Barcode
		inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
        and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')  and (pe.idEstados = '2' or (peApp.MovimientoDeSucursal = '2'))#MovimientoDeSucursal
		
		inner join (
			select max.Barcode, max(max.Fecha) as 'Fecha'
            FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
			inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = '$DespachosActivos' and pd.id = pdp.despacho_id
			inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
			inner join sispoc5_Banco.PiezasEstados as max on fp.barcode_externo = max.Barcode
			group by max.Barcode
		) as max on max.Barcode = fp.barcode_externo and max.Fecha = pe.Fecha
		where
		pd.id = '$DespachosActivos'
		and 
		(
			pe.Activo is null
			or
			pe.Activo = '1'
		)
		#limit 100
	";
	
	/*
	$Columnas = array("Barcode");
	$Consulta="
		SELECT pd.id as 'Despacho', fs.nombre as 'Sucursal De Origen', fsd.nombre as 'Sucursal De Destino', fp.comprobante_ingreso_id as 'Comprobante De Ingreso', fp.id as 'Pieza Id', fp.barcode_externo as 'Barcode', peApp.NombreDeEstado as 'Estado'
		, case pe.Activo
		when '0' then 'No'
		when '1' then  'Si'
		else ''
		END as 'Estado Activo'
		FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
		inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
		inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
		inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
		inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
		inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo= pe.Barcode and (pe.idEstados = '2' or (pe.idEstados in ('29','31','33','35','37','39','41','43','45','47','49','51')))
		inner join (
			select max.Barcode, max(max.Fecha) as 'Fecha'
			from sispoc5_Banco.PiezasEstados as max 
			group by max.Barcode
		) as max on max.Barcode = fp.barcode_externo and max.Fecha = pe.Fecha
		inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')
		
		where
		pd.id = '$DespachosActivos'
		and 
		(
			pe.Activo is null
			or
			pe.Activo = '1'
		)
		#limit 100
	";
	*/
	
	
	
	
	
	
	
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$Barcode = $ClaseMaster->ArraydResultados;
		$Barcode = ColumaEnArrayAArray(",",$Barcode,0);
		$Barcode = "('".implode("','",$Barcode)."')";
		$Columnas = array("Pieza Id");
		
		date_default_timezone_set('America/Argentina/Tucuman');
		$currentDateTime = '' . date('Y-m-d H:i:s');
		
		/*
		$Consulta= "#Rutina DespacharDespachoDeBancoMacro Activo = false
			UPDATE sispoc5_Banco.PiezasEstados
			SET PiezasEstados.Activo = true
			where PiezasEstados.Barcode in '$BcExterno'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		*/
		
		
		
		
		$Consulta="
			UPDATE sispoc5_Banco.Piezas
			inner join (
				select 
				p.Tarjeta as 'barcode'
				, case pd.destino_id
					when 1 THEN '28'#FLASH JUJUY
					when 2 THEN '30'#FLASH SANTIAGO
					when 3 THEN '32'#FLASH SALTA
					when 4 THEN '34'#FLASH TUCUMAN
					when 5 THEN '36'#FLASH CATAMARCA
					when 6 THEN '38'#FLASH LA RIOJA
					when 7 THEN '40'#FLASH BUENOS AIRES
					#when 8 THEN '42'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN '44'#FLASH ORAN - SALTA
					when 10 THEN '46'#CENTRO DE DISTRIBUCION
					when 11 THEN '48'#TRAFICO TUCUMAN
					when 12 THEN '50'#FLASH TARTAGAL - SALTA
					else '-1'
                END as 'idEstados'
				from sispoc5_gestionpostal.flash_piezas_despacho as pd
					inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id and pd.id = '$DespachosActivos'
					inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
					inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
					inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados = '2')
					inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
					and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')  and (pe.idEstados = '2' or (peApp.MovimientoDeSucursal = '2'))
					inner join sispoc5_Banco.Piezas as p on pe.Barcode = concat('CF',p.Tarjeta)
				where
				pd.id = '$DespachosActivos'
				and 
				(
					pe.Activo is null
					or
					pe.Activo = '1'
				)
			) as fp
			SET 
				Piezas.UltimoEstado = fp.idEstados
				,Piezas.FechaDeEstado = '$currentDateTime'
			WHERE Piezas.Tarjeta = fp.Barcode
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		
		$Consulta="
			UPDATE sispoc5_consultasweb.piezas
			inner join (
				select 
				p.NumPiezaCorreo as 'barcode'
				,case pd.destino_id
					when 1 THEN 'Enviado a Jujuy'#FLASH JUJUY
					when 2 THEN 'Enviado a Santiago del Estero'#FLASH SANTIAGO
					when 3 THEN 'Enviado a Salta'#FLASH SALTA
					when 4 THEN 'Enviado a Tucuman'#FLASH TUCUMAN
					when 5 THEN 'Enviado a Catamarca'#FLASH CATAMARCA
					when 6 THEN 'Enviado a La Rioja'#FLASH LA RIOJA
					when 7 THEN 'Enviado a Buenos Aires'#FLASH BUENOS AIRES
					#when 8 THEN '42'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN 'Enviado a Oran Salta'#FLASH ORAN - SALTA
					when 10 THEN 'Enviado a Centro De Distribucion'#CENTRO DE DISTRIBUCION
					when 11 THEN 'Enviado a Trafico Tucuman'#TRAFICO TUCUMAN
					when 12 THEN 'Enviado a Tartagal Salta'#FLASH TARTAGAL - SALTA
					else 'Enviado a Otra Sucursal'
                END as 'EstadoPieza'
				from sispoc5_gestionpostal.flash_piezas_despacho as pd
					inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id and pd.id = '$DespachosActivos'
					inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
					inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
					inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados = '2')
					inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
					and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')  and (pe.idEstados = '2' or (peApp.MovimientoDeSucursal = '2'))
					inner join sispoc5_consultasweb.piezas as p on pe.Barcode = p.NumPiezaCorreo
				where
				pd.id = '$DespachosActivos'
				and 
				(
					pe.Activo is null
					or
					pe.Activo = '1'
				)
			) 
             as fp
			SET 
				piezas.EstadoPieza = fp.EstadoPieza
				,piezas.FechaEstadoPieza = '$currentDateTime'
				,piezas.EstadoDefinitivo = '3'
			WHERE piezas.NumPiezaCorreo = fp.Barcode
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas Despachadas:".$Consulta,$RespuestaJsonAjax);//85134300
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		
		$Columnas = array("Pieza Id");
		
		$Consulta="
			INSERT INTO sispoc5_consultasweb.estados_piezas
			(
				pieza_id
				,NumeroPieza
				,EstadoPieza
				,idEstados
				,MotivoPieza
				,idMotivo
				,FechaEstadoPieza
				,DatoPieza
				,HDR
			)
				SELECT
				cwp.id
				, fp.barcode_externo as 'Barcode'
				,case pd.destino_id
					when 1 THEN 'Enviado a Jujuy'
					when 2 THEN 'Enviado a Santiago del Estero'
					when 3 THEN 'Enviado a Salta'
					when 4 THEN 'Enviado a Tucuman'
					when 5 THEN 'Enviado a Catamarca'
					when 6 THEN 'Enviado a La Rioja'
					when 7 THEN 'Enviado a Buenos Aires'
					
					when 9 THEN 'Enviado a Oran Salta'
					when 10 THEN 'Enviado a Centro De Distribucion'
					when 11 THEN 'Enviado a Trafico Tucuman'
					when 12 THEN 'Enviado a Tartagal Salta'
					else 'Enviado a Otra Sucursal'
                END as 'EstadoPieza'
				,case pd.destino_id
					when 1 THEN '28'
					when 2 THEN '30'
					when 3 THEN '32'
					when 4 THEN '34'
					when 5 THEN '36'
					when 6 THEN '38'
					when 7 THEN '40'
					when 9 THEN '44'
					when 10 THEN '46'
					when 11 THEN '48'
					when 12 THEN '50'
					else '-1'
                END as 'idEstados'
				, cwp.MotivoPieza as 'MotivoPieza'
				,case cwp.MotivoPieza
					when 'Domicilio' THEN '1'
					when 'Sucursal' THEN '2'
					else ''
				END as 'idMotivo'
				, '$currentDateTime' as 'FechaEstadoPieza'
				, '' as DatoPieza
				, fp.hoja_ruta_id as 'HDR'
					FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
					inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
					inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.destino_id
					
					inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode 
					inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
					and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')  and (pe.idEstados = '2' or (peApp.MovimientoDeSucursal = '2'))
					
					inner join sispoc5_consultasweb.piezas as cwp on fp.barcode_externo = cwp.NumPiezaCorreo
					where
					pd.id = '$DespachosActivos'
					and 
					(
						pe.Activo is null
						or
						pe.Activo = '1'
					)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		//print_r($Consulta);
		$Columnas = array("Pieza Id");
		$Consulta="
			INSERT INTO sispoc5_Banco.PiezasEstados
			(
				id
				, idPieza
				, Barcode
				, idVinculo
				, ApellidoNombreRecibio
				, Documento
				, Fecha
				, VercionAPP
				, Latitud
				, Longitud
				, Exactitud
				, Altitud
				, Tipo
				, idEstados
				, Activo
				, NombreDeUsuario
				, DocumentoUsuario
				, FotoDeAcuse
				, FotoDeAcuseWeb
			)
				SELECT '' as 'id'
				, fp.id as 'Pieza Id'
				, fp.barcode_externo as 'Barcode'
				,'' as 'idVinculo'
				,'' as 'ApellidoNombreRecibio'
				,'' as 'Documento'
				,'$currentDateTime' as 'Fecha'
				,'0' as 'VercionAPP'
				,'' as 'Latitud'
				,'' as 'Longitud'
				,'' as 'Exactitud'
				,'' as 'Altitud'
				,'' as 'Tipo'
				,case pd.destino_id
					when 1 THEN '28'#FLASH JUJUY
					when 2 THEN '30'#FLASH SANTIAGO
					when 3 THEN '32'#FLASH SALTA
					when 4 THEN '34'#FLASH TUCUMAN
					when 5 THEN '36'#FLASH CATAMARCA
					when 6 THEN '38'#FLASH LA RIOJA
					when 7 THEN '40'#FLASH BUENOS AIRES
					#when 8 THEN '42'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN '44'#FLASH ORAN - SALTA
					when 10 THEN '46'#CENTRO DE DISTRIBUCION
					when 11 THEN '48'#TRAFICO TUCUMAN
					when 12 THEN '50'#FLASH TARTAGAL - SALTA
					else '-1'
                END as 'idEstados'
				,true as 'Activo'
				,'User Web DespacharDespachoDeBancoMacro' as 'NombreDeUsuario'
				,'00000000' as 'DocumentoUsuario'
				,'' as 'FotoDeAcuse'
				,'' as 'FotoDeAcuseWe'
					FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
					left join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
					left join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					left join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.destino_id
					
					inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados = '2')
					inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
					and (peApp.IdTipoDeEstado = '2' or peApp.IdTipoDeEstado = '3')  and (pe.idEstados = '2' or (peApp.MovimientoDeSucursal = '2'))
					
					where
					
					pd.id = '$DespachosActivos'
					and 
					(
						pe.Activo is null
						or
						pe.Activo = '1'
					)
					#limit 100
		";
		$ResultadoF = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		$CantidadDePiezasActualizadas = $ClaseMaster->Insertado;
		
		//$RespuestaJsonAjax = functionRespuestaJsonAjax(print_r($Consulta),$RespuestaJsonAjax);//85134300
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		
		
		$Consulta= "#Rutina DespacharDespachoDeBancoMacro Activo = false
			UPDATE sispoc5_Banco.PiezasEstados
			inner join (
			select max.Barcode, max(max.Fecha) as 'Fecha'
				FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
				inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = '$DespachosActivos' and pd.id = pdp.despacho_id
				inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
				inner join sispoc5_Banco.PiezasEstados as max on fp.barcode_externo = max.Barcode
				group by max.Barcode
			) as max on max.Barcode = PiezasEstados.Barcode 
			
			SET PiezasEstados.Activo = false
			where PiezasEstados.Barcode in $Barcode
			and max.Fecha > PiezasEstados.Fecha
			
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		
		
		
		if($ResultadoF){
			//$RespuestaJsonAjax = functionRespuestaJsonAjax("Ultimo Estado Insertado:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas Despachadas:".$CantidadDePiezasActualizadas,$RespuestaJsonAjax);//85134300
		}else{
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Pudo Poner El Estado A Las Piezas",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		//$RespuestaJsonAjax = functionRespuestaJsonAjax($Piezas,$RespuestaJsonAjax);
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		//
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Piezas No Encontradas Con Ultimo Estado Físico Recibido",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

?>
















