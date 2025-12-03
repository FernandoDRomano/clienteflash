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
		Elementos::CrearDesplegableConTitulo("Crear Menu","1");
		Elementos::CrearLeftTitulo("Crear Menu");
		Elementos::CrearImput("MenuNombre","text","Nombre","4");
		Elementos::CrearImput("MenuCarpetaRaiz","text","Carpeta Raiz","4");
		Elementos::CrearImput("MenuVistaDeMenu","textWeb","Vista De Menu","4");
		Elementos::CrearBoton("CrearMenues();","12","Crear Menu","");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		//Titulo
		Elementos::CrearDesplegableConTitulo("Lista De Menues","2");
		Elementos::CrearBoton("BuscarMenues();","12","Buscar Menues Creados","");
		Elementos::Creardashboard("","MenuesCreados","Menues Creados","12","Uncolor","SizableMenuesCreados");
		Elementos::CrearTabladashboard("MenuesCreados","12","Menues Creados");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
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
	
	?>







