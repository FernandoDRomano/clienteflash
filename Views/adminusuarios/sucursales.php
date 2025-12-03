	<?php
		$Objeto = json_encode($_REQUEST);
		$Post = json_decode($Objeto, false);
		$InicioDeAnio = "InicioDeAnio";
		$Fecha = "Fecha";
		use Config\Elementos as Elementos;
		
	?>
	<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
	<?php
		//Titulo
		Elementos::CrearDesplegableConTitulo("Sucursales","1");
		Elementos::CrearLeftTitulo("Crear Sucursales");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("SucursalNombre","text","Nombre","12");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("CrearSucursal();","12","Crear Sucursal","");
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Buscar Sucursales");
		Elementos::CrearBoton("BuscarSucursales();","12","Buscar Sucursales Creadas","");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("","SucursalesCreadas","Sucursales Creadas","12","Uncolor","SizableSucursalesCreadas");
		Elementos::CrearTabladashboard("SucursalesCreadas","12","Sucursales Creadas");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		Elementos::CrearDesplegableConTitulo("Grupos De Sucursales","2");
		Elementos::CrearLeftTitulo("Crear Grupo De Sucursales");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("GrupoDeSucursalNombre","text","Nombre","12");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("CrearGrupoDeSucursal();","12","Crear Grupo De Sucursal","");
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Buscar Grupo De Sucursales");
		Elementos::CrearBoton("BuscarGrupoDeSucursales();","12","Buscar Grupos De Sucursales Creados","");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("","GrupoDeSucursalesCreadas","Grupos De Sucursales Creados","12","Uncolor","SizableGrupoDeSucursalesCreadas");
		Elementos::CrearTabladashboard("GrupoDeSucursalesCreadas","12","Grupos De Sucursales Creados");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		Elementos::CrearDesplegableConTitulo("Sucursales En Grupos De Sucursales","3");
		Elementos::CrearLeftTitulo("Asignar Y Quitar Sucursal A Grupo De Sucursales");
		echo('<hr class="size1 hideline">');
		Elementos::CrearSelectt("GrupoDeSucursal","Grupo De Sucursal","6");
		Elementos::CrearSelectt("Sucursales","Sucursal","6");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("AsignarSucursalAGrupoDeSucursal();","12","Asignar Sucursal A Grupo De Sucursal","");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("QuitarSucursalAGrupoDeSucursal();","12","Quitar Sucursal A Grupo De Sucursal","");
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Buscar Sucursales En Grupos De Sucursales");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("BuscarSucursalesEnGrupoDeSucursales();","12","Buscar Sucursales En Grupo De Sucursales","");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("","SucursalesAsignadasEnGruposDeSucursales","Sucursales Asignadas En Grupos De Sucursales","12","Uncolor","SizableSucursalesAsignadasEnGruposDeSucursales");
		Elementos::CrearTabladashboard("SucursalesAsignadasEnGruposDeSucursales","12","Sucursales Asignadas En Grupos De Sucursales");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		Elementos::CrearDesplegableConTitulo("Grupo De Sucursales De Usuario","4");
		Elementos::CrearLeftTitulo("Asignar Grupo De Sucursales A Usuario");
		echo('<hr class="size1 hideline">');
		Elementos::CrearSelectt("Usuario","Usuario","6");
		Elementos::CrearSelectt("GrupoDeSucursalParaUsuarios","Grupo De Sucursal","6");
		echo('<hr class="size1 hideline">');
		Elementos::CrearBoton("AsignarGrupoDeSucursalAUsuario();","12","Asignar Grupo De Sucursal A Usuario","");
		echo('<hr class="size2 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		
		
		
		/*
		//Titulo
		Elementos::CrearDesplegableConTitulo("Asignar Menu A Usuario","3");
		Elementos::CrearSelectt("Menues","Menues","6");
		Elementos::CrearSelectt("Usuario","Usuario","6");
		Elementos::CrearBoton("AsignarMenuAUsuario();","12","Asignar Menu A Usuario","");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		//Titulo
		Elementos::CrearDesplegableConTitulo("Crear Cliente","Titulo4");
		Elementos::CrearImput("ClienteUsuario","text","Alias","6");
		Elementos::CrearImput("ClientePassword","password","Password","6");
		Elementos::CrearImput("ClienteNombre","text","Nombre De Empresa","4");
		Elementos::CrearImput("ClienteNombreFantacia","text","Nombre De Fantacia","4");
		Elementos::CrearImput("ClienteEmail","textCorreo","Email","4");
		Elementos::CrearBoton("CrearCliente();","12","Crear Cliente","");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		*/
	?>







