<?php namespace Views;
	use Config\Elementos as Elementos;
	$template = new Template();
	if (file_exists('Config/Elementos.php')){
		require_once('Config/Elementos.php');
	}else{
		
		echo('Config/Elementos.php No Existe');
	}
	
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
	
	if(isset($_SESSION['idusuario'])){
		$UserId = $_SESSION['idusuario'];
	}
	$Usuario = "" ;
	if(isset($_SESSION['ClienteId'])){
		$Usuario = $_SESSION['ClienteId'] ;
	}else{
		$Usuario = "Correoflash" ;
	}
	
	$PermisosFicherosDeMenues = $_SESSION['UsuarioURL'];

    /*
        Funcion para determinar que menu esta activo en base a la url
    */
    function estaElMenuActivo($urlDelMenu){
        $rutaActual = $_SERVER['REQUEST_URI'];
        $partesRuta = explode('/', $rutaActual);
        foreach ($partesRuta as $parte) {
            if ($parte === $urlDelMenu) {
                return true;
            }
        }
        return false;
    }
?>
<script>
	var UserId = <?= (json_encode($UserId));?>;
	var permisos = <?= (json_encode($PermisosFicherosDeMenues));?>
</script>

<!DOCTYPE html>
<html lang="es" >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Dashboard | Clientes</title>

        <!-- ESTILOS 2.0 -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/Styles/recursos/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/Styles/recursos/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="/Styles/recursos/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- pickadate.js -->
        <link rel="stylesheet" href="/Styles/recursos/plugins/pickadate.js/css/default.css">
        <link rel="stylesheet" href="/Styles/recursos/plugins/pickadate.js/css/default.date.css">
        <!-- DataTable -->
        <link rel="stylesheet" href="/Styles/recursos/plugins/DataTables/datatables.min.css">
        <!-- SELECT2 -->
        <link rel="stylesheet" href="/Styles/recursos/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/Styles/recursos/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- style owner -->
        <link rel="stylesheet" href="/Styles/recursos/css/style.css">
        <!-- Sprite SVG Icons -->

        <!-- Loading -->
        <link href="/Styles/Styles/loading.css" rel="stylesheet" type="text/css">
        <script src="/Js/loading.js"></script>
        
		<!-- FIN ESTILOS 2.0 -->

		<script>
			var time=<?=  json_encode($time); ?>;
			var NoMemory = <?=  json_encode($NoMemory); ?>;
			var UserId = <?=  json_encode($UserId); ?>;
		</script>
	</head>

	<!-- <div id="loading" name="loading" style="display:none">
		<b id="loadingText" style="color: white;text-shadow: 4px 4px 8px #000000;"></b>
	</div> -->

    <div id="loading" name="loading" style="display:none"></div>

    <!--  BODY 2.0 -->
    <body class="hold-transition sidebar-mini layout-fixed" id="body">

        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand bg-principal px-md-4 px-lg-5 d-flex justify-content-between align-items-center">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item mr-md-4 mr-lg-0 d-lg-none">
                        <a id="btnMenu" class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <svg width="24" height="24">
                                <use xlink:href="/Styles/inicio/sprite.svg#bars"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <img src="/Styles/inicio/logo-flash.svg" alt="Logo Empresa" class="img-logo-navbar">
                    </li>
                    <li class="nav-item d-none d-lg-flex justify-content-center align-items-center">
                        <span class="text-plataforma">Plataforma para Clientes</span>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item mr-3 d-flex justify-content-center align-items-center gap-2">
                        <svg width="16" height="16">
                            <use xlink:href="/Styles/inicio/sprite.svg#user"></use>
                        </svg>
                        <span class="d-inline nav-user ml-1"><?php global $NombreDeUsuario; echo($NombreDeUsuario); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn-logout" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");}?>" role="button">
                            Cerrar Sesi&oacute;n
                            <svg width="16" height="16">
                                <use xlink:href="/Styles/inicio/sprite.svg#logout"></use>
                            </svg>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar bg-principal">
                <div class="nav-header">
                    <p class="p-0 m-0">Men&uacute;</p>
                    <svg class="d-none d-lg-block" width="24" height="24" data-widget="pushmenu" role="button">
                        <use xlink:href="/Styles/inicio/sprite.svg#bars"></use>
                    </svg>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="border-top">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item <?= estaElMenuActivo('principal') ? 'menu-activo' : '' ?>">
                                <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>principal/inicio" class="nav-link">
                                    <svg width="24" height="24">
                                        <use xlink:href="/Styles/inicio/sprite.svg#home"></use>
                                    </svg>
                                    <p>Inicio</p>
                                </a>
                            </li>

                            <li class="nav-item <?= estaElMenuActivo('pedidodeenvio') ? 'menu-activo' : '' ?>">
                                <a href="#" class="nav-link">
                                    <svg width="24" height="24">
                                        <use xlink:href="/Styles/inicio/sprite.svg#envelopes"></use>
                                    </svg>
                                    <p>Solicitud de envio</p>
                                    <svg width="14" height="14" class="arrow">
                                        <use xlink:href="/Styles/inicio/sprite.svg#chevron-down"></use>
                                    </svg>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>pedidodeenvio/cartadocumento" class="nav-link">
                                            <svg width="24" height="24">
                                                <use xlink:href="/Styles/inicio/sprite.svg#note"></use>
                                            </svg>
                                            <p>Carta documento</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>pedidodeenvio/cartadocumentomasivo" class="nav-link">
                                            <svg width="24" height="24">
                                                <use xlink:href="/Styles/inicio/sprite.svg#note"></use>
                                            </svg>
                                            <p>Carta documento masiva</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item <?= estaElMenuActivo('clientepiezassolicitadas') ? 'menu-activo' : '' ?>">
                                <a href="#" class="nav-link">
                                    <svg width="24" height="24">
                                        <use xlink:href="/Styles/inicio/sprite.svg#box-archive"></use>
                                    </svg>
                                    <p>Piezas solicitadas</p>
                                    <svg width="14" height="14" class="arrow">
                                        <use xlink:href="/Styles/inicio/sprite.svg#chevron-down"></use>
                                    </svg>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>clientepiezassolicitadas/estados" class="nav-link">
                                            <svg width="24" height="24">
                                                <use xlink:href="/Styles/inicio/sprite.svg#box-archive"></use>
                                            </svg>
                                            <p>Piezas y estados de piezas</p>
                                        </a>
                                    </li>
        
                                </ul>
                            </li>
                            
                            <li class="nav-item <?= estaElMenuActivo('clienteruteoservicios') ? 'menu-activo' : '' ?>">
                                <a href="#" class="nav-link">
                                    <svg width="24" height="24">
                                        <use xlink:href="/Styles/inicio/sprite.svg#location"></use>
                                    </svg>
                                    <p>Ruteo</p>
                                    <svg width="14" height="14" class="arrow">
                                        <use xlink:href="/Styles/inicio/sprite.svg#chevron-down"></use>
                                    </svg>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>clienteruteoservicios/circulacion" class="nav-link">
                                            <svg width="24" height="24">
                                                <use xlink:href="/Styles/inicio/sprite.svg#location"></use>
                                            </svg>
                                            <p>Circulaci&oacute;n</p>
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
                <!-- Main content -->
                <section class="content">
                   
                    <!-- CONTENIDO INSERTADO DE LA PÁGINA -->
                    <div class="container-fluid contenido-principal" id="ForInner">
                        
                    </div><!-- /.container-fluid -->
                    <!-- FINAL DEL CONTENIDO INSERTADO DE LA PÁGINA -->
               
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer footer text-white bg-principal text-center text-md-left text-sm mt-5">
                <p>
                    Copyright &copy; 2022 Correo Flash. Todos los derechos reservados.
                </p>
            </footer>

        </div>
    
    </body>
    <!-- FIN DEL BODY 2.0 -->

</html>

<?php }}?>

<script lang="javascript" src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/Rugedit.js"></script>
<script lang="javascript" src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/dist/xlsx.full.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jquery.min.js"></script>

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
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/JsBarcode.code39.min.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.debug.js"></script>
<script src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Js/jspdf.plugin.autotable.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.5/canvg.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>


<!-- SCRIPTS 2.0 -->
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

