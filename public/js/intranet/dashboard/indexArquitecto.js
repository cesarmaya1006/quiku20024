$(document).ready(function () {
    getInmueblesArquitecto();
    //--------------------------------------------------------------------------

    $(".modalPredioBtn").on("click", function () {});
    //--------------------------------------------------------------------------
});
function mostrarModalPredioBtn(id) {

    var data_url_ini = $('#modalArquitecto').attr("data_url");
    data_url_ini = data_url_ini.substring(0,data_url_ini.length - 1);
    const data_url = data_url_ini+ id;

    const data_imagenes = $('#modalArquitecto').attr("data_imagenes");

    const formatter = new Intl.NumberFormat("es-CO");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            console.log(respuesta);
            var respuesta_html = "";
            var contar = 1;
            $("#modalInmueblesLabel").html(respuesta.inmueble.tipo.tipo +" - " +respuesta.inmueble.municipio.municipio +"(" +respuesta.inmueble.municipio.departamento.departamento +")");
            $.each(respuesta.inmueble.multimedia, function (index, item) {
                if (contar == 1) {
                    respuesta_html += '<div class="carousel-item active">';
                } else {
                    respuesta_html += '<div class="carousel-item">';
                }
                respuesta_html += '<img class="d-block w-100" src="' + data_imagenes + "/" + item.url + '">';
                respuesta_html += "</div>";
                contar++;
            });
            $("#multimediModal").html(respuesta_html);
            if (respuesta.inmueble.tipo_area == "Metros Cuadrados") {
                var magnitud = "M²";
            } else {
                var magnitud = respuesta.inmueble.tipo_area;
            }
            $("#precioModal").html(
                "$ " + formatter.format(respuesta.inmueble.precio)
            );
            $("#areaModal").html(
                formatter.format(respuesta.inmueble.area) + "  " + magnitud
            );
            $("#descripcionModal").html(respuesta.inmueble.descripcion);
            $("#vistoModal").html(respuesta.inmueble.visto + "  Veces");
        },
        error: function () {},
    });
}

function getInmueblesArquitecto() {
    const data_url = $("#getInmueblesArq").attr("data_url");
    var data_url_inm_ini = $("#getInmueblesArq").attr("data_url_inm");
    data_url_inm_ini = data_url_inm_ini.substring(0,data_url_inm_ini.length - 1);
    const data_url_inm_ini_fin = data_url_inm_ini;
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            console.log(respuesta);
            var respuesta_html = "";
            if (respuesta.inmuebles.length > 0) {
                respuesta_html += '<div class="row">';
                $.each(respuesta.inmuebles, function (index, inmueble) {
                    respuesta_html += '<div class="col-12 col-md-5 p-2">';
                    respuesta_html +=
                        '<div class="card" style="width: 18rem;">';
                    if (inmueble.multimedia.length > 0) {
                        respuesta_html += '<div class="card-img-top">';
                        respuesta_html +=
                            '<div id="carouselInmueble{{ $inmueble->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                        respuesta_html += '<div class="carousel-inner">';
                        var contador = 0;
                        $.each(
                            inmueble.multimedia,
                            function (index, multimedia) {
                                contador++;
                                if (contador == 1) {
                                    respuesta_html +=
                                        '<div class="carousel-item active">';
                                } else {
                                    respuesta_html +=
                                        '<div class="carousel-item">';
                                }
                                respuesta_html +=
                                    '<img src="' +
                                    $("#getInmueblesArq").attr(
                                        "data_imagenes_inmu"
                                    ) +
                                    "/" +
                                    multimedia.url +
                                    '" class="d-block w-100" alt="..."></img>';
                                respuesta_html += "</div>";
                            }
                        );
                        respuesta_html += "</div>";
                        respuesta_html +=
                            '<button class="carousel-control-prev" type="button"';
                        respuesta_html +=
                            'data-bs-target="#carouselInmueble{{ $inmueble->id }}"';
                        respuesta_html += 'data-bs-slide="prev">';
                        respuesta_html +=
                            '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        respuesta_html +=
                            '<span class="visually-hidden">Previous</span>';
                        respuesta_html += "</button>";
                        respuesta_html +=
                            '<button class="carousel-control-next" type="button"';
                        respuesta_html +=
                            'data-bs-target="#carouselInmueble{{ $inmueble->id }}"';
                        respuesta_html += 'data-bs-slide="next">';
                        respuesta_html +=
                            '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        respuesta_html +=
                            '<span class="visually-hidden">Next</span>';
                        respuesta_html += "</button>";
                        respuesta_html += "</div>";
                        respuesta_html += "</div>";
                    } else {
                        respuesta_html +=
                            '<img src="' +
                            $("#getInmueblesArq").attr("data_imagenes_inmu") +
                            'sin_imagen.png" class="card-img-top" alt="..."></img>';
                    }

                    respuesta_html += '<div class="card-body">';
                    respuesta_html +=
                        '<h5 class="card-title mb-4">' +
                        inmueble.tipo.tipo +
                        " - " +
                        inmueble.municipio.municipio +
                        "(" +
                        inmueble.municipio.departamento.departamento +
                        ")</h5>";
                    respuesta_html +=
                        '<p style="line-height:0pt">Precio de Venta</p>';
                    respuesta_html += '<p style="line-height:0pt">';
                    respuesta_html +=
                        "<strong>$ " + inmueble.precio + "</strong></p>";
                    respuesta_html +=
                        '<p class="mt-4" style="line-height:0pt">Área del inmueble</p>';
                    respuesta_html += '<p style="line-height:0pt">';
                    respuesta_html += "<strong>" + inmueble.area;
                    if (inmueble.tipo_area == "Metros Cuadrados") {
                        respuesta_html += "M²";
                    } else {
                        respuesta_html += inmueble.tipo_area;
                    }
                    respuesta_html += "</strong>";
                    respuesta_html += "</p>";
                    respuesta_html +=
                        '<p class="card-text" style="text-align: justify">';
                    respuesta_html +=
                        inmueble.descripcion.substr(0, 100) + "...</p>";
                    respuesta_html +=
                        "<p>Visto: <strong>" +
                        inmueble.visto +
                        " veces</strong></p>";
                    respuesta_html +=
                        '<button type="button" class="btn btn-primary btn-xs w-100 mb-3 mt-3 modalPredioBtn" data-toggle="modal" onclick="mostrarModalPredioBtn(\''+inmueble.id+'\')" data-target="#modalInmuebles" data_url="' +
                        data_url_inm_ini_fin +
                        inmueble.id +
                        '" data_imagenes="' +
                        $("#getInmueblesArq").attr("data_imagenes_inmu") +
                        '">Ver detalles</button>';
                    respuesta_html += "</div>";
                    respuesta_html += "</div>";
                    respuesta_html += "</div>";
                });
                respuesta_html += "</div>";
            }
            $("#inmueblesArquitecto").html(respuesta_html);
        },
        error: function () {},
    });
}
