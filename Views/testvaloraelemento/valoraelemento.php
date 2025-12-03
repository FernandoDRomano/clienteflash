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
		</div>
	</div>	
</div>