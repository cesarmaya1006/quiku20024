@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-user-tie mr-3" aria-hidden="true"></i> Configuración Cargos
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Cargos</li>
@endsection

@section('titulo_card')
    Listado de Cargos
@endsection

@section('botones_card')
    @can('cargos.create')
        <a href="{{ route('cargos.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('cargos.index')
        <div class="row">
            <div class="col-12 col-md-3 form-group" id="caja_clinicas">
                <label for="clinica_id">Regional</label>
                <select id="clinica_id" class="form-control form-control-sm" data_url="{{ route('cargos.getAreasCargos') }}">
                    <option value="">Elija Regional</option>
                    @foreach ($regionales as $regional)
                        <option value="{{ $regional->id }}">
                            {{ $regional->regional }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-md-center">
            <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Cargos">
            <input type="hidden" id="control_dataTable" value="1">
            <input type="hidden" id="cargos_edit" data_url="{{ route('cargos.edit', ['id' => 1]) }}">
            <input type="hidden" id="cargos_destroy" data_url="{{ route('cargos.destroy', ['id' => 1]) }}">
            <input type="hidden" id="cargos_todos" data_url="{{ route('cargos.getCargosTodos') }}">
            @csrf @method('delete')
            <div class="col-12 col-md-8 table-responsive">
                <table class="table table-striped table-hover table-sm tabla_data_table" id="tabla_empleados">
                    <thead id="thead_empleados">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center" >Empresa</th>
                            <th class="text-center" >Area</th>
                            <th class="text-center" >Cargo</th>
                            <th class="text-center" >Identificación</th>
                            <th class="text-center" >Nombres y Apellidos</th>
                            <th class="text-center" >Correo Electrónico</th>
                            <th class="text-center" >Teléfono</th>
                            <th class="text-center" >Dirección</th>
                            <th class="text-center" >Estado</th>
                            <th class="text-center" ></td>
                        </tr>
                    </thead>
                    <tbody id="tbody_empleados">

                    </tbody>
                </table>
            </div>
        </div>
        @can('cargos.edit')
            <input type="hidden" id="permiso_cargos_edit" value="1" data_url="{{route('cargos.edit',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_cargos_edit" value="0" data_url="{{route('cargos.edit',['id'=>1])}}">
        @endcan

        @can('cargos.destroy')
            <input type="hidden" id="permiso_cargos_destroy" value="1">
        @else
            <input type="hidden" id="permiso_cargos_destroy" value="0">
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
    <!-- Modales  -->

    <!-- Fin Modales  -->
@endsection

@section('scripts_pagina')
    @include('intranet.layout.data_table')
    <script src="{{ asset('js/intranet/regionales/cargo/index.js') }}"></script>
<!-- = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = -->

@endsection
