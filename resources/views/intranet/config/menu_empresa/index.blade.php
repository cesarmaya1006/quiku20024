@extends('intranet.layout.app')

@section('php_funciones')
    @php
        function sub_menu($Array_1, $x,$empresas){
            foreach ($Array_1 as $sub_menu_array) {
                echo('<tr>');
                echo('<td style="padding-left: '.$x.'px;"><i class="fa fa-arrow-right" aria-hidden="true"></i> '.$sub_menu_array['nombre'].'</td>');
                foreach ($empresas as $empresa) {
                    echo('
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    No
                                </label>
                            </div>
                        </td>
                    ');
                }
                echo('</tr>');
                if (count($sub_menu_array['submenu']) > 0) {
                    sub_menu($sub_menu_array['submenu'], ($x+20),$empresas);
                }
            }
        };
    @endphp
@endsection

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-grip-horizontal mr-3" aria-hidden="true"></i> Configuración Menus/Empresas
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Menus - Empresas</li>
@endsection

@section('titulo_card')
    Administración de permisos Menu - Roles
@endsection

@section('botones_card')

@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 table-responsive">
            <input type="hidden" id="id_permisos_menus_empresas_store" data_url="{{route('permisos_menus_empresas.store')}}">
            @csrf
            <table class="table table-striped table-hover" id="tabla-data">
                <thead>
                    <tr>
                        <th>Menú</th>
                        @foreach ($empresas as $id => $empresa)
                            <th class="text-center" style="width:1px;white-space:nowrap; max-width: 200px;">
                                {{ utf8_encode(ucwords(strtolower(utf8_decode($empresa)))) }}</th>
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
                        @foreach ($empresas as $id => $empresa)
                            <td class="text-center">
                                <input type="checkbox" class="menu_empresa" name="menu_empresa[]"
                                    data-menuid={{ $menu['id'] }} value="{{ $id }}"
                                    {{ in_array($id, array_column($menusEmpresas[$menu['id']], 'id')) ? 'checked' : '' }}>
                            </td>
                        @endforeach
                    </tr>
                    @foreach ($menu['submenu'] as $key => $hijo)
                        <tr>
                            <td class="pl-20  pl-4" style="width:1px;white-space:nowrap;"><i class="fa fa-arrow-right"></i>
                                {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo['nombre'])))) }}   -  {{$hijo['id']}}</td>
                            @foreach ($empresas as $id => $empresa)
                                <td class="text-center">
                                    <input type="checkbox" class="menu_empresa" name="menu_empresa[]"
                                        data-menuid={{ $hijo['id'] }} value="{{ $id }}"
                                        {{ in_array($id, array_column($menusEmpresas[$hijo['id']], 'id')) ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                        @foreach ($hijo['submenu'] as $key => $hijo2)
                            <tr>
                                <td class="pl-30" style="width:1px;white-space:nowrap;"><i
                                        class="fa fa-arrow-right"></i>
                                    {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo2['nombre'])))) }}   -  {{$hijo2['id']}}</td>
                                @foreach ($empresas as $id => $empresa)
                                    <td class="text-center">
                                        <input type="checkbox" class="menu_empresa" name="menu_empresa[]"
                                            data-menuid={{ $hijo2['id'] }} value="{{ $id }}"
                                            {{ in_array($id, array_column($menusEmpresas[$hijo2['id']], 'id')) ? 'checked' : '' }}>
                                    </td>
                                @endforeach
                            </tr>
                            @foreach ($hijo2['submenu'] as $key => $hijo3)
                                <tr>
                                    <td class="pl-40" style="width:1px;white-space:nowrap;"><i
                                            class="fa fa-arrow-right"></i>
                                        {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo3['nombre'])))) }}   -  {{$hijo3['id']}}
                                    </td>
                                    @foreach ($empresas as $id => $empresa)
                                        <td class="text-center">
                                            <input type="checkbox" class="menu_empresa" name="menu_empresa[]"
                                                data-menuid={{ $hijo3['id'] }} value="{{ $id }}"
                                                {{ in_array($id, array_column($menusEmpresas[$hijo3['id']], 'id')) ? 'checked' : '' }}>
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
    <script src="{{ asset('js/intranet/configuracion/menu_empresa/index.js') }}"></script>
    @include('intranet.layout.script_datatable')
@endsection
