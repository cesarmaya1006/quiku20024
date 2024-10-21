$(document).ready(function () {
    const myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
    $(".mostrar_dependencias").on("click", function () {
        const data_id = $(this).attr("data_id");
        const data_url = $(this).attr("data_url");
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                var respuesta_html = "";
                respuesta_html += '<ol class="list-group list-group-numbered">';
                $.each(respuesta.dependencias, function (index, item) {
                    respuesta_html +=
                        '<li class="list-group-item">' + item.area + "</li>";
                });
                respuesta_html += "</ol>";
                $(".modal-body").html(respuesta_html);
            },
            error: function () {},
        });
        myModal.show();
    });
    $(".boton_cerrar_modal").on("click", function () {
        myModal.toggle();
    });
    // - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * - - * -
    //--------------------------------------------------------------------------
    $("#clinica_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        if ($(this).val() != '') {

            var url_areas_edit_ini = $('#areas_edit').attr("data_url");
            url_areas_edit_ini = url_areas_edit_ini.substring(0, url_areas_edit_ini.length - 1);
            const areas_edit_fin = url_areas_edit_ini;

            var areas_destroy_ini = $('#areas_destroy').attr("data_url");
            areas_destroy_ini = areas_destroy_ini.substring(0,areas_destroy_ini.length - 1);
            const areas_destroy_fin = areas_destroy_ini;

            var getDependencias_ini = $('#id_areas_getDependencias').attr("data_url");
            getDependencias_ini = getDependencias_ini.substring(0,getDependencias_ini.length - 1);
            const id_areas_getDependencias_fin = getDependencias_ini;

            const permiso_areas_edit = $('#permiso_areas_edit').val();
            const permiso_areas_destroy = $('#permiso_areas_destroy').val();

            $.ajax({
                url: data_url,
                type: "GET",
                data: data,
                success: function(respuesta) {

                    respuesta_html = '';
                    if (respuesta.areasPadre.length > 0) {
                        respuesta_html = '';
                        $.each(respuesta.areasPadre, function(index, item) {
                            respuesta_html += '<tr>';
                            respuesta_html += '<td class="text-center">' + item .id + '</td>';
                            respuesta_html += '<td class="text-center">' + item.area + '</td>';
                            respuesta_html += '<td class="text-center">';
                            if (item.area_id) {
                                respuesta_html += item.area_sup.area;
                            } else {
                                respuesta_html += '---';
                            }
                            respuesta_html += '</td>';
                            respuesta_html += '<td class="text-center">';
                            if (item.areas.length > 0) {
                                respuesta_html +='<button type="submit" class="btn-accion-tabla tooltipsC mostrar_dependencias text-info"';
                                respuesta_html += 'onClick="mostrarModal(\'' +id_areas_getDependencias_fin + item.id +'\')"';
                                respuesta_html +='title="Mostrar Dependencias" data_id ="' +item.id + '"';
                                respuesta_html += 'data_url = "' + id_areas_getDependencias_fin + item.id + '">';
                                respuesta_html += item.areas.length;
                                respuesta_html += '</button>';
                            } else {
                                respuesta_html += '<h6 class="text-danger">---</h6>';
                            }
                            respuesta_html += '</td>';
                            respuesta_html +='<td class="d-flex justify-content-evenly align-items-center">';

                            if (permiso_areas_edit==1) {
                                respuesta_html += '<a href="' + areas_edit_fin + item.id + '" class="btn-accion-tabla tooltipsC"';
                                respuesta_html += 'title="Editar este registro">';
                                respuesta_html += '<i class="fas fa-pen-square"></i>';
                                respuesta_html += '</a>';
                            }
                            if (permiso_areas_destroy == 1) {
                                respuesta_html += '<form action="' + areas_destroy_fin + item.id + '" class="d-inline form-eliminar" method="POST">';
                                respuesta_html += '<input type="hidden" name="_token" value="'+document.getElementsByName("_token")[0].value+'" autocomplete="off">';
                                respuesta_html += '<input type="hidden" name="_method" value="delete">';
                                respuesta_html += '<button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">';
                                respuesta_html += '<i class="fa fa-fw fa-trash text-danger"></i>';
                                respuesta_html += '</button>';
                                respuesta_html += '</form>';
                            }
                            if (permiso_areas_edit==0 && permiso_areas_destroy == 0) {
                                respuesta_html += '<span class="text-danger">---</span>';
                            }
                            respuesta_html += '</td>';
                            respuesta_html += '</tr>';
                        });

                        var table = new DataTable('#tablaAreas');
                        table.destroy();
                        $('#tbody_areas').html(respuesta_html);
                        asignarDataTable_ajax('#tablaAreas',10,"portrait","Legal","listado de areas",false);
                    }
                },
                error: function() {},
            });

        }

    });
});


function mostrarModal(data_url_) {
    const myModal = new bootstrap.Modal(
        document.getElementById("exampleModal")
    );
    const data_url = data_url_;
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            var respuesta_html = "";
            respuesta_html += '<ol class="list-group list-group-numbered">';
            $.each(respuesta.dependencias, function (index, item) {
                respuesta_html +=
                    '<li class="list-group-item">' + item.area + "</li>";
            });
            respuesta_html += "</ol>";
            $(".modal-body").html(respuesta_html);
        },
        error: function () {},
    });
    myModal.show();
}

function cerrarModalF(){
    const myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
    myModal.hide();
}
