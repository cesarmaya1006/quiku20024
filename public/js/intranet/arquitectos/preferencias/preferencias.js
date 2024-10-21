$(document).ready(function () {
    //--------------------------------------------------------------------------
    $(".departamentos").on("change", function () {
        const data_url = $(this).attr("data_url");

        const id = $(this).attr("id");
        const valor = $(this).val();

        var estado =0;
        if (this.checked) {
            console.log('entra');
            estado =1;
        }

        var departamentos = [];
        $("input[name='departamento_id[]']").each(function () {
            if (this.checked) {
                departamentos.push($(this).val());
            }
        });
        var data = {
            departamentos: departamentos,
            id :valor,
            estado :estado,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                var respuesta_html = '';
                console.log(respuesta);
                if (respuesta.municipios.length > 0) {
                    respuesta_html+='<div class="col-12"><h6><strong>Municipios</strong></h6></div>';
                    respuesta_html+='<div class="col-12 col-md-2 mb-3">';
                    respuesta_html+='<div class="form-check">';
                    respuesta_html+='<input class="form-check-input" type="checkbox" value="todos_municipio_id" name="todos_municipio_id" id="check_todos_municipio_id">';
                    respuesta_html+='<label class="form-check-label" for="check_todos_municipio_id">';
                    respuesta_html+='Todos';
                    respuesta_html+='</label>';
                    respuesta_html+='</div>';
                    respuesta_html+='</div>';

                    $.each(respuesta.municipios, function (index, municipio) {
                        respuesta_html+='<div class="col-12 col-md-2 mb-3">';
                        respuesta_html+='<div class="form-check">';
                        respuesta_html+='<input class="form-check-input municipios" type="checkbox"';
                        respuesta_html+='value="'+municipio.id+'"';
                        respuesta_html+='name="municipio_id[]"';
                        respuesta_html+='id="check'+municipio.municipio+'">';
                        respuesta_html+='<label class="form-check-label" for="check'+municipio.municipio+'">';
                        respuesta_html+=''+municipio.municipio+'';
                        respuesta_html+='</label>';
                        respuesta_html+='</div>';
                        respuesta_html+='</div>';
                    });
                    $('#row_municipios').html(respuesta_html);
                    $('#row_municipios').removeClass('d-none');
                    $('#hr_municipios').removeClass('d-none');
                } else {
                    $('#row_municipios').addClass('d-none');
                    $('#hr_municipios').addClass('d-none');
                }

                if (respuesta.respuesta=='attach') {
                    $('.setDepartamento').prop('checked', false);
                    Sistema.notificaciones('Departamento añadido correctamente', 'Sistema', 'success');
                }else{
                    $('.setDepartamento').prop('checked', false);
                    Sistema.notificaciones('Departamento eliminado correctamente', 'Sistema', 'warning');
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
    $('.setTipoInmueble').on("change", function(){
        const data_url = $(this).attr("data_url");
        const id = $(this).attr("id");
        const valor = $(this).val();

        var estado =0;
        if (this.checked) {
            console.log('entra');
            estado =1;
        }
        var data = {
            id :valor,
            estado :estado,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                var respuesta_html = '';
                if (respuesta.respuesta=='attach') {
                    if (valor == 'todos_tipo_inmueble_id') {
                        $('.setTipoInmuebleVal').prop('checked', true);
                    }else{
                        $('.setTipoInmuebleVal').prop('checked', false);
                        $(this).prop('checked', true);
                    }
                    Sistema.notificaciones('Tipo de inmueble añadido correctamente', 'Sistema', 'success');
                }else{
                    if (valor == 'todos_tipo_inmueble_id') {
                        $('.setTipoInmuebleVal').prop('checked', false);
                    }else{
                        $('#check_todos_tipo_inmueble_id').prop('checked', false);
                    }

                    Sistema.notificaciones('Tipo de inmueble eliminado correctamente', 'Sistema', 'warning');
                }

            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
    $('.setDepartamento').on("change", function(){
        const data_url = $(this).attr("data_url");
        const id = $(this).attr("id");
        const valor = $(this).val();

        var estado =0;
        if (this.checked) {
            estado =1;
        }
        var data = {
            id :valor,
            estado :estado,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                var respuesta_html = '';
                if (respuesta.respuesta=='attach') {
                    $('.departamentos').prop('checked', true);
                    Sistema.notificaciones('Deártamento añadido correctamente', 'Sistema', 'success');
                }else{
                    $('.departamentos').prop('checked', false);
                    Sistema.notificaciones('Deártamento eliminado correctamente', 'Sistema', 'warning');
                }

            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
});
