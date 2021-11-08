function carga() {

    document.getElementById('texto').innerHTML = '<p>Un grupo de marines de la Marina Imperial Japonesa, se vio, no sabe muy bien cómo,' +
        'encerrado en la bodega de un buque de guerra japonés de la era Sengoku (s. XVI).' +
        'Uno de los marines se da cuenta de ' +
        'que sus pies cada vez están más ' +
        'cubiertos de agua.' +
        'El objetivo es salir del barco en el ' +
        'menor tiempo posible, ya que ' +
        'calculan que en menos de media hora ' +
        'su vida corre peligro.' +
        'Para salir del barco, deberán ' +
        'permitirán salir de la bodega…' +
        'pero… ¿cómo?</p>';

    document.getElementById('foto').innerHTML = '<img src="../IMAGENES/atakebune.png" class="imagenResponsive">';
    var time = setTimeout(function() { carga() }, 1000);
    document.getElementById('introduccion').innerHTML = time;
    if (time == 10) {
        window.location.href = './Enigma.php';
        clearTimeout(time);
    }
}