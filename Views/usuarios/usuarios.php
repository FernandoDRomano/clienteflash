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
		Elementos::CrearDesplegableConTitulo("Usuarios Creados","Titulo1");
		//Botones
		Elementos::CrearBoton("BuscarUsuario();","12","Buscar Usuarios Creados","");
		echo('<hr class="size1 hideline">');
		//Tablero
		Elementos::Creardashboard("","Usuarios","Usuarios Creados","12","Uncolor","SizableUsuariosCreados");
		echo('<hr class="size1 hideline">');
		//Tablas De Tableros
		Elementos::CrearTabladashboard("UsuariosCreados","12","Usuarios Creados");
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		//Titulo
		Elementos::CrearDesplegableConTitulo("Crear Usuarios","Titulo2");
		//Elementos Para Busqueda
		Elementos::CrearImput("UserUsuario","text","Alias","6");
		Elementos::CrearImput("UserPassword","password","Password","6");
		Elementos::CrearImput("UserNombre","text","Nombre/s","4");
		Elementos::CrearImput("UserApellido","text","Apellido/s","4");
		Elementos::CrearImput("UserEmail","textCorreo","Email","4");
		Elementos::CrearBoton("CrearUsuario();","12","Crear Usuarios","");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
	?>
	






