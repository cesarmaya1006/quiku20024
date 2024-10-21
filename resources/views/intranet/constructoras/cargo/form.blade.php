<div class="row">
    <div class="col-12 col-md-3 form-group" id="caja_clinicas">
        <label class="requerido" for="area_id" id="label_area_id">Área </label>
        <select id="area_id" name="area_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}" required>
            <option value="">Elija área</option>
            @foreach ($constructora->areas as $area)
                <option value="{{ $area->id }}" {{isset($cargo_edit)?($cargo_edit->area_id==$area->id? 'selected':''):''}}>{{ $area->area }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="caja_cargo_nueva">
        <label class="requerido" for="cargo">Nombre del Cargo</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('cargo', $cargo_edit->cargo ?? '') }}" name="cargo" id="cargo" >
    </div>
</div>
