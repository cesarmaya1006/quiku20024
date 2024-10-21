@extends('extranet.plantilla.plantilla')
<!-- ************************************************************* -->
@section('css_pagina')
    <link rel="stylesheet" href="{{ asset('css/extranet/login/login_2.css') }}">
@endsection
@section('cuerpo_pagina')
    <div class="row mt-5">
        <div class="col-11 col-md-6">
            @include('includes.error-form')
            @include('includes.mensaje')
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="box">
                <img src="{{ asset('imagenes/sistema/logo.png') }}" alt="M $ M" width="300" />
                <h3 class="mt-3 mb-4">Bienvenidos</h3>
                <h3 style="font-size: 1.2em;">Sistema Base de Proyectos</h3>
                <br>
                <form action="{{ route('login') }}" method="post" autocomplete="off">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm email" id="email" name="email" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-sm password" id="password" name="password"placeholder="Password">
                    </div>
                    <button class="btn btn-warning btn-sombra mt-3" style="min-width: 50%">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script_pagina')
<script src="{{ asset('js/extranet/login/login_2.js') }}"></script>
@endsection
