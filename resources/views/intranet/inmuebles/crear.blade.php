@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
    <i class="fas fa-home mr-3" aria-hidden="true"></i> Inmuebles
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">inscribir Inmuebles</li>
@endsection

@section('titulo_card')
    <i class="fa fa-plus-square mr-3" aria-hidden="true"></i> inscribir Inmueble
@endsection

@section('botones_card')
    <a href="{{ route('dashboard') }}" class="btn btn-success btn-xs mini_sombra pl-5 pr-5 float-md-end"
        style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-center" id="cuerpoPagina">
        <form class="col-12 form-horizontal" action="{{ route('inmuebles.store') }}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('post')
            @include('intranet.inmuebles.form')
            <div class="row mt-5">
                <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                    <button type="submit" class="btn btn-primary btn-sm mini_sombra pl-sm-5 pr-sm-5"
                        style="font-size: 0.8em;">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row d-none" id="cuerpoCargando">
        <div class="col-12 text-center">
            <img src="{{asset('imagenes/sistema/imagen_cargando1.gif')}}" style="max-height: 400px;width: auto" class="img-fluid" alt="...">
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
    <!-- ========================================================================================================= -->
    <!-- Scrollable modal -->
    <div class="modal fade" id="tipoInmuebleModal" tabindex="-1" aria-labelledby="tipoInmuebleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tipoInmuebleModalLabel">Nuevo tipo de inmueble</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipo" class="requerido">Tipo de Inmueble</label>
                        <input type="text" class="form-control form-control-sm" name="tipo" id="tipo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="idFormNewTipo" class="btn btn-primary btn-sm" data_url="{{ route('tipo_inmuebles.store') }}">Guardar Y Seleccionar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================================================================================= -->
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/inmuebles/crear.js') }}"></script>
@endsection
