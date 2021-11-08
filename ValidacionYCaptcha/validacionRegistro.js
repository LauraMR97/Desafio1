/*************************************VALIDAR EDITAR************************** */
function validarEditar() {

    const email = document.getElementById('mail');
    const nombre = document.getElementById('nom');

    const botonEditar = document.getElementById('Edita');

    const emailError = document.querySelector('#mail + span.error');
    const NombreError = document.getElementById('nombreError');
    if (botonEditar != undefined) {
        email.addEventListener('onblur', function (event) {
            if (email.validity.valid) {
                emailError.innerHTML = '';
                emailError.className = 'error';
            } else {
                showErrorEmail();
            }
        });

        nombre.addEventListener('onblur', function (event) {
            if (nombre.validity.valid) {
                NombreError.innerHTML = ''; // Restablece el contenido del mensaje
                NombreError.className = 'error'; // Restablece el estado visual del mensaje
            } else {
                showErrorNombre();
            }
        });


        function validarEdicion(event) {
            if (!email.validity.valid) {
                showErrorEmail();
                event.preventDefault();
            }

            if (!nombre.validity.valid) {
                showErrorNombre();
                event.preventDefault();
            }
        }
        botonEditar.addEventListener('click', validarEdicion);

        function showErrorNombre() {

            if (nombre.validity.valueMissing) {
                NombreError.textContent = 'Debe introducir un nombre de usuario.';
            } else if (nombre.validity.tooShort) {
                NombreError.textContent = 'El nombre debe tener al menos 4 caracteres';
            } else if (nombre.validity.tooLong) {
                NombreError.textContent = 'El nombre debe tener como mucho 8 caracteres';
            }

            NombreError.className = 'error active';
        }

        function showErrorEmail() {
            if (email.validity.valueMissing) {
                emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
            } else if (email.validity.typeMismatch) {
                emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
            } else if (email.validity.tooShort) {
                emailError.textContent = 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
            }
            // Establece el estilo apropiado
            emailError.className = 'error active';

        }
    } else {
        validarAniadir();
    }
}


/*************************************VALIDAR AÑADIR************************** */

function validarAniadir() {
    const email = document.getElementById('mail');
    const pass = document.getElementById('password');
    const passRepeat = document.getElementById('passwordConfirm');
    const nombre = document.getElementById('nom');

    const botonRegistrar = document.getElementById('Registro');
    const botonEditar = document.getElementById('Edit');

    const emailError = document.querySelector('#mail + span.error');
    const passwordError = document.getElementById('passwordError');
    const passwordConfirmError = document.getElementById('passwordConfirmError');
    const NombreError = document.getElementById('nombreError');

    email.addEventListener('onblur', function (event) {
        if (email.validity.valid) {
            emailError.innerHTML = '';
            emailError.className = 'error';
        } else {
            showErrorEmail();
        }
    });

    pass.addEventListener('onblur', function (event) {

        if (pass.validity.valid) {
            passwordError.innerHTML = '';
            passwordError.className = 'error';
        } else {
            showErrorPassword();
        }
    });


    passRepeat.addEventListener('onblur', function (event) {

        if (passRepeat.validity.valid) {
            passwordConfirmError.innerHTML = '';
            passwordConfirmError.className = 'error';
        } else {
            showErrorPasswordRepeat();
        }
    });

    nombre.addEventListener('onblur', function (event) {
        if (nombre.validity.valid) {
            NombreError.innerHTML = ''; // Restablece el contenido del mensaje
            NombreError.className = 'error'; // Restablece el estado visual del mensaje
        } else {
            showErrorNombre();
        }
    });

    function validarRegistro(event) {
        var pass1 = document.getElementById('password').value;
        var pass2 = document.getElementById('passwordConfirm').value;

        if (!email.validity.valid) {
            showErrorEmail();
            event.preventDefault();
        }

        if (!pass.validity.valid) {
            showErrorPassword();
            event.preventDefault();
        }

        if (pass1 != pass2) {
            showErrorPasswordRepeat();
            event.preventDefault();
        }
        if (!passRepeat.validity.valid) {
            showErrorPasswordRepeat();
            event.preventDefault();
        }

        if (!nombre.validity.valid) {
            showErrorNombre();
            event.preventDefault();
        }
    }
    botonRegistrar.addEventListener('click', validarRegistro);


    function showErrorEmail() {
        if (email.validity.valueMissing) {
            emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
        } else if (email.validity.typeMismatch) {
            emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
        } else if (email.validity.tooShort) {
            emailError.textContent = 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
        }
        // Establece el estilo apropiado
        emailError.className = 'error active';

    }

    function showErrorPassword() {

        if (pass.validity.valueMissing) {

            passwordError.textContent = 'Debe introducir una contraseña.';
        } else {
            passwordError.textContent = 'Las contraseñas no son iguales';

        }

        passwordError.className = 'error active';
    }

    function showErrorPasswordRepeat() {

        if (passRepeat.validity.valueMissing) {
            passwordConfirmError.textContent = 'Debe repetir la contraseña.';
        } else {
            passwordConfirmError.textContent = 'Contraseñas distintas.';
        }
        passwordConfirmError.className = 'error active';
    }

    function showErrorNombre() {

        if (nombre.validity.valueMissing) {
            NombreError.textContent = 'Debe introducir un nombre de usuario.';
        } else if (nombre.validity.tooShort) {
            NombreError.textContent = 'El nombre debe tener al menos 4 caracteres';
        } else if (nombre.validity.tooLong) {
            NombreError.textContent = 'El nombre debe tener como mucho 8 caracteres';
        }

        NombreError.className = 'error active';
    }
}




