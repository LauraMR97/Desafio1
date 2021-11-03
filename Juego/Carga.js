function carga() {




    
    var time = setTimeout(function () { carga() }, 500);
    document.getElementById('introduccion').innerHTML = time;
    if (time == 40) {
        clearTimeout(time);
    }
}