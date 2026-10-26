let temporizadorAlerta;

function mostrarAlerta(tipo, mensaje) {

    clearTimeout(temporizadorAlerta);

    $(".alerta-flotante").stop(true, true).hide();

    let alerta;

    if (tipo === "success") {
        alerta = $("#al_s");
        $("#msg_success").text(mensaje);
    } 
    else if (tipo === "danger") {
        alerta = $("#al_d");
        $("#msg_danger").text(mensaje);
    } 
    else if (tipo === "warning") {
        alerta = $("#al_w");
        $("#msg_warning").text(mensaje);
    } 
    else {
        return;
    }

    alerta.fadeIn(200);

    temporizadorAlerta = setTimeout(function () {
        alerta.fadeOut(300);
    }, 3000);
}

async function PlazaAP(datos){

    const respuesta = await $.ajax({
        type: "POST",
        url : "/Vacantes/servicios/API/plazaAP.php",
        dataType: "json",
        data:{
            cod_pago: datos.cod_pago,
            unidad: datos.unidad,
            subunidad: datos.subunidad,
            cat_puesto: datos.cat_puesto,
            horas: datos.horas,
            cons_plaza: datos.cons_plaza
        }
    });

    return respuesta;

}

async function BuscarEFUP(datos){
    const respuesta = await $.ajax({
        type: "POST",
        url: "/Vacantes/servicios/API/buscarEFUP.php",
        dataType: "json",
        data:{
            cod_pago: datos.cod_pago,
            unidad: datos.unidad,
            subunidad: datos.subunidad,
            cat_puesto: datos.cat_puesto,
            horas: datos.horas,
            cons_plaza: datos.cons_plaza,
            qna_ini: datos.qna_ini
        }
    });

    return respuesta;
}

function verificarCamposObligatorios(nombre_clase, nombre_boton){
    let todoContestado = true;

    $("." + nombre_clase).each(function(){
        let valor = $(this).val();
        if(valor === null || valor === undefined || $.trim(valor) === ""){
            todoContestado = false;
            return false;
        }
    });
    $("#" + nombre_boton).prop("disabled", !todoContestado);
}

function mostrarDatosCaptura(id){
    return $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/mostrarLayout.php",
        dataType: "json",
        data:{
            id_tipo_layout: id 
        }
    });
}

async function cargarDatosCapturados(id){
    var response = await $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/verVacante.php",
        dataType: "json",
        data:{
            id_vacante: id 
        }
    });

    return response;
}

async function conocerMotivoRechazo(id){
    var respuesta = await $.ajax({
        type: "GET",
        url:"/Vacantes/servicios/ejecucion/verDetallesRechazo.php",
        dataType: "json",
        data:{
            id_validacion: id 
        }
    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });

    return respuesta;
}

function captura(tipo_layout, datos){

    const fecha = new Date();
    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, "0");
    const dia = String(fecha.getDate()).padStart(2, "0");

    let fecha_captura = `${anio}-${mes}-${dia}`;

    // Se calcula la quincena del año segun la fecha del dia de registro
    let qna = String(((mes - 1) * 2) + (dia <= 15 ? 1 : 2)).padStart(2, "0")+String(anio);

    $.ajax({
        type: "POST",
        url: "/Vacantes/servicios/ejecucion/capturarVacante.php",
        dataType: "json",
        data: {
            qna: qna,
            tipo_layout: tipo_layout,
            fecha_captura: fecha_captura, 
            datos: datos
        }
    }).done(function(data){
        if(data.success == true){
            mostrarAlerta("success", data.msg);
        } else {
            mostrarAlerta("danger", data.msg);

        }
    }).fail(function(xhr, status, error) {
        console.log("FAIL");
        console.log("Status:", xhr.status);
        console.log("Status text:", status);
        console.log("Error:", error);
        console.log("Response:", xhr.responseText);
    });
}

//function corregir(vacante, tipo_layout, fecha_captura, estado_vacante, entidad, municipio, institucion, region, zona_economica, proceso, apreciacion, tipo_vacante, tipo_plaza, numero_horas, tipo_sostenimiento, fecha_inicio_vacancia, fecha_fin_vacancia, clv_categoria, paquete_de_plaza, clave_plaza, cctPlazaDondeCobra, cctPlazaDondeTrabaja, turno, tipo_de_licencia, codigo_licencia, inicio_de_licencia, observaciones, inicio_ocupacion, ordenamiento, curp, nombre_docente, codigo){
function corregir(vacante, datos){
    $.ajax({
        type: "POST",
        url: "/Vacantes/servicios/ejecucion/corregirCaptura.php",
        dataType: "json",
        data: {
            id_vacante: vacante,
            datos: datos
        }
    }).done(function(data){
        if(data.success == true){
            mostrarAlerta("success", data.msg);
        } else {
            mostrarAlerta("danger", data.msg);

        }
    }).fail(function(xhr, status, error) {
        console.log("FAIL");
        console.log("Status:", xhr.status);
        console.log("Status text:", status);
        console.log("Error:", error);
        console.log("Response:", xhr.responseText);
    });
}

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

function mostrarOpciones(selectId, textoPlaceholder, idCampo, textoCampo, contenedorId) {
    return function(data) {
        const select = $("#" + selectId);
        select.empty();
        select.append(
            `<option value="">${textoPlaceholder}</option>`
        );
        data.datos.forEach(function(item) {
            select.append(
                `<option value="${item[idCampo]}">
                    ${item[textoCampo]}
                </option>`
            );
        });

        if(contenedorId != ""){
            $("#" + contenedorId).show();
        }
    }
}

$(document).ready(function() {

    let datos_a_pedir_captura = {};

    $("#modalNuevoRegistro").click(function(){
        $("#nBotonForm").text("Capturar");
        $("#tituloModalDatos").text("Capturar Nueva Vacante");
        $("#modalElegirTipo").modal("show");
    });

    $("#tipo_layout").on("change", function() {
        if ($(this).val() !== "") {
            $("#btnSiguiente").prop("disabled", false);
        } else {
            $("#btnSiguiente").prop("disabled", true);
        }
    });

    $("#btnSiguiente").click(function(){
        if ($("#paso1").is(":visible")){
            $("#paso1").hide();
            $("#paso2").show();
            $("#btnSiguiente").hide();
            $("#btnAtras").show();
            $("#btnValidar").show();
        }

        if ($("#pasoEFUP").is(":visible")){
            $("#pasoEFUP").hide();
            $("#paso3").show().trigger("mostrarFormCaptura");
            $("#btnSiguiente").hide();
            $("#btnCapturar").show();
        }
    });

    $("#btnAtras").click(function(){

        if ($("#paso2").is(":visible")){
            $("#paso2").hide();
            $("#paso1").show();
            $("#btnAtras").hide();
            $("#btnValidar").hide();
            $("#btnSiguiente").show();
        }

        if ($("#paso3").is(":visible")){
            $("#paso3").hide();
            $("#paso2").show();
            $("#btnCapturar").hide();
            $("#btnValidar").show();

            Object.entries(datos_a_pedir_captura).forEach(function([dato, val]) {
                if(val == 1){
                    $("#" + dato).hide();
                }
            });

            datos_a_pedir_captura = {};
        }

        if ($("#pasoEFUP").is(":visible")){
            $("#pasoEFUP").hide();
            $("#paso2").show();
            $("#btnValidar").show();
            $("#btnSiguiente").hide();
        }

        if ($("#pasoAP").is(":visible")){
            $("#pasoAP").hide();
            $("#paso2").show();
            $("#btnValidar").show();
        }
    });

    $("#tipo_plazaInput").on("change", function() {
        if($("#tipo_plazaInput").val() == "2"){
            $("#numero_horasInput").prop("disabled", false);
        }else{
            $("#numero_horasInput").prop("disabled", true);
        }
    });

    $("#tipo_vacanteInput").on("change", function() {
        if($("#tipo_vacanteInput").val() == "2"){
            $("#tipo_licenciaInput").prop("disabled", false);
        }else{
            $("#tipo_licenciaInput").prop("disabled", true);
        }
    });

    $(document).on('change', 'select.requerido', function(){
        verificarCamposObligatorios("requerido", "btnCapturar");
    });
    $(document).on('blur', 'input.requerido', function(){
        verificarCamposObligatorios("requerido", "btnCapturar");
    });

    $(document).on('blur', 'input.validarplaza', function(){
        verificarCamposObligatorios("validarplaza", "btnValidar");
    });

    $("#formularioValidarPlaza").on("submit", async function(e){
        e.preventDefault();

        var datos = $(this).serializeArray();
        var datosSeparados = {};
        $.each(datos, function(){
            datosSeparados[this.name] = this.value;
        });

        var respuestaAP = await PlazaAP(datosSeparados);
        var respuestaEFUP = await BuscarEFUP(datosSeparados);

        // No olvidar cambiar la segunda condicion del if por un != despues de las pruebas
        if (respuestaAP.status === "ok" && respuestaAP.result.plaza != null) {
            $("#clave_plazaInput").val(respuestaAP.result.plaza);

            if (respuestaEFUP.status === "ok" && respuestaEFUP.result.plaza == null){
                $("#paso2").hide();
                $("#paso3").show().trigger("mostrarFormCaptura");
                $("#btnValidar").hide();
                $("#btnAtras").show();
                $("#btnCapturar").show();

            } else {
                $("#paso2").hide();
                $("#pasoEFUP").show();
                $("#btnValidar").hide();
                $("#btnSiguiente").show();
            }
            
        } else {
            $("#paso2").hide();
            $("#pasoAP").show();
            $("#btnValidar").hide();
        }
    });

    let vacante_corregir = null

    $("#formularioCaptura").submit(function(e){
        e.preventDefault();

        let tipo_layout = $("#tipo_layout").val();

        const $form = $(this);
        const $disabled = $form.find(":disabled");

        $disabled.prop("disabled", false);
        const datos = $form.serializeArray();
        $disabled.prop("disabled", true);

        var datosSeparados = {};
        $.each(datos, function(){
            datosSeparados[this.name] = this.value;
        });

        if ($("#nBotonForm").text() == "Capturar") {
            captura(tipo_layout, datosSeparados);
        }

        if ($("#nBotonForm").text() == "Corregir") {
            try {
                corregir(vacante_corregir, datosSeparados);
            } catch {
                console.log("Probablemnte no se encontro vacnte");
            }
            
        }

        
        $("#formularioValidarPlaza")[0].reset();
        $("#formularioCaptura")[0].reset();
        $("#modalElegirTipo").modal("hide");

    });

    var datos_existentes = null;
    $("#paso3").on("mostrarFormCaptura", function (){
        $("#btnCapturar").prop("disabled", true);

        mostrarDatosCaptura($("#tipo_layout").val(), null)
        .done(async function(data){
            datos_a_pedir_captura = JSON.parse(data.datos.datos_requeridos);
                    
            await listarOpciones("cat_zona_economica", null)
            .done(mostrarOpciones("zona_economicaInput", "Seleccione una zona economica", "id_zona_economica", "zona_economica", "zona_economicaInput"));

            await listarOpciones("cat_proceso", null)
            .done(mostrarOpciones("procesoInput", "Seleccione el proceso", "id_proceso", "proceso", "procesoInput"));

            await listarOpciones("cat_tipo_vacante", null)
            .done(mostrarOpciones("tipo_vacanteInput", "Seleccione el tipo de vacante", "id_tipo_vacante", "tipo_vacante", "tipo_vacanteInput"));

            await listarOpciones("cat_tipo_plaza", null)
            .done(mostrarOpciones("tipo_plazaInput", "Seleccione el tipo de plaza", "id_tipo_plaza", "tipo_plaza", "tipo_plazaInput"));

            await listarOpciones("cat_tipo_sostenimiento", null)
            .done(mostrarOpciones("tipo_sostenimientoInput", "Seleccione el tipo de sostenimiento", "id_tipo_sostenimiento", "tipo_sostenimiento", "tipo_sostenimientoInput"));

            await listarOpciones("cat_turno", null)
            .done(mostrarOpciones("turnoInput", "Seleccione un turno", "id_turno", "turno", "turnoInput"));

            await listarOpciones("cat_tipo_licencia", null)
            .done(mostrarOpciones("tipo_licenciaInput", "Seleccione el tipo de licencia", "id_tipo_licencia", "tipo_licencia", "tipo_licenciaInput"));

            Object.entries(datos_a_pedir_captura).forEach(function([dato, val]) {
                if(val == 1){
                    $("#" + dato).show();
                }
            });

            if (datos_existentes != null){
                Object.entries(datos_existentes.datos).forEach(function([dato, val]) {
                    let $elemento = $("#" + dato + "Input");
                    if($elemento.length > 0 && $elemento.is("input")){
                        if (val != null) $elemento.val(val.toString());
                    }else{
                        if ($elemento.length > 0 && $elemento.is("select")) {
                            if (val !== null) {
                                $elemento.val(val.toString()).change();
                            }
                        }
                    }
                });
            }

        }).fail(function(xhr){
            console.log("Status:", xhr.status);
            console.log("Response:", xhr.responseText);
            alert("Error en petición");
            return;
        });

        $("#clave_plazaInput").prop("readonly", true);
    });

    $("#procesoInput").on("change", async function() {
        if($("#procesoInput").val() !== ""){
            await listarOpciones("cat_tipo_apreciacion", $("#procesoInput").val())
            .done(mostrarOpciones("tipo_apreciacionInput", "Seleccione el tipo de apreciacion", "id_tipo_apreciacion", "tipo_apreciacion", "tipo_apreciacionInput"));

            if (datos_existentes != null) $("#tipo_apreciacionInput").val(datos_existentes.datos.tipo_apreciacion);
            datos_existentes = null;
        }else{
            $("#tipo_apreciacionInput").empty();
        }
    });

    $('#modalElegirTipo').on('hidden.bs.modal', function () {
        $("#modalMostrarRechazo").modal("hide");
        $("#dialogoElegirTipo")
            .removeClass("position-absolute start-0 ms-5")
            .addClass("modal-dialog-centered")
            .css("top", "");
    });
        
    let carga_tipoVacante = null;

    $('#modalElegirTipo').on('show.bs.modal', async function () {
        $(this).find('form').trigger('reset');

        await listarOpciones("TipoLayout", null)
        .then(mostrarOpciones("tipo_layout", "Seleccione un tipo de layout", "id_tipo_layout", "descripcion", ""));

        if (carga_tipoVacante !== null) {
            $("#tipo_layout").val(carga_tipoVacante.toString()).change();
            carga_tipoVacante = null;
        } else {
            $("#btnSiguiente").prop("disabled", true);
        }
        
        $("#paso2, #paso3, #pasoAP, #pasoEFUP").hide();
        $("#btnAtras, #btnCapturar, #btnValidar, #btnCorregir").hide();
        $("#btnSiguiente").show();
        $("#paso1").show();
        $(this).find('.modal-body').scrollTop(0);
    });

    $("#tablaRechazados").on('click', '.corregirfila', async function() {
        let fila = $(this).closest('tr');

        vacante_corregir = fila.data('vacante');
        let id_validacion = fila.data('validacion');
        let folio = fila.find('td').eq(0).text();
        let fecha_captura = fila.find('td').eq(1).text();
        let fecha_rechazo = fila.find('td').eq(2).text();
        let usuario = fila.find('td').eq(4).text();

        var nota_rechazo = await conocerMotivoRechazo(id_validacion);
        datos_existentes = await cargarDatosCapturados(vacante_corregir);

        carga_tipoVacante = datos_existentes.datos.tipo_layout;

        $("#span_folio").text(folio);
        $("#span_fecha_captura").text(fecha_captura);
        $("#span_fecha_rechazo").text(fecha_rechazo);
        $("#span_usuario_rechazo").text(usuario);
        $("#span_nota_rechazo").text(nota_rechazo.datos.nota_rechazo);

        $("#tituloModalDatos").text("Corregir Captura");
        $("#nBotonForm").text("Corregir");

        $("#dialogoElegirTipo")
            .removeClass("modal-dialog-centered")
            .addClass("position-absolute start-0 ms-5")
            .css("top", "15%");
        
        $("#modalMostrarRechazo").modal("show");
        $("#modalElegirTipo").modal("show");

        let plaza = datos_existentes.datos.clave_plaza;

        $("#cod_pagoInput").val(plaza.substring(0, 2));
        $("#unidadInput").val(plaza.substring(2, 4));
        $("#subunidadInput").val(plaza.substring(4, 6));
        $("#cat_puestoInput").val(plaza.substring(6, 11));
        $("#horasInput").val(plaza.substring(11, 15));
        $("#cons_plazaInput").val(plaza.substring(15, 21));
        
    });
                
});