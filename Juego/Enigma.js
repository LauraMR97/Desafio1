function tiempo() {

    document.getElementById('llaves').innerHTML = time;



    var time = setTimeout(function() { carga() }, 1000);
    document.getElementById('tiempo').innerHTML = time;

    if (time == 60) {
        clearTimeout(time);
    }
}