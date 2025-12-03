<?php
	$Helps = array(
		'Titulo' => 'Guia De Elementos De select Automaticos<b style="color:#FF0000">Desde FlameSelect.js</b>',
		'Elementos' => array(
			array('Select1','Con Resultados Como Respuesta','Muestra Como Es El Resultado De La Busqueda De Datos Automatica De Select','','Ejecutando La Funcion <b style="color:#FF0000">SelectDesdeConsulta(Config)</b>',),
			array('Select2','Con Respuesta NULL','Muestra Una Respuesta <b style="color:#0000FF">bootstrapGrowl(Config)</b> Tras Una Busqueda En La Que No Se Encontro Respuesta Y Ajax PHP Retorna NULL ','','Ejecutando La Funcion <b style="color:#FF0000">SelectDesdeConsulta(Config)</b>',),
			array('Select3','Con Respuesta SinDatos','Muestra Una Respuesta <b style="color:#0000FF">bootstrapGrowl(Config)</b> Tras Una Busqueda En La Que Se Encontro Respuesta SinDatos Y Ajax PHP Retorna SinDatos','','Ejecutando La Funcion <b style="color:#FF0000">SelectDesdeConsulta(Config)</b>',),
		),
	);
	$Helps = json_encode($Helps);
	$Helps = json_decode($Helps, false);
?>

<style>
	.btn-info{
		color: #fff !important;
		background-color: #6c757d;
		border-color: #6c757d;
	}
</style>
<html lang="es" ><!-- style="width:98%;height:90%"-->
<head>
		<title>Flash-2019</title>
	</head>
	<body >
		<div id="loading" name="loading" style="display:none"></div>
		<?php  include("Views/Helps.php");?>
		<div class="row" id="container">
		
		
			<div class='col-sm-4'>
				<div class="form-group">
					<label class="control-label">FechaI Para Test:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextvolumenHastam3"></b>
					</label>
					<div class='input-group FechaHoraMinuto' id='datetimepicker1'>
						<input type='text' class="form-control" id="FechaI" value="01/01/2020 00:00"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
			<div class='col-sm-4'>
				<div class="form-group">
					<label class="control-label">FechaF Para Test:
						<span class="required" aria-required="true">*</span>
						<b id="BoltTextvolumenHastam3"></b>
					</label>
					<div class='input-group FechaHoraMinuto' id='datetimepicker2'>
						<input type='text' class="form-control" id="FechaF"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Select1 Resultados:
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextSelect1"></b><!-- BoltTextCliente -->
						</label>
						<div>
							<select id="Select1" name="Select1" class="select-2 form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true">
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Select2 NULL:
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextSelect2"></b><!-- BoltTextCliente -->
						</label>
						<div>
							<select id="Select2" name="Select2" class="select-2 form-control select1-Borrado  select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true"><!-- -->
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Select3 SinDatos:
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextSelect3"></b><!-- BoltTextCliente -->
						</label>
						<div>
							<select id="Select3" name="Select3" class="select-2 form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true">
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<div class="formright" style="text-align: -webkit-right;">
				<h3></h3><b id="Paragrap"></b>
				<button onclick="Buscar();" type="button" class="btn btn-info" id="btnGuardarFormulario" style="text-align: right;">Buscar</button>
				<button id="Liquidacion" onclick="DescargarTablas('MainTabla','Debito');" type="button" class="btn btn-info"  style="text-align: right;"><i class="fa fa-check"></i>Descargar</button>
				
			</div>
			
			
			<style type="text/css">
				#DivDeTabla{
					//overflow-x: scroll;
					margin: 0 auto;
					white-space: nowrap;
					max-width: 960px;
					width: auto;
					//height: 300px;
					//min-height: 100vh;
				}
				#TablaMain{
					height: 100%;
					max-height: 80vh;
					display: block;
					overflow-x: auto;
					overflow-y: auto;
					white-space: nowrap;
					min-height: 500px;
				}
			</style>
			<p  id="resultado1"></p>
			<div class="col-md-12">
				<hr style="margin-top:1px;margin-bottom:1px;">
			</div>
			<div  id="DivDeTabla">
				<div id="MainTabla" >
					
				</div>
			</div>
		</div>
	</body >
</html>






