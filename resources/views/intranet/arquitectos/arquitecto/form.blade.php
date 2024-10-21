@if (isset($arquitecto_edit))
    <div class="row">
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$arquitecto_edit->estado?'1':'0'}}" {{$arquitecto_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$arquitecto_edit->estado?'arquitecto Activo':'arquitecto Inactivo'}}</label>
            </div>
        </div>
    </div>
    <br>
@endif
<div class="row">
    <input type="hidden" name="rol_id" value="3">
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="regional_id">Regional</label>
        <select id="regional_id" name="regional_id" class="form-control form-control-sm" required>
            <option value="">Elija Regional</option>
            @foreach ($regionales as $regional)
                <option value="{{ $regional->id }}" {{isset($arquitecto_edit)? ($arquitecto_edit->regional_id==$regional->id? 'selected':''):''}}>
                    {{ $regional->regional }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="tipo_documento_id">Tipo de identificación</label>
        <select id="tipo_documento_id" class="form-control form-control-sm" name="tipo_documento_id" required>
            <option value="">Elija tipo</option>
            @foreach ($tiposdocu as $tipoDocu)
                <option value="{{ $tipoDocu->id }}" {{isset($arquitecto_edit)?$arquitecto_edit->tipo_documento_id == $tipoDocu->id?'selected':'':''}}>
                    {{ $tipoDocu->abreb_id .' - ' . $tipoDocu->tipo_id}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="identificacion">Identificación</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('identificacion', $arquitecto_edit->identificacion ?? '') }}" name="identificacion" id="identificacion" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="nombres">Nombres</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('nombres', $arquitecto_edit->nombres ?? '') }}" name="nombres" id="nombres" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="apellidos">Apellidos</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('apellidos', $arquitecto_edit->apellidos ?? '') }}" name="apellidos" id="apellidos" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" value="{{ old('email', $arquitecto_edit->usuario->email ?? '') }}" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="telefono">Teléfono</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('telefono', $arquitecto_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
    </div>
</div>

