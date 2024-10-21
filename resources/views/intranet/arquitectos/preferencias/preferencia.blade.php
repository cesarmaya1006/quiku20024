@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-id-badge mr-3" aria-hidden="true"></i> Configuración Arquitectos
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Preferencias Cuenta</li>
@endsection

@section('titulo_card')
    Preferencias de Inmuebles
@endsection

@section('botones_card')
    @can('arquitectos.create')
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
            style="font-size: 0.85em;">
            <i class="fas fa-reply mr-3" aria-hidden="true"></i>
            Volver
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('arquitecto.preferencias')
        <div class="row">
            <div class="col-12">
                <p>Configure aca sus preferencias para las busquedas predeterminadas de inmuebles</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6><strong>Tipo de inmueble</strong></h6>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-2 mb-3">
                        <div class="form-check">
                            <input class="form-check-input setTipoInmueble" type="checkbox" value="todos_tipo_inmueble_id"
                                name="todos_tipo_inmueble_id" id="check_todos_tipo_inmueble_id"
                                data_url="{{ route('arquitecto.setTipoInmueble') }}"
                                {{ $arquitecto->arquitecto_tipoinmuebles->count() == $tiposInmueble->count() ? 'checked' : '' }}>
                            <label class="form-check-label" for="check_todos_tipo_inmueble_id">
                                Todos
                            </label>
                        </div>
                    </div>
                    @foreach ($tiposInmueble as $tipo)
                        <div class="col-12 col-md-2 mb-3">
                            <div class="form-check">
                                <input class="form-check-input setTipoInmuebleVal setTipoInmueble" type="checkbox"
                                    value="{{ $tipo->id }}" name="tipo_inmueble_id[]" id="check{{ $tipo->tipo }}"
                                    data_url="{{ route('arquitecto.setTipoInmueble') }}"
                                    {{ $arquitecto->arquitecto_tipoinmuebles->where('id', $tipo->id)->count() > 0 ? ($arquitecto->arquitecto_tipoinmuebles->where('id', $tipo->id)->first()->id = $tipo->id ? 'checked' : '') : '' }}>
                                <label class="form-check-label" for="check{{ $tipo->tipo }}">{{ $tipo->tipo }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6><strong>Departamentos</strong></h6>
                    </div>
                    <div class="col-12 col-md-2 mb-3">
                        <div class="form-check">
                            <input class="form-check-input setDepartamento" type="checkbox" value="todos_departamento_id"
                                name="todos_departamento_id" id="check_todos_departamento_id"
                                data_url="{{ route('arquitecto.setDepartamento') }}"
                                {{ $arquitecto->arquitecto_departamentos->count() == $departamentos->count() ? 'checked' : '' }}>
                            <label class="form-check-label" for="check_todos_departamento_id">
                                Todos
                            </label>
                        </div>
                    </div>
                    @foreach ($departamentos as $departamento)
                        <div class="col-12 col-md-2 mb-3">
                            <div class="form-check">
                                <input class="form-check-input departamentos" type="checkbox" value="{{ $departamento->id }}"
                                    name="departamento_id[]" id="check{{ $departamento->departamento }}"
                                    data_url="{{ route('arquitecto.getMunicipios') }}"
                                    {{ $arquitecto->arquitecto_departamentos->where('id', $departamento->id)->count() > 0 ? ($arquitecto->arquitecto_departamentos->where('id', $departamento->id)->first()->id = $departamento->id ? 'checked' : '') : '' }}>
                                <label class="form-check-label" for="check{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="row d-none" id="row_municipios">
                    <div class="col-12">
                        <h6><strong>Municipios</strong></h6>
                    </div>
                    <div class="col-12 col-md-2 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="todos_municipio_id" name="todos_municipio_id"
                                id="check_todos_municipio_id">
                            <label class="form-check-label" for="check_todos_municipio_id">
                                Todos
                            </label>
                        </div>
                    </div>
                </div>
                <hr class="d-none" id="hr_municipios">
                <form class="col-12 form-horizontal" action="{{ route('arquitecto.setPreferencias') }}" method="POST" autocomplete="off">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-12 col-md-3 form-group">
                            <label class="requerido" for="ubicacion" id="label_area_id">Ubicación</label>
                            <select id="ubicacion" name="ubicacion" class="form-control form-control-sm" required>
                                <option value="URBANO">URBANO</option>
                                <option value="RURAL">RURAL</option>
                                <option value="AMBOS">AMBOS</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label class="requerido" for="avaluo_corporativo" id="label_area_id">Con Avalúo Corporativo?</label>
                            <select id="avaluo_corporativo" name="avaluo_corporativo" class="form-control form-control-sm"
                                required>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="precio_min" id="label_area_id">Precio Mínimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="number" class="form-control form-control-sm text-right" min="0"
                                    value="0" step="1000000" name="precio_min" id="precio_min">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="precio_max" id="label_area_id">Precio Maximo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">$</span>
                                <input type="number" class="form-control form-control-sm text-right" min="0"
                                    value="0" step="1000000" name="precio_max" id="precio_max">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="area_minima" id="label_area_id">Área Mínima</label>
                            <input type="number" class="form-control form-control-sm text-right" min="0"
                                value="0" step="1" name="area_minima" id="area_minima">
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="area_maxima" id="label_area_id">Área Maxima</label>
                            <input type="number" class="form-control form-control-sm text-right" min="0"
                                value="0" step="1" name="area_maxima" id="area_maxima">
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="tipo_area" id="label_area_id">Tipo de Área</label>
                            <select id="tipo_area" name="tipo_area" class="form-control form-control-sm"
                                required>
                                <option value="Metros Cuadrados">Metros Cuadrados</option>
                                <option value="Fanegadas">Fanegadas</option>
                                <option value="Hectareas">Hectareas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                            <button type="submit" class="btn btn-primary btn-sm mini_sombra pl-sm-5 pr-sm-5" style="font-size: 0.8em;">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="alert alert-warning alert-dismissible mini_sombra">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sin Acceso!</h5>
                    <p style="text-align: justify">Su arquitecto no tiene permisos de acceso para esta vista, Comuniquese con
                        el
                        administrador del sistema.</p>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/arquitectos/preferencias/preferencias.js') }}"></script>
@endsection
