<?php
	header("Access-Control-Allow-Origin: *");
	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);
	function ColumaEnArrayAArray($Arg = ",",$ArraydStr,$Columna){
		$Tstr = array();
		for($i = 0;$i<count($ArraydStr);$i++){
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
	//InluirPHP('../clases/ClaseMaster.php','1');
	//Tendria Que Entrar Por Config.php	
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	require('../FuncionesHorarias.php');
	$horaPasada = date("Y-m-d H:i:s", strtotime('2020-02-25 00:00:00'));
	$HoraBusqueda = date('Y-m-d H:i:s', strtotime($horaPasada. $DiferenciaHoraria));
	$ComprobantesDeIngreso = issetornull('ComprobantesDeIngreso');
	$Error=[];
	$Columnas = array("Pieza Id");
	$Consulta= "#BaseDeControlPostal 1 Banco Fisico Recibido
		INSERT INTO sispoc5_Banco.PiezasEstados
		(idPieza, Cliente, HDR, Barcode, idEstados, Fecha, Tipo, Activo)
			select p.idp, '30', '', p.TarjetaCF, '2', p.fpFecha , 'sql IngresoLogicoDesdeCIBancoMacro', true
			FROM (
				select p.*, bp.FechaDeCargaSistemaFlash as 'MiFecha'
				FROM (
					select p.*, concat('CF',p.Tarjeta) as TarjetaCF, fp.create as 'fpFecha',fp.id as 'idp'
					#FROM sispoc5_Banco.Piezas as p
					FROM sispoc5_gestionpostal.flash_comprobantes_ingresos as ci 
					inner join sispoc5_gestionpostal.flash_piezas as fp on ci.id = '$ComprobantesDeIngreso' and fp.comprobante_ingreso_id = ci.id
					inner join sispoc5_Banco.Piezas as p on fp.barcode_externo = concat('cf',p.Tarjeta)
				) as p
				inner join sispoc5_Banco.Piezas as bp on p.Tarjeta = bp.Tarjeta
				left join (
					select epw.idEstados as 'EstadoPieza' , epw.Barcode as 'NumeroPieza', epw.id as 'id'
					from sispoc5_Banco.PiezasEstados as epw
				) as epw on ( p.TarjetaCF = epw.NumeroPieza and( epw.EstadoPieza = '2'))
				where epw.id is null
				group by p.Tarjeta
				ORDER by bp.Id
			) as p
			inner join sispoc5_Banco.Marcas as m on p.IdMarca = m.id
			inner join sispoc5_Banco.Destino as d on p.IdDestino = d.id
			inner join sispoc5_Banco.PiezasTipo as TipoTarjeta on p.Tipo = TipoTarjeta.id
			group by p.Tarjeta
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	if($ClaseMaster->Insertado == 0){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("<p><b>Las Piezas Ya tienen El Estado En Banco</p>",$RespuestaJsonAjax);
		//85134300
		//$Error=['Error' => 'Las Piezas Ya tienen El Estado'];
	}
	
	$Consulta= "#BaseDeControlPostal 2 consultasweb Logico Recibido
		#Rutina 2
		INSERT INTO sispoc5_consultasweb.estados_piezas
		(pieza_id, NumeroPieza, EstadoPieza, idEstados, MotivoPieza, idMotivo, FechaEstadoPieza, HDR)
		select '0', p.TarjetaCF, 'Lógico Recibido' , '1', d.Nombre, d.id, p.MiFecha, ''
		FROM (
			select p.*, bp.FechaDeCargaSistemaFlash as 'MiFecha'
			FROM (
				select p.*, concat('CF',p.Tarjeta) as TarjetaCF
				#FROM sispoc5_Banco.Piezas as p
				FROM sispoc5_gestionpostal.flash_comprobantes_ingresos as ci 
				inner join sispoc5_gestionpostal.flash_piezas as fp on ci.id = '$ComprobantesDeIngreso' and fp.comprobante_ingreso_id = ci.id
				inner join sispoc5_Banco.Piezas as p on fp.barcode_externo = concat('cf',p.Tarjeta)
				#limit 1000,100000
			) as p
			inner join sispoc5_Banco.Piezas as bp on p.Tarjeta = bp.Tarjeta
			left join (
				select epw.EstadoPieza as 'EstadoPieza' , epw.NumeroPieza as 'NumeroPieza', epw.id as 'id'
				from sispoc5_consultasweb.estados_piezas as epw
			) as epw on ( p.TarjetaCF = epw.NumeroPieza and( epw.EstadoPieza = 'Lógico Recibido'))
			where epw.id is null
			group by p.Tarjeta
			ORDER by bp.Id
			#limit 1
		) as p
		inner join sispoc5_Banco.Marcas as m on p.IdMarca = m.id
		inner join sispoc5_Banco.Destino as d on p.IdDestino = d.id
		inner join sispoc5_Banco.PiezasTipo as TipoTarjeta on p.Tipo = TipoTarjeta.id
		group by p.Tarjeta
		ORDER by p.id
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	if($ClaseMaster->Insertado == 0){
		//$Error[]={"Error":"Las Piezas Ya tienen El Estado "};
	}
		$Consulta= "#BaseDeControlPostal 3 consultasweb Fisico Recibido
		INSERT INTO sispoc5_consultasweb.estados_piezas 
		(pieza_id, NumeroPieza, EstadoPieza, idEstados, MotivoPieza, idMotivo, FechaEstadoPieza, HDR)
		select '0', p.TarjetaCF, 'Aceptada En Distribuidora' , '2', d.Nombre, d.id, p.fpFecha, p.hoja_ruta_id
		FROM (
			select p.*, fp.create as 'MiFecha', fp.hoja_ruta_id as 'hoja_ruta_id'
			FROM (
				select p.*, concat('CF',p.Tarjeta) as TarjetaCF, fp.create as 'fpFecha'
				#FROM sispoc5_Banco.Piezas as p
				FROM sispoc5_gestionpostal.flash_comprobantes_ingresos as ci 
				inner join sispoc5_gestionpostal.flash_piezas as fp on ci.id = '$ComprobantesDeIngreso' and fp.comprobante_ingreso_id = ci.id
				inner join sispoc5_Banco.Piezas as p on fp.barcode_externo = concat('cf',p.Tarjeta)
			) as p
			inner join sispoc5_gestionpostal.flash_piezas as fp on p.TarjetaCF = fp.barcode_externo
			left join (
				select epw.EstadoPieza as 'EstadoPieza' , epw.NumeroPieza as 'NumeroPieza', epw.id as 'id'
				from sispoc5_consultasweb.estados_piezas as epw
			) as epw on ( p.TarjetaCF = epw.NumeroPieza and( epw.EstadoPieza = 'Aceptada En Distribuidora'))
			where epw.id is null
			group by p.Tarjeta
			ORDER by fp.id
			#limit 1000
		) as p
		inner join sispoc5_Banco.Marcas as m on p.IdMarca = m.id
		inner join sispoc5_Banco.Destino as d on p.IdDestino = d.id
		inner join sispoc5_Banco.PiezasTipo as TipoTarjeta on p.Tipo = TipoTarjeta.id
		group by p.Tarjeta
		ORDER by p.id
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	if($ClaseMaster->Insertado == 0){
		//$Error=['Error' => 'Las Piezas Ya tienen El Estado'];
		$RespuestaJsonAjax = functionRespuestaJsonAjax("<p><b>Las Piezas Ya tienen El Estado En consultasweb</p>",$RespuestaJsonAjax);//85134300
	}	
	$Consulta= "#BaseDeControlPostal 4 consultasweb pieza_id
		UPDATE sispoc5_consultasweb.estados_piezas as ep
		inner join (
			select p.*
			from  (
				select ep.* from sispoc5_consultasweb.estados_piezas as ep
				WHERE ep.pieza_id = 0 or ep.pieza_id is null
				order by ep.id desc
				#LIMIT 1000
			) as ep
			inner join sispoc5_consultasweb.piezas as p on ep.NumeroPieza = p.NumPiezaCorreo
		) as p  on ep.NumeroPieza = p.NumPiezaCorreo
		SET ep.pieza_id = p.id
		WHERE ep.pieza_id = 0 or ep.pieza_id is null
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	
	if($ClaseMaster->Insertado > 0){
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Ultimo Estado Insertado:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Estados De Piezas Ingresada Fisicamente:",$RespuestaJsonAjax);//85134300	
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Estados De Piezas No Ingresadas",$RespuestaJsonAjax);
		//$RespuestaJsonAjax = functionRespuestaJsonAjax($Error,$RespuestaJsonAjax);
		//$RespuestaJsonAjax = json_encode($Error);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);

		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
		exit;
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	exit;
?>