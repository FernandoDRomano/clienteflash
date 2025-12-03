<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	
	
?>
<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">

<script>
	
</script>
<div id="TableroDeGestiones" style="background: aliceblue;">
	<div class='col-sm-6'>
		<div class="form-group">
			<label class="control-label">Fecha Inicial De Busqueda:
				<span class="required" aria-required="true">*</span>
				<b id="BoltTextFechaDesde"></b>
			</label>
			<div class='input-group FechaHoraMinuto' id='datetimepicker1'>
				<input type='text' class="form-control" id="FechaDesde" value="01/01/2020 00:00"/>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>

	<div class='col-sm-6'>
		<div class="form-group">
			<label class="control-label">Fecha Final De Busqueda:
				<span class="required" aria-required="true">*</span>
				<b id="BoltTextFechaHasta"></b>
			</label>
			<div class='input-group FechaHoraMinuto' id='datetimepicker2'>
				<input type='text' class="form-control" id="FechaHasta" value="01/01/2025 00:00"/>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	
	<div class="col-md-12" style="">
		<div class="col-md-12" style="">
			<div class="form-group">
				<button id="btnBuscar" type="button" onclick="Buscar();" class="btn btn-secondary mx-1 my-1 px-1 py-1 align-middle">
				<i class="fas fa-search"></i>Buscar</button><b style="color:#0000C0;font-size: 10px;width: 90%;"></b>
			</div>
		</div>
	</div>
	 
	<div id="Pannel">
		<div class="row" id="dashboardStats">
			<div class="col-sm-3 col-xs-12">
				<div id="divColor1" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTarjetasIngresadas" >
					<div class="visual"><i class="fa fa-globe"></i></div>
					<div class="details">
						<div id="TarjetasIngresadas" class="number">0</div>
						<div class="desc">Tarjetas Ingresadas</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12">
				<div id="divColor2" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTarjetasEnGestion" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="TarjetasEnGestion" class="number">0</div>
						<div class="desc">Tarjetas En Gestion</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12">
				<div id="divColor3" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTarjetasEntregadas" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="TarjetasEntregadas" class="number">0</div>
						<div class="desc">Tarjetas Entregadas</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12">
				<div id="divColor4" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTarjetasSolicitadasPorElClente" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="SolicitadasPorElCliente" class="number">0</div>
						<div class="desc">Solicitadas Por El Cliente</div>
					</div>
				</div>
			</div>
			<hr class="size1 hide">
			<div class="col-sm-12 col-xs-12">
				<div id="divColor5" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTarjetasNoEntregadas" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="TarjetasNoEntregadas" class="number">0</div>
						<div class="desc">Tarjetas No Entregadas</div>
					</div>
				</div>
			</div>
			
			<hr class="size1 hide">
			
			<hr class="size1 hide">
			<div class="col-sm-3 col-xs-12">
				<div id="divColor6" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableDomicilioInsuficiente" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="DomicilioInsuficiente" class="number">0</div>
						<div class="desc">Domicilio Insuficiente</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12">
				<div id="divColor7" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableSeMudo" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="SeMudo" class="number">0</div>
						<div class="desc">Se Mudo</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12">
				<div id="divColor8" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableFallecio" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="Fallecio" class="number">0</div>
						<div class="desc">Fallecio</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-3 col-xs-12">
				<div id="divColor9" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableSeNiegaARecibir" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="SeNiegaARecibir" class="number">0</div>
						<div class="desc">Se Niega A Recibir</div>
					</div>
				</div>
			</div>
			
			<hr class="size1 hide">
			
			<div class="col-sm-6">
				<div id="divColor10" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTresVisitas" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="SegundaVisitas" class="number">0</div>
						<div class="desc">Segunda Visitas</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div id="divColor10" class="dashboard-stat purple-plum MaximixedTable" Uncolor="MaximixedTable" Sizable="SizableTresVisitas" >
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div id="OtrasRazonesDeNoEntregadas" class="number">0</div>
						<div class="desc">Otras Razones De (No Entregadas)</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="col-sm-12 col-xs-12" id="GraficaGestion" ></div>
		<hr class="size1 hide">
		<div class="col-sm-12 col-xs-12" id="GraficaMotivos" ></div>
		<hr class="size1 hide">
		<!--
		<div class="container Grafica-2" id="GraficaGestion"></div>
		<div class="container Grafica-2" id="GraficaMotivos"></div>
		 -->
		 
		<hr class="size1 hide">
		
		
		<div class="row">
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTarjetasIngresadas" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Tarjetas Ingresadas</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTarjetasIngresadas" >
						<table id="TablaTarjetasIngresadas">
							<tr>
								<th>
									1
								</th>
								<th>
									2
								</th>
								<th>
									3
								</th>
								<th>
									4
								</th>
							</tr>
							<tr>
								<td>
								1
								</td>
								<td>
								2
								</td>
								<td>
								3
								</td>
								<td>
								4
								</td>
							</tr>
						</table>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTarjetasEnGestion" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Tarjetas En Gestion</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTarjetasEnGestion">
						<table id="TablaTarjetasEnGestion"></table>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTarjetasEntregadas" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Tarjetas Entegadas.</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTarjetasEntregadas" >
						<table id="TablaTarjetasEntregadas"></table>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTarjetasSolicitadasPorElClente" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Solicitadas Por El Cliente</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTarjetasSolicitadasPorElClente" >
						<table id="TablaTarjetasSolicitadasPorElClente"></table>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTarjetasNoEntregadas" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Tarjetas No Entregadas</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTarjetasNoEntregadas" >
						<table id="TablaTarjetasNoEntregadas"></table>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableDomicilioInsuficiente" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Domicilio Insuficiente</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivDomicilioInsuficiente" >
						<table id="TablaDomicilioInsuficiente"></table>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableSeMudo" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Se Mudo</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivSeMudo" >
						<table id="TablaSeMudo"></table>
					</div>
				</div>
			</div>
			<div id="divhide8" class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableFallecio" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Fallecio</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivFallecio" >
						<table id="TablaFallecio"></table>
					</div>
				</div>
			</div>
			<div id="divhide8" class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableSeNiegaARecibir" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Se Niega A Recibir</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivSeNiegaARecibir" >
						<table id="TablaSeNiegaARecibir"></table>
					</div>
				</div>
			</div>
			<div id="divhide8" class="col-sm-3 col-xs-3">
				<div class="portlet light" id="SizableTresVisitas" style="display: none">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase">Estadisticas</span>
							<span class="caption-helper">Tres Visitas</span>
							<hr>
							<span class="caption-helper">Los Datos Mostrados Contienen Resultados De La Fecha Buscada.</span>
						</div>
						<div class="actions">
							<a href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							<B style="color:#c21bde">Minimizar Tabla</B>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:HideFullScreen('Sizable');" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div id="DivTresVisitas">
						<table id="TablaTresVisitas"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



























<script>
	
	
	
	
</script>