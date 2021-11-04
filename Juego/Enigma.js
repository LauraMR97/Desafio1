function tiempo() {
    var time = setTimeout(function () { tiempo() }, 1000);
    document.getElementById('tiempo').innerHTML = time;
    if (time == 60) {
        clearTimeout(time);
    }
}

function pintar(llaves) {
    pintarLlaves(llaves);
}

function pintarLlaves(llaves) {
    var numLlaves = JSON.parse(llaves);
    console.log(numLlaves);
    document.getElementById('llaves').innerHTML = numLlaves;
}