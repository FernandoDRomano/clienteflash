<?php
	require('../FuncionesGenerales.php');
	InluirPHP('../clases/ClaseMaster.php','1');
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	require('../FuncionesHorarias.php');
	$horaPasada = date("Y-m-d H:i:s", strtotime('2020-02-25 00:00:00'));
	$HoraBusqueda = date('Y-m-d H:i:s', strtotime($horaPasada. $DiferenciaHoraria));
	
	$IdUsuario = issetornull('IdUsuario');
	$HDR = issetornull('HDR');
	$Columnas = array("Contador");
	$Consulta= "
		SELECT count(Contador) as 'Contador'
		from(
			SELECT count(T1.PiezaId) as 'Contador'
			from(
				SELECT fp.id as 'PiezaId', fp.id as 'id'#, pe.id as 'Estados'
				FROM sispoc5_gestionpostal.flash_hojas_rutas as hdr
				inner join sispoc5_gestionpostal.flash_sucursales as suc on hdr.sucursal_id = suc.id and hdr.id = '$HDR'
				inner join sispoc5_gestionpostal.flash_piezas as fp on fp.tipo_id = '2' and fp.hoja_ruta_id = hdr.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
				inner join sispoc5_gestionpostal.flash_sucursales_carteros as Cartero on hdr.cartero_id = Cartero.id
				left join sispoc5_Banco.PiezasEstados as pe on fp.barcode_externo = pe.Barcode
				left join sispoc5_Banco.Estados as eapp on pe.idEstados = eapp.id
				where hdr.id = '$HDR'
				and ci.cliente_id = 30 and fp.tipo_id = '2' and pe.Activo = true
				order by pe.id desc
			)as T1
			group by T1.PiezaId
		)as T1
		
	";

	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	if($Resultado){
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
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
	}else{
		echo($Consulta);
	}
?>













