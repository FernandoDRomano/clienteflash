<?php
	//echo("Suses");
	//exit;
	function ToASCIITilde($str) { 
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
		//$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
		$b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', ' Lv', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'o', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'ae', 'ae', 'o', 'o');
		return str_replace($a, $b, $str); 
	}
	function StringSize($str,$size,$modo,$Relleno,$LugarDeRelleno,$FinalDeLinea){
		$strT ;
		if(mb_detect_encoding($str, "auto") === "UTF-8"){
			//$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"ASCII");
			$str = ToASCIITilde($str);
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"UTF-8") . $FinalDeLinea ;
		}else{
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,$modo) . $FinalDeLinea ;
		}
		//$strT = $strT . "(".mb_detect_encoding($str, "auto").")";
		return $strT;
	}
	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format($differenceFormat);
	}
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
	if(!function_exists ('InluirPHP')){
		function InluirPHP($PHPFILE,$FILEID){
			if (file_exists($PHPFILE)){
				require_once($PHPFILE);
			}
		}
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
	
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	$Date = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	$time = '0';
	
	/*
	if(session_id() != '') {
		session_destroy();
	}
	session_start([
			'cookie_lifetime' => 86400,
			'read_and_close'  => true,
	]);
	*/
	$_SESSION['logged_in'] = TRUE;
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	
	
	$FechaIFPN = issetornull('FechaI');
	$FechaFFPN = issetornull('FechaF');
	
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
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$HoraInicial = $ClaseMaster->ArraydResultados[0][0];
		
	}else{
		exit;
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
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	//echo($FechaI . " " . $FechaF);exit;
	//$DiferenciaHoraria
	
	$Columnas = array("Contador");
	$Consulta= "
		select count(distinct(TU.Contador)) as 'Contador'
		#select  distinct(TU.Contador) as 'Contador', TU.Pieza as 'Pieza' , TU.barcode as 'barcode', TU.CDI as 'Comprobante De Ingreso', TU.CDC as 'Creacion De Comprobante', TU.Cliente as 'Cliente'
		#, Banco.Sucursal as 'Sucursal'
		#, GROUP_CONCAT( DISTINCT concat(Sucursales.Numero, '-', Sucursales.Nombre) separator ' , ') as 'Sucursales'
		from
		(
            select distinct(fp.id) as 'Contador', fp.id as 'Pieza' , fp.barcode_externo as 'barcode', ci.numero as 'CDI', ci.create as 'CDC', clientes.nombre as 'Cliente'
			#select distinct(fp.barcode_externo) as id
			from 
			(
				select pe.*
				FROM
				(
					select pe.*
					FROM
					(
						select * 
						from sispoc5_Ocasa.Piezas_Estados as pe 
						where pe.Activo = '1'
						order by pe.id desc
					)as pe
					group by pe.idPieza
				)as pe
			)as pe
			inner join sispoc5_gestionpostal.flash_piezas as fp on pe.idPieza = fp.id
			inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
			inner join sispoc5_gestionpostal.flash_clientes as clientes on ci.cliente_id = clientes.id and clientes.id = 30
			
			where fp.tipo_id = 2
			and ci.cliente_id = '30'
			and pe.Activo = '1'
			and pe.idEstados in ('1', '13') #8 TARJETAS ENTREGADAS ,#0 SOLICITADAS POR EL CLIENTE (RECUPEROS) #6 Domicilio Insuficiente #14 Se Mudó #15 Se Niega A Recibir #16 Segunda visita No Entregado
			#and fp.create >  DATE_ADD('2020-02-01', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('2020-02-03', INTERVAL 0 HOUR)
			and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
			
			union
			
            #Piezas En Sispo Que no Estan Con Estados Ni Aceptadas Por Carteros
			select distinct(fp.id) as 'Contador', fp.id as 'Pieza' , fp.barcode_externo as 'barcode', ci.numero as 'CDI', ci.create as 'CDC', clientes.nombre as 'Cliente'
			#select distinct(fp.barcode_externo) as id #SELECT distinct(fp.id) as 'id'
			FROM sispoc5_gestionpostal.flash_piezas as fp
			inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
			inner join sispoc5_gestionpostal.flash_clientes as clientes on ci.cliente_id = clientes.id and clientes.id = 30
			inner join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
            left join 
			(
				select pe.*
				FROM
				(
					select pe.*
					FROM
					(
						select * 
						from sispoc5_Ocasa.Piezas_Estados as pe 
						where pe.Activo = '1'
						order by pe.id desc
					)as pe
					group by pe.idPieza
				)as pe
			)as NOTPE on PSPP.Barcode = NOTPE.BarcodeExterno
			
			where 
			(NOTPE.id is null 
				or 
				(
					(PSPP.FechaDeEstado > DATE_ADD(NOTPE.Fecha, INTERVAL 0 HOUR) and NOTPE.Activo = '1' )
					#(PSPP.FechaDeEstado > DATE_ADD(NOTPE.Fecha, INTERVAL $DiferenciaHoraria HOUR) and NOTPE.Activo = '1' )
					and
					NOTPE.idEstados in ('1','13')
				)
			)
			and ci.cliente_id = '30'
			and fp.tipo_id = 2
			#and fp.create >  DATE_ADD('2020-02-01', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('2020-02-03', INTERVAL 0 HOUR)
			and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
			
			union
			
            select distinct(fp.id) as 'Contador', fp.id as 'Pieza' , fp.barcode_externo as 'barcode', ci.numero as 'CDI', ci.create as 'CDC', clientes.nombre as 'Cliente'
			#select distinct(fp.id) as 'Contador'
			from
            (
            	select fp.id as 'id' , fp.barcode_externo as 'barcode_externo', fp.tipo_id as 'tipo_id', fp.create as 'create', fp.comprobante_ingreso_id as 'comprobante_ingreso_id'
                from sispoc5_gestionpostal.flash_piezas as fp
                inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on ci.cliente_id = 30 and fp.comprobante_ingreso_id = ci.id
                inner join sispoc5_gestionpostal.flash_clientes as clientes on ci.cliente_id = clientes.id and clientes.id = 30
                where fp.tipo_id = 2
                and ci.cliente_id = '30'
            
            ) as fp
			inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
			inner join sispoc5_gestionpostal.flash_clientes as clientes on ci.cliente_id = clientes.id and clientes.id = 30
			left join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
			left join sispoc5_Ocasa.Piezas_Estados as pe on pe.idPieza = fp.id
			where fp.tipo_id = 2
			and ci.cliente_id = '30'
			and PSPP.id is null
			and pe.id is null
			#and fp.create >  DATE_ADD('2020-02-01', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('2020-02-03', INTERVAL 0 HOUR)
			and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
        ) as TU
        inner join 
        (
        	select concat('cf',Banco.Tarjeta) as 'Tarjeta', Banco.CodigoDeSucursal as 'Sucursal'
        	from sispoc5_Banco.tarjetasDeDebito as Banco 
        	where 1
       		#Banco.CodigoDeSucursal is not null
        	
        	UNION
        	
        	select concat('cf',Banco.SecuenciaDeTargeta) as 'Tarjeta', Banco.SucursalDeRadicacionDeLaCuenta as 'Sucursal'
        	from sispoc5_Banco.TarjetasSinChipEMV as Banco 
        	where 1
        	#Banco.SucursalDeRadicacionDeLaCuenta is not null
        	
        	UNION
        	select concat('cf',Banco.NumeroDeTarjeta) as 'Tarjeta', Banco.CodigoDeLaSucursal as 'Sucursal'
        	from sispoc5_Banco.TarjetasImpresas as Banco 
        	where 1
        	#Banco.CodigoDeLaSucursal is not null
			
        ) as Banco on TU.barcode = Banco.Tarjeta
        left join sispoc5_Banco.sucursales as Sucursales on Banco.Sucursal = Sucursales.Numero
		where Banco.Sucursal is not null
		and (Sucursales.Region like '%%' or Sucursales.Region is null)
		and (Sucursales.Numero >= '0' or Sucursales.Numero is null)
        #group by TU.barcode,Sucursales.Nombre
		#ORDER BY TU.barcode ASC
	";
	//echo($Consulta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		/*
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("|");}
			echo($Columnas[$cont]);
		}
		echo(";");
		*/
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("".$resultado);
						}else{
							if($Columnas[0]=="PieceNumber"){
								echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}else{
								echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("|"."");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("|".$resultado);
						}else{
							echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
		}
	}
?>













