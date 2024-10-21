$(document).ready(function () {
    //--------------------------------------------------------------------------
    const tipoInmuebleModal = new bootstrap.Modal(document.getElementById("tipoInmuebleModal"));
    $('#btn_tipoInmuebleModal').on('click', function (){
        tipoInmuebleModal.show();
    });
    $("#idFormNewTipo").on("click", function () {
        event.preventDefault();
        const urlData = $(this).attr('data_url');
        var data = {
            tipo: $('#tipo').val(),
        };
        $.ajax({
            url: urlData,
            type: "GET",
            data: data,

            success: function (respuesta) {
                console.log(respuesta);
                var respuesta_html = '';
                $.each(respuesta.tipos, function (index, item) {
                    if (item.id == respuesta.tipo.id) {
                        respuesta_html += '<option value="' + item.id + '" selected>' + item.tipo + "</option>";
                    } else {
                        respuesta_html += '<option value="' + item.id + '">' + item.tipo + "</option>";
                    }
                });
                $("#tipo_inmueble_id").html(respuesta_html);
                if (respuesta.mensaje == "nuevo") {
                    Sistema.notificaciones("El registro fue creado y seleccionado correctamente","Sistema","success");
                } else {
                    Sistema.notificaciones("El registro ya exixte en la base de datos, y fue seleccionado","Sistema","warning");
                }
                tipoInmuebleModal.hide();
            },
            error: function () {},
        });
    });

    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    $("#departamento_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        $('#cuerpoPagina').addClass('d-none');
        $('#cuerpoCargando').removeClass('d-none');
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                console.log(respuesta);
                var respuesta_html = "";
                if (respuesta.municipios.length > 0) {
                    respuesta_html += '<option value="">Elija un municipio</option>';
                    $.each(respuesta.municipios, function (index, item) {
                        respuesta_html += '<option value="' + item.id + '">' + item.municipio + "</option>";
                    });

                }else{
                    respuesta_html += '<option value="">Elija un departamento</option>';
                }
                $("#municipio_id").html(respuesta_html);
                $('#cuerpoPagina').removeClass('d-none');
                    $('#cuerpoCargando').addClass('d-none');
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
    $("#btnAgregarMultimedia").on("click", function () {
        $( "#cajaMultimedia0" ).clone().appendTo( "#cajonMultimedia0" );
        var cantidad = 0;
        $('.cajaMultimedia').each(function(i, obj) {
            if (cantidad > 0) {
                $(this).attr("id", "cajaMultimedia"+ cantidad);
                $(this).children("input").attr("id", "multimedia"+ cantidad);
                $(this).removeClass('d-none');
            }
            cantidad++;
        });
    });
    //--------------------------------------------------------------------------
    $('#precio').on('change',function(){
        var precio = $(this).val();
        if (precio < 2000000000) {
            $('#rango_precio').html('menor a $2.000.000.000');
        } else if(precio < 4000000000){
            $('#rango_precio').html('entre $2.000.000.000 y $4.000.000.000');
        } else if(precio < 8000000000){
            $('#rango_precio').html('entre $4.000.000.000 y $8.000.000.000');
        } else if(precio > 8000000001){
            $('#rango_precio').html('mayor a $8.000.000.000');
        }else{
            $('#rango_precio').html('No lo sé');
        }
    });
    $("#precio").on("keyup change", function(e) {
        var precio = $(this).val();
        if (precio < 2000000000) {
            $('#rango_precio').html('menor a $2.000.000.000');
        } else if(precio < 4000000000){
            $('#rango_precio').html('entre $2.000.000.000 y $4.000.000.000');
        } else if(precio < 8000000000){
            $('#rango_precio').html('entre $4.000.000.000 y $8.000.000.000');
        } else if(precio > 8000000001){
            $('#rango_precio').html('mayor a $8.000.000.000');
        }else{
            $('#rango_precio').html('No lo sé');
        }
    })
    //--------------------------------------------------------------------------

});


