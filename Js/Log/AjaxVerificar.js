function RecuperarCuenta(event, time) {
    event.preventDefault();
	var email = document.getElementById("email");

    if(email.value.length === 0){ 
        document.getElementById("Paragrapforget").innerHTML="Por favor ingrese su email";
        return;
    }

    if(!validateEmail(email.value)){
        document.getElementById("Paragrapforget").innerHTML="El email ingresado no es valido";
        return;
    }

    Loading();
    AjaxMasterRecuperar(email.value,time);
	
}
function validateEmail(email){
	var re = /\S+@\S+\.\S+/;
	return re.test(email);
}

function AjaxMasterRecuperar(Email,time){
	var Paragrap = document.getElementById("Paragrap");
	Loading();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		// Debug: Ver todos los cambios de estado
		// console.log("ReadyState:", this.readyState, "Status:", this.status);
		if (this.readyState == 4 && this.status == 200){
			var Resultado = this.responseText.trim();
			EndLoading();
			// Debug: Ver la respuesta del servidor antes de ejecutarla
			// console.log("Respuesta del servidor:", Resultado);
			// Ejecutar el código JavaScript recibido
			eval(Resultado);
		}else{
			if(this.readyState == 4){
				// Debug: Ver el error cuando no es status 200
				console.error("Error en la petición. Status:", this.status);
				console.error("Respuesta:", this.responseText);
				// window.location="403forbidden";
			}
		}
	};
	Email = Email.replace(/[^a-z0-9  ññ°°??¡¡@@[[\]\]\+\+¨¨**!!""##$$%%&&//(())==,,..;;::__\-\-{{}}´´''¿¿]/g,'');
	Email = encodeURIComponent(Email);
	xhttp.open("GET", "XMLHttpRequest/AjaxMasterRecuperar.php"+
	"?Time="+
	time+
	"&Email="+
	Email+
	"&NoMemory="+
	NoMemory
	, true);
	// console.log("XMLHttpRequest/AjaxMasterRecuperar.php"+"?Time="+time+"&Email="+Email+"&NoMemory="+NoMemory);
	xhttp.send();
}

function setVisible(selector, visible) {
	document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

$(document).ajaxStop(function(){
	setVisible('#loading', false);
});
setVisible('#loading', false);
function GoUrl(url){
	window.location.href =(url);
	//window.location.replace(url);
}

// Mostrar mensaje de error si existe desde el servidor
if(typeof LOGIN_ERROR !== 'undefined' && LOGIN_ERROR.code === 401) {
	document.getElementById('login-error-mensaje').innerText = LOGIN_ERROR.message;
	document.getElementById('login-error-mensaje').classList.remove('d-none');
}

document.getElementById('togglePassword').addEventListener('click', function() {
	const passwordInput = document.getElementById('us_password');
	const icon = this;

	if(passwordInput.type === 'password') {
		passwordInput.type = 'text';
		icon.src = '/Styles/login/icon-eye-close.png'; // Cambia el icono a "ojo cerrado"
	} else {
		passwordInput.type = 'password';
		icon.src = '/Styles/login/icon-eye.png'; // Cambia el icono a "ojo abierto"
	}
});

function mostrarFormLogin(event){
	event.preventDefault();
	document.getElementById('contenedor-form-login').classList.remove('d-none');
	document.getElementById('contenedor-form-forget').classList.add('d-none');
}

function mostrarFormForget(event){
	event.preventDefault();
	document.getElementById('contenedor-form-login').classList.add('d-none');
	document.getElementById('contenedor-form-forget').classList.remove('d-none');
}

function login(event) {
	event.preventDefault();
	const username = document.getElementById('us_name').value.trim();
	const password = document.getElementById('us_password').value.trim();

	if (!username || !password) {
		const errorMensaje = document.getElementById('login-error-mensaje');
		errorMensaje.innerText = 'Por favor, ingrese usuario y contraseña.';
		errorMensaje.classList.remove('d-none');
		return;
	}

	Loading();

	document.getElementById('form-login').submit();
}