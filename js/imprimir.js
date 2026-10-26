function imprimir(qna, id){
    $.ajax({
        type: "GET",
        url: "/Vacantes/servicios/ejecucion/imprimir.php",
        dataType: "json",
        data: {
            qna_folio: qna,
            id_tipo_layout: id
        } 
    }).done(function(data){
        alert(data);
    }).fail(function(xhr){
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        alert("Error en petición");
        return;
    });
}

$(document).ready(function(){
    // Aqui poner las acciones y eso
})