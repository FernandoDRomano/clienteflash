<?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //ini_set('memory_limit','9999M');
    //error_reporting(E_ALL);
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('memory_limit','9999M');
    error_reporting(E_ALL);
	header("Content-type: text/csv"); 
	header("Content-Disposition: attachment; filename=reporte.csv");
	
	
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
            $PiezasConEstadosEnFila[3] = $EstadosDePiezas[0][10];
            $PiezasConEstadosEnFila[4] = $EstadosDePiezas[0][11];
            $PiezasConEstadosEnFila[5] = $EstadosDePiezas[0][12];
            $PiezasConEstadosEnFila[6] = $EstadosDePiezas[0][13];
            $PiezasConEstadosEnFila[7] = $EstadosDePiezas[0][8];
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
            $PiezasConEstadosEnFila[31] = $EstadosDePiezas[0][8];
            $PiezasConEstadosEnFila[32] = $EstadosDePiezas[0][7];
            $PiezasConEstadosEnFila[33] = $EstadosDePiezas[0][19];
            $PiezasConEstadosEnFila[34] = 'NULL';
            $PiezasConEstadosEnFila[35] = 'NULL';
            $PiezasConEstadosEnFila[36] = '';
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
                $estado = $EstadosDePiezas[$j][5];
                
                if($EstadosDePiezas[$j][2] == 8 ){
                    $PiezasConEstadosEnFila[34] = $EstadosDePiezas[$j][15];
                    $PiezasConEstadosEnFila[35] = $EstadosDePiezas[$j][16];
                    $PiezasConEstadosEnFila[36] = $EstadosDePiezas[$j][17];
                    //$PiezasConEstadosEnFila[36] = $EstadosDePiezas[0][16];
                    //$PiezasConEstadosEnFila[37] = $EstadosDePiezas[0][17];
                }
                
                //Logico
                if($EstadosDePiezas[$j][2] == 1 ){
                    $PiezasConEstadosEnFila[10] = $estado;
                    $PiezasConEstadosEnFila[11] = $EstadosDePiezas[$j][1];
                }else{
                    //Fisico
                    if($EstadosDePiezas[$j][2] == 33 ){
                        $PiezasConEstadosEnFila[12] = $estado;
                        $PiezasConEstadosEnFila[13] = $EstadosDePiezas[$j][1];
                    }else{
                        //Enviado A
                        if($EstadosDePiezas[$j][18] == 5 and $EstadosDePiezas[$j][2] != 32 and $contadorDeEnvios == 0){//
                            $PiezasConEstadosEnFila[14] = $estado;
                            $PiezasConEstadosEnFila[15] = $EstadosDePiezas[$j][1];
                            $contadorDeEnvios++;
                        }else{
                            //En
                            if($EstadosDePiezas[$j][18] == 6 and $EstadosDePiezas[$j][2] != 33 and $contadorDeRecepcion == 0){//fpt.flash_piezas_estados_declarados
                                $PiezasConEstadosEnFila[16] = $estado;
                                $PiezasConEstadosEnFila[17] = $EstadosDePiezas[$j][1];
                                $contadorDeRecepcion++;
                            }else{
                                //Enviado A
                                if($EstadosDePiezas[$j][18] == 5 and $EstadosDePiezas[$j][2] != 32 and $contadorDeEnvios >= 1){
                                    $PiezasConEstadosEnFila[18] = $estado;
                                    $PiezasConEstadosEnFila[19] = $EstadosDePiezas[$j][1];
                                }else{
                                    //En
                                    if($EstadosDePiezas[$j][18] == 6 and $EstadosDePiezas[$j][2] != 33 and $contadorDeRecepcion >= 1){
                                        $PiezasConEstadosEnFila[20] = $estado;
                                        $PiezasConEstadosEnFila[21] = $EstadosDePiezas[$j][1];
                                        $contadorDeRecepcion++;
                                        break;
                                    }else{
                                        
                                        
                                        //Distri 1 
                                        if($EstadosDePiezas[$j][2] == 2 and $contadorDedistribucion == 0){
                                            $PiezasConEstadosEnFila[22] = $EstadosDePiezas[$j][1];
                                            $contadorDedistribucion ++;
                                        }else{
                                            //Distri 2 
                                            if($EstadosDePiezas[$j][2] == 2 and $contadorDedistribucion == 1){
                                                $PiezasConEstadosEnFila[25] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                            }
                                            else{
                                                //Distri 3 
                                                if($EstadosDePiezas[$j][2] == 2  and $contadorDedistribucion >= 2){
                                                    $PiezasConEstadosEnFila[28] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                                }
                                                else{
                                                    //Resultado 1
                                                    if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 1){
                                                        $PiezasConEstadosEnFila[23] = $estado;
                                                        $PiezasConEstadosEnFila[24] = $EstadosDePiezas[$j][1];
                                                    }
                                                    else{
                                                        //Resultado 2
                                                        if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 2){
                                                            $PiezasConEstadosEnFila[26] = $estado;
                                                            $PiezasConEstadosEnFila[27] = $EstadosDePiezas[$j][1];
                                                        }
                                                        else{
                                                            //Resultado3
                                                            if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 3){
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
	
	//Agregada
	function curlPost(string $url, array $data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        return $response;
    }
	
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	$Date = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	$time = '0';
    
    
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
	$FechaF = str_replace('/', '-', $FechaF).' 23:59';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);

	$FechaIServer = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaFServer = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	$Desde = $FechaI;
	$Hasta = $FechaF;
	
	$ComprobanteDeIngreso = issetornull('ComprobanteDeIngreso');
	$UserId = issetornull('UserId');
	$BarcodeExterno = issetornull('BarcodeExterno');
	$Documento = issetornull('Documento');
	$ApellidoYNombre = issetornull('ApellidoYNombre');
	$IdPieza = issetornull('IdPieza');
	
	
	$RealDesde = issetornull('FechaI');
	if($RealDesde != ''){
		$RealDesde = str_replace('/', '-', $RealDesde).':00';
		$RealDesde = date('Y-m-d H:i:s', strtotime($RealDesde . '') );
		//$Desde = date('Y-m-d', strtotime($Desde ) );
	}
	$RealHasta = issetornull('FechaF');
	if($RealHasta != ''){
		$RealHasta = str_replace('/', '-', $RealHasta).':00';
		$RealHasta = date('Y-m-d H:i:s', strtotime($RealHasta . '') );
		//$Hasta = date('Y-m-d', strtotime($Hasta ) );
	}
	$Destinatario = $ApellidoYNombre;
	$DNIBusqueda = $Documento;
	$NumeroDePieza = $BarcodeExterno;
	
	$Columnas = array("ClienteId");
	$Consulta = "
		SELECT cfc.SispoId as 'ClienteId'
		from sispoc5_correoflash.cliente  as cfc
		where cfc.Id = '$UserId'
    ";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$UserId = $ClaseMaster->ArraydResultados[0][0];
	}else{
		exit;
	}
	
	$Columnas = array("Barcode","FechaDeEstado","idEstado","idPieza","id"
	,"NombreDeEstado","UltimoEstado","FechaDeUltimoEstado","NombreDeUltimoEstado","Sucursal"
	,"Destinatario","Direccion de entrega","Cp","Localidad",'documento'
	,'recibio','Vinculo','FotoDeAcuse','flash_piezas_estados_declarados','Imagen'
	);
	
	/*
	$Columnas2 = array('Id pieza','Barcod externo','Sucursal','Destinatario','Direccion de entrega'
                    ,'Cp','Localidad','Estado actual','Fecha del estado actual','Cantidad De Gestiones','Ingreso Logico'
                    ,'Fecha','Ingreso Fisico','Fecha');	
    */
/*	*/
	
	$Consulta = "
	        SELECT 
            	fp.barcode_externo AS 'Barcode'
                ,fpt.create AS 'FechaDeEstado'
                ,fpt.estado_id AS 'idEstado'
                ,fp.id AS 'idPieza'
                ,fp.id
                ,fev.nombre AS 'NombreDeEstado'
                ,fp.estado_id AS 'UltimoEstado'
                ,fp.update AS 'FechaDeUltimoEstado'
                ,fuev.nombre AS 'NombreDeUltimoEstado'
                ,fs.nombre AS 'Sucursal'
                ,RTRIM(fp.destinatario) AS 'Destinatario'
                ,RTRIM(fp.domicilio) AS 'Direccion de entrega'
                ,fp.codigo_postal AS 'Cp'
                ,fp.localidad AS 'Localidad'
                ,fp.documento AS 'documento'
                ,fp.recibio AS 'recibio'
            	,CASE
            		WHEN fp.vinculo LIKE 'APP-%' THEN SUBSTRING(fp.vinculo, 5)
            		ELSE fp.vinculo
            	END AS 'Vinculo'
                ,datos.fichero AS 'FotoDeAcuse'
                ,fev.flash_piezas_estados_declarados
                , case 
                	when datos.fichero like '' then 'No'
                	else 'Si'
                end as 'Imagen'
            FROM
            	sispoc5_gestionpostal.flash_piezas AS fp
                INNER JOIN sispoc5_gestionpostal.flash_piezas_estados_variables fuev on fuev.id = fp.estado_id
                INNER JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos AS fci ON fci.id = fp.comprobante_ingreso_id
                INNER JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios AS fcis ON fcis.id = fp.servicio_id
                INNER JOIN sispoc5_gestionpostal.flash_piezas_tracking AS fpt ON fpt.pieza_id  = fp.id
                INNER JOIN sispoc5_gestionpostal.flash_piezas_estados_variables fev on fev.id = fpt.estado_id
                LEFT JOIN sispoc5_gestionpostal.flash_datos_estados AS datos ON datos.flash_piezas_tracking_id  = fpt.id
                LEFT JOIN sispoc5_gestionpostal.flash_piezas_cd AS cd ON cd.IdFlashPieza = fp.id
                LEFT JOIN sispoc5_gestionpostal.flash_sucursales AS fs ON fs.id = fp.sucursal_id
            WHERE 1
            	#AND fp.barcode_externo NOT LIKE '' 
                AND (fci.cliente_id = '$UserId')
                AND (fp.barcode_externo = '$NumeroDePieza' or '' = '$NumeroDePieza')
                AND (cd.ApoderadoDocumento = '$DNIBusqueda' or '' = '$DNIBusqueda')
                AND (fp.destinatario LIKE '%$Destinatario%' or '' = '$Destinatario')
                AND ((fci.create >= '$Desde' AND fci.create <= '$Hasta')) 
            ORDER BY
                fp.barcode_externo ,
                fp.id,
                fpt.create ASC;
        ";
    //print_r($Consulta);
    //return;
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	$respuesta = $ClaseMaster->ArraydResultados;
	$registros = count($respuesta);
	
	
	$respuesta = EstadosEnFilas($respuesta);
    
	$Columnas = array('Id pieza','Barcod externo','Sucursal','Destinatario','Direccion de entrega'
                    ,'Cp','Localidad','Estado actual','Fecha del estado actual','Cantidad De Gestiones'
                    ,'Ingreso Logico','Fecha','Ingreso Fisico','Fecha','Enviado a (1)'
                    ,'Fecha','Recibido en (1)','Fecha','Enviado a (2)','Fecha'
                    ,'Recibido en (2)','Fecha','Fecha 1ra Dist.','Resultado','Fecha'
                    ,'Fecha 2da Dist.','Resultado','Fecha','Fecha 3ra Dist.','Resultado'
                    ,'Fecha','Ultima Novedad','Fecha','Imagen');//,'Documento','Recibio','Vinculo','FotoDeAcuse'
	$ClaseMaster->ArraydResultados = $respuesta;
	
	//AGREGADO
    /* 
        BUSCAR ARCHIVOS EN LA API DE IMAGENES PARA SABER SI EXISTE EL ARCHIVO FISICAMENTE 
    */
    
    
    $archivosImagenes = [];
    for($cont=0; $cont< count($ClaseMaster->ArraydResultados); $cont++){
        if($ClaseMaster->ArraydResultados[$cont][36] != ""){
            $archivosImagenes[] = $ClaseMaster->ArraydResultados[$cont][36];
        }
    }
    
    $archivosImagenesConcatenados = implode(",", $archivosImagenes);

    $apiUrl = "https://apiimagenes.intranetflash.com/api/buscar";
    
    $postParameter = array(
        "archivos" => $archivosImagenesConcatenados
    );
    
    $respuesta = curlPost($apiUrl, $postParameter);

    if(count($respuesta) > 0){
        for($cont=0; $cont< count($ClaseMaster->ArraydResultados); $cont++){
            //NO TIENE IMAGEN
            if($ClaseMaster->ArraydResultados[$cont][36] == ""){
                //COMO NO SE USA EL CAMPO Documento, SE COLOCA LA IMAGEN EN ESA POSICIÓN
                $ClaseMaster->ArraydResultados[$cont][33] = "No";
            }else{
                foreach($respuesta as $key => $value){
                    if($ClaseMaster->ArraydResultados[$cont][36] == $key){
                        //COMO NO SE USA EL CAMPO Documento, SE COLOCA LA IMAGEN EN ESA POSICIÓN
                        $ClaseMaster->ArraydResultados[$cont][33] = $value ? "Si" : "No";
                    }
                }
            }
        }
    }
    
    
    
    /*
    echo "<pre>";
    var_dump($ClaseMaster->ArraydResultados);
    echo "</pre>";
    die;
    */
	
	if($Resultado){
	    //print_r($respuesta);
		for($cont=0;$cont< count($Columnas) ;$cont++){
		    if($cont!=9){
    			if($cont>0){
    			    echo(";");
    			}
    			echo('"' . str_replace(';',"",str_replace('"',"",$Columnas[$cont])) . '"');
		    }
		}
		echo("\n");
		for($cont=0; $cont< count($ClaseMaster->ArraydResultados); $cont++){
		    if($cont>0){
		        echo("\n");
		    }
		    for($cont2=0; $cont2 < count($Columnas);$cont2++){
	            if($cont2!=9){
    		        if($cont2==0){
    		            if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
    						echo('""');
    					}
    					else{
    					    echo( '"' . str_replace(';',"",str_replace('"',"",$ClaseMaster->ArraydResultados[$cont][$cont2])) . '"' );
    					}
    		        }
    		        else{
    		            if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
    						echo(";".'""');
    					}
    					else{
    					    echo(";". '"' . str_replace(';',"",str_replace('"',"",$ClaseMaster->ArraydResultados[$cont][$cont2])) . '"');
    					}
    		        }
		        }
		    }
		}
		//exit;
	}else{
		//print_r($Consulta);
	}
	

	
//	$mivariable = 1;
//	Echo("Dato(;)");
//	echo($ClaseMaster);
    
    
?>