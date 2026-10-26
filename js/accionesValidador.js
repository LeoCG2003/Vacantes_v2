function cambiarEstado(vacante, estado){
    return $.ajax({
        type: "POST",
        url: "/Vacantes/servicios/ejecucion/cambiarEstado.php",
        dataType: "json",
        data: {
            id_vacante: vacante,
            nuevo_estado: estado
        }
    });
}

function autorizar(vacante, usuario, estado_vacante){

    if (vacante == null || usuario == null) {
        alert("Falta id_usuario o id_vacante");
        return;
    }

    cambiarEstado(vacante, estado_actual+1)
    .then(function(data){
        return $.ajax({
            type: "POST",
            url: "/Vacantes/servicios/ejecucion/autorizarVacante.php",
            dataType: "json",
            data: {
                id_vacante: vacante,
                id_usuario: usuario,
                id_estado_vacante: estado_vacante
            }
        })
    }).done(function(data){
        alert("Vacante autorizada exitosamente");
        return;
    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });
}

function rechazar(vacante, usuario, nota_rechazo, estado_vacante){

    if (vacante == null || usuario == null || nota_rechazo == null) {
        alert("Falta id_usuario, id_vacante o nota_rechazo");
        return;
    }

    cambiarEstado(vacante, 0)
    .then(function(data){
        return $.ajax({
            type: "POST",
            url: "/Vacantes/servicios/ejecucion/rechazarVacante.php",
            dataType: "json",
            data: {
                id_vacante: vacante,
                id_usuario: usuario,
                id_estado_vacante: estado_vacante
            }
        });
    }).then(function(data){
        return $.ajax({
            type: "POST",
            url: "/Vacantes/servicios/ejecucion/motivoRechazo.php",
            dataType: "json",
            data: {
                id_validacion: data.id_validacion,
                nota_rechazo: nota_rechazo
            }
        });
    }).done(function(data){
        alert("Vacante rechazada exitosamente");
        return;
    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });
}

// Temporal, solo para plantear la idea de las interaciones
$(document).ready(function(){
    $("#btnAutorizar").click(function(){
        id_vacante = $("#id_vacante").val();
        id_usuario = $("#id_usuario").val();
        estado_actual = $("#estado_actual").val();

        autorizar(id_vacante, id_usuario, estado_actual);
    });

    $("#btnRechazar").click(function(){
        id_vacante = $("#id_vacante").val();
        id_usuario = $("#id_usuario").val();
        nota_rechazo = $("#nota_rechazo").val();
    
        rechazar(id_vacante, id_usuario, nota_rechazo);
    });
    
});