@if (isset($constructora_edit))
    <div class="row">
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$constructora_edit->estado?'1':'0'}}" {{$constructora_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$constructora_edit->estado?'constructora Activo':'constructora Inactivo'}}</label>
            </div>
        </div>
    </div>
    <br>
@endif
<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="regional_id">Regional</label>
        <select id="regional_id" name="regional_id" class="form-control form-control-sm" required>
            <option value="">Elija Regional</option>
            @foreach ($regionales as $regional)
                <option value="{{ $regional->id }}" {{isset($constructora_edit)? ($constructora_edit->regional_id==$regional->id? 'selected':''):''}}>
                    {{ $regional->regional }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="identificacion">NIT</label>
        <input type="hidden" name="tipo_documento_id" value="6">
        <input type="text" class="form-control form-control-sm" value="{{ old('identificacion', $constructora_edit->identificacion ?? '') }}" name="identificacion" id="identificacion" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="constructora">Nombre Constructora</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('constructora', $constructora_edit->constructora ?? '') }}" name="constructora" id="constructora" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="contacto">Nombre del Contacto</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('contacto', $constructora_edit->contacto ?? '') }}" name="contacto" id="contacto" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" value="{{ old('email', $constructora_edit->email ?? '') }}" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="telefono">Teléfono</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('telefono', $constructora_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
    </div>
</div>

