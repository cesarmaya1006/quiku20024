@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-bullhorn mr-3" aria-hidden="true"></i> Configuración Publicidad
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Publicidad</li>
@endsection

@section('titulo_card')
    Listado de Publicidad
@endsection

@section('botones_card')
    @can('publicidad.create')
        <a href="{{ route('publicidad.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    @can('publicidad.index')
        <div class="row d-flex justify-content-md-center">
            <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de publicidad">
            <input type="hidden" id="publicidad_edit" data_url="{{ route('publicidad.edit', ['id' => 1]) }}">
            <input type="hidden" id="publicidad_destroy" data_url="{{ route('publicidad.destroy', ['id' => 1]) }}">
            @csrf @method('delete')
            <div class="col-12 table-responsive">
                <table class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table_inicial_opt" id="tabla_publicidad">
                    <thead id="thead_publicidad">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center" >Rol</th>
                            <th class="text-center" >Tipo</th>
                            <th class="text-center" >Cliente</th>
                            <th class="text-center" >Url</th>
                            <th class="text-center" >Estado</th>
                            <th class="text-center" >Imagen</th>
                            <th class="text-center" ></td>
                        </tr>
                    </thead>
                    <tbody id="tbody_publicidad">
                        @foreach ($publicidades as $publicidad)
                            <tr>
                                <td>{{$publicidad->id}}</td>
                                <td>{{$publicidad->rol->name}}</td>
                                <td>{{$publicidad->tipo}}</td>
                                <td>{{$publicidad->cliente}}</td>
                                <td>{{$publicidad->url}}</td>
                                <td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-{{$publicidad->estado==1?'success':'gray'}} rounded">{{$publicidad->estado==1?'Activo':'Inactivo'}}</span></td>
                                <td class="pt-2 pb-2"><img src="{{asset('imagenes/patrocinios/'. $publicidad->imagen)}}" class="img-fluid" style="width: 250px; height: 100px;border: 1px solid black"></td>
                                <td>
                                    <a href="{{ route('publicidad.edit', ['id' => $publicidad->id]) }}" class="btn-accion-tabla tooltipsC"
                                        title="Editar este registro">
                                        <i class="fas fa-pen-square"></i>
                                    </a>
                                    <form action="{{ route('publicidad.destroy', ['id' => $publicidad->id]) }}" class="d-inline form-eliminar"
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
        @can('publicidad.edit')
            <input type="hidden" id="permiso_publicidad_edit" value="1" data_url="{{route('publicidad.edit',['id'=>1])}}">
        @else
            <input type="hidden" id="permiso_publicidad_edit" value="0" data_url="{{route('publicidad.edit',['id'=>1])}}">
        @endcan

        @can('publicidad.destroy')
            <input type="hidden" id="permiso_publicidad_destroy" value="1">
        @else
            <input type="hidden" id="permiso_publicidad_destroy" value="0">
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
    <script src="{{ asset('js/intranet/publicidad/index.js') }}"></script>
<!-- = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = -->

@endsection
