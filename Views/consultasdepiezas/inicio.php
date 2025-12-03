<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
?>
<html lang="es" style="width:98%;height:90%">
	<head>
		<title>MisEnvios</title>
	</head>
	<style>
		#ModalDatos ::-webkit-scrollbar {
		width: 16px;
		}
		#ModalDatos ::-webkit-scrollbar-track {
		background: #00F0F0; 
		}
		#ModalDatos ::-webkit-scrollbar-thumb {
		background: #00B0B0;
		}
		#ModalDatos ::-webkit-scrollbar-thumb:hover {
		background: #00A0A0; 
		}
		.form-control:focus {
			box-sizing: border-box;
			box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25) !important;
		}
		.card-header {
			color: #fff;
			background-color: #292d57;
			border-bottom: 1px solid #292d57;
			padding: .75rem 1.25rem;
		}
	</style>
	<div class="col-md-12">
		<div class="form-group">
			<div id="ModalDatos" class="modal fade" >
				<div class="row" id="container" style=" background: rgb(255, 255, 255);position: absolute;overflow-y: auto;bottom: 10px;top: 10px;width: -webkit-fill-available;margin-right: 50px;margin-left: 100px;">
					<div class="card mx-2 my-2 px-2 py-2">
						<div class="card-header text-uppercase font-weight-bold">
									<P id="DatosDePieza"></P>
						</div>
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-3 text-center">
									<b id="BoltApellidoYNombre" for="ApellidoYNombre">Apellido y Nombre:</b>
									<input type="text" class="form-control text-center" id="ApellidoYNombre" name="ApellidoYNombre" placeholder="" value="" autocomplete="off" readonly="">
								</div>
								<div class="form-group col-md-2">
									<b id="BoltDNI" for="">DNI / DU:</b>
									<input type="number" class="form-control" id="DNI" name="DNI" placeholder="" value="" autocomplete="off" readonly="">
								</div>
								<div class="form-group col-md-5">
									<b id="BoltDomicilio" for="Domicilio">Dirección de Entrega:</b>
									<input type="text" class="form-control" id="Domicilio" name="Domicilio" placeholder="" value="" autocomplete="off" readonly="">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<b id="BoltNumPiezaCorreo" for="NumPiezaCorreo">Codigo Externo:</b>
									<input type="text" class="form-control" id="NumPiezaCorreo" name="NumPiezaCorreo" placeholder="" value="" autocomplete="off" readonly="">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<b id="BoltEstadoPieza" for="EstadoPieza">Ultimo estado:</b>
									<input type="text" class="form-control" id="EstadoPieza" name="EstadoPieza" placeholder="" value="" autocomplete="off" readonly="">
								</div>
								<div class="form-group col-md-2">
									<b id="BoltFechaEstadoPieza" for="FechaEstadoPieza">Fecha último estado:</b>
									<input type="text" class="form-control" id="FechaEstadoPieza" name="FechaEstadoPieza" placeholder="" value="" autocomplete="off" readonly="">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<b id="Boltrecibio" for="recibio">Recibió:</b>
									<input type="text" class="form-control" id="recibio" name="recibio" placeholder="" value="" autocomplete="off" readonly="">
								</div>
								<div class="form-group col-md-2">
									<b id="Boltdocumento" for="documento">Documento:</b>
									<input type="text" class="form-control" id="documento" name="documento" placeholder="" value="" autocomplete="off" readonly="">
								</div>
								<div class="form-group col-md-2">
									<b id="Boltvinculo" for="vinculo">Vínculo:</b>
									<input type="text" class="form-control" id="vinculo" name="vinculo" placeholder="" value="" autocomplete="off" readonly="">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-8">
									<div class="card-header text-uppercase font-weight-bold">Movimientos</div>
									<table id="movimientos" class="table table-striped dt-responsive nowrap mx-2 my-2 px-2 py-2" style="width:100%">
									</table>
								</div>
							</div>
							<div class="form-group">
								<button type="button"  class="btn btn-secondary" id="SalirDeModal"> <!-- onclick="javascript:window.history.back();" -->
									<i class="fas fa-arrow-circle-left"></i>
									<font style="vertical-align: inherit;">
										<font style="vertical-align: inherit;">
											Volver
										</font>
									</font>
								</button>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<h3 class="tituloFormulario form-section" id=""></h3>
								</div>
							</div>
							<style>
								ul.pagination li a.active{
									background: #CDDC39;
								}
								#ParaTabla{
									overflow-x: scroll !important;
									margin: 0 auto;
									white-space: nowrap;
								}
							</style>
							
							<button id="MaximizeBoxDetalle" class="collapsible" readonly>Desplegar Resultados</button>
							<div class="content" style="">
								<div class="formright" style="text-align: text-align: left;">
									<button onclick="DescargarTablas('MainTablaDetalle','DetalleDePiezas');" type="button"  id="Buscar" style="height: 40px; background-color: #ffffff00;">
										<i class="fas fa-file-excel fa-2x" style="color:green;"></i>
									</button>
								</div>
								<div id="DivPaginadorDetalle">
								</div>
								<div  id="DivDeTablaDetalle">
									<div class="form-group" id="ParaTabla">
										<div id="MainTablaDetalle" ></div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<body >
		<div class="row" id="container">
			<div class="col-md-12">
				<div class="form-group">
					<h3 class="tituloFormulario form-section" id="">Busque Las Piezas Para Editar Estados</h3>
				</div>
			</div>
			
			<div class="col-md-8" style="">
				<div class="col-md-6" style="">
					<div class="form-group">
						<label class="control-label">DNI / DU:
							<span class="required" aria-required="true"></span>
							<b id="BoltTextDNIBusqueda"><b style="color:#FF0000;font-size: 10px;width: 90%;">
							<!--<a data-toggle="modal" data-target="#myModal">(?)Ver Ayuda.</a> --></b></b>
						</label>
						<div>
							<input placeholder="" type="numberNoFloat" id="DNIBusqueda" name="DNIBusqueda" class="form-control" value="">
						</div>
					</div>
				</div>
				<select id="ConfigContainer" hidden> <!--  -->
					<option value="0">Seleccione</option>
					<option value="1">Seleccione</option>
				</select>
						
				<div class="col-md-6" style="">
					<div class="form-group">
						<label class="control-label">Apellido y Nombre:
							<span class="required" aria-required="true"></span>
							<b id="BoltTextDestinatario"><b style="color:#FF0000;font-size: 10px;width: 90%;">
							<!--<span class="required" aria-required="true">*</span>-->
							<!-- <a data-toggle="modal" data-target="#myModal">(?)Ver Ayuda.</a> --></b></b>
						</label>
						<div>
							<input placeholder="" type="text" id="Destinatario" name="Destinatario" class="form-control" value="">
						</div>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class="form-group">
						<label class="control-label">Desde:
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextDesde"></b>
						</label>
						<div class='input-group FechaHoraMinuto' >
							<input type='text' class="form-control" id="Desde"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class="form-group">
						<label class="control-label">Hasta:
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextHasta"></b>
						</label>
						<div class='input-group FechaHoraMinuto' >
							<input type='text' class="form-control" id="Hasta"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="">
					<div class="form-group">
						<label class="control-label">Numero De Pieza:
							<span class="required" aria-required="true"></span>
							<b id="BoltTextNumeroDePieza"><b style="color:#FF0000;font-size: 10px;width: 90%;">
							<!--<span class="required" aria-required="true">*</span>-->
							<!-- <a data-toggle="modal" data-target="#myModal">(?)Ver Ayuda.</a> --></b></b>
						</label>
						<div>
							<input placeholder="" type="text" id="NumeroDePieza" name="NumeroDePieza" class="form-control" value="">
						</div>
					</div>
				</div>
			</div>
			<style>
				.btn-secondary {
					color: #fff !important;
					background-color: #6c757d;
					border-color: #6c757d;
				}
			</style>
			<div class="col-md-4" style="">
				<div class="col-md-12" style="">
					<div class="form-group">
						<button id="btnBuscar" type="button" onclick="BuscarResultados();" class="btn btn-secondary mx-1 my-1 px-1 py-1 align-middle">
						<i class="fas fa-search"></i>Buscar</button><b style="color:#0000C0;font-size: 10px;width: 90%;">*Se Incluye Un Hipervínculo En Tabla De Resultados</b>
					</div>
				</div>
				
				<div class="col-md-10" style="">
					<div class="form-group">
						<button id="btnReporte" type="button" onclick="DescargarReporteCompleto();" class="btn btn-secondary mx-1 my-1 px-1 py-1 align-middle">
						<i class="fas fa-scroll"></i> Reporte
						</button>
					</div>
				</div>
			</div>
			<hr>
			<div class="col-md-12" style="">
				<div class="form-group">
					<label class="control-label">Cantidad Maxima De Resultados En Tabla:
						<span class="required" aria-required="true"></span>
						<b id="BoltTextDNIBusqueda"><b style="color:#FF0000;font-size: 10px;width: 90%;">
						<!--<a data-toggle="modal" data-target="#myModal">(?)Ver Ayuda.</a> --></b></b>
					</label>
					<div class="col-md-2" style="">
						<div>
							<input placeholder="" type="numberNoFloat" id="CantidadDeResultadosEnTabla" name="CantidadDeResultadosEnTabla" class="form-control" value="50">
						</div>
					</div>
				</div>
			</div>
			
			
				
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<!--
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Seleccione Estado De Cliente:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextActividadDeClientes"></b>
					</label>
					<div>
						<select id="ActividadDeClientes" name="ActividadDeClientes" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true">
							<option value="0">Seleccione</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Seleccione Cliente:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextClientes"></b>
					</label>
					<div>
						<select id="Clientes" name="Clientes" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true" readonly>
							<option value="0">Seleccione</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Comprobante De Ingreso De Gesstion Postal:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextComprobanteDeIngreso"></b>
					</label>
					<div>
						<select id="ComprobanteDeIngreso" name="ComprobanteDeIngreso" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true" readonly>
							<option value="0">Seleccione</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Comprobante De Ingreso De Ocasa:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextComprobanteDeIngresoOcasa"></b>
					</label>
					<div>
						<select id="ComprobanteDeIngresoOcasa" name="ComprobanteDeIngresoOcasa" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true" readonly>
							<option value="0">Seleccione</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<button onclick="MandarDatosTablaDefault();" type="button" class="btn btn-default">
					<i class="fa fa-check" style="color:#000000;"></i>Mandar Datos Tildados De Gestion Postal
				</button>
				<div class="col-md-12">
					<label class="control-label" >
						<div class="Subiendo" id="PreLoaderBar" style="background-color: #C3C3C3;">
							<b id="TextUpload" class="Aceptando"></b>
							<div class="indeterminate" id="LoadBar"></div>
						</div>
					</label>
				</div>
			</div>
			<div class="col-md-12">
				<button onclick="MandarDatos();" type="button" class="btn btn-default">
					<i class="fa fa-check" style="color:#000000;"></i>Mandar Datos Tildados De Ocasa
				</button>
				<div class="col-md-12">
					<label class="control-label" >
						<div class="Subiendo" id="PreLoaderBar" style="background-color: #C3C3C3;">
							<b id="TextUpload" class="Aceptando"></b>
							<div class="indeterminate" id="LoadBar"></div>
						</div>
					</label>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<h3 class="tituloFormulario form-section" id="">Resultados De Gestion Postal</h3>
				</div>
			</div>
			<button id="MaximizeBoxGestion" class="collapsible" readonly>Desplegar Resultados</button>
			<div class="content" style="">
				<div class="formright" style="text-align: text-align: left;">
						<button onclick="DescargarTablas('MainTabla','Gestion Postal');" type="button"  id="Buscar" >
							<i class="fas fa-file-excel" style="color:green;"></i>
						</button>
				</div>
				<div id="DivPaginadorGestionPostal">
				</div>
				<div  id="DivDeTabla">
					<div class="form-group" >
						<div id="MainTabla" ></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<h3 class="tituloFormulario form-section" id="">Resultados De Ocasa</h3>
				</div>
			</div>
			-->
			<div class="col-md-12">
				<div class="form-group">
					<h3 class="tituloFormulario form-section" id=""></h3>
				</div>
			</div>
			<button id="MaximizeBox" class="collapsible" readonly>Desplegar Resultados</button>
			
			<div class="content" style="overflow-x: scroll;">
				<div class="formright" style="text-align: text-align: left;">
					<!--
					<button onclick="DescargarTablas('DivDeTabla','DetalleDePiezas');" type="button"  id="Buscar" style="height: 40px; background-color: #ffffff00;">
					-->
					<button onclick="DescargarReporteCompletoUltimosEstados();" type="button"  id="Buscar" style="height: 40px; background-color: #ffffff00;">
						<i class="fas fa-file-excel fa-2x" style="color:green;"></i>
					</button>
				</div>
				<style>
					.control-label.Active{
						background: none;
					}
					#TablaDeResultados{
						display: contents;
					}
				</style>
				<div id="DivPaginador">
				</div>
				<div  id="DivDeTabla">
					<div class="form-group" >
						<div id="MainTabla" ></div>
					</div>
				</div>
			</div>
			</br>
			</br>
		</div>
	</body >
</html>
