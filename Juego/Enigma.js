var llaves;
var preguntas;


function cargar(llaves_PHP, Preguntas_PHP) {
    llaves = llaves_PHP;
    preguntas = json.parse(Preguntas_PHP);
}

function tiempo() {
    var time = setTimeout(function() { tiempo() }, 1000);
    document.getElementById('tiempo').innerHTML = time;
    if (time == 60) {
        clearTimeout(time);
    }
    pintarLlaves();
    pintarPreguntas();
}

function pintarPreguntas() {
    console.log(preguntas);
    document.getElementById('pregunta').innerHTML = preguntas.descripcion;
}

function pintarLlaves() {
    console.log(llaves);
    document.getElementById('llaves').innerHTML = llaves;
}