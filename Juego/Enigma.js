var llaves;
var pregunta;
var numPreguntas;
var equipo;
var opciones;
var almirante;
var perLoggeada;

function cargar(llaves_PHP, Preguntas_PHP, numPreguntas_PHP, equipo_PHP, opciones_PHP, almirante_PHP, perLoggeada_PHP) {
    llaves = llaves_PHP;
    pregunta = Preguntas_PHP;
    numPreguntas = numPreguntas_PHP;
    equipo = JSON.parse(equipo_PHP);
    opciones = JSON.parse(opciones_PHP);
    almirante = almirante_PHP;
    perLoggeada = perLoggeada_PHP;
}

function tiempo() {
    var time = setTimeout(function () { tiempo() }, 1000);
    document.getElementById('tiempo').innerHTML = "<h3>" + time + "</h3>";

    if (time == 60) {
        clearTimeout(time);
    }

}

function pintar() {

        if (almirante == perLoggeada) {
            pintarLlaves();
            pintarEquipo();
            pintarPreguntas();
            pintarOpciones();
            pintarBoton();
        } else {
            pintarLlaves();
            pintarPreguntas();
            pintarOpciones();
        }
}

function ganar() {
    window.location.href = './Ganar.php';
}

function perder() {
    window.location.href = './Perder.php';
}

function pintarOpciones() {
    console.log(opciones);
    var datos = "";
    var NumOpcion = 0;

    ;
    datos += "<form action='./Enigma.php' method='POST' class='oriental'>";
    opciones.forEach(o => {
        datos += "<div class='row fondoOriental-a'>";
        datos += "<div class='col-12'>";
        datos += "<input class='col-6' type='text' value='" + o.opcion + "'name='OP" + NumOpcion + "' readonly>";
        datos += "<div class='col-6'>";
        datos += "<input type='radio' value='" + o.opcion + "' name='opcion'>";
        datos += "</div>";
        datos += "</div>";
    });
    datos += "<input class='col-12' type='submit' name='verSolucion' value='Comprobar'>";
    datos += '</form>';


    console.log(datos);
    document.getElementById('respuestas').innerHTML = datos;
}

function pintarPreguntas() {
    console.log(pregunta);
    var datos = "";
    datos += "<h3>" + pregunta + "</h3>";
    document.getElementById('pregunta').innerHTML = datos;
}

function pintarEquipo() {
    console.log(equipo);
    var datos = "";


    datos += '<div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado linea">';
    datos += '<h3>Bloquear A..:</h3>';
    datos += '</div>'

    datos += "<form action='./Base_de_datos/controlador.php' method='POST' class='oriental'>";
    equipo.forEach(p => {
        datos += "<div class='row'>";
        datos += "<div class='col-12'>";
        datos += "<input class='col-6' type='text' value='" + p.persona + "' readonly>";
        datos += "<div class='col-6'>";
        datos += "<input type='checkbox' value='" + p.persona + "' name='opcion[]'>";
        datos += "</div>";
        datos += "</div>";
        datos += "</div>";
    });
    datos += "<input class='col-12' type='submit' name='AnularPersona' value='Vetar'>";
    datos += '</form>';
    document.getElementById('personas').innerHTML = datos;
}


function pintarLlaves() {
    console.log(llaves);
    document.getElementById('llaves').innerHTML = '<p class="linea">llaves: ' + llaves + '</p>';
}


