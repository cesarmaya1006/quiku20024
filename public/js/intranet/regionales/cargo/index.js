$(document).ready(function () {
    //--------------------------------------------------------------------------
    $("#clinica_id").on("change", function () {
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

                llenarTablaCargos(respuesta.areas);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});

function llenarTablaCargos(areas) {

    var respuesta_tabla_html = "";
    const permiso_cargos_edit = $("#permiso_cargos_edit").val();
    const permiso_cargos_destroy = $("#permiso_cargos_destroy").val();
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    var cargos_edit_ini = $("#permiso_cargos_edit").attr("data_url");
    cargos_edit_ini = cargos_edit_ini.substring(0,cargos_edit_ini.length - 1);
    const cargos_edit_fin = cargos_edit_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    vaciarTabla("#tablaCargos","#tbody_cargos");
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    $.each(areas, function (index, area) {
        $.each(area.cargos, function (index, cargo) {
            respuesta_tabla_html += "<tr>";
            respuesta_tabla_html += '<td class="text-center">' + cargo.id + "</td>";
            respuesta_tabla_html += "<td>" + area.area + "</td>";
            respuesta_tabla_html += "<td>" + cargo.cargo + "</td>";
            respuesta_tabla_html += '<td class="d-flex justify-content-evenly align-cargos-center">';
            if (permiso_cargos_edit == 1) {
                respuesta_tabla_html += '<a href="' + cargos_edit_fin + cargo.id + '" class="btn-accion-tabla tooltipsC"';
                respuesta_tabla_html += 'title="Editar este registro">';
                respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
                respuesta_tabla_html += "</a>";
            } else {
                respuesta_tabla_html += '<span class="text-danger">---</span>';
            }
            respuesta_tabla_html += "</td>";
            respuesta_tabla_html += "</tr>";
        });
    });
    $('#tbody_cargos').html(respuesta_tabla_html);
    asignarDataTableAjax('#tablaCargos','Tabla Cargos',5);
}
