<div class="row">
    <div class="col-12 col-md-3 form-group" id="caja_empresas">
        <label class="requerido" for="departamento_id">Departamento</label>
        <select id="departamento_id" name="departamento_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}" required>
            <option value="">Elija departamento</option>
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}"
                    {{ isset($regional_edit) ? ($regional_edit->departamento_id == $departamento->id ? 'selected' : '') : '' }}>
                    {{ $departamento->departamento }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label for="regional" class="requerido">Nombre regional</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('regional', $regional_edit->regional ?? '') }}" name="regional" id="regional" required>
    </div>
    @if (isset($regional_edit))
        <div class="col-12 col-md-2 form-group">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$regional_edit->estado?'1':'0'}}" {{$regional_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$regional_edit->estado?'Regional Activa':'Regional Inactiva'}}</label>
            </div>
        </div>
    @endif
</div>
