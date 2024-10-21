$(document).ready(function () {
    //--------------------------------------------------------------------------
    $("#clinica_id").on("change", function () {
        vaciarTabla();
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
                respuesta_tabla_html_fin = '';
                $("#tablaCargos").dataTable().fnDestroy();
                if (respuesta.areas.length > 0) {
                    var respuesta_html = "";
                    respuesta_html += '<option value="Todos">Todos los cargos</option>';
                    $.each(respuesta.areas, function (index, item) {
                        respuesta_html +='<option value="' + item.id + '">' + item.area + "</option>";
                        //================================================================================
                        respuesta_tabla_html_fin += llenarTablaCargos_emp(item.cargos);
                        //================================================================================
                    });
                    $("#tbody_cargos").html(respuesta_tabla_html_fin);
                    asignarDataTable();
                    $("#area_id").html(respuesta_html);
                }else{
                    respuesta_html += '<option value="">Elija una empresa</option>';
                    $("#area_id").html(respuesta_html);
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------


});
function vaciarTabla(){
    respuesta_tabla_html = '';
    $("#tablaCargos").dataTable().fnDestroy();
    $("#tbody_cargos").html(respuesta_tabla_html);
    asignarDataTable();
};
