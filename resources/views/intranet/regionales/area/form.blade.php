<div class="row" id="row_caja_areas">
    <div class="col-12 col-md-3 form-group" id="caja_empresas">
        <label for="regional_id">Regional</label>
        <select id="regional_id" name="regional_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}" required>
            <option value="">Elija regional</option>
                @foreach ($regionales as $regional)
                    <option value="{{ $regional->id }}" {{isset($area_edit)?($area_edit->regional_id==$regional->id? 'selected':''):''}}>
                        {{ $regional->regional }}
                    </option>
                @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="caja_areas">
        <label for="area_id">Área Superior</label>
        <select id="area_id" class="form-control form-control-sm" name="area_id">
            @if (isset($area_edit))
                @foreach ($regionales as $regional)
                    @if ($regional->id == $area_edit->regional_id)
                        @foreach ($regional->areas as $area)
                            <option value="{{$area->id}}" {{$area->id == $area_edit->area_id?'selected':''}}>{{$area->area}}</option>
                        @endforeach
                    @endif
                @endforeach
            @else
                <option value="">Elija primero una regional</option>
            @endif
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="caja_area_nueva">
        <label class="requerido" for="area">Nombre del Área</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('area', $area_edit->area ?? '') }}" name="area" id="area" >
    </div>
</div>
