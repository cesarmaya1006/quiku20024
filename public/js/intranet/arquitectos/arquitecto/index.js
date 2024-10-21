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
                llenarTablaArquitectos(respuesta.arquitectos);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});

function llenarTablaArquitectos(arquitectos) {
    var respuesta_tabla_html = "";
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_arquitecto_edit = $("#permiso_arquitectos_edit").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var arquitecto_edit_ini = $("#permiso_arquitectos_edit").attr("data_url");
    arquitecto_edit_ini = arquitecto_edit_ini.substring(0, arquitecto_edit_ini.length - 1);
    const arquitecto_edit_fin = arquitecto_edit_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_arquitecto_activar = $("#permiso_arquitectos_activar").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var arquitecto_activar_ini = $("#permiso_arquitectos_activar").attr("data_url");
    arquitecto_activar_ini = arquitecto_activar_ini.substring(0,arquitecto_activar_ini.length - 1);
    const arquitecto_activar_fin = arquitecto_activar_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    vaciarTabla("#tabla_arquitectos", "#tbody_arquitectos");
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    $.each(arquitectos, function (index, arquitecto) {
        respuesta_tabla_html += "<tr>";
        respuesta_tabla_html += '<td class="text-center">' + arquitecto.id + "</td>";
        respuesta_tabla_html += "<td>" + arquitecto.tipo_docu.abreb_id + " - " + arquitecto.identificacion + "</td>";
        respuesta_tabla_html += "<td>" + arquitecto.nombres + " " + arquitecto.apellidos + "</td>";
        respuesta_tabla_html += "<td>" + arquitecto.usuario.email + "</td>";
        respuesta_tabla_html += "<td>" + arquitecto.telefono + "</td>";
        if (arquitecto.estado == 1) {
            estado_bg = "success";
            estado = "Activo";
        } else {
            estado_bg = "gray";
            estado = "Inactivo";
        }
        respuesta_tabla_html += '<td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-' + estado_bg + ' rounded">' + estado + "</span></td>";
        respuesta_tabla_html += '<td class="d-flex justify-content-evenly align-arquitecto-center">';
        if (permiso_arquitecto_edit == 1) {
            respuesta_tabla_html += '<a href="' + arquitecto_edit_fin + arquitecto.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += "</a>";
        } else {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += "</td>";
        respuesta_tabla_html += "</tr>";
    });
    $("#tbody_arquitectos").html(respuesta_tabla_html);
    asignarDataTableAjax("#tabla_arquitectos", "Listado arquitecto", 10);
}
