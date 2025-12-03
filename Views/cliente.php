<?php namespace Views;
	use Config\Elementos as Elementos;
	$template = new Template();
	//require (__ROOT__.'/PHPMailer/Exception.php');
	if (file_exists('Config/Elementos.php')){
		require_once('Config/Elementos.php');
		//echo('Config/Elementos.php Existe');
	}else{
		
		echo('Config/Elementos.php No Existe');
	}
	
	//require_once (__ROOT__.'Config/Elementos.php');
	class Template{
	public function __construct(){
?>

<?php

	function JScookieCompletar($nombre,$Valor){
		if(! ($nombre==="" || $Valor ==="") ){
			echo "<script> setCookie('$nombre','$Valor'); </script>"; 
		}
	}
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	function issetsessionornull($name){
		if(isset($_SESSION[$name])){
			return ($_SESSION[$name]);
		}else{
			return("");
		}
	}
	
	$MesActual = date("Y-m-01", time()); 
	$year = substr($MesActual, 0, 4);
	$month = substr($MesActual, 5, 2);
	$MesActual = date("Y-m-01", mktime(0,0,0, $month+1, 0, $year));
	$MesSiguiente = date("Y-m-01", mktime(0,0,0, $month+2, 0, $year));
	$time = time();
	$NoMemory = strtotime(date("Ymdhis"));
	
	/*
	session_start([
		'cookie_lifetime' => 86400,
		'read_and_close'  => true,
	]);
	if(issetsessionornull('UserId')==''){
		header('Location: http://sispo.com.ar/consultas/logueo.php');
		echo("Main MSJ 38");
		exit;
	}
	$UserId = issetsessionornull('UserId');
	if(issetsessionornull('UserId')=='1'){
	}
	*/
	if(isset($_SESSION['idusuario'])){
		$UserId = $_SESSION['idusuario'];
		//$IdUsuarioSpp = $_SESSION['idusuario'];
	}else{
		//echo('<script>window.location.replace(URLJS);</script>');exit;exit;
	}
	$Usuario = "" ;
	if(isset($_SESSION['ClienteId'])){
		$Usuario = $_SESSION['ClienteId'] ;
		//$IdClienteSpp = $_SESSION['ClienteId'];
		//echo('<script>window.location.replace(URLJS);</script>');exit;exit;
	}else{
		$Usuario = "Correoflash" ;
	}
	//echo($Usuario);
	
	$PermisosFicherosDeMenues = $_SESSION['UsuarioURL'];
	//echo($UserId);
	
	
	//print_r($_SESSION);
?>
<script>
	var UserId = <?php echo(json_encode($UserId));?>;
	var permisos = <?php echo(json_encode($PermisosFicherosDeMenues));?>
</script>

<!DOCTYPE html>
<html lang="es" >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Correoflash</title>

        <!-- 
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/ImputUploads.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/SubaDeImagenes.css">
		
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Mouse.css" rel="stylesheet">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/select2.min.css" rel="stylesheet">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/loading.css" type="text/css">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/table.css" type="text/css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Menu.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/bootstrap.min.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/csstips.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Form.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Map.css">
		
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/assets/global/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/assets/global/css/componentsARG.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/assets/global/css/DivsBolivia.css">
		
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/XLSX.css">
		
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/fileUpload.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Francisco.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/css.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/TablaYColapsable.css">

		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/FranciscoMenu.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/FranciscoFontawesome.css">
		<link href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/bancomacro.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" charset="UTF-8" href="https://translate.googleapis.com/translate_static/css/translateelement.css">
		<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Ruben.css">
		
		<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jquery.min.js"></script>
        -->

        <!-- ESTILOS 2.0 -->
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- pickadate.js -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/pickadate.js/css/default.css">
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/pickadate.js/css/default.date.css">
        <!-- DataTable -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/DataTables/datatables.min.css">
        <!-- SELECT2 -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- style owner -->
        <link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/css/style.css">
		<!-- FIN ESTILOS 2.0 -->

		<script>
			var time=<?php echo json_encode($time); ?>;
			var NoMemory = <?php echo json_encode($NoMemory); ?>;
			var UserId = <?php echo json_encode($UserId); ?>;
		</script>

	</head>

	<div id="loading" name="loading" style="display:none">
		<b id="loadingText" style="color: white;text-shadow: 4px 4px 8px #000000;"></b>
	</div>

    <!--  BODY 2.0 -->
    <body class="hold-transition sidebar-mini layout-fixed" id="body">
        
        <!--
        <div id="PanelDeEscondibles"></div>
        -->
        
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand bg-principal navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="btnMenu" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");}?>" role="button">
                            Cerrar Sesión <span class="d-none d-sm-inline">(<?php global $NombreDeUsuario; echo($NombreDeUsuario); ?>)</span>
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar bg-principal elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link" id="logo">
                <span id="logoGrande">
                    <img src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/img/logo.png" alt="Logo correo flash" class="h-100 d-block m-auto">
                </span>
                <span id="logoChico" class="d-none">
                    <img src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/img/logo.png" alt="Logo correo flash" class="h-100 d-block m-auto">
                </span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                <!-- Sidebar user panel (optional) 
                <div class="user-panel mt-3 pb-3 d-flex justify-content-center">
                    <div class="info">
                    <p class="text-white font-weight-bold mb-0 text-center">Usuario del sistema</p>
                    </div>
                </div>
                -->

                <!-- Sidebar Menu -->
                <nav class="border-top">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    
                    <li class="nav-header">MENU</li>
                    <li class="nav-item">
                        <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>principal/inicio" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-mail-bulk"></i>
                            <p>
                                Solicitud de Envio
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>pedidodeenvio/cartadocumento" class="nav-link">
                                    <i class="fas fa-file-alt"></i>
                                    <p>Carta Documento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>pedidodeenvio/cartadocumentomasivo" class="nav-link">
                                    <i class="fas fa-file-alt"></i>
                                    <p>Carta Documento Masivo</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-archive"></i>
                            <p>
                                Piezas Solicitadas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>clientepiezassolicitadas/estados" class="nav-link">
                                    <i class="fas fa-box"></i>
                                    <p>Piezas y Estados de Piezas</p>
                                </a>
                            </li>
  
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-archive"></i>
                            <p>
                                Ruteo
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>clienteruteoservicios/circulacion" class="nav-link">
                                    <i class="fas fa-box"></i>
                                    <p>Circulacion</p>
                                </a>
                            </li>
  
                        </ul>
                    </li>                    
                    

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. CONTENIDO PRINCIPAL DE LA PAGINA -->
            <div class="content-wrapper altura-wrapper-auto">
                <!-- Content Header (Page header) 
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row justify-content-center">

                        </div>
                    </div>
                </div>
                 -->

                <!-- Main content -->
                <section class="content">
                   
                    <!-- CONTENIDO INSERTADO DE LA PÁGINA -->
                    <div class="container-fluid" id="ForInner">
                        
                    </div><!-- /.container-fluid -->
                    <!-- FINAL DEL CONTENIDO INSERTADO DE LA PÁGINA -->
               
                </section>
                <!-- /.content -->
            
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer footer text-white bg-principal text-center text-md-left text-sm mt-5">
                <strong>Copyright &copy; 2022 Correo Flash.</strong>
                <br class="d-md-none"> Todos los derechos reservados.
            </footer>

        </div>
    
    </body>
    <!-- FIN DEL BODY 2.0 -->

</html>

<?php }}?>




