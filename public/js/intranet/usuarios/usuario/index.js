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

                llenarTablaUsuarios(respuesta.usuarios);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});

function llenarTablaUsuarios(usuarios) {

    var respuesta_tabla_html = "";
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_usuario_edit = $("#permiso_usuarios_edit").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var usuario_edit_ini = $("#permiso_usuarios_edit").attr("data_url");
    usuario_edit_ini = usuario_edit_ini.substring(0, usuario_edit_ini.length - 1);
    const usuario_edit_fin = usuario_edit_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    const permiso_usuario_activar = $("#permiso_usuarios_activar").val();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    var usuario_activar_ini = $("#permiso_usuarios_activar").attr("data_url");
    usuario_activar_ini = usuario_activar_ini.substring(0,usuario_activar_ini.length - 1);
    const usuario_activar_fin = usuario_activar_ini;
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    vaciarTabla("#tabla_usuarios", "#tbody_usuarios");
    // -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*- -*-
    $.each(usuarios, function (index, usuario) {
        respuesta_tabla_html += "<tr>";
        respuesta_tabla_html += '<td class="text-center">' + usuario.id + "</td>";
        respuesta_tabla_html += "<td>" + usuario.tipo_docu.abreb_id + " - " + usuario.identificacion + "</td>";
        respuesta_tabla_html += "<td>" + usuario.nombres + " " + usuario.apellidos + "</td>";
        respuesta_tabla_html += "<td>" + usuario.usuario.email + "</td>";
        respuesta_tabla_html += "<td>" + usuario.telefono + "</td>";
        if (usuario.estado == 1) {
            estado_bg = "success";
            estado = "Activo";
        } else {
            estado_bg = "gray";
            estado = "Inactivo";
        }
        respuesta_tabla_html += '<td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-' + estado_bg + ' rounded">' + estado + "</span></td>";
        respuesta_tabla_html += '<td class="d-flex justify-content-evenly align-usuario-center">';
        if (permiso_usuario_edit == 1) {
            respuesta_tabla_html += '<a href="' + usuario_edit_fin + usuario.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += "</a>";
        } else {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += "</td>";
        respuesta_tabla_html += "</tr>";
    });
    $("#tbody_usuarios").html(respuesta_tabla_html);
    asignarDataTableAjax("#tabla_usuarios", "Listado usuario", 10);
}
