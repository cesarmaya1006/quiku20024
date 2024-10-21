@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-gopuram mr-3" aria-hidden="true"></i> Configuración Constructoras
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Constructoras</li>
@endsection

@section('titulo_card')
    Listado de Constructoras
@endsection

@section('botones_card')
    @can('constructoras.create')
        <a href="{{ route('constructoras.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
            style="font-size: 0.85em;">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('constructoras.index')
        <div class="row">
            <div class="col-12 col-md-3 form-group" id="caja_empresas">
                <label class="requerido" for="region_id">Regional</label>
                <select class="form-control form-control-sm" data_url="{{ route('constructoras.getconstructorasRegional') }}" id="region_id">
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
                <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de constructoras">
                <input type="hidden" id="constructoras_edit" data_url="{{ route('constructoras.edit', ['id' => 1]) }}">
                <input type="hidden" id="constructoras_activar" data_url="{{ route('constructoras.activar', ['id' => 1]) }}">
                <table class="table table-striped table-hover table-sm" id="tabla_constructoras">
                    <thead id="thead_constructoras">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Constructora</th>
                            <th class="text-center">Contacto</th>
                            <th class="text-center">Correo Electrónico</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></td>
                        </tr>
                    </thead>
                    <tbody id="tbody_constructoras">

                    </tbody>
                </table>
            </div>
        </div>
        @can('constructoras.edit')
            <input type="hidden" id="permiso_constructoras_edit" value="1" data_url="{{route('constructoras.edit',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_constructoras_edit" value="0" data_url="{{route('constructoras.edit',['id'=>1])}}">
        @endcan

        @can('constructoras.activar')
            <input type="hidden" id="permiso_constructoras_activar" value="1" data_url="{{route('constructoras.activar',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_constructoras_activar" value="0" data_url="{{route('constructoras.activar',['id'=>1])}}">
        @endcan
    @else
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="alert alert-warning alert-dismissible mini_sombra">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sin Acceso!</h5>
                    <p style="text-align: justify">Su usuario no tiene permisos de acceso para esta vista, Comuniquese con el
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
    <script src="{{ asset('js/intranet/constructoras/constructora/index.js') }}"></script>
@endsection
