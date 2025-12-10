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

document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
    const passwordInput = document.getElementById('us_password_confirm');
    const icon = this;
    if(passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.src = '/Styles/login/icon-eye-close.png'; // Cambia el icono a "ojo cerrado"
    } else {
        passwordInput.type = 'password';
        icon.src = '/Styles/login/icon-eye.png'; // Cambia el icono a "ojo abierto"
    }
});

async function actualizarPassword(event) {
    event.preventDefault(); // Evita el envío del formulario

    const password = document.getElementById('us_password').value;
    const passwordConfirm = document.getElementById('us_password_confirm').value;
    const errorMensaje = document.getElementById('login-error-mensaje');

    // Validar que las contraseñas coincidan
    if(password !== passwordConfirm) {
        errorMensaje.innerText = 'Las contraseñas no coinciden.';
        errorMensaje.classList.remove('d-none');
        return;
    }

    if(password.length < 8) {
        errorMensaje.innerText = 'La contraseña debe tener al menos 8 caracteres.';
        errorMensaje.classList.remove('d-none');
        return;
    }

    Loading()

    try {
        const response = await fetch('/XMLHttpRequest/AjaxResetPasswordCliente.php', {
            method: 'POST',
            credentials: 'same-origin', // enviar cookies de sesión (necesario para PHP session)
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                newPassword: password, 
                confirmPassword: passwordConfirm,
                selector: (typeof DATA !== 'undefined' ? DATA.selector : null),
                validator: (typeof DATA !== 'undefined' ? DATA.validator : null)
            })
        });

        const result = await response.json();

        if(!response.ok){
            errorMensaje.innerText = 'Ocurrió un error en el servidor. Por favor, inténtalo de nuevo más tarde.';
            errorMensaje.classList.remove('d-none');
            return;
        }

        errorMensaje.innerText = result.message;
        
        if(result.success){
            errorMensaje.style.color = 'green'; 
            setTimeout(() => {
                window.location.href = '/';
            }, 2500);
        }

        errorMensaje.classList.remove('d-none');

    } catch (error) {
        errorMensaje.innerText = 'Error de red. Por favor, inténtalo de nuevo más tarde.';
        errorMensaje.classList.remove('d-none');
    } finally {
        EndLoading();
    }
}