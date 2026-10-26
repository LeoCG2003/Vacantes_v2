async function mostrarTablaValidacion(id, tabla){

    var tuplas = await $.ajax({
            type: "GET",
            url:"/Vacantes/servicios/ejecucion/mostrarTablaVacante.php",
            dataType: "json",
            data:{
                id_estado_vacante: id 
            }
        }).fail(function(xhr){
            console.log("Status:", xhr.status);
            console.log("Response:", xhr.responseText);
            alert("Error en petición");
            return;
        });
        
    let filas = "";

    $.each(tuplas.datos, function(index, item) {
        filas += `<tr data-vacante='${item.id_vacante}'>`;
        filas += `<td>${item.folio}</td>`;
        filas += `<td>${item.fecha_captura}</td>`;
        filas += `<td>${item.proceso}</td>`;
        filas += `<td>${item.tipo_plaza}</td>`;
        filas += `<td>${item.tipo_sostenimiento}</td>`;
        filas += `<td>${item.clave_plaza}</td>`;
        filas += `<td><button class="btn btn-info verfila">Ver <ion-icon name="eye-outline"></ion-icon></button></td>`
        filas +=`</tr>`;
    });
    
    $("#"+tabla).html(filas);
}

async function mostrarTablaRechazadas(id, tabla){

    var tuplas = await $.ajax({
            type: "GET",
            url:"/Vacantes/servicios/ejecucion/mostrarTablaRechazada.php",
            dataType: "json",
            data:{
                id_estado_vacante: id 
            }
        }).fail(function(xhr){
            console.log("Status:", xhr.status);
            console.log("Response:", xhr.responseText);
            alert("Error en petición");
            return;
        });
        
    let filas = "";

    $.each(tuplas.datos, function(index, item) {
        filas += `<tr data-validacion='${item.id_validacion}' data-vacante='${item.id_vacante}'>`;
        filas += `<td>${item.folio}</td>`;
        filas += `<td>${item.fecha_captura}</td>`;
        filas += `<td>${item.fecha_validacion}</td>`;
        filas += `<td>${item.proceso}</td>`;
        filas += `<td>${item.id_usuario}</td>`;
        filas += `<td><button class="btn btn-warning corregirfila">Corregir <ion-icon name="create-outline"></ion-icon></button></td>`
        filas +=`</tr>`;
    });
    
    $("#"+tabla).html(filas);
}

function mostrarDatosVacante(id){
    $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/verVacante.php",
        dataType: "json",
        data:{
            id_vacante: id 
        }
    }).done(function(data){
        let datos = data.datos[0]
        $.each(datos,function(index, item) {
            console.log(index, item);
        })
    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });
}

$(document).ready(function(){

    mostrarTablaValidacion(1, "tablaValidacion");
    var tabla_activa = "Validacion";
    $('#pillNav2 button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        // e.target es el botón que se acaba de activar
        let botonID = e.target.id; 
        let textoPestaña = $(e.target).text().trim();

        if (botonID === "btnNivel1") {
            mostrarTablaValidacion(1, "tablaValidacion");
            tabla_activa = "Validacion";
        } else if (botonID === "btnNivel2") {
            mostrarTablaValidacion(2, "tablaPromocion");
            tabla_activa = "Promocion";
        } else if (botonID === "btnNivel3") {
            mostrarTablaValidacion(3, "tablaEnlace");
            tabla_activa = "Enlace";
        } else if (botonID === "btnNivel4") {
            mostrarTablaValidacion(4, "tablaCoordinador");
            tabla_activa = "Coordinador";
        } else if (botonID === "btnNivel0") {
            mostrarTablaRechazadas(1, "tablaRechazados");
            tabla_activa = "Rechazados";
        }
    });

    $("#tabla"+tabla_activa).on('click', '.verfila', function () {
        let fila = $(this).closest('tr');
        let vacante = fila.data('vacante');

        console.log("Se apreto boton", vacante);

        mostrarDatosVacante(vacante);
    })

})