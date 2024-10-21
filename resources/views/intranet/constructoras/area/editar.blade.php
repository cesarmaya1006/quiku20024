@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('titulo_pagina')
<i class="fas fa-project-diagram mr-3" aria-hidden="true"></i> Configuración Áreas Constructora - {{$constructora->constructora}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
<li class="breadcrumb-item"><a href="{{ route('constructoras.index') }}">Constructoras</a></li>
<li class="breadcrumb-item"><a href="{{ route('constructoras.edit',['id'=>$constructora->id]) }}">Constructoras - Editar</a></li>
<li class="breadcrumb-item active">Constructoras-Editar-Areas-Editar</li>
@endsection

@section('titulo_card')
    <i class="fa fa-edit mr-3" aria-hidden="true"></i> Editar Área
@endsection

@section('botones_card')
    <a href="{{route('constructoras.edit',['id'=>$constructora->id])}}" class="btn btn-success btn-sm mini_sombra pl-5 pr-5 float-md-end" style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection

@section('cuerpo')
<div class="row d-flex justify-content-center">
    <form class="col-12 form-horizontal" action="{{ route('constructora.areas.update',['constructora_id'=>$constructora->id,'id'=>$area_edit]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('intranet.constructoras.area.form')
        <div class="row mt-5">
            <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                <button type="submit" class="btn btn-primary btn-sm mini_sombra pl-sm-5 pr-sm-5" style="font-size: 0.8em;">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')

@endsection
