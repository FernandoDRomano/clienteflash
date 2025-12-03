<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('memory_limit','9999M');
    error_reporting(E_ALL);
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=reporte.csv");
	
	$default_timezone = date_default_timezone_get();
	$HoraInicial = date("Y-m-d H:i:s", time());
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$HoraFinal = date("Y-m-d H:i:s", time());
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
	$FechaIFPN = issetornull('FechaDesde');
	$FechaFFPN = issetornull('FechaHasta');
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
	$FechaIServer = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaFServer = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	$Desde = $FechaIFPN;
	$Hasta = $FechaFFPN;
	$Desde = new DateTime(substr($Desde,6,4) . '-' . substr($Desde,3,2) . '-' . substr($Desde,0,2) . substr($Desde,10));
	$Desde = $Desde->format('Y-m-d H:i:s');
	$Hasta = new DateTime(substr($Hasta,6,4) . '-' . substr($Hasta,3,2) . '-' . substr($Hasta,0,2) . substr($Hasta,10));
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
	
	
	
	$Columnas = array("Barcode","FechaDeEstado","idEstado","idPieza","id"
	,"NombreDeEstado","UltimoEstado","FechaDeUltimoEstado","NombreDeUltimoEstado","Sucursal"
	,"Destinatario","Direccion de entrega","Cp","Localidad",'documento'
	,'recibio','Vinculo','FotoDeAcuse'
	);

	$Consulta = "SELECT 
            pe.BarcodeExterno as 'Barcode'
            , pe.Fecha as 'FechaDeEstado'
            , pe.idEstados as 'idEstado'
            , pe.idPieza as 'idPieza'
            , fp.id
            , eeApp.NombreApp as 'NombreDeEstado'
            , ue.idEstados as 'UltimoEstado'
            , ue.Fecha as 'FechaDeUltimoEstado'
            , ueeApp.NombreApp as 'NombreDeUltimoEstado'
            , fs.nombre as 'Sucursal'
            , RTRIM(fp.destinatario) as 'Destinatario'
            , RTRIM(fp.domicilio) as 'Direccion de entrega'
            , fp.codigo_postal as 'Cp'
            , fp.localidad as 'Localidad'
            
            , fp.documento as 'documento'
            , pe.ApellidoNombreRecibio as 'recibio'
            , vd.Nombre as 'Vinculo'
            , pe.FotoDeAcuse as 'FotoDeAcuse'
            
        FROM sispoc5_Ocasa.Piezas_Estados as pe
        inner join (
        	SELECT 
        	pe.idPieza as 'idPieza'
            FROM sispoc5_Ocasa.Piezas_Estados as pe
            inner join(
            	SELECT pe.idPieza as 'idPieza', min(pe.Fecha) as 'Fecha'
                FROM sispoc5_Ocasa.Piezas_Estados as pe
                where pe.BarcodeExterno not like ''
                group by pe.idPieza
            ) as EstadoMinimo on pe.idPieza = EstadoMinimo.idPieza and pe.Fecha = EstadoMinimo.Fecha
            WHERE 
            pe.BarcodeExterno not like ''
            and
            (
                pe.Fecha >= '$Desde'
            	AND 
                pe.Fecha <= '$Hasta'
            )
            
        	and pe.BarcodeExterno not like ''
        	group by pe.idPieza
        ) as pef on pef.idPieza = pe.idPieza
        inner join (
            select pe.idPieza as 'idPieza',pe.Fecha as 'Fecha', pe.idEstados as 'idEstados'
            from sispoc5_Ocasa.Piezas_Estados as pe
            inner join (
                select pe.idPieza as 'idPieza', max(pe.Fecha) as 'Fecha'
                from sispoc5_Ocasa.Piezas_Estados as pe
                inner join (
                    SELECT 
                    pe.idPieza as 'idPieza'
                    FROM sispoc5_Ocasa.Piezas_Estados as pe
                    inner join(
                        SELECT 
                        pe.idPieza as 'idPieza', min(pe.Fecha) as 'Fecha'
                        FROM sispoc5_Ocasa.Piezas_Estados as pe
                        where pe.BarcodeExterno not like ''
                        group by pe.idPieza
                    )as EstadoMinimo on pe.idPieza = EstadoMinimo.idPieza and EstadoMinimo.Fecha = pe.Fecha
                    WHERE 
                    pe.BarcodeExterno not like ''
                    and
                    (
                        pe.Fecha >= '$Desde'
                    	AND 
                   		pe.Fecha <= '$Hasta'
                    )
                    and pe.BarcodeExterno not like ''
                    group by pe.idPieza
                ) as pef on pef.idPieza = pe.idPieza
                group by pe.idPieza
            )as pef on pef.idPieza = pe.idPieza and pef.Fecha = pe.Fecha
        ) as ue on ue.idPieza = pe.idPieza
        inner join sispoc5_gestionpostal.flash_piezas as fp on fp.id = pe.idPieza
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on fci.id = fp.comprobante_ingreso_id
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as fcis on fcis.id = fp.servicio_id
        inner join sispoc5_Ocasa.EstadoEntregaApp as eeApp on eeApp.id = pe.idEstados
        inner join sispoc5_Ocasa.EstadoEntregaApp as ueeApp on ueeApp.id = ue.idEstados
        left join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = fp.sucursal_id
        left join sispoc5_Ocasa.VinculoDestinatario as vd on pe.idVinculo = vd.id
        WHERE 1
        and pe.BarcodeExterno not like ''
        and fci.cliente_id = '$UserId'
        and (fp.documento = '$DNIBusqueda' or '' = '$DNIBusqueda')
        and (fp.destinatario = '$Destinatario' or '' = '$Destinatario')
        and (pe.BarcodeExterno = '$NumeroDePieza' or '' = '$NumeroDePieza')
        order by pe.BarcodeExterno ,fp.id, pe.Fecha ASC
        limit 10000
        ";
    
	$res = [];
	$resultado = $db->query($Consulta);
	
	if ($resultado) {
		if($db->error){
		}
		while ($fila = $resultado->fetch_assoc()) {
			$res[] = $fila;
		}
		$resultado->free();
	}
    
	$respuesta = EstadosEnFilas($resultado);


    print_r($res);
    exit;
	    function EstadosEnFilas($respuesta){
        //return $respuesta;
        $idGrupo = 0 ;
        $FilasEnGrupo = 0;
        $GropoDeEstadosDePieza=[];
        $PiezasConEstadosEnFila = [];
        $keys = array_keys($respuesta[0]);
        for($i=0; $i < count($respuesta); $i++){
            if($i>0){
                $FilaActual = $respuesta[$i];
                $FilaAnterior = $respuesta[$i-1];
                if($FilaActual[$keys[3]] == $FilaAnterior[$keys[3]] ){
                    $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $FilaActual;
                    $FilasEnGrupo++;
                }else{
                    $idGrupo++;
                    $FilasEnGrupo=0;
                    $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $FilaActual;
                    $FilasEnGrupo++;
                }
                
            }else{
                $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $respuesta[0];//8000000
                $FilasEnGrupo++;
            }
        }
        //return $GropoDeEstadosDePieza;
        
        $Respuesta = [];
        for($i=0; $i < count($GropoDeEstadosDePieza); $i++){
            $EstadosDePiezas = $GropoDeEstadosDePieza[$i];
            $PiezasConEstadosEnFila[0] = $EstadosDePiezas[0][3];
            $PiezasConEstadosEnFila[1] = $EstadosDePiezas[0][0];
            $PiezasConEstadosEnFila[2] = $EstadosDePiezas[0][9];
            $PiezasConEstadosEnFila[3] = utf8_encode($EstadosDePiezas[0][10]);
            $PiezasConEstadosEnFila[4] = utf8_encode($EstadosDePiezas[0][11]);
            $PiezasConEstadosEnFila[5] = $EstadosDePiezas[0][12];
            $PiezasConEstadosEnFila[6] = utf8_encode($EstadosDePiezas[0][13]);
            $PiezasConEstadosEnFila[7] = utf8_encode($EstadosDePiezas[0][8]);
            $PiezasConEstadosEnFila[8] = $EstadosDePiezas[0][7];
            
            $PiezasConEstadosEnFila[9] = 'NULL';
            
            $PiezasConEstadosEnFila[10] = 'NULL';
            $PiezasConEstadosEnFila[11] = 'NULL';
            $PiezasConEstadosEnFila[12] = 'NULL';
            $PiezasConEstadosEnFila[13] = 'NULL';
            $PiezasConEstadosEnFila[14] = 'NULL';
            $PiezasConEstadosEnFila[15] = 'NULL';
            $PiezasConEstadosEnFila[16] = 'NULL';
            $PiezasConEstadosEnFila[17] = 'NULL';
            $PiezasConEstadosEnFila[18] = 'NULL';
            $PiezasConEstadosEnFila[19] = 'NULL';
            $PiezasConEstadosEnFila[20] = 'NULL';
            $PiezasConEstadosEnFila[21] = 'NULL';
            $PiezasConEstadosEnFila[22] = 'NULL';
            $PiezasConEstadosEnFila[23] = 'NULL';
            $PiezasConEstadosEnFila[24] = 'NULL';
            $PiezasConEstadosEnFila[25] = 'NULL';
            $PiezasConEstadosEnFila[26] = 'NULL';
            $PiezasConEstadosEnFila[27] = 'NULL';
            $PiezasConEstadosEnFila[28] = 'NULL';
            $PiezasConEstadosEnFila[29] = 'NULL';
            $PiezasConEstadosEnFila[30] = 'NULL';
            $PiezasConEstadosEnFila[31] = utf8_encode($EstadosDePiezas[0][8]);
            $PiezasConEstadosEnFila[32] = $EstadosDePiezas[0][7];
            $PiezasConEstadosEnFila[33] = $EstadosDePiezas[0][14];
            $PiezasConEstadosEnFila[34] = 'NULL';
            /*
            $PiezasConEstadosEnFila[34] = $EstadosDePiezas[0][14];
            $PiezasConEstadosEnFila[35] = 'NULL';
            $PiezasConEstadosEnFila[36] = 'NULL';
            $PiezasConEstadosEnFila[37] = 'NULL';
            */
            
            
            //.....
            $EstadosDePiezas = $GropoDeEstadosDePieza[$i];
            $contadorDeEnvios=0;
            $contadorDeRecepcion=0;
            $contadorDedistribucion=0;
            for($j=0; $j< count($EstadosDePiezas) ; $j++){
                $estado = utf8_encode($EstadosDePiezas[$j][5]);
                
                if($EstadosDePiezas[$j][2] == 8 ){
                    $PiezasConEstadosEnFila[34] = $EstadosDePiezas[0][15];
                    //$PiezasConEstadosEnFila[36] = $EstadosDePiezas[0][16];
                    //$PiezasConEstadosEnFila[37] = $EstadosDePiezas[0][17];
                }
                
                //Logico
                if($EstadosDePiezas[$j][2] == 48 ){
                    $PiezasConEstadosEnFila[10] = $estado;
                    $PiezasConEstadosEnFila[11] = $EstadosDePiezas[$j][1];
                }else{
                    //Fisico
                    if($EstadosDePiezas[$j][2] == 49 ){
                        $PiezasConEstadosEnFila[12] = $estado;
                        $PiezasConEstadosEnFila[13] = $EstadosDePiezas[$j][1];
                    }else{
                        //Enviado A
                        if($EstadosDePiezas[$j][2] >= 22 and $EstadosDePiezas[$j][2] <= 33 and $contadorDeEnvios == 0){
                            $PiezasConEstadosEnFila[14] = $estado;
                            $PiezasConEstadosEnFila[15] = $EstadosDePiezas[$j][1];
                            $contadorDeEnvios++;
                        }else{
                            //En
                            if($EstadosDePiezas[$j][2] >= 34 and $EstadosDePiezas[$j][2] <= 45  and $contadorDeRecepcion == 0){
                                $PiezasConEstadosEnFila[16] = $estado;
                                $PiezasConEstadosEnFila[17] = $EstadosDePiezas[$j][1];
                                $contadorDeRecepcion++;
                            }else{
                                //Enviado A
                                if($EstadosDePiezas[$j][2] >= 22 and $EstadosDePiezas[$j][2] <= 33 and $contadorDeEnvios >= 1){
                                    $PiezasConEstadosEnFila[18] = $estado;
                                    $PiezasConEstadosEnFila[19] = $EstadosDePiezas[$j][1];
                                }else{
                                    //En
                                    if($EstadosDePiezas[$j][2] >= 34 and $EstadosDePiezas[$j][2] <= 45 and $contadorDeRecepcion >= 1){
                                        $PiezasConEstadosEnFila[20] = $estado;
                                        $PiezasConEstadosEnFila[21] = $EstadosDePiezas[$j][1];
                                        $contadorDeRecepcion++;
                                        break;
                                    }else{
                                        
                                        
                                        //Distri 1 
                                        if($EstadosDePiezas[$j][2] == 46 and $contadorDedistribucion == 0){
                                            $PiezasConEstadosEnFila[22] = $EstadosDePiezas[$j][1];
                                            $contadorDedistribucion ++;
                                        }else{
                                            //Distri 2 
                                            if($EstadosDePiezas[$j][2] == 46 and $contadorDedistribucion == 1){
                                                $PiezasConEstadosEnFila[25] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                            }
                                            else{
                                                //Distri 3 
                                                if($EstadosDePiezas[$j][2] == 46  and $contadorDedistribucion >= 2){
                                                    $PiezasConEstadosEnFila[28] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                                }
                                                else{
                                                    //Resultado 1
                                                    if($EstadosDePiezas[$j][2] != 46 and $contadorDedistribucion == 1){
                                                        $PiezasConEstadosEnFila[23] = $estado;
                                                        $PiezasConEstadosEnFila[24] = $EstadosDePiezas[$j][1];
                                                    }
                                                    else{
                                                        //Resultado 2
                                                        if($EstadosDePiezas[$j][2] != 46 and $contadorDedistribucion == 2){
                                                            $PiezasConEstadosEnFila[26] = $estado;
                                                            $PiezasConEstadosEnFila[27] = $EstadosDePiezas[$j][1];
                                                        }
                                                        else{
                                                            //Resultado3
                                                            if($EstadosDePiezas[$j][2] != 46 and $contadorDedistribucion == 3){
                                                                if($PiezasConEstadosEnFila[29] == 'NULL'){
                                                                    $PiezasConEstadosEnFila[29] = $estado;
                                                                    $PiezasConEstadosEnFila[30] = $EstadosDePiezas[$j][1];   
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $PiezasConEstadosEnFila[9] = $contadorDedistribucion;
            $Respuesta[] = $PiezasConEstadosEnFila;
        }
        return $Respuesta;

        //return $respuesta;
    }
?>