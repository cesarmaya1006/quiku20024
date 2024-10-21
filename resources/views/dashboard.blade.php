@extends('intranet.layout.app')
@section('css_pagina')
<link rel="stylesheet" href="{{asset('css/intranet/dashboard/usuario.css')}}">
@endsection
@section('titulo_pagina')
    Bienvenido {{session('rol_principal_id')==5? 'Arquitecto ': ''}} {{ session('nombres_completos') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
@endsection
@section('titulo_card')
@endsection
@section('botones_card')
@endsection
@section('cuerpo')
    @if (session('rol_principal_id')==1||session('rol_principal_id')==2)
        @include('intranet.dashboard.index_sistem')
    @endif
    @if (session('rol_principal_id')==1||session('rol_principal_id')==3)
        @include('intranet.dashboard.index_emplea')
    @endif
    @if (session('rol_principal_id')==1||session('rol_principal_id')==4)
        @include('intranet.dashboard.index_usuario')
    @endif
    @if (session('rol_principal_id')==1||session('rol_principal_id')==5)
        @include('intranet.dashboard.index_arquite')
    @endif
    @if (session('rol_principal_id')==1||session('rol_principal_id')==6)
        @include('intranet.dashboard.index_constr')
    @endif
@endsection
@section('footer_card')
@endsection
@section('modales')

@endsection
@section('scripts_pagina')
    <script src="{{asset('js/intranet/dashboard/index.js')}}"></script>
@endsection

