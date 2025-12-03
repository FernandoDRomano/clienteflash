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

	$DespachosActivosEnviados = issetornull('DespachosActivos');
	
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
		inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id and pd.id = '$DespachosActivosEnviados'
		inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
		inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
		inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
		
        inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
        inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
        and ( peApp.IdTipoDeEstado = '3' and peApp.MovimientoDeSucursal = '1')
		
		inner join (
			select max.Barcode, max(max.Fecha) as 'Fecha'
            FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
		inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = '$DespachosActivosEnviados' and pd.id = pdp.despacho_id
		inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
			inner join sispoc5_Banco.PiezasEstados as max on fp.barcode_externo = max.Barcode
			group by max.Barcode
		) as max on max.Barcode = fp.barcode_externo and max.Fecha = pe.Fecha
		
		where
		pd.id = '$DespachosActivosEnviados'
		and 
		(
			pe.Activo is null
			or
			pe.Activo = '1'
		)
		#limit 100
	";
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
					when 1 THEN '29'#FLASH JUJUY
					when 2 THEN '31'#FLASH SANTIAGO
					when 3 THEN '33'#FLASH SALTA
					when 4 THEN '35'#FLASH TUCUMAN
					when 5 THEN '37'#FLASH CATAMARCA
					when 6 THEN '39'#FLASH LA RIOJA
					when 7 THEN '41'#FLASH BUENOS AIRES
					#when 8 THEN '43'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN '45'#FLASH ORAN - SALTA
					when 10 THEN '47'#CENTRO DE DISTRIBUCION
					when 11 THEN '49'#TRAFICO TUCUMAN
					when 12 THEN '51'#FLASH TARTAGAL - SALTA
					else '-1'
                END as 'idEstados'
				from sispoc5_gestionpostal.flash_piezas_despacho as pd
					inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id and pd.id = '$DespachosActivosEnviados'
					inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
					inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
                    inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
                    inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
                    and ( peApp.IdTipoDeEstado = '3' and peApp.MovimientoDeSucursal = '1')
					inner join sispoc5_Banco.Piezas as p on pe.Barcode = concat('CF',p.Tarjeta)
				where
				pd.id = '$DespachosActivosEnviados'
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
					when 1 THEN 'Recibido en Jujuy'#FLASH JUJUY
					when 2 THEN 'Recibido en Santiago del Estero'#FLASH SANTIAGO
					when 3 THEN 'Recibido en Salta'#FLASH SALTA
					when 4 THEN 'Recibido en Tucuman'#FLASH TUCUMAN
					when 5 THEN 'Recibido en Catamarca'#FLASH CATAMARCA
					when 6 THEN 'Recibido en La Rioja'#FLASH LA RIOJA
					when 7 THEN 'Recibido en Buenos Aires'#FLASH BUENOS AIRES
					#when 8 THEN '42'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN 'Recibido en Oran Salta'#FLASH ORAN - SALTA
					when 10 THEN 'Recibido en Centro De Distribucion'#CENTRO DE DISTRIBUCION
					when 11 THEN 'Recibido en Trafico Tucuman'#TRAFICO TUCUMAN
					when 12 THEN 'Recibido en Tartagal Salta'#FLASH TARTAGAL - SALTA
					else 'Recibido en Otra Sucursal'
                END as 'EstadoPieza'
				from sispoc5_gestionpostal.flash_piezas_despacho as pd
					inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id and pd.id = '$DespachosActivosEnviados'
					inner join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					inner join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.origen_id
					inner join sispoc5_gestionpostal.flash_sucursales as fsd on fsd.id = pd.destino_id
					#inner join sispoc5_consultasweb.estados_piezas as pe on fp.barcode_externo = pe.NumeroPieza and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
					
                    inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
                    inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
                    and ( peApp.IdTipoDeEstado = '3' and peApp.MovimientoDeSucursal = '1')
					
					inner join sispoc5_consultasweb.piezas as p on pe.Barcode = p.NumPiezaCorreo
				where
				pd.id = '$DespachosActivosEnviados'
                and 
				(
					pe.Activo is null
					or
					pe.Activo = '1'
				)
			) as fp
			SET 
				piezas.EstadoPieza = fp.EstadoPieza
				,piezas.FechaEstadoPieza = '$currentDateTime'
			WHERE piezas.NumPiezaCorreo = fp.Barcode
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Columnas = array("Pieza Id");
		$Consulta="
			INSERT INTO sispoc5_consultasweb.estados_piezas
			(
				id
				,pieza_id
				,NumeroPieza
				,EstadoPieza
				,idEstados
				,MotivoPieza
				,idMotivo
				,FechaEstadoPieza
				,DatoPieza
				,HDR
			)
				SELECT '' as 'id'
				, cwp.id
				, fp.barcode_externo as 'Barcode'
				,case pd.destino_id
					when 1 THEN 'Recibido en Jujuy'#FLASH JUJUY
					when 2 THEN 'Recibido en Santiago del Estero'#FLASH SANTIAGO
					when 3 THEN 'Recibido en Salta'#FLASH SALTA
					when 4 THEN 'Recibido en Tucuman'#FLASH TUCUMAN
					when 5 THEN 'Recibido en Catamarca'#FLASH CATAMARCA
					when 6 THEN 'Recibido en La Rioja'#FLASH LA RIOJA
					when 7 THEN 'Recibido en Buenos Aires'#FLASH BUENOS AIRES
					#when 8 THEN '42'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN 'Recibido en Oran Salta'#FLASH ORAN - SALTA
					when 10 THEN 'Recibido en Centro De Distribucion'#CENTRO DE DISTRIBUCION
					when 11 THEN 'Recibido en Trafico Tucuman'#TRAFICO TUCUMAN
					when 12 THEN 'Recibido en Tartagal Salta'#FLASH TARTAGAL - SALTA
					else 'Recibido en Otra Sucursal'
                END as 'EstadoPieza'
				,case pd.destino_id
					when 1 THEN '29'#FLASH JUJUY
					when 2 THEN '31'#FLASH SANTIAGO
					when 3 THEN '33'#FLASH SALTA
					when 4 THEN '35'#FLASH TUCUMAN
					when 5 THEN '37'#FLASH CATAMARCA
					when 6 THEN '39'#FLASH LA RIOJA
					when 7 THEN '41'#FLASH BUENOS AIRES
					#when 8 THEN '43'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN '45'#FLASH ORAN - SALTA
					when 10 THEN '47'#CENTRO DE DISTRIBUCION
					when 11 THEN '49'#TRAFICO TUCUMAN
					when 12 THEN '51'#FLASH TARTAGAL - SALTA
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
					inner join sispoc5_consultasweb.piezas as cwp on fp.barcode_externo = cwp.NumPiezaCorreo
                    
                    inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
                    inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
                    and ( peApp.IdTipoDeEstado = '3' and peApp.MovimientoDeSucursal = '1')
                    
					where
					pd.id = '$DespachosActivosEnviados'
                    and 
					(
						pe.Activo is null
						or
						pe.Activo = '1'
					)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
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
				SELECT 
				/*
				'' as 'id'
				,*/
				fp.id as 'Pieza Id'
				, fp.barcode_externo as 'Barcode'
				,'' as 'idVinculo'
				,'' as 'ApellidoNombreRecibio'
				,'' as 'Documento'
				,'$currentDateTime' as 'Fecha'
				,'0' as 'VercionAPP'
				/*
				,'' as 'Latitud'
				,'' as 'Longitud'
				,'' as 'Exactitud'
				,'' as 'Altitud'
				,'' as 'Tipo'
				*/
				,case pd.destino_id
					when 1 THEN '29'#FLASH JUJUY
					when 2 THEN '31'#FLASH SANTIAGO
					when 3 THEN '33'#FLASH SALTA
					when 4 THEN '35'#FLASH TUCUMAN
					when 5 THEN '37'#FLASH CATAMARCA
					when 6 THEN '39'#FLASH LA RIOJA
					when 7 THEN '41'#FLASH BUENOS AIRES
					#when 8 THEN '43'#FLASH SC DE LA SIERRA (BOL)
					when 9 THEN '45'#FLASH ORAN - SALTA
					when 10 THEN '47'#CENTRO DE DISTRIBUCION
					when 11 THEN '49'#TRAFICO TUCUMAN
					when 12 THEN '51'#FLASH TARTAGAL - SALTA
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
                    
                    inner join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode #and (pe.idEstados in ('28','30','32','34','36','38','40','42','44','46','48','50'))
                    inner join sispoc5_Banco.Estados as peApp on pe.idEstados = peApp.Id 
                    and ( peApp.IdTipoDeEstado = '3' and peApp.MovimientoDeSucursal = '1')
                    
					where
					pd.id = '$DespachosActivosEnviados'
                    and 
					(
						pe.Activo is null
						or
						pe.Activo = '1'
					)
		";
		//$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		$ResultadoF = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		$CantidadDePiezasActualizadas = $ClaseMaster->Insertado;
		
		
		
		$Consulta= "#Rutina DespacharDespachoDeBancoMacro Activo = false
			UPDATE sispoc5_Banco.PiezasEstados
			inner join (
			select max.Barcode, max(max.Fecha) as 'Fecha'
				FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
				inner join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = '$DespachosActivosEnviados' and pd.id = pdp.despacho_id
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
			/*
			$RespuestaJsonAjax = functionRespuestaJsonAjax($Consulta),$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			*/
			
			
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		//$RespuestaJsonAjax = functionRespuestaJsonAjax($Piezas,$RespuestaJsonAjax);
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		//
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Piezas No Encontradas Con Ultimo Estado Enviado A Sucursal",$RespuestaJsonAjax);
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
















