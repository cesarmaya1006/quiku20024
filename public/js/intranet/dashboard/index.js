$(document).ready(function () {
    //--------------------------------------------------------------------------
    if ($('#cintaPublicidad').length) {
        const data_url = $('#cintaPublicidad').attr("data_url");
        const data_imagenes = $('#cintaPublicidad').attr("data_imagenes");
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                if (respuesta.publicidad.length >0) {
                    var respuesta_html = '';
                    respuesta_html+='<div class="slider">';
                    respuesta_html+='<div class="move">';
                    $.each(respuesta.publicidad, function (index, item) {
                        respuesta_html+='<div class="box ml-4 mr-4"><a href="'+item.url+'" target="_blank" rel="noopener noreferrer"><img src="'+data_imagenes+'/'+item.imagen+'" style="width: 250px;height: 100px;"></a></div>';
                    });
                    $.each(respuesta.publicidad, function (index, item) {
                        respuesta_html+='<div class="box ml-4 mr-4"><a href="'+item.url+'" target="_blank" rel="noopener noreferrer"><img src="'+data_imagenes+'/'+item.imagen+'" style="width: 250px;height: 100px;"></a></div>';
                    });
                    respuesta_html+='</div>';
                    respuesta_html+='</div>';

                    $("#cintaPublicidad").html(respuesta_html);
                }else{
                    $('#cintaPublicidad').parent().addClass('d-none');
                }

            },
            error: function () {},
        });
    }
    //--------------------------------------------------------------------------
    if ($('#publicidadLateral').length) {
        const data_url = $('#publicidadLateral').attr("data_url");
        const data_imagenes = $('#publicidadLateral').attr("data_imagenes");
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                if (respuesta.publicidad.length > 0) {
                    var respuesta_html = '';
                    respuesta_html+='<div class="row">';
                    $.each(respuesta.publicidad, function (index, item) {
                        respuesta_html+='<div class="col-12 mb-4 mini_sombra">';
                        respuesta_html+='<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'
                        respuesta_html+='<img src="'+data_imagenes+'/'+item.imagen+'" class="img-fluid" alt="..."></a>';
                        respuesta_html+='</div>'
                    });
                    respuesta_html+='</div>'
                    $("#publicidadLateral").html(respuesta_html);
                } else {
                    $('#publicidadLateral').addClass('d-none');
                }
            },
            error: function () {},
        });
    }
    //--------------------------------------------------------------------------

    $(".modalPredioBtn").on("click", function () {
        const data_url = $(this).attr("data_url");
        const data_imagenes = $(this).attr("data_imagenes");
        const formatter = new Intl.NumberFormat('es-CO');
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                var respuesta_html = '';
                var contar = 1
                $('#modalInmueblesLabel').html( respuesta.inmueble.tipo.tipo + ' - ' + respuesta.inmueble.municipio.municipio + '(' + respuesta.inmueble.municipio.departamento.departamento + ')');
                $.each(respuesta.inmueble.multimedia, function (index, item) {
                    if (contar ==1) {
                        respuesta_html+='<div class="carousel-item active">';
                    } else {
                        respuesta_html+='<div class="carousel-item">';
                    }
                    respuesta_html+='<img class="d-block w-100" src="'+data_imagenes+'/'+item.url+'">';
                    respuesta_html+='</div>';
                    contar++;
                });
                $('#multimediModal').html(respuesta_html);
                if (respuesta.inmueble.tipo_area=='Metros Cuadrados') {
                    var magnitud ='M²';
                } else {
                    var magnitud =respuesta.inmueble.tipo_area;
                }
                $('#precioModal').html('$ ' + formatter.format(respuesta.inmueble.precio));
                $('#areaModal').html(formatter.format(respuesta.inmueble.area) + '  ' + magnitud);
                $('#descripcionModal').html(respuesta.inmueble.descripcion);
                $('#vistoModal').html(respuesta.inmueble.visto + '  Veces');

            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
});
