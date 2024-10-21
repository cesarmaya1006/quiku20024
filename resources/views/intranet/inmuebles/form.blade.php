<div class="row" style="font-size: 0.85em;">
    <div class="col-12 col-md-4 form-group" id="caja_clinicas">
        <label class="requerido" for="tipo_inmueble_id">¿QUE TIPO DE INMUEBLE QUIERE VENDER? </label>
        <div class="input-group mb-3">
            <select id="tipo_inmueble_id" name="tipo_inmueble_id" class="form-control form-control-sm" required>
                <option value="">Tipo de inmueble</option>
                @foreach ($tipoInmueble as $tipo)
                <option value="{{ $tipo->id }}" {{isset($inmueble_edit)?($inmueble_edit->tipo_inmueble_id==$tipo->id? 'selected':''):''}}>{{ $tipo->tipo }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <span class="input-group-text" id="btn_tipoInmuebleModal" style="cursor: pointer"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 form-group" id="col_caja_areas">
        <label class="requerido" for="ubicacion" id="label_area_id">¿ES UN INMUEBLE URBANO O RURAL?</label>
        <select id="ubicacion" name="ubicacion" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="URBANO">URBANO</option>
            <option value="RURAL">RURAL</option>
            <option value="No lo sé">No lo sé</option>
        </select>
    </div>
    <div class="col-12 col-md-4 form-group" id="col_caja_areas">
        <label class="requerido" for="avaluo_corporativo" id="label_area_id">¿POSEE UN AVALÚO CORPORATIVO?</label>
        <select id="avaluo_corporativo" name="avaluo_corporativo" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <option value="No lo sé">No lo sé</option>
        </select>
    </div>
    <div class="col-12 col-md-4 form-group" id="caja_cargo_nueva">
        <label class="requerido" for="precio">VALOR DEL INMUEBLE</label>
        <input type="number" class="form-control form-control-sm" name="precio" id="precio" min="0" required>
    </div>
    <div class="col-12 col-md-4 form-group" id="col_caja_areas">
        <label class="requerido" for="rango" id="label_area_id">¿EN QUE RANGO DE PRECIO DE VENTA ESTA EL INMUEBLE?</label>
        <span class="form-control form-control-sm" id="rango_precio"></span>
    </div>
    <div class="col-12 col-md-8 form-group" id="col_caja_areas">
        <label class="requerido" for="solicitud_avaluo" id="label_area_id">¿NECESITA QUE LA LONJA AVALUADORA E INMOBILIARIA DE LA S.C.A REALICE UN AVALUO CORPORATIVO DE SU INMUEBLE?</label>
        <select id="solicitud_avaluo" name="solicitud_avaluo" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
        </select>
    </div>
    <div class="col-12 col-md-2 form-group" id="col_caja_areas">
        <label class="requerido" for="area" id="label_area_id">ÁREA DE PREDIO</label>
        <input type="number" class="form-control form-control-sm" name="area" id="area" min="0" required>
    </div>
    <div class="col-12 col-md-2 form-group" id="col_caja_areas">
        <label class="requerido" for="tipo_area" id="label_area_id">TIPO DE ÁREA</label>
        <select id="tipo_area" name="tipo_area" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="Metros Cuadrados">Metros Cuadrados</option>
            <option value="Fanegadas">Fanegadas</option>
            <option value="Hectareas">Hectareas</option>
        </select>
    </div>
    <div class="col-12 form-group">
        <label class="requerido" for="descripcion" id="label_area_id">DESCRIPCIÓN DEL PREDIO</label>
        <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="30" rows="5" required style="resize: none;" required></textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-4 form-group" id="col_caja_areas">
        <label class="requerido" for="departamento_id" id="label_area_id">DEPARTAMENTO</label>
        <select id="departamento_id" name="departamento_id" class="form-control form-control-sm" data_url="{{route('inmuebles.getMunicipiosByDepartamento')}}" required>
            <option value="">Elija una opción</option>
            @foreach ($departamentos as $departamento)
                <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-4 form-group" id="col_caja_areas">
        <label class="requerido" for="municipio_id" id="label_area_id">MUNICIPIO</label>
        <select id="municipio_id" name="municipio_id" class="form-control form-control-sm" required>
            <option value="">Elija primero un departamento</option>
        </select>
    </div>
    <div class="col-12 col-md-4 form-group" id="caja_cargo_nueva">
        <label class="requerido" for="direccion">DIRECCIÓN DEL INMUEBLE</label>
        <input type="text" class="form-control form-control-sm" name="direccion" id="direccion" >
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-6 mb-4 mb-md-0">
        <h6>Agregar Imagenes y/o Videos</h6>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
        <span class="btn btn-success btn-xs mini_sombra pl-5 pr-5 float-md-end" id="btnAgregarMultimedia"><i class="fa fa-plus-square mr-3" aria-hidden="true"></i>Agregar</span>
    </div>
</div>
<div class="row mt-4 cajonMultimedia" id="cajonMultimedia0">
    <div class="col-12 col-md-7 form-group cajaMultimedia d-none" id="cajaMultimedia0">
        <label for="multimedia">Imagen/Video</label>
        <input type="file" class="form-control form-control-sm" id="multimedia0" name="multimedia[]" accept="image/*,video/*">
        <small id="helpId" class="form-text text-muted">Agregar Imagenes o  Videos (Solo archivos mp4 y nomayores a 20MB)</small>
    </div>
</div>
<hr>
