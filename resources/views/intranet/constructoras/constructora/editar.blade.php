@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-gopuram mr-3" aria-hidden="true"></i> Configuración Constructoras
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('constructoras.index') }}">Constructoras</a></li>
    <li class="breadcrumb-item active">Constructoras - Editar</li>
@endsection

@section('titulo_card')
    <i class="fa fa-edit mr-3" aria-hidden="true"></i> Editar Constructora
@endsection

@section('botones_card')
    <a href="{{ route('constructoras.index') }}" class="btn btn-success btn-sm mini_sombra pl-5 pr-5 float-md-end"
        style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-center">
        <form class="col-12 form-horizontal" action="{{ route('constructoras.update', ['id' => $constructora_edit]) }}"
            method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('intranet.constructoras.constructora.form')
            <div class="row mt-5">
                <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                    <button type="submit" class="btn btn-primary btn-xs mini_sombra pl-sm-5 pr-sm-5"
                        style="font-size: 0.8em;">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    @if (isset($constructora_edit))
        <hr>
        <div class="row">
            <div class="col-12">
                <h6><strong>Configuración Organigrama Constructora</strong></h6>
            </div>
            <br>
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="areas-tab" data-bs-toggle="tab" data-bs-target="#areas-tab-pane"
                            type="button" role="tab" aria-controls="areas-tab-pane" aria-selected="true">Áreas</button>
                    </li>
                    @if ($constructora_edit->areas->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cargos-tab" data-bs-toggle="tab" data-bs-target="#cargos-tab-pane"
                                type="button" role="tab" aria-controls="cargos-tab-pane"
                                aria-selected="false">Cargos</button>
                        </li>
                    @endif
                    @php
                        $empleadosNumber = 0;
                        foreach ($constructora_edit->areas as $area) {
                            $empleadosNumber += $area->cargos->count();
                        }
                    @endphp
                    @if ($empleadosNumber > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="empleados-tab" data-bs-toggle="tab"
                                data-bs-target="#empleados-tab-pane" type="button" role="tab"
                                aria-controls="empleados-tab-pane" aria-selected="false">Empleados</button>
                        </li>
                    @endif

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="areas-tab-pane" role="tabpanel" aria-labelledby="areas-tab"
                        tabindex="0">
                        <div class="row mt-4 mb-4">
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <h4 class="card-title">Listado de Áreas</h4>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                                <a href="{{ route('constructora.areas.create', ['id' => $constructora_edit->id]) }}"
                                    class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
                                    style="font-size: 0.85em;">
                                    <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                    Nuevo registro
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table
                                    class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table_inicial_opt"
                                    id="tablaAreas">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Area</th>
                                            <th class="text-center">Area Superior</th>
                                            <th class="text-center">Dependencias</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_areas">
                                        @foreach ($constructora_edit->areas as $area)
                                            <tr>
                                                <td class="text-center">{{ $area->id }}</td>
                                                <td style="white-space:nowrap;">{{ $area->area }}</td>
                                                <td class="text-center">{{ $area->area_id ? $area->area_sup->area : '---' }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($area->areas->count() > 0)
                                                        <button type="submit"
                                                            class="btn-accion-tabla tooltipsC mostrar_dependencias text-info"
                                                            onClick="mostrarModal('{{ route('areas.getDependencias', ['id' => $area->id]) }}')"
                                                            title="Mostrar Dependencias" data_id ="{{ $area->id }}"
                                                            data_url = "{{ route('areas.getDependencias', ['id' => $area->id]) }}">
                                                            {{ $area->areas->count() }}
                                                        </button>
                                                    @else
                                                        <h6 class="text-danger">---</h6>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-evenly align-items-center">
                                                    <a href="{{ route('constructora.areas.edit', ['constructora_id' => $constructora_edit->id, 'id' => $area->id]) }}"
                                                        class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                        <i class="fas fa-pen-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($constructora_edit->areas->count() > 0)
                        <div class="tab-pane fade" id="cargos-tab-pane" role="tabpanel" aria-labelledby="cargos-tab" tabindex="0">
                            <div class="row mt-4 mb-4">
                                <div class="col-12 col-md-6 mb-4 mb-md-0">
                                    <h4 class="card-title">Listado de Cargos</h4>
                                </div>
                                <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                                    <a href="{{ route('constructora.cargos.create', ['id' => $constructora_edit->id]) }}"
                                        class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
                                        style="font-size: 0.85em;">
                                        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                        Nuevo registro
                                    </a>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12 col-md-7 table-responsive">
                                    <table
                                        class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table_inicial_opt w-100" id="tablaAreas">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Area</th>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Cargo</th>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_areas">
                                            @foreach ($constructora_edit->areas as $area)
                                                @foreach ($area->cargos as $cargo)
                                                    <tr>
                                                        <td style="white-space:nowrap;">{{ $area->area }}</td>
                                                        <td class="text-center">{{ $cargo->id }}</td>
                                                        <td class="text-center">{{ $cargo->cargo }}</td>
                                                        <td class="d-flex justify-content-evenly align-items-center">
                                                            <a href="{{ route('constructora.cargos.edit', ['constructora_id' => $constructora_edit->id, 'id' => $cargo->id]) }}"
                                                                class="btn-accion-tabla tooltipsC"
                                                                title="Editar este registro">
                                                                <i class="fas fa-pen-square"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($empleadosNumber > 0)
                        <div class="tab-pane fade" id="empleados-tab-pane" role="tabpanel" aria-labelledby="empleados-tab" tabindex="0">
                            <div class="row mt-4 mb-4">
                                <div class="col-12 col-md-6 mb-4 mb-md-0">
                                    <h4 class="card-title">Listado de Empleados</h4>
                                </div>
                                <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                                    <a href="{{ route('constructora.empleados.create', ['id' => $constructora_edit->id]) }}"
                                        class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end"
                                        style="font-size: 0.85em;">
                                        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                        Nuevo registro
                                    </a>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12 table-responsive">
                                    <table
                                        class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table_inicial_opt w-100" id="tablaAreas">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Area</th>
                                                <th class="text-center">Cargo</th>
                                                <th class="text-center">Identificación</th>
                                                <th class="text-center">Nombres y Apellidos</th>
                                                <th class="text-center">Correo Electrónico</th>
                                                <th class="text-center">Teléfono</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_areas">
                                            @foreach ($constructora_edit->areas as $area)
                                                @foreach ($area->cargos as $cargo)
                                                    @foreach ($cargo->empleados as $empleado)
                                                        <tr>
                                                            <td style="white-space:nowrap;">{{ $empleado->id }}</td>
                                                            <td class="text-center">{{ $area->area }}</td>
                                                            <td class="text-center">{{ $cargo->cargo }}</td>
                                                            <td class="text-center">{{ $empleado->tipo_docu->abreb_id . ' - ' . $empleado->identificacion}}</td>
                                                            <td class="text-center">{{ $empleado->nombres . ' ' . $empleado->apellidos }}</td>
                                                            <td class="text-center">{{ $empleado->usuario->email }}</td>
                                                            <td class="text-center">{{ $empleado->telefono }}</td>
                                                            <td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-{{$empleado->estado==1?'success':'gray'}} rounded">{{$empleado->estado==1?'Activo':'Inactivo'}}</span></td>
                                                            <td class="d-flex justify-content-evenly align-items-center">
                                                                <a href="{{ route('constructora.empleados.edit', ['constructora_id' => $constructora_edit->id, 'id' => $empleado->id]) }}"
                                                                    class="btn-accion-tabla tooltipsC"
                                                                    title="Editar este registro">
                                                                    <i class="fas fa-pen-square"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@section('footer_card')
@endsection

@section('modales')
    <!-- Modal tareas  componentes y proytectos -->
@endsection

@section('scripts_pagina')
    @include('intranet.layout.data_table')
    <script src="{{ asset('js/intranet/constructoras/constructora/editar.js') }}"></script>
@endsection
