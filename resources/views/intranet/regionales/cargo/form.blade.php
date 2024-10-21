<div class="row">
    <div class="col-12 col-md-3 form-group" id="caja_clinicas">
        <label class="requerido" for="regional_id" id="label_regional_id">Regional </label>
        <select id="regional_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}">
            <option value="">Elija regional</option>
            @foreach ($regionales as $regional)
                <option value="{{ $regional->id }}" {{isset($cargo_edit)?($cargo_edit->area->regional_id==$regional->id? 'selected':''):''}}>
                    {{ $regional->regional }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="col_caja_areas">
        <label class="requerido" for="area_id" id="label_area_id">Área</label>
        <select id="area_id" name="area_id" class="form-control form-control-sm" required>
            @if (isset($cargo_edit))
                <option value="">Elija un área</option>
                @foreach ($cargo_edit->area->regional->areas as $area)
                    <option value="{{ $area->id }}" {{$cargo_edit->area_id==$area->id? 'selected':''}}>
                        {{ $area->area }}
                    </option>
                @endforeach
            @else
                <option value="">Elija una empresa</option>
            @endif
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="caja_cargo_nueva">
        <label class="requerido" for="cargo">Nombre del Cargo</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('cargo', $cargo_edit->cargo ?? '') }}" name="cargo" id="cargo" >
    </div>
</div>


