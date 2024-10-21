$(document).ready(function () {
    //--------------------------------------------------------------------------
    $("#region_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                llenarTablaConstructoras(respuesta.constructoras);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});

function llenarTablaConstructoras(constructoras) {
    var respuesta_tabla_html = "";
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_constructora_edit = $("#permiso_constructoras_edit").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var constructora_edit_ini = $("#permiso_constructoras_edit").attr("data_url");
    constructora_edit_ini = constructora_edit_ini.substring(0, constructora_edit_ini.length - 1);
    const constructora_edit_fin = constructora_edit_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_constructora_activar = $("#permiso_constructoras_activar").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var constructora_activar_ini = $("#permiso_constructoras_activar").attr("data_url");
    constructora_activar_ini = constructora_activar_ini.substring(0,constructora_activar_ini.length - 1);
    const constructora_activar_fin = constructora_activar_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    vaciarTabla("#tabla_constructoras", "#tbody_constructoras");
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    $.each(constructoras, function (index, constructora) {
        respuesta_tabla_html += "<tr>";
        respuesta_tabla_html += '<td class="text-center">' + constructora.id + "</td>";
        respuesta_tabla_html += "<td>" + constructora.tipo_docu.abreb_id + " - " + constructora.identificacion + "</td>";
        respuesta_tabla_html += "<td>" + constructora.constructora + "</td>";
        respuesta_tabla_html += "<td>" + constructora.contacto + "</td>";
        respuesta_tabla_html += "<td>" + constructora.email + "</td>";
        respuesta_tabla_html += "<td>" + constructora.telefono + "</td>";
        if (constructora.estado == 1) {
            estado_bg = "success";
            estado = "Activo";
        } else {
            estado_bg = "gray";
            estado = "Inactivo";
        }
        respuesta_tabla_html += '<td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-' + estado_bg + ' rounded">' + estado + "</span></td>";
        respuesta_tabla_html += '<td class="d-flex justify-content-evenly align-constructora-center">';
        if (permiso_constructora_edit == 1) {
            respuesta_tabla_html += '<a href="' + constructora_edit_fin + constructora.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += "</a>";
        } else {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += "</td>";
        respuesta_tabla_html += "</tr>";
    });
    $("#tbody_constructoras").html(respuesta_tabla_html);
    asignarDataTableAjax("#tabla_constructoras", "Listado constructora", 10);
}
