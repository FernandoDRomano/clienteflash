<?php namespace Config;
	class Elementos{
		//Config\Elementos::CrearMenu("","");
		public static function StartFormFileColumnas($Tamaño, $URL){
			echo('
			<div class="col-sm-' . $Tamaño . '">
				<form  class="SubaDeImagenes" method="post" enctype="multipart/form-data" action="' . $URL . '">
			');
		}
		
		public static function FormFileDosColumnas($id, $Formatos, $MultipesFicheros, $Tamaño, $Texto, $Comentario,$Funcion, $TextoImagen = "" ){
			if($TextoImagen == ""){
				$TextoImagen = 'Seleccione Archivos (' . $Formatos . ')';
			}
			echo('
					<div class="col-md-4">
							<label class="SubaDeImagenes" for="' . $id . '" style="width: 100%;">' . $TextoImagen . '</label>
							<input class="SubaDeImagenes" type="file" id="' . $id . '" name="image_uploads[]" accept="' . $Formatos . '" ' .$MultipesFicheros . '>
				
					</div>
					<div class="col-md-4">
			');
							Elementos::CrearBoton('PostImagenDeFichero(this)',"",$Texto,$Comentario,"Boton".$id,"display: none;");
			echo('		
						<div class="preview" style="margin-top: 20px;">
							<p></p>
						</div>
					</div>
			');
		}
		
		/**
		 * NUEVO FORM FILE 2 COLUMNAS
		 */
		public static function FormFileDosColumnasNuevo($id, $Formatos, $MultipesFicheros, $Tamaño, $Texto, $Comentario,$Funcion, $TextoImagen = "", $class = "" ){
			if($TextoImagen == ""){
				$TextoImagen = 'Seleccione Archivos (' . $Formatos . ')';
			}
			echo('
					<div class="col-md-4">
							<label class="SubaDeImagenes" for="' . $id . '" style="width: 100%;">' . $TextoImagen . '</label>
							<input class="SubaDeImagenes" type="file" id="' . $id . '" name="image_uploads[]" accept="' . $Formatos . '" ' .$MultipesFicheros . '>
				
					</div>
					<div class="col-md-4">
			');
							Elementos::CrearBoton('PostImagenDeFichero(this)',"",$Texto,$Comentario,"Boton".$id,"display: none;", $class);
			echo('		
						<div class="preview" style="margin-top: 20px;">
							<p></p>
						</div>
					</div>
			');
		}
		
		public static function CerrarFormulario(){
			echo('	
				</form>
			</div>
			');
		}
		public static function EndFormFileColumnas($id, $Formatos, $MultipesFicheros, $Tamaño, $Texto, $Comentario,$Funcion, $TextoImagen = "" ){
			if($TextoImagen == ""){
				$TextoImagen = 'Seleccione Archivos (' . $Formatos . ')';
			}
			echo('
					<div class="col-md-4">
							<label class="SubaDeImagenes" for="' . $id . '" style="width: 100%;">' . $TextoImagen . '</label>
							<input class="SubaDeImagenes" type="file" id="' . $id . '" name="image_uploads[]" accept="' . $Formatos . '" ' .$MultipesFicheros . '>
					</div>
					<div class="col-md-4">
						<div class="preview" >
							<p></p>
						</div>
					</div>
					<div class="col-md-4">
			');
						Elementos::CrearBoton('PostImagenDeFichero(this)',$Tamaño,$Texto,$Comentario,$Funcion);
			echo('
					<!-- <button class="buttonSubaDeImagenes" onClick="' . $Funcion . '">Subir</button> -->
					</div>
				</form>
			</div>
			');
		}
		
		
		public static function StartFormFile($Tamaño, $URL, $clases = ""){
			echo('
			<div class="col-sm-' . $Tamaño . '">
				<form  class="SubaDeImagenes ' . $clases . '" method="post" enctype="multipart/form-data" action="' . $URL . '">
			');
		}
		
		public static function EndFormFile($id, $Formatos, $MultipesFicheros, $Tamaño, $Texto, $Comentario,$Funcion, $TextoImagen = "" ){
			if($TextoImagen == ""){
				$TextoImagen = 'Seleccione Archivos (' . $Formatos . ')';
			}
			echo('
					<div>
						<label class="SubaDeImagenes" for="' . $id . '" style="width: 100%;">' . $TextoImagen . '</label>
						<input class="SubaDeImagenes" type="file" id="' . $id . '" name="image_uploads[]" accept="' . $Formatos . '" ' .$MultipesFicheros . '>
					</div>
					<div class="preview" >
						<p></p>
					</div>
					<div>
			');
				Elementos::CrearBoton('PostImagenDeFichero(this)',$Tamaño,$Texto,$Comentario,$Funcion);
			echo('
					<!-- <button class="buttonSubaDeImagenes" onClick="' . $Funcion . '">Subir</button> -->
					</div>
				</form>
			</div>
			');
		}
		
		public static function StartHide($Id){
			echo('
			<div id="' . $Id . '" Style="display:none" value="' . $value . '">
				
			');
		}
		public static function EndHide(){
			echo('
			</div>
			');
		}

		public static function CrearInputUploadExelATabla($Id,$IdListado,$IdTabla,$Tamaño,$Filtro,$Config = null){//
			echo('
			<div id="DivContenedor' . $Id . '" class="col-md-' . $Tamaño . '" style="position: sticky;" Filtro="' . $Filtro. '" for="' . $IdTabla . '">
				<label class="file col-md-12" style="top: 8px;left: -8px;">
					<input class="InputFiles" type="file" id="' . $Id . '" multiple accept=".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >
					<span class="SpanFile" style="display: table-row;">...</span>
				</label>
				<div class="ListaDeArchivos" style="min-height: 36px;" id="' . $IdListado . '"></div>
			</div>
			');
			echo('<script>var Config = JSON.parse(`');
			print_r($Config);
			echo('`); document.getElementById("DivContenedor' . $Id . '").Config = Config; </script>');//console.log(Config);
			
		}
		
		public static function CrearInputUploadFilesRaw($Id,$ListadoId,$FicherosPermitidos,$Funcion,$Tamaño,$Filtro,$FiltroDesde,$FiltroHasta,$Config = null,$ReadDesde = 0, $ReadHasta = 0){
			echo('
			<div id="DivContenedor' . $Id . '" class="col-md-' . $Tamaño . '" funcion="' . $Funcion . '" Columnas="' . $Filtro. '" ColumnasDesde="' . $FiltroDesde. '"  ColumnasHasta="' . $FiltroHasta. ' " ReadDesde="' . $ReadDesde. ' " ReadHasta="' . $ReadHasta. ' " >
				<label class="file">
					<input class="InputUploadFilesRaw" type="file" id="' . $Id . '" multiplex accept="' . $FicherosPermitidos . '" >
					<span class="SpanFile">...</span>
				</label>
				<div class="ListaDeArchivos" id="' . $ListadoId . '"></div>
				<DATA id="fileinfo' . $Id . '"></DATA>
			</div>
			');
			echo('<script>var Config = JSON.parse(`');
			print_r($Config);
			echo('`); document.getElementById("DivContenedor' . $Id . '").Config = Config; </script>');//console.log(Config);
		}
		
		
		public static function CrearInputUploadFiles($Id,$ListadoId,$FicherosPermitidos,$Funcion,$Tamaño,$Filtro){
			echo('
			<div class="col-md-' . $Tamaño . '" funcion="' . $Funcion . '" Filtro="' . $Filtro. '">
				<label class="file">
					<input class="InputUploadFiles" type="file" id="' . $Id . '" multiple accept="' . $FicherosPermitidos . '" >
					<span class="SpanFile">...</span>
				</label>
				<div class="ListaDeArchivos" id="' . $ListadoId . '"></div>
			</div>
			');
			/*
			
				<div class="input-group">
				</div>
			*/
		}
		
		public static function CrearSelectt2($Id,$Texto,$Tamaño,$Extra = false,$requiered = false){
			$ConfiguracionExtra = "";
			$ValorRequerido ="";
			if($Extra != false){
				$ConfiguracionExtra = $Extra;
			}
			if($requiered){
				$ValorRequerido ="*";
			}
			echo('
			<div class="col-md-' . $Tamaño . '">
				<div class="form-group">
					<label class="control-label">' . $Texto . '
						<span class="required" aria-required="true">' . $ValorRequerido . '</span>
						<b id="BoltText' . $Id . '"></b><!-- BoltTextCliente -->
					</label>
					<div>
					<select id="' . $Id . '" name="' . $Id . '" class="select-2 form-control select1-Borrado  select1-hidden-accessible-Borrado" '. $ConfiguracionExtra .'>
						</select>
					</div>
				</div>
			</div>
			');
			/*
			echo("
				<script>
					$(document).ready(function() {
						$('#" . $Id . "').select2();
					});
				</script>
			");
			*/
		}
		
		public static function CrearSelectt($Id,$Texto,$Tamaño,$Extra = false){
			$ConfiguracionExtra = "";
			if($Extra != false){
				$ConfiguracionExtra = $Extra;
			}
			echo('
			<div class="col-md-' . $Tamaño . '">
				<div class="form-group">
					<label class="control-label">' . $Texto . '
						<span class="required" aria-required="true">*</span>
						<b id="BoltText' . $Id . '"></b><!-- BoltTextCliente -->
					</label>
					<div>
						<select id="' . $Id . '" name="' . $Id . '" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true" '. $ConfiguracionExtra .'>
						</select>
					</div>
				</div>
			</div>
			');
		}
		
		public static function CrearIniRow($Tamaño,$style = ""){
			echo('
			<div class="col-md-' . $Tamaño . '" style="' . $style . '">
			');
		}
			
		public static function CrearFinRow(){
			echo('
			</div>
			');
		}
		
		public static function CrearFormularioCheck($id = "",$Tamaño,$Texto,$Comentario,$iclass = "",$Valores,$PrimeroSeleccionado = false){
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<fieldset id="' . $id . '">
			');
			for($i=0;$i<count($Valores);$i++){
				if($i==0 and $PrimeroSeleccionado){
					$checked='checked="checked"';
				}else{$checked='';}
				echo('
					<label style="display: block;" class="' . $iclass . '">
						<input  id="' . $id . '-' . $i . '" type="checkbox" value="' . $i . '" ' . $checked. '>' . $Valores[$i] . '
					</label>
				');
			}
			echo('
				</fieldset>
			</div>
			');
		
		}
		
		public static function CrearFormularioRadio($id = "",$Tamaño,$Texto,$Comentario,$iclass = "",$Valores){
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<fieldset class="' . $iclass . '">
			');
			for($i=0;$i<count($Valores);$i++){
				if($i==0){
					$checked='checked="checked"';
				}else{$checked='';}
				echo('
					<input style="display: block;" id = "' . $id . '" type="radio" name="color" value="' . $i . '" ' . $checked. '>' . $Valores[$i] . '
				');
			}
			echo('
				</fieldset>
			</div>
			');
		
		}
		
		public static function CrearBotonFrancisco($Funcion,$Tamaño,$Texto,$Comentario,$id = "",$iclass = "",$TextoExtra = ""){
			//fas fa-search
			
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<div class="span9 btn-block">
					<button id = "' . $id . '" class="btn btn-secondary mx-1 my-1 px-1 py-1 align-middle" type="button" onclick="' . $Funcion . '">
						<i class="' . $iclass . '"></i>
						' . $Texto . '
					</button>
					<b style="color:#0000C0;font-size: 10px;width: 90%;">' . $TextoExtra . '</b>
					<div class="col-md-12" style= "text-align:center; color:#0000C0; font-size:10px;">' . $Comentario . '</div>
				</div>
			</div>
			');
		}
		
		public static function CrearImput($Id,$Tipo,$Texto,$Tamaño,$Extra = false,$requiered = false,$autojs = true){
			$Password = "";
			$ValorRequerido ="";
			if($Tipo == "password"){
				$Password = 'autocomplete="new-password"';
			}
			$ConfiguracionParaNumerico = "";
			if($Extra != false){
				$ConfiguracionParaNumerico = $Extra;
			}
			if($requiered){
				$ValorRequerido ="*";
			}
			$Info = "";
			if($Tipo=="Celular"){
				$Info = "Codigo De Area + Numero Personal 10 Digitos";
			}
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<div class="form-group">
					<label class="control-label">' . $Texto . '
						<span class="required" aria-required="true">' . $ValorRequerido . '</span>
						<b style="color:#0000FF;font-size: 10px;width: 90%;">' . $Info . '</b>
						<b id="BoltText' . $Id . '"><b style="color:#FF0000;font-size: 10px;width: 90%;"></b></b>
					</label>
					<div>
						<input ' . $Password . ' placeholder="' . $Texto . '" type="' . $Tipo . '" id="' . $Id . '" name="' . $Id . '" class="form-control" ' . $ConfiguracionParaNumerico .'>
					</div>
				</div>
			</div>
			');
			if($autojs){
				echo("
				<script>
					var Config = JSON.parse(`{
						\"Elemento\":\"" . $Id . "\",
						\"ElementoTexto\":\"BoltText" . $Id . "\",
						\"DigitosMinimos\":\"1\",
						\"TextoInicial\":\"\",
						\"TextoMenor\":\"\"
					}`);
					Texto(Config);
				</script>
			");
		}
		}
		public static function CrearTerminosYCondiciones($Id,$IdButton,$Texto,$Linck,$MyURL,$Tamaño){
			//fas fa-search
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<input type="checkbox" id="' . $Id . '" avilitar="' . $IdButton . '" value="first_checkbox" style="width: 30px;height: 30px;" ></input>' . $Texto . '<a style="vertical-align: bottom;" data-toggle="modal" data-target="#ModalDatos">' . $Linck . '</a>
				
			</div>
			');
		}
		
		public static function CrearBotonDisabled($Funcion,$Tamaño,$Texto,$Comentario,$id = ""){
			//fas fa-search
			
			echo('
			<div class="col-md-' . $Tamaño . '" style="">
				<div class="span9 btn-block">
					<button id = "' . $id . '" class="btn btn-large btn-block btn-tertiary disabled" type="button" onclick="' . $Funcion . '">
						<i class=""></i>
						' . $Texto . '
					</button>
					<div class="col-md-12" style= "text-align:center; color:#0000C0; font-size:10px;">' . $Comentario . '</div>
				</div>
			</div>
			');
		}
		
		public static function CrearBoton($Funcion,$Tamaño,$Texto,$Comentario,$id = "",$StyleDiv = "",$StyloDeBoton = "btn btn-large btn-block btn-tertiary"){
			//fas fa-search
			echo('
			<div class="col-md-' . $Tamaño . '" style="' . $StyleDiv . '">
				<div class="span9 btn-block">
					<button id = "' . $id . '" class="'. $StyloDeBoton .'" type="button" onclick="' . $Funcion . '">
						<i class=""></i>
						' . $Texto . '
					</button>
					<div class="col-md-12" style= "text-align:center; color:#0000C0; font-size:10px;">' . $Comentario . '</div>
				</div>
			</div>
			');
		}
		
		
		public static function CrearDesplegableConTitulo($Titulo,$Id){
			echo('
			<div class="btn-minimize-CajaDeGrupos" for="' . $Id . '">
				<div class="col-md-12">
					<div class="form-group">
						<h1 class="tituloFormulario-Desplegable form-section" id="" style="text-align: center;">' . $Titulo . '</h1>
					</div>
				</div>
			</div>
			<div id="" style="background: aliceblue;border-bottom-right-radius: 20px 20px!important;border-bottom-left-radius: 20px 20px!important;border: 2px solid rgba(0, 0, 0, .2);">
				<div class="CajaDeGrupos" id="' . $Id . '">
			');
		}
		public static function CerrarDesplegableConTitulo(){
			echo('
				<hr class="size1 hideline">
				</div>
			</div>
			');
		}
		
		public static function CrearTitulo($Titulo){
			echo('
			<div class="col-md-12">
				<div class="form-group">
					<h1 class="tituloFormulario form-section" id="" style="text-align: center;">' . $Titulo . '</h1>
				</div>
			</div>
			');
		}
		
		public static function CrearLeftTitulo($Titulo){
			echo('
			<div class="col-md-12">
				<div class="form-group">
					<h1 class="tituloFormulario form-section" id="" >' . $Titulo . '</h1>
				</div>
			</div>
			');
		}
		
		public static function CrearSubMenu($Titulo,$URL,$PermisosFicherosDeMenues){
			if(array_search(explode('/',$URL)[0], $PermisosFicherosDeMenues) !== false){
				if(SUBDOMINIO != ""){
					echo(
						'<a class="ElementosDeSubMenu collapse list-group-item list-group-item-action text-light collapse-item" href="/' . SUBDOMINIO . '/' . $URL . '">' .
							'<i></i>' . $Titulo .
						'</a>'
					);
				}else{
					echo(
						'<a class="ElementosDeSubMenu collapse list-group-item list-group-item-action text-light collapse-item" href="/' . $URL . '">' .
							'<i></i>' . $Titulo .
						'</a>'
					);
				}
			}else{
				//echo(explode('/',$URL)[0]);
			}
		}
		public static function CrearMenu($Titulo,$URL,$Icono,$PermisosFicherosDeMenues){
			if(array_search(explode('/',$URL)[0], $PermisosFicherosDeMenues) !== false){
				if(SUBDOMINIO != ""){
					echo(
						'<a class="list-group-item list-group-item-action sidebar text-light" href="/' . SUBDOMINIO . '/' . $URL . '">' .
							'<i class="' . $Icono . '"></i> ' .
							'<font style="vertical-align: inherit;"> ' .
								'<font style="vertical-align: inherit;">' .
									$Titulo .
								'</font>' .
							'</font>' .
						'</a>'
					);
				}else{
					echo(
						'<a class="list-group-item list-group-item-action sidebar text-light" href="/' . $URL . '">' .
							'<i class="' . $Icono . '"></i> ' .
							'<font style="vertical-align: inherit;"> ' .
								'<font style="vertical-align: inherit;">' .
									$Titulo .
								'</font>' .
							'</font>' .
						'</a>'
					);
				}
			}else{
				//echo(explode('/',$URL)[0]);
			}
		}
		public static function CrearMainMenu($id,$Titulo,$Icono,$TituloSubMenues,$URLSubMenues,$PermisosFicherosDeMenues){
			//print_r($URLSubMenues);
			$URLConPermisos = $URLSubMenues;
			for($i = 0; $i < count($URLSubMenues);$i++){
				$URLConPermisos[$i] = explode('/',$URLSubMenues[$i])[0];
			}
			$Encontrados =  array_intersect($URLConPermisos, $PermisosFicherosDeMenues);
			//print_r($PermisosFicherosDeMenues);
			//print_r($URLConPermisos);
			//print_r($Encontrados);
			if(count($Encontrados) > 0 ){
				echo(
					'<a class="nav-item">' .
						'<a id="' . $id . '" class="list-group-item list-group-item-action sidebar text-light" href="#' . $id . '" data-toggle="collapse" data-target="#collapse' . $id . '" aria-expanded="true" aria-controls="collapsePages">' .
							'<i class="' . $Icono . '"></i>' .
							'<span>' . $Titulo . '</span>' .
						'</a>' .
						'<div id="collapse' . $id . '" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">'
				);
				for($i=0; $i < count($TituloSubMenues); $i++){
					Elementos::CrearSubMenu($TituloSubMenues[$i],$URLSubMenues[$i],$PermisosFicherosDeMenues);
				}
				echo(
						'</div>' .
					'</a>'
				);
			}
		}
		
		public static function CrearImputDeFecha($id,$IdImput,$Texto,$Tamaño,$Extra = false){
			
			$ConfiguracionParaNumerico = "";
			if($Extra != false){
				$ConfiguracionParaNumerico = $Extra;
			}
			echo('
				<div class="col-sm-' . $Tamaño . '">
					<div class="form-group">
						<label class="control-label">' . $Texto . ':
							<span class="required" aria-required="true">*</span>
							<b id="BoltText' . $IdImput . '"></b>
						</label>
						<div class="input-group FechaHoraMinuto" id="' . $id . '">
							<input type="text" class="form-control" id="' . $IdImput . '" name="' . $IdImput . '" value="01/01/2025 00:00"/ ' . $ConfiguracionParaNumerico .'>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
			');
		}
		public static function Creardashboard($Iddashboard,$IdValor,$Texto,$Tamaño,$IdUncolor,$Sizable){
			echo('
				<div class="col-sm-' . $Tamaño . ' col-xs-12 pointer">
					<div id="' . $Iddashboard . '" class="dashboard-stat purple-plum MaximixedTable" Uncolor="' . $IdUncolor . '" Sizable="' . $Sizable . '" >
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div id="' . $IdValor . '" class="number">0</div>
							<div class="desc">' . $Texto . '</div>
						</div>
					</div>
				</div>
			');
		}
		public static function CrearTabladashboard($Elementos,$Tamaño,$TituloDeTabla,$Display = "display: none",$Info = true,$NumeroDeFilas = 100,$StyleNumeroDeFilasDiv = "", $StyleDescargasDiv = "", $FullVertical = true, $StyleDivPrimario = "",$StylePaginador = ""){
			$IdTabladashboard = "Sizable" . $Elementos;
			$IdDiv = "Div" . $Elementos;
			$IdPaginador = "DivPaginador" . $Elementos;
			$IdMaximoDeFilas = "MaximoDeFilas" . $Elementos;
			$IdTabla = "Tabla" . $Elementos;
			if($FullVertical){
				$classportletlight = "portlet light";
			}else{
				$classportletlight = "";
			}
			//			<hr>
			//				<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
			echo('
			<div class="col-sm-' . $Tamaño . ' col-xs-3" style="overflow-x:auto;' . $StyleDivPrimario . '">
				<div class="' . $classportletlight . '" id="' . $IdTabladashboard . '" style="'. $Display . '">
				
			');
			if($TituloDeTabla!=""){
				echo('
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase"></span>
							<span class="caption-helper" style="border-bottom: 2px solid #0068a9!important;">' . $TituloDeTabla . '</span>
						</div>
				');
				if($Info){
					echo('
						<div class="actions">
							<a class="TextoSombreado" href="javascript:HideFullScreen(\'Sizable\');" data-original-title="" title="">
							<B style="color:#3030ff;">Volver</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen(\'Sizable\');" data-original-title="" title="">
							</a>
						</div>
					');
				}
				echo('
					</div>
				');
			}
			echo('
					<div class="col-sm-12" id="' . $IdDiv . '" >
						<hr class="size2 hideline">
						<div class="Paginador" id="' . $IdPaginador . '" style="' . $StylePaginador . '">
						</div>
						<div class="col-md-12 MaximoDeFilas" style="' . $StyleNumeroDeFilasDiv . '">
							<b>Numero De Lineas Por Pagina</b>
							<input placeholder="" type="numberNoFloat" id="' . $IdMaximoDeFilas . '" " value="' . $NumeroDeFilas . '" style="">
						</div>
						<div class="col-sm-4" style="' . $StyleDescargasDiv . '">
							<label class="control-label"> Exportar Tabla A Archivo
								<span class="required" aria-required="true"></span>
							</label>
							<div class="btn-group">
								<button style="border-color: black;" onclick="DescargarTablaXLSX(\'' . $IdDiv . '\')" class="btn" title="XLSX Para Exel">
									<span>
										<i class="fas fa-file-excel" style="color:green;"></i>
									</span>
								</button>
								<button style="border-color: black;" onclick="DescargarTablaCSV(\'' . $IdDiv . '\')" class="btn" title="CSV Para Exel">
									<span>
										<i class="fas fa-file-csv" style="color:blue;"></i>
									</span>
								</button>
								<button style="border-color: black;" onclick="DescargarTablaPDF(\'' . $IdDiv . '\')" class="btn" title="PDF Para Adove">
									<span>
										<i class="fas fa-file-pdf" style="color:red;"></i>
									</span>
								</button>
							</div>
						</div>
						<table id="' . $IdTabla . '" style="white-space: nowrap;">
						</table>
					</div>
					
				</div>
			</div>
			');
		}
		
		/**
		 * TABLA MODIFICADA
		 */
		public static function CrearTabla($Elementos,$Tamaño,$TituloDeTabla,$Display = "display: none",$Info = true,$NumeroDeFilas = 100,$StyleNumeroDeFilasDiv = "", $StyleDescargasDiv = "", $FullVertical = true, $StyleDivPrimario = "",$StylePaginador = ""){
			$IdTabladashboard = "Sizable" . $Elementos;
			$IdDiv = "Div" . $Elementos;
			$IdPaginador = "DivPaginador" . $Elementos;
			$IdMaximoDeFilas = "MaximoDeFilas" . $Elementos;
			$IdTabla = "Tabla" . $Elementos;
			if($FullVertical){
				$classportletlight = "portlet light";
			}else{
				$classportletlight = "";
			}
			//			<hr>
			//				<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
			echo('
			<div class="col-sm-' . $Tamaño . ' col-xs-3" style="overflow-x:auto;' . $StyleDivPrimario . '">
				<div class="' . $classportletlight . '" id="' . $IdTabladashboard . '" style="'. $Display . '">
				
			');
			if($TituloDeTabla!=""){
				echo('
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase"></span>
							<span class="caption-helper" style="border-bottom: 2px solid #0068a9!important;">' . $TituloDeTabla . '</span>
						</div>
				');
				if($Info){
					echo('
						<div class="actions">
							<a class="TextoSombreado" href="javascript:HideFullScreen(\'Sizable\');" data-original-title="" title="">
							<B style="color:#3030ff;">Volver</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen(\'Sizable\');" data-original-title="" title="">
							</a>
						</div>
					');
				}
				echo('
					</div>
				');
			}
			echo('
					<div class="col-sm-12" id="' . $IdDiv . '" >
						<hr class="size2 hideline">
						<div class="Paginador" id="' . $IdPaginador . '" style="' . $StylePaginador . '">
						</div>
						<div class="col-md-12 MaximoDeFilas" style="' . $StyleNumeroDeFilasDiv . '">
							<b>Numero De Lineas Por Pagina</b>
							<input placeholder="" type="numberNoFloat" id="' . $IdMaximoDeFilas . '" " value="' . $NumeroDeFilas . '" style="">
						</div>
						<div class="col-sm-4" style="' . $StyleDescargasDiv . '">
							<label class="control-label"> Exportar Tabla A Archivo
								<span class="required" aria-required="true"></span>
							</label>
							<div class="btn-group">
								<button style="border-color: black;" onclick="DescargarTablaXLSX(\'' . $IdDiv . '\')" class="btn" title="XLSX Para Exel">
									<span>
										<i class="fas fa-file-excel" style="color:green;"></i>
									</span>
								</button>
								<button style="border-color: black;" onclick="DescargarTablaCSV(\'' . $IdDiv . '\')" class="btn" title="CSV Para Exel">
									<span>
										<i class="fas fa-file-csv" style="color:blue;"></i>
									</span>
								</button>
								<button style="border-color: black;" onclick="DescargarTablaPDF(\'' . $IdDiv . '\')" class="btn" title="PDF Para Adove">
									<span>
										<i class="fas fa-file-pdf" style="color:red;"></i>
									</span>
								</button>
							</div>
						</div>
						<table id="' . $IdTabla . '" class="table table-striped table-bordered nowrap" style="width:100%">
						</table>
					</div>
					
				</div>
			</div>
			');
		}
		
	}
?>

















































