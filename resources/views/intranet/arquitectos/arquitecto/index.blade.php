@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-id-badge mr-3" aria-hidden="true"></i> Configuración Arquitectos
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Arquitectos</li>
@endsection

@section('titulo_card')
    Listado de Arquitectos
@endsection

@section('botones_card')
    @can('arquitectos.create')
        <a href="{{ route('arquitectos.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
            style="font-size: 0.85em;">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('arquitectos.index')
        <div class="row">
            <div class="col-12 col-md-3 form-group" id="caja_empresas">
                <label class="requerido" for="region_id">Regional</label>
                <select class="form-control form-control-sm" data_url="{{ route('arquitectos.getArquitectosRegional') }}" id="region_id">
                    <option value="">Elija regional</option>
                    @foreach ($regionales as $regional)
                        <option value="{{ $regional->id }}">{{ $regional->regional }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="row" id="row_tabla">
            <div class="col-12 table-responsive">
                <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de arquitectos">
                <input type="hidden" id="arquitectos_edit" data_url="{{ route('arquitectos.edit', ['id' => 1]) }}">
                <input type="hidden" id="arquitectos_activar" data_url="{{ route('arquitectos.activar', ['id' => 1]) }}">
                <table class="table table-striped table-hover table-sm" id="tabla_arquitectos">
                    <thead id="thead_arquitectos">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Nombres y Apellidos</th>
                            <th class="text-center">Correo Electrónico</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></td>
                        </tr>
                    </thead>
                    <tbody id="tbody_arquitectos">

                    </tbody>
                </table>
            </div>
        </div>
        @can('arquitectos.edit')
            <input type="hidden" id="permiso_arquitectos_edit" value="1" data_url="{{route('arquitectos.edit',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_arquitectos_edit" value="0" data_url="{{route('arquitectos.edit',['id'=>1])}}">
        @endcan

        @can('arquitectos.activar')
            <input type="hidden" id="permiso_arquitectos_activar" value="1" data_url="{{route('arquitectos.activar',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_arquitectos_activar" value="0" data_url="{{route('arquitectos.activar',['id'=>1])}}">
        @endcan
    @else
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="alert alert-warning alert-dismissible mini_sombra">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sin Acceso!</h5>
                    <p style="text-align: justify">Su arquitecto no tiene permisos de acceso para esta vista, Comuniquese con el
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
    @include('intranet.layout.data_table')
    <script src="{{ asset('js/intranet/arquitectos/arquitecto/index.js') }}"></script>
@endsection
