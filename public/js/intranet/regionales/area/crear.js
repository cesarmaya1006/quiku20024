$(document).ready(function () {
    //--------------------------------------------------------------------------
    $("#regional_id").on("change", function () {
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
                var respuesta_html = "";
                if (respuesta.areasPadre.length > 0) {
                    respuesta_html += '<option value="">Elija área padre</option>';
                    $.each(respuesta.areasPadre, function (index, item) {
                        respuesta_html += '<option value="' + item.id + '">' + item.area + "</option>";
                    });
                    $("#area_id").html(respuesta_html);
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});
