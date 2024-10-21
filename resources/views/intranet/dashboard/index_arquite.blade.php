<div class="row">
    <div class="col-12 mb-5" id="cintaPublicidad" data_url="{{ route('getPublicidadCinta') }}" data_imagenes="{{ asset('imagenes/patrocinios') }}"></div>
</div>
<div class="row mt-3 mb-4">
    <div class="col-12 col-md-2 mb-4 mb-md-0 d-grid gap-2 d-md-block">
        <a href="{{ route('inmuebles.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5"
            style="font-size: 0.85em;">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Registro de Inmuebles
        </a>
    </div>
    <div class="col-12 col-md-2 mb-4 mb-md-0 d-grid gap-2 d-md-block">
        <a href="{{ route('arquitecto.preferencias',['id' => session('id_usuario')]) }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5"
            style="font-size: 0.85em;">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Preferencias Inmubles
        </a>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-8">
        <div class="row">
            <input type="hidden" id="getInmueblesArq" data_url="{{route('arquitecto.getInmueblesArq')}}" data_imagenes_inmu="{{asset('imagenes/inmuebles/')}}" data_url_inm ="{{ route('inmuebles.getInmuebles', ['id' => 1]) }}">
            <input type="hidden" id="modalArquitecto" data_url="{{ route('inmuebles.getInmuebles', 1) }}" data_imagenes="{{ asset('imagenes/inmuebles') }}">
            <div class="clo-12" id="inmueblesArquitecto">

            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 publicidad" id="publicidadLateral" data_url="{{ route('getPublicidadLateral') }}" data_imagenes="{{ asset('imagenes/patrocinios') }}">

    </div>
</div>
<hr>

@section('modales')
    <!-- Modal Inmuebles -->
    <div class="modal fade" id="modalInmuebles" tabindex="-1" role="dialog" aria-labelledby="modalInmueblesLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInmueblesLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="carouselModal" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="multimediModal">

                                </div>
                                <a class="carousel-control-prev" href="#carouselModal" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselModal" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <p style="line-height:0pt">Precio de Venta</p>
                            <p style="line-height:0pt" id="precioModal"><strong></strong></p>
                            <p class="mt-4" style="line-height:0pt">Área del inmueble</p>
                            <p style="line-height:0pt"><strong id="areaModal"></strong></p>
                            <p class="card-text" style="text-align: justify" id="descripcionModal"></p>
                            <p>Visto: <strong id="vistoModal"> veces</strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts_pagina')
    <script src="{{asset('js/intranet/dashboard/indexArquitecto.js')}}"></script>
@endsection
