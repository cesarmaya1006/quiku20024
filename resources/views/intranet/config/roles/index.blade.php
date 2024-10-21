@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-users mr-3" aria-hidden="true"></i> Configuración Roles
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('titulo_card')
    Listado de Roles
@endsection

@section('botones_card')
    <a href="{{ route('rol.create') }}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 col-md-6 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_xs tabla-borrando" id="tabla-data">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th class="width70"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->name }}</td>
                            <td class="d-flex justify-content-evenly">
                                <a href="{{ route('rol.edit', ['id' => $rol->id]) }}" class="btn-accion-tabla tooltipsC"
                                    title="Editar este registro">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                                <form action="{{ route('rol.destroy', ['id' => $rol->id]) }}" class="d-inline form-eliminar"
                                    method="POST">
                                    @csrf @method('delete')
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                        title="Eliminar este registro">
                                        <i class="fa fa-fw fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/configuracion/roles/index.js') }}"></script>
    @include('intranet.layout.script_datatable')
@endsection
