<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit','9999M');
error_reporting(E_ALL);

	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=reporte.csv");
	// header("Content-type: text/plain");  // comentar arriba y descomentar esto para hacer debug y hacer echo "xxx"
	// header("Content-Disposition: attachment; filename=reporte.txt");

	//echo("<p>" .date_default_timezone_get() . "</p>");
	$default_timezone = date_default_timezone_get();
	$HoraInicial = date("Y-m-d H:i:s", time());
	//echo($HoraInicial);
	//exit;
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	//echo("<p>" .date_default_timezone_get() . "</p>");
	$HoraFinal = date("Y-m-d H:i:s", time());
	//echo($HoraInicial);
	//echo($HoraFinal);
	$file_ticket = 'UploadConfirmed.ticket.txt';
	
	function StrToHTML($str) { 
		$a = array('&quot;');
		$b = array(' ');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		return str_replace($a, $b, $str); 
	}
	
	function SQLServerScape($str){ 
		$a = array('[','!','"','#','$','%','&','/','(',')','=',',','.',';',':','_','-','{','}','´','\'');
		$b = array('[[]','[!]','["]','[#]','[$]','[%]','[&]','[/]','[(]','[)]','[=]','[,]','[.]','[;]','[:]','[_]','[-]','[{]','[}]','[´]',"''");
		$str = str_replace($a, $b, $str);
		return $str;
	}
	
	function BCFOROCASA($str){ 
		$a = array('\'');
		$b = array('-');
		$str = str_replace($a, $b, $str);
		return $str;
	}

	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}

	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format($differenceFormat);
	}

	$db = new mysqli('sispo.com.ar', 'sispoc5_RubenGF', 'RGF32601828Ruben', 'sispoc5_zonificacion');
	if ($db->connect_errno) {
		echo "Conexión fallida: %s\n" .  $db->connect_error;
		die();
	}
	mysqli_select_db($db, 'sispoc5_zonificacion');
	$dbSppFlash = new mysqli('sppflash.com.ar', 'sppfla5_zonif', 'sispoZonificacion2017', 'sppfla5_solicitud');
	if ($dbSppFlash->connect_errno) {
		echo "Conexión fallida: %s\n" .  $dbSppFlash->connect_error;
		die();
	}
	mysqli_select_db($dbSppFlash, 'sppfla5_solicitud');

	$UserId				= $_REQUEST['UserId'];
	$Documento 			= $_REQUEST['Documento'];
	$ApellidoYNombre 	= $_REQUEST['ApellidoYNombre'];
	$FechaDesde 		= $_REQUEST['FechaDesde'];
	$FechaHasta 		= $_REQUEST['FechaHasta'];
	$BarcodeExterno 	= $_REQUEST['BarcodeExterno'];

	// echo "Desde:{$FechaDesde} Hasta:{$FechaHasta} Ñato:'{$ApellidoYNombre}' Patente:{$Documento} #:{$BarcodeExterno}" . PHP_EOL;

	$FechaIFPN = issetornull('FechaDesde');
	$FechaFFPN = issetornull('FechaHasta');
	// echo $FechaIFPN . PHP_EOL;
	// echo $FechaFFPN . PHP_EOL;
	
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	$FechaF = issetornull('FechaF');
	$FechaF = str_replace('/', '-', $FechaF).':00';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);
	$DiaYMes = '-' . substr($FechaF,8, 2) . '-' . substr($FechaF,5, 2);

	$Columnas = array("Hora");
	$Consulta= "
		SELECT CURRENT_TIMESTAMP() as 'Hora'
	";
	$Resultado = $db->query($Consulta);
	if($db->error){
		echo("SQLERROR:" . $db->error . PHP_EOL);
		print_r($db);
		print_r($SQLquery);
		die();
	}
	$res = []; $i = 0;
	while($fila = mysqli_fetch_assoc($Resultado))
		for($cont=0;$cont<count($Columnas);$cont++)
			$res[$i++][$cont]=$fila[$Columnas[$cont]];
	if($res){
		$HoraInicial = $res[0][0];
	}else{
		echo "# Error al obtener HoraInicial #" . PHP_EOL;
		die();
	}

	$HoraInicial = date('Y-m-d H:i:s', strtotime($HoraInicial . ' - 5 minutes'));
	$DiferenciaHoraria = dateDifference($HoraInicial,$HoraFinal,"%h");
	date_default_timezone_set($default_timezone);
	
	$FechaISpp = date('Y-m-d H:i:s', strtotime($FechaI));
	$FechaFSpp = date('Y-m-d H:i:s', strtotime($FechaF));
	
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	
	
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	$FechaF = issetornull('FechaF');
	$FechaF = str_replace('/', '-', $FechaF).':00';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);
	/*
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	*/
	$FechaIServer = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaFServer = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	//echo($FechaI . " " . $FechaF);exit;
	//$DiferenciaHoraria
	
	$Desde = $FechaIFPN; // $FechaI;
	$Hasta = $FechaFFPN; //$FechaF;      // Instala la librería Carbon\Carbon para manejar fechas y horas , calendario etc,
	$Desde = new DateTime(substr($Desde,6,4) . '-' . substr($Desde,3,2) . '-' . substr($Desde,0,2) . substr($Desde,10));
	$Desde = $Desde->format('Y-m-d H:i:s');
	$Hasta = new DateTime(substr($Hasta,6,4) . '-' . substr($Hasta,3,2) . '-' . substr($Hasta,0,2) . substr($Hasta,10));
	$Hasta = $Hasta->format('Y-m-d H:i:s');
	// echo $Desde . PHP_EOL;
	// echo $Hasta . PHP_EOL;

	$Destinatario = $ApellidoYNombre;
	$DNIBusqueda = $Documento;
	$NumeroDePieza = $BarcodeExterno;

	$UserId = issetornull('UserId');

	$Columnas = array("ClienteId");
	$Consulta = "
		SELECT cfc.SispoId as 'ClienteId'
		from sispoc5_correoflash.cliente  as cfc
		where cfc.Id = '$UserId'
    ";
	$Resultado = $db->query($Consulta);
	if($db->error){
		echo("SQLERROR:" . $db->error . PHP_EOL);
		print_r($db);
		print_r($SQLquery);
		die();
	}
	$res = []; $i = 0;
	while($fila = mysqli_fetch_assoc($Resultado)){
		for($cont=0;$cont<count($Columnas);$cont++)
			$res[$i++][$cont]=$fila[$Columnas[$cont]];
	}
	if($res){
		$UserId = $res[0][0];
	}else{
		echo "# Error al obtener UserId #" . PHP_EOL;
		die();
	}
	
	$Columnas = array("Fecha Ingreso","Identificador","Numero De Pieza","Servicio","Destinatario","DNI"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos","Dirección de Entrega","Apellido Nombre Recibio","Vinculo Con Destinatario","FotoEnCalle","FotoHD","datos_varios_3"
	);
	$Consulta = "
		
		SELECT
		pe.idPieza as 'Identificador'
		,pe.BarcodeExterno as 'Id'
		,pe.BarcodeExterno as 'Numero De Pieza'


	
	
		,case 
			when pe.datos_varios_3 not like ''
			then pe.datos_varios_3
			else Piezas.datos_varios_3
			end as 'datos_varios_3'
		
		,case 
			when pe.Sub > '1'
			then pe.destinatario
			else Piezas.destinatario
			end as 'Destinatario'
			
		,case 
			when pe.Sub > '1'
			then pe.Domicilio
			else Piezas.domicilio
			end as 'Dirección de Entrega'
			
		,case 
			when pe.Sub > '1'
			then pe.CodigoPostal
			else Piezas.codigo_postal
			end as 'Codigo_postal'
		
		,case 
			when pe.Sub > '1'
			then pe.Localidad
			else Piezas.localidad
			end as 'Localidad'
		
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Logico Recibido'
			WHEN 'Fisico' THEN 'Fisico Recibido'
			WHEN '0' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		,pe.Estados as 'Estados Historicos'
		,Piezas.documento as 'DNI'
        ,'Domicilio' as 'Destino'
		,case 
			when pe.Sub > '1'
			then 'Sin Ingreso Fisico'
			else Piezas.create
			end as 'Fecha Ingreso'
		,case 
			when pe.Sub > '1'
			then pe.Servicio
			else fs.nombre
			end as 'Servicio'
        ,$UserId
        ,DATE_ADD(pe.Fecha, INTERVAL 0 HOUR) as 'Fecha De Estado'
		, CASE pe.idEstados
			WHEN '8' THEN pe.ApellidoNombreRecibio
			ELSE ''
		END as 'Apellido Nombre Recibio'
		, CASE pe.idEstados
			WHEN '8' THEN VD.Nombre
			ELSE ''
		END as 'Vinculo Con Destinatario'
		,CASE 
			WHEN pe.FotoAndroid not like '' THEN concat('', pe.FotoAndroid)#http://sispo.com.ar/zonificacion/Android/Acusses/
			ELSE ''
		END as 'FotoEnCalle'
		,CASE 
			WHEN pe.FotoEscaner not like '' THEN concat('', pe.FotoEscaner)#http://sispo.com.ar/clienteflash/XMLHttpRequest/EstadosManuales/uploads/
			ELSE ''
		END as 'FotoHD'
		FROM 
		(
			select count(pe.id) as 'Estados', pe.* 
            from 
            (
				
                select *
				from
				(
				select pe.idVinculo as 'idVinculo'
				, Piezas.destinatario as 'Destinatario'
				, '' as 'CodigoPostal'
				, '' as 'Localidad'
				, '' as 'Domicilio'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
				, '1' as 'Sub'
				, '' as 'Servicio'
				,CASE 
					WHEN pe.FotoDeAcuse not like ''
						THEN pe.FotoDeAcuse
					ELSE ''
				END as 'FotoAndroid'
				,CASE 
					WHEN pe.FotoDeAcuseWeb not like '' 
						THEN pe.FotoDeAcuseWeb
					ELSE ''
				END as 'FotoEscaner'
			    ,Piezas.datos_varios_3 as 'datos_varios_3'
                from sispoc5_Ocasa.Piezas_Estados as pe
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on pe.idPieza = Piezas.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on ci.cliente_id = '$UserId' and  Piezas.comprobante_ingreso_id = ci.id
				where (pe.BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (Piezas.destinatario like '%$Destinatario%' or '$Destinatario' = '')
				order by pe.Fecha desc
                ) as pe
				
				union
                
				select
				'0' as 'idVinculo'
				, PI.Destinatario as 'Destinatario'
				, PI.CodigoPostal as 'CodigoPostal'
				, PI.Localidad as 'Localidad'
				, PI.Domicilio as 'Domicilio'
				, '0' as 'id'
				, 'Fisico' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, PI.Barra as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				, '1' as 'Sub'
				, fsSegundo.nombre as 'Servicio'
	            ,Piezas.datos_varios_3 as 'datos_varios_3'
				, '' as 'FotoAndroid'
				, '' as 'FotoEscaner'
				from sispoc5_Ocasa.PiezasIngresadas as PI
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on PI.PiezaId = Piezas.id and PI.ClienteId = '$UserId'
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as cis on cis.id = PI.ServicioId
				inner JOIN sispoc5_gestionpostal.flash_servicios as fsSegundo on cis.servicio_id = fsSegundo.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                and ci.cliente_id = '$UserId'
                where 1
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (PI.destinatario like '%$Destinatario%' or '$Destinatario' = '')
                and PI.EstadoDeIngreso = '2'
				and  (PI.Barra like '$NumeroDePieza%' or '$NumeroDePieza' = '')

				union
                
				select
				  '0' as 'idVinculo'
				, PI.Destinatario as 'Destinatario'
		        ,Piezas.datos_varios_3 as 'datos_varios_3'
				, PI.CodigoPostal as 'CodigoPostal'
				, PI.Localidad as 'Localidad'
				, PI.Domicilio as 'Domicilio'
				, '0' as 'id'
				, 'x01' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, PI.Barra as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				, '2' as 'Sub'
				, fsSegundo.nombre as 'Servicio'
				, '' as 'FotoAndroid'
				, '' as 'FotoEscaner'
				from sispoc5_Ocasa.PiezasIngresadas as PI
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on PI.PiezaId = Piezas.id and PI.ClienteId = '$UserId'
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as cis on cis.id = PI.ServicioId
				inner JOIN sispoc5_gestionpostal.flash_servicios as fsSegundo on cis.servicio_id = fsSegundo.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                and ci.cliente_id = '$UserId'
                where 1
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (PI.destinatario like '%$Destinatario%' or '$Destinatario' = '')
                and PI.EstadoDeIngreso = '1'
				and  (PI.Barra like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				
				union 
				 
                select	
				
			    
		        pe.idVinculo as 'idVinculo'
				, Piezas.destinatario as 'Destinatario'
			    ,Piezas.datos_varios_3 as 'datos_varios_3'
				, '' as 'CodigoPostal'
				, '' as 'Localidad'
				, '' as 'Domicilio'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
				, '1' as 'Sub'
				, '' as 'Servicio'
				,CASE 
					WHEN pe.FotoDeAcuse not like ''
						THEN pe.FotoDeAcuse
					ELSE ''
				END as 'FotoAndroid'
				,CASE 
					WHEN pe.FotoDeAcuseWeb not like '' 
						THEN pe.FotoDeAcuseWeb
					ELSE ''
				END as 'FotoEscaner'
 				
 		
				from sispoc5_gestionpostal.flash_piezas as Piezas 
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id 
                inner join sispoc5_gestionpostal.flash_clientes as fcr on $UserId = fcr.id 
                inner join sispoc5_Ocasa.Piezas_Estados as pe on pe.idPieza = Piezas.id
				where (Piezas.datos_varios_3 = fcr.nombre_fantasia) and (ci.cliente_id = '1795') 
			
            )as pe 
	        GROUP by pe.idPieza, pe.id
			order by pe.Fecha desc
		)as pe 
		
		
        inner join sispoc5_gestionpostal.flash_piezas as Piezas on Piezas.id = pe.idPieza
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
        inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id
        inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as fcis on Piezas.servicio_id = fcis.id
        inner JOIN sispoc5_gestionpostal.flash_servicios as fs on fcis.servicio_id = fs.id
		
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		inner join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		
		WHERE
		
		(fc.id = '$UserId' or fc.id is null or fc.id = '1795')
		and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '' or pe.Sub = '2' or pe.Sub = '3')
		and ('$Destinatario' = '' or Piezas.destinatario like '%$Destinatario%' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')

		group by pe.idPieza , pe.BarcodeExterno
		order by pe.idPieza, pe.Fecha desc
		limit 10000
    "; 	// pq limit 10000 ???? si se ejecuta bajo ajax ?????
		// debería paginarse bajo ajax:  https://www.jose-aguilar.com/blog/paginacion-jquery-ajax-php/
		// consultar y guardar las paginas que estas mostrando
		
		// deberías buscar una librería que haga eso
		// en Laravel la mejor es yajra/laravel-datatables-oracle   
		// la unica doc en español que encontré es vieja: https://laraveles.com/implementacion-datatables-laravel-5-4/

	// $Resultado = $db->query($Consult	a);
	$res = [];
	if ($resultado = $db->query($Consulta)) {
		if($db->error){
			echo("SQLERROR:" . $db->error . PHP_EOL);
			die();
		}
		while ($fila = $resultado->fetch_assoc()) {
			//printf ("%s (%s)\n", $fila["Name"], $fila["CountryCode"]);
			$res[] = $fila;
		}
		/* liberar el conjunto de resultados */
		$resultado->free();
	}
	$res_final = [];
	$max_estados = 0;
	if($res){
		foreach($res as $fila){
			// print_r($fila);
			$IdPieza = $fila["Identificador"];
			// echo $IdPieza . PHP_EOL;
			$Columnas = array("Estado","Fecha De Estado");//"idEstado",
			$Consulta= "
				SELECT Piezas.id as 'Id'
				,Piezas.barcode_externo as 'Numero De Pieza'
				,case
					when pe.Sub > 1
					then pe.Destinatario
					else Piezas.destinatario
				end as 'Destinatario'
				,case
					when pe.Sub > 1
					then pe.DNI
					else Piezas.documento
				end as 'DNI'
				,case
					when pe.Sub > 1
					then pe.Domicilio
					else Piezas.domicilio
				end as 'Domicilio'
				,case
					when pe.Sub > 1
					then pe.CodigoPostal
					else Piezas.codigo_postal
				end as 'Codigo_postal'
				,case
					when pe.Sub > 1
					then pe.Localidad
					else Piezas.localidad
				end as 'Localidad'
				
				,CASE pe.idEstados
					WHEN 'X01' THEN 'Logico Recibido'
					WHEN 'Fisico' THEN 'Fisico Recibido'
					WHEN '0' THEN 'Hoja De Ruta Aceptada Por Catero'
					ELSE EE.NombreAPP
				END as 'Estado'
				
				,'Domicilio' as 'Destino'
				,DATE_ADD(pe.Fecha, INTERVAL 0 HOUR) as 'Fecha De Estado'
				, pe.idPieza as 'idPieza'
				FROM (
					select 
					pe.idVinculo as 'idVinculo'
					, pe.idEstados as 'idEstados'
					, pe.idPieza as 'idPieza'
					, DATE_ADD(pe.Fecha, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
					, '' as 'Destinatario'
					, '' as 'DNI'
					, '' as 'Domicilio'
					, '' as 'CodigoPostal'
					, '' as 'Localidad'
					, '1' as 'Sub'
					, pe.BarcodeExterno as 'barra'
					from sispoc5_Ocasa.Piezas_Estados as pe
					where pe.idPieza = '$IdPieza'

					union

					select
					'0' as 'idVinculo'
					, 'Fisico' as 'idEstados'
					, Piezas.id as 'idPieza'
					, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
					, PI.Destinatario as 'Destinatario'
					, '' as 'DNI'
					, PI.Domicilio as 'Domicilio'
					, PI.CodigoPostal as 'CodigoPostal'
					, PI.Localidad as 'Localidad'
					, '3' as 'Sub'
					, PI.Barra as 'barra'
					from sispoc5_Ocasa.PiezasIngresadas as PI
					inner join sispoc5_gestionpostal.flash_piezas as Piezas on Piezas.id = PI.PiezaId
					where Piezas.id = '$IdPieza'
					and PI.EstadoDeIngreso = '2'
					
					union

					select
					'0' as 'idVinculo'
					, 'x01' as 'idEstados'
					, Piezas.id as 'idPieza'
					, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
					, PI.Destinatario as 'Destinatario'
					, '' as 'DNI'
					, PI.Domicilio as 'Domicilio'
					, PI.CodigoPostal as 'CodigoPostal'
					, PI.Localidad as 'Localidad'
					, '2' as 'Sub'
					, PI.Barra as 'barra'
					from sispoc5_Ocasa.PiezasIngresadas as PI
					inner join sispoc5_gestionpostal.flash_piezas as Piezas on Piezas.id = PI.PiezaId
					where Piezas.id = '$IdPieza'
					and PI.EstadoDeIngreso = '1'
					
				) as pe
				left join sispoc5_gestionpostal.flash_piezas as Piezas on Piezas.id = pe.idPieza
				left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
				left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
				WHERE 1 
				and (Piezas.id = '$IdPieza' )
				order by Piezas.id, pe.Fecha
			";
			$fila["estados"] = [];
			if ($resultado2 = $db->query($Consulta)) {
				if($db->error){
					echo("SQLERROR:" . $db->error . PHP_EOL);
					die();
				}
				$i = 1;
				while ($fila2 = $resultado2->fetch_assoc()) {
					if( $i > $max_estados )
						$max_estados = $i;
					$fila["estados"][] = $fila2;
					$i++;
				}
				$resultado2->free();
			}
			$res_final[] = $fila;
		}
		// print_r($res_final);

		echo "Identificador|Fecha Ingreso|Numero De Pieza|Destinatario|Estado|Fecha De Estado|";
		$detalle_estados = [];
		foreach(range(1,$max_estados) as $i)
			 $detalle_estados [] = "Estado {$i}|Fecha De Estado {$i}";
		echo implode('|', $detalle_estados) . PHP_EOL;

		foreach($res_final as $reg){
			$dt1 = new DateTime($reg["Fecha Ingreso"]);
			$dt2 = new DateTime($Hasta);
			// echo $dt1->format('Y-m-d H:i:s') . ' -> ' .  $dt2->format('Y-m-d H:i:s') . PHP_EOL;
			if($dt1 > $dt2) break;
			echo implode('|', [
				$reg["Identificador"], 
				$reg["Fecha Ingreso"], 
				$reg["Numero De Pieza"], 
				$reg["Destinatario"], 
				$reg["Estado"], 
				$reg["Fecha De Estado"]
			]) . '|';
			$reg_estados = [];
			foreach($reg["estados"] as $reg_estado)
				$reg_estados [] = $reg_estado["Estado"] . "|" . $reg_estado["Fecha De Estado"];
			echo implode('|', $reg_estados) . PHP_EOL;
		}

	}

?>