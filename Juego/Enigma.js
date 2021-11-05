var llaves;
var preguntas;
var numPreguntas;
var equipo;


function cargar(llaves_PHP, Preguntas_PHP, numPreguntas_PHP, equipo_PHP) {
    llaves = llaves_PHP;
    preguntas = JSON.parse(Preguntas_PHP);
    numPreguntas = numPreguntas_PHP;
    equipo = JSON.parse(equipo_PHP);
}

function tiempo() {
    var time = setTimeout(function() { tiempo() }, 1000);
    document.getElementById('tiempo').innerHTML = time;

    if (time == 60) {
        clearTimeout(time);
    }
    pintarLlaves();
    pintarEquipo();
}

function pintarPreguntas() {
    console.log(preguntas);
    var datos = "";
    var alea = Math.random() * numPreguntas;
    alea = Math.trunc(alea);


    datos += "<form action='./Base_de_datos/controlador.php' method='POST' class='oriental'>";
    datos += "<input type='text' value='" + preguntas[alea].pregunta + "' readonly>";
    datos += '</form>';

    document.getElementById('pregunta').innerHTML = datos;
}

function pintarEquipo() {
    console.log(equipo);
    var datos = "";

    equipo.forEach(p => {
        datos += "<form action='./Base_de_datos/controlador.php' method='POST' class='oriental'>";
        datos += "<input type='text' value='" + p.persona + "' readonly>";
        datos += '</form>';
    });
    document.getElementById('personas').innerHTML = datos;
}


function pintarLlaves() {
    console.log(llaves);
    document.getElementById('llaves').innerHTML = llaves;
}