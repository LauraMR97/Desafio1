function validacion() {

    const Pregunta = document.getElementById('preg');
    const Op1 = document.getElementById('o1');
    const Op2 = document.getElementById('o2');
    const Op3 = document.getElementById('o3');
    const Op4 = document.getElementById('o4');

    const botonGestionar = document.getElementById('Gestionar');

    const ErrorPregunta = document.getElementById('PreguntaError');
    const ErrorO1 = document.getElementById('ErrorO1');
    const ErrorO2 = document.getElementById('ErrorO2');
    const ErrorO3 = document.getElementById('ErrorO3');
    const ErrorO4 = document.getElementById('ErrorO4');


    Pregunta.addEventListener('onblur', function (event) {

        if (Pregunta.validity.valid) {
            ErrorPregunta.innerHTML = '';
            ErrorPregunta.className = 'error';
        } else {
            showErrorPregunta();
        }
    });

    Op1.addEventListener('onblur', function (event) {

        if (Op1.validity.valid) {
            ErrorO1.innerHTML = '';
            ErrorO1.className = 'error';
        } else {
            showErrorO1();
        }
    });

    Op2.addEventListener('onblur', function (event) {
        if (Op2.validity.valid) {
            ErrorO2.innerHTML = '';
            ErrorO2.className = 'error';
        } else {
            showError02();
        }
    });

    Op3.addEventListener('onblur', function (event) {
        if (Op3.validity.valid) {
            ErrorO3.innerHTML = '';
            ErrorO3.className = 'error';
        } else {
            showError03();
        }
    });

    Op4.addEventListener('onblur', function (event) {
        if (Op4.validity.valid) {
            ErrorO4.innerHTML = '';
            ErrorO4.className = 'error';
        } else {
            showError04();
        }
    });


    botonGestionar.addEventListener('click', function (event) {

        if (!Pregunta.validity.valid) {
            showErrorPregunta();
            event.preventDefault();
        }

        if (!Op1.validity.valid) {
            showError01();
            event.preventDefault();
        }

        if (!Op2.validity.valid) {
            showError02();
            event.preventDefault();
        }

        if (!Op3.validity.valid) {
            showError03();
            event.preventDefault();
        }

        if (!Op4.validity.valid) {
            showError04();
            event.preventDefault();
        }
    });


    function showErrorPregunta() {
        if (Pregunta.validity.valueMissing) {
            ErrorPregunta.textContent = 'Debe introducir una Pregunta.';
        }
        ErrorPregunta.className = 'error active';

    }

    function showError01() {
        if (Op1.validity.valueMissing) {
            ErrorO1.textContent = 'Debe introducir una opcion.';
        }
        ErrorO1.className = 'error active';
    }

    function showError02() {
        if (Op2.validity.valueMissing) {
            ErrorO2.textContent = 'Debe introducir una opcion.';
        }
        ErrorO2.className = 'error active';
    }

    function showError03() {
        if (Op3.validity.valueMissing) {
            ErrorO3.textContent = 'Debe introducir una opcion.';
        }
        ErrorO3.className = 'error active';
    }

    function showError04() {
        if (Op4.validity.valueMissing) {
            ErrorO4.textContent = 'Debe introducir una opcion.';
        }
        ErrorO4.className = 'error active';
    }
}