@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fa fa-cogs mr-3" aria-hidden="true"></i> Configuración - Menu/Roles
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Menu/Roles</li>
@endsection

@section('titulo_card')
Administración de permisos Menu - Roles
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 table-responsive">
            @csrf
            <table class="table table-striped table-hover" id="tabla-data">
                <thead>
                    <tr>
                        <th>Menú</th>
                        @foreach ($rols as $id => $name)
                            <th class="text-center" style="width:1px;white-space:nowrap; max-width: 200px;">
                                {{ utf8_encode(ucwords(strtolower(utf8_decode($name)))) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $key => $menu)
                        @if ($menu['menu_id'] != 0)
                            @break
                        @endif
                    <tr>
                        <td class="font-weight-bold" style="width:1px;white-space:nowrap;">
                            <i class="fa fa-arrows-alt"></i>
                                {{ utf8_encode(ucfirst(strtolower(utf8_decode($menu['nombre'])))) }}  -  {{$menu['id']}}
                        </td>
                        @foreach ($rols as $id => $name)
                            <td class="text-center">
                                <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                    data-menuid={{ $menu['id'] }} value="{{ $id }}"
                                    {{ in_array($id, array_column($menusRols[$menu['id']], 'id')) ? 'checked' : '' }}>
                            </td>
                        @endforeach
                    </tr>
                    @foreach ($menu['submenu'] as $key => $hijo)
                        <tr>
                            <td class="pl-20  pl-4" style="width:1px;white-space:nowrap;"><i class="fa fa-arrow-right"></i>
                                {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo['nombre'])))) }}   -  {{$hijo['id']}}</td>
                            @foreach ($rols as $id => $name)
                                <td class="text-center">
                                    <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                        data-menuid={{ $hijo['id'] }} value="{{ $id }}"
                                        {{ in_array($id, array_column($menusRols[$hijo['id']], 'id')) ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                        @foreach ($hijo['submenu'] as $key => $hijo2)
                            <tr>
                                <td class="pl-30" style="width:1px;white-space:nowrap;"><i
                                        class="fa fa-arrow-right"></i>
                                    {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo2['nombre'])))) }}   -  {{$hijo2['id']}}</td>
                                @foreach ($rols as $id => $name)
                                    <td class="text-center">
                                        <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                            data-menuid={{ $hijo2['id'] }} value="{{ $id }}"
                                            {{ in_array($id, array_column($menusRols[$hijo2['id']], 'id')) ? 'checked' : '' }}>
                                    </td>
                                @endforeach
                            </tr>
                            @foreach ($hijo2['submenu'] as $key => $hijo3)
                                <tr>
                                    <td class="pl-40" style="width:1px;white-space:nowrap;"><i
                                            class="fa fa-arrow-right"></i>
                                        {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo3['nombre'])))) }}   -  {{$hijo3['id']}}
                                    </td>
                                    @foreach ($rols as $id => $name)
                                        <td class="text-center">
                                            <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                                data-menuid={{ $hijo3['id'] }} value="{{ $id }}"
                                                {{ in_array($id, array_column($menusRols[$hijo3['id']], 'id')) ? 'checked' : '' }}>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/configuracion/menu_rol/menu_rol.js') }}"></script>
    @include('intranet.layout.script_datatable')
@endsection
