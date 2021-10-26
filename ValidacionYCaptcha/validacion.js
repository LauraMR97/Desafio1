function validacion() {

    const email = document.getElementById('mail');
    const pass = document.getElementById('password');

    const botonAceptar = document.getElementById('aceptar');

    const emailError = document.querySelector('#mail + span.error');
    const passwordError = document.getElementById('passwordError');

    email.addEventListener('onblur', function(event) {
        // Cada vez que el usuario escribe algo, verificamos si
        // los campos del formulario son válidos.

        if (email.validity.valid) {
            // En caso de que haya un mensaje de error visible, si el campo
            // es válido, eliminamos el mensaje de error.
            emailError.innerHTML = ''; // Restablece el contenido del mensaje
            emailError.className = 'error'; // Restablece el estado visual del mensaje
        } else {
            // Si todavía hay un error, muestra el error exacto
            showErrorEmail();
        }
    });

    pass.addEventListener('onblur', function(event) {
        // Cada vez que el usuario escribe algo, verificamos si
        // los campos del formulario son válidos.

        if (pass.validity.valid) {
            // En caso de que haya un mensaje de error visible, si el campo
            // es válido, eliminamos el mensaje de error.
            passwordError.innerHTML = ''; // Restablece el contenido del mensaje
            passwordError.className = 'error'; // Restablece el estado visual del mensaje
        } else {
            // Si todavía hay un error, muestra el error exacto
            showErrorPassword();
        }
    });

    botonAceptar.addEventListener('click', function(event) {
        // si el campo de correo electrónico es válido, dejamos que el formulario se envíe

        if (!email.validity.valid) {
            // Si no es así, mostramos un mensaje de error apropiado
            showErrorEmail();
            // Luego evitamos que se envíe el formulario cancelando el evento
            event.preventDefault();
        }
        console.log(pass.validity);
        if (!pass.validity.valid) {
            // Si no es así, mostramos un mensaje de error apropiado
            showErrorPassword();
            // Luego evitamos que se envíe el formulario cancelando el evento
            event.preventDefault();
        }

    });

    function showErrorEmail() {
        if (email.validity.valueMissing) {
            // Si el campo está vacío
            // muestra el mensaje de error siguiente.
            emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
        } else if (email.validity.typeMismatch) {
            // Si el campo no contiene una dirección de correo electrónico
            // muestra el mensaje de error siguiente.
            emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
        } else if (email.validity.tooShort) {
            // Si los datos son demasiado cortos
            // muestra el mensaje de error siguiente.
            emailError.textContent = 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
        }



        // Establece el estilo apropiado
        emailError.className = 'error active';

    }

    function showErrorPassword() {

        console.log('ENtra en error password');
        if (pass.validity.valueMissing) {
            // Si el campo está vacío
            // muestra el mensaje de error siguiente.
            passwordError.textContent = 'Debe introducir una contraseña.';
        }

        passwordError.className = 'error active';
    }
}