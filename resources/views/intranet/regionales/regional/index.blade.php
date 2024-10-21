@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-building mr-3" aria-hidden="true"></i> Configuración Regionales
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Regionales</li>
@endsection

@section('titulo_card')
    Listado de Regionales
@endsection

@section('botones_card')
    @can('regionales.create')
        <a href="{{ route('regionales.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('regionales.index')
        <div class="row">
            <div class="col-12">
                <div class="col-12">
                    @csrf @method('delete')
                    <div class="col-12">
                        <table class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table_inicial_opt"
                            data_titulo="Listado de Clínicas" data_pageLength="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Departamento</th>
                                    <th>Regional</th>
                                    <th>Estado</th>
                                    @if (auth()->user()->hasPermissionTo('regionales.edit') || auth()->user()->hasPermissionTo('regionales.destroy'))
                                        <td></td>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regionales as $regional)
                                    <tr>
                                        <td>{{ $regional->id }}</td>
                                        <td>{{ $regional->nacional ? '---' : $regional->departamento->departamento }}</td>
                                        <td>{{ $regional->regional }}</td>
                                        <td><span
                                                class="badge bg-{{ $regional->estado == 1 ? 'success' : 'danger' }}">{{ $regional->estado == 1 ? 'Activa' : 'Inactiva' }}</span>
                                        </td>
                                        @if (auth()->user()->hasPermissionTo('regionales.edit') || auth()->user()->hasPermissionTo('regionales.destroy'))
                                            <td>
                                                @can('regionales.edit')
                                                    <a href="{{ route('regionales.edit', ['id' => $regional->id]) }}"
                                                        class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                        <i class="fas fa-pen-square"></i>
                                                    </a>
                                                @endcan
                                                @can('regionales.destroy')
                                                    <form action="{{ route('regionales.destroy', ['id' => $regional->id]) }}"
                                                        class="d-inline form-eliminar" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                            title="Eliminar este registro">
                                                            <i class="fa fa-fw fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
@endsection
