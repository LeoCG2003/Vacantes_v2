function listarOpciones(tabla, proceso = null){

    return $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/listar_opciones.php",
        dataType: "json",
        data:{
            tabla: tabla,
            proceso: proceso
        }
    })
}

function mostrarDatosCaptura(id){
    $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/mostrarLayout.php",
        dataType: "json",
        data:{
            id_tipo_layout: id 
        }
    }).done(function(data){
        console.log(data.datos.datos);
        const datos = JSON.parse(data.datos.datos);
        console.log(datos.municipio);
        console.log(datos.proceso);
        console.log(datos.turno);
        // Aquí puedes usar los datos para llenar los selects
        if(datos.municipio == 1){
            listarOpciones("municipio", null)
            .done(function(data){
                $("#municipio").empty();
                $("#municipio").append(
                    '<option value="">Seleccione un municipio</option>'
                );
                data.datos.forEach(function(municipio) {
                    $("#municipio").append(
                        `<option value="${municipio.id_municipio}">
                            ${municipio.municipio}
                        </option>`
                    );
                });
            });
            $("#mun").show();
        }
        if(datos.proceso  == 1){
            listarOpciones("tipo_apreciacion", 1)
            .done(function(data){
                console.log(data);
                $("#tipo_apreciacion").empty();
                $("#tipo_apreciacion").append(
                    '<option value="">Seleccione un tipo de apreciación</option>'
                );
                data.datos.forEach(function(tipo_apreciacion) {
                    $("#tipo_apreciacion").append(
                        `<option value="${tipo_apreciacion.id_tipo_apreciacion}">
                            ${tipo_apreciacion.apreciacion}
                        </option>`
                    );
                });
            });
            $("#ap").show();
        }
        if(datos.turno == 1){
            listarOpciones("turno", null)
            .done(function(data){
                $("#turno").empty();
                $("#turno").append(
                    '<option value="">Seleccione un turno</option>'
                );
                data.datos.forEach(function(turno) {
                    $("#turno").append(
                        `<option value="${turno.id_turno}">
                            ${turno.turno}
                        </option>`
                    );
                });
            });
            $("#turn").show();
        }

    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });
}



console.log("test.js cargado");
$(document).ready(function() {
    $("#mModal").click(function(){
        $("#miModal").show();
        mostrarDatosCaptura(4);
    });
    $("#cerrarModal").click(function(){
        $("#miModal").hide();
    });
});