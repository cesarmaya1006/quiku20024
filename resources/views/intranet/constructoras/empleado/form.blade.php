@if (isset($empleado_edit))
    <div class="row">
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$empleado_edit->estado?'1':'0'}}" {{$empleado_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$empleado_edit->estado?'Empleado Activo':'Empleado Inactivo'}}</label>
            </div>
        </div>
    </div>
    <br>
@endif
<div class="row">
    <div class="col-12 col-md-3 form-group" id="caja_clinicas">
        <label class="requerido" for="area_id" id="label_area_id">Área </label>
        <select id="area_id" class="form-control form-control-sm" data_url="{{ route('constructora.cargos.getCargos') }}" required>
            <option value="">Elija área</option>
            @foreach ($constructora->areas as $area)
                <option value="{{ $area->id }}" {{isset($empleado_edit)?($empleado_edit->cargo->area_id==$area->id? 'selected':''):''}}>{{ $area->area }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="cargo_id">Nombre del Cargo</label>
        <select id="cargo_id" name="cargo_id" class="form-control form-control-sm" required>
            @if (isset($empleado_edit))
                <option value="">Elija un cargo</option>
                @foreach ($empleado_edit->cargo->area->cargos as $cargo)
                    <option value="{{$cargo->id}}" {{$empleado_edit->cargo_id==$cargo->id?'selected':''}}>{{$cargo->cargo}}</option>
                @endforeach
            @else
                <option value="">Elija primero un área</option>
            @endif
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="tipo_documento_id">Tipo de identificación</label>
        <select id="tipo_documento_id" class="form-control form-control-sm" name="tipo_documento_id" required>
            <option value="">Elija tipo</option>
            @foreach ($tiposdocu as $tipoDocu)
                <option value="{{ $tipoDocu->id }}" {{isset($empleado_edit)?$empleado_edit->tipo_documento_id == $tipoDocu->id?'selected':'':''}}>
                    {{ $tipoDocu->abreb_id .' - ' . $tipoDocu->tipo_id}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="identificacion">Identificación</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('identificacion', $empleado_edit->identificacion ?? '') }}" name="identificacion" id="identificacion" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="nombres">Nombres</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('nombres', $empleado_edit->nombres ?? '') }}" name="nombres" id="nombres" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="apellidos">Apellidos</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('apellidos', $empleado_edit->apellidos ?? '') }}" name="apellidos" id="apellidos" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" value="{{ old('email', $empleado_edit->usuario->email ?? '') }}" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="telefono">Teléfono</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('telefono', $empleado_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
    </div>
</div>