<!--
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
-->
<script lang="javascript" src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Rugedit.js"></script>
<script lang="javascript" src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/dist/xlsx.full.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jquery.min.js"></script>
<!--
<script src="<?php echo URL; ?>Js/JsRu.js"></script>
-->

<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameBase.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameSelect.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameGracicaHighcharts.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameTablero.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameElementosGenericos.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameTabla.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameGrowlMSJ.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameMultipleEnvio.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameDescargas.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameUploadFormFile.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameImputDeImagen.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameCajaDeGrupos.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameSQLObtenerValores.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameValoresAElementos.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameCustomSelect.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlamePostsBoveda.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameApiSend.js"></script>

<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/JsRu.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/bootstrap.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Moment.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ResizeSensor.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ElementQueries.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Habla.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Menu.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Growl.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Main.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptMap.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptForzadoOcasa.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptEditarSpp.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptEditarOcasa.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptCero.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptLoadXLS.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptTerceros.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptConsultaGlobalTuenti.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptConsultaTuentiGPS.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/FechaHDR.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptPing.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/ScriptFiles.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/RuScriptFiles.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/select2.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/dist/xlsx.full.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/html2canvas.js"></script>

<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameCargas.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Flame/FlameImputUpload.js"></script>

<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Tablas.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/highcharts.js"></script>

<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Barcode.js"></script>
<!--
<script src="< ?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ? >Js/BarcodePre.js"></script>
-->
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/JsBarcode.code39.min.js"></script>
<!-- <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.js"></script> -->
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.debug.js"></script>
<!-- <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.min.js"></script> -->
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.plugin.autotable.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.5/canvg.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>


<!-- SCRIPTS 2.0 -->

    <!-- jQuery  
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/jquery/jquery.min.js"></script>
     -->
   
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    //$.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- pickadate.js -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/pickadate.js/js/picker.js"></script>
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/pickadate.js/js/picker.date.js"></script>
    <!-- DataTable -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/DataTables/datatables.min.js"></script>
    <!-- SELECT2 -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/select2/js/select2.min.js"></script>
    <!-- INPUT MASK -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/recursos/js/adminlte.js"></script>


    
<!-- FIN DE SCRIPTS 2.0 -->

