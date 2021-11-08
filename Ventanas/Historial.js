var historial;

function pintar() {
    cargar();
}

function cargar(historial_PHP) {
    historial = JSON.parse(historial_PHP);
    var datos = '';

    datos += '<div class="row">';
    datos += '<div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">';
    datos += '<h3>Historial:</h3>';
    datos += '</div>';
    datos += '</div>';
    datos += '<div class="row">';
    datos += '<div class="col-12">';
    datos += '<table class="oriental">';
    datos += '<tr>';
    datos += '<th>IDEquipo:</th>';
    datos += '<th>Participantes:</th>';
    datos += '<th>Inicio:</th>';
    datos += '<th>Fin:</th>';
    datos += '<th>Almirante:</th>';
    datos += '<th>Resultado:</th>';
    datos += '</tr>';

    historial.forEach(h => {
        datos += "<tr>";
        datos += "<td>" + h.equipo + "</td>";
        datos += "<td>" + h.personas + "</td>";
        datos += "<td>" + h.fechaIni + "</td>";
        datos += "<td>" + h.fechaFin + "</td>";
        datos += "<td>" + h.almirante + "</td>";
        datos += "<td>" + h.resultado + "</td>";
        datos += "</tr>";
    });
    datos += "</table>";
    datos += "</div>";
    datos += "</div>"
    console.log(datos);
    /*FORMULARIO*/
    datos += '<form action="../Base_de_datos/controlador.php" method="POST" class="oriental">';
    datos += '<div class="row p-d-1">';
    datos += '<input class="col-6 s-col-12" type="submit" value="Cerrar Sesion" name="CerrarSesion">';
    datos += '<input class="col-6 s-col-12 botVolver" type="submit" value="Volver" name="VolverMenu">';
    datos += '</div>';
    datos += '</form>';

    document.getElementById('historial').innerHTML = datos;
}
