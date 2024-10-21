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

                llenarTablaEmpleados(respuesta.empleados);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});

function llenarTablaEmpleados(empleados) {

    var respuesta_tabla_html = "";
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_empleado_edit = $("#permiso_empleados_edit").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var empleado_edit_ini = $("#permiso_empleados_edit").attr("data_url");
    empleado_edit_ini = empleado_edit_ini.substring(0, empleado_edit_ini.length - 1);
    const empleado_edit_fin = empleado_edit_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_empleado_activar = $("#permiso_empleados_activar").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var empleado_activar_ini = $("#permiso_empleados_activar").attr("data_url");
    empleado_activar_ini = empleado_activar_ini.substring(0,empleado_activar_ini.length - 1);
    const empleado_activar_fin = empleado_activar_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    vaciarTabla("#tabla_empleados", "#tbody_empleados");
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    $.each(empleados, function (index, empleado) {
        respuesta_tabla_html += "<tr>";
        respuesta_tabla_html += '<td class="text-center">' + empleado.id + "</td>";
        respuesta_tabla_html += "<td>" + empleado.cargo.area.area + "</td>";
        respuesta_tabla_html += "<td>" + empleado.cargo.cargo + "</td>";
        respuesta_tabla_html += "<td>" + empleado.tipo_docu.abreb_id + " - " + empleado.identificacion + "</td>";
        respuesta_tabla_html += "<td>" + empleado.nombres + " " + empleado.apellidos + "</td>";
        respuesta_tabla_html += "<td>" + empleado.usuario.email + "</td>";
        respuesta_tabla_html += "<td>" + empleado.telefono + "</td>";
        if (empleado.estado == 1) {
            estado_bg = "success";
            estado = "Activo";
        } else {
            estado_bg = "gray";
            estado = "Inactivo";
        }
        respuesta_tabla_html += '<td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-' + estado_bg + ' rounded">' + estado + "</span></td>";
        respuesta_tabla_html += '<td class="d-flex justify-content-evenly align-empleado-center">';
        if (permiso_empleado_edit == 1) {
            respuesta_tabla_html += '<a href="' + empleado_edit_fin + empleado.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += "</a>";
        } else {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += "</td>";
        respuesta_tabla_html += "</tr>";
    });
    $("#tbody_empleados").html(respuesta_tabla_html);
    asignarDataTableAjax("#tabla_empleados", "Listado empleado", 10);
}
