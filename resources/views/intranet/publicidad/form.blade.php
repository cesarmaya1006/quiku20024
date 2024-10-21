@if (isset($publicidad_edit))
    <div class="row">
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$publicidad_edit->estado?'1':'0'}}" {{$publicidad_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$publicidad_edit->estado?'Publicidad Activo':'Publicidad Inactivo'}}</label>
            </div>
        </div>
    </div>
    <br>
@endif
<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="rol_id" id="label_area_id">ROL DESTINO</label>
        <select id="rol_id" name="rol_id" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="4" {{isset($publicidad_edit)? ($publicidad_edit->rol_id == 4?'selected':''):''}}>Usuario Externo</option>
            <option value="5" {{isset($publicidad_edit)? ($publicidad_edit->rol_id == 5?'selected':''):''}}>Arquitecto</option>
            <option value="6" {{isset($publicidad_edit)? ($publicidad_edit->rol_id == 6?'selected':''):''}}>Empleado Constructora</option>
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="tipo" id="label_area_id">Tipo Publicidad</label>
        <select id="tipo" name="tipo" class="form-control form-control-sm" required>
            <option value="">Elija una opción</option>
            <option value="Cinta" {{isset($publicidad_edit)? ($publicidad_edit->tipo == 'Cinta'?'selected':''):''}}>Publicidad Cinta</option>
            <option value="Lateral" {{isset($publicidad_edit)? ($publicidad_edit->tipo == 'Lateral'?'selected':''):''}}>Publicidad Lateral</option>
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="cliente">Cliente</label>
        <input type="text" class="form-control form-control-sm" name="cliente" id="cliente" value="{{ old('cliente', $publicidad_edit->cliente ?? '') }}">
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="url">Url de link</label>
        <input type="text" class="form-control form-control-sm" name="url" id="url" value="{{ old('url', $publicidad_edit->url ?? '') }}">
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 form-group">
                <label for="imagen" class="requerido">Imagen publicitaria</label>
                <input type="file" class="form-control form-control-sm" id="imagen" name="imagen" accept="image/png,image/jpeg" onchange="mostrar()" {{isset($publicidad_edit)?'':'required'}}>
                <small id="helpId" class="form-text text-muted">Imagen publicitaria</small>
            </div>
            <div class="col-12">
                <div class="row d-flex justify-content-evenly">
                    <div class="col-6 col-md-4">
                        <img class="img-fluid fotoUsuario" id="fotoUsuario" src="{{ isset($publicidad_edit) ?($publicidad_edit->imagen!=null?asset('/imagenes/patrocinios/'.$publicidad_edit->imagen) : asset('/imagenes/patrocinios/sin_imagen.png')) : asset('/imagenes/patrocinios/sin_imagen.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
