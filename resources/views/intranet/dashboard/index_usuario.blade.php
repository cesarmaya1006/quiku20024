<div class="row">
    <div class="col-12 mb-5" id="cintaPublicidad" data_url="{{ route('getPublicidadCinta') }}"
        data_imagenes="{{ asset('imagenes/patrocinios') }}">

    </div>
</div>
<div class="row mt-3 mb-4">
    <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block">
        <a href="{{ route('inmuebles.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5"
            style="font-size: 0.85em;">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Registro de Inmuebles
        </a>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-12">
                <h6><strong>Mis Inmuebles...</strong></h6>
            </div>
            @if ($usuario->inmuebles->count() > 0)
                <div class="col-12">
                    <div class="row">
                        @foreach ($usuario->inmuebles as $inmueble)
                            <div class="col-12 col-md-5 p-2">
                                <div class="card" style="width: 18rem;">
                                    @if ($inmueble->multimedia->count() > 0)
                                        <div class="card-img-top">
                                            <div id="carouselInmueble{{ $inmueble->id }}"
                                                class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @php
                                                        $contador = 0;
                                                    @endphp
                                                    @foreach ($inmueble->multimedia as $multimedia)
                                                        @php
                                                            $contador++;
                                                        @endphp
                                                        <div class="carousel-item {{ $contador == 1 ? 'active' : '' }}">
                                                            @if ($multimedia->tipo == 'imagen')
                                                                <img src="{{ asset('imagenes/inmuebles/' . $multimedia->url) }}"
                                                                    class="d-block w-100" alt="...">
                                                            @else
                                                                <video
                                                                    src="{{ asset('imagenes/inmuebles/' . $multimedia->url) }}"
                                                                    type="video/mp4"></video>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselInmueble{{ $inmueble->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselInmueble{{ $inmueble->id }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        @foreach ($inmueble->multimedia as $multimedia)
                                        @endforeach
                                    @else
                                        <img src="{{ asset('imagenes/inmuebles/sin_imagen.png') }}" class="card-img-top"
                                            alt="...">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">{{ $inmueble->tipo->tipo }} - {{ $inmueble->municipio->municipio . '(' . $inmueble->municipio->departamento->departamento . ')' }}</h5>
                                        <p style="line-height:0pt">Precio de Venta</p>
                                        <p style="line-height:0pt">
                                            <strong>${{ number_format($inmueble->precio, 0, ',', '.') }}</strong></p>
                                        <p class="mt-4" style="line-height:0pt">Área del inmueble</p>
                                        <p style="line-height:0pt">
                                            <strong>{{ number_format($inmueble->area, 0, ',', '.') }}
                                                {{ $inmueble->tipo_area == 'Metros Cuadrados' ? 'M²' : $inmueble->tipo_area }}</strong>
                                        </p>
                                        <p class="card-text" style="text-align: justify">
                                            {{ substr(ucfirst(strtolower($inmueble->descripcion)), 0, 100) }} ...</p>
                                        <p>Visto: <strong>{{ $inmueble->visto }} veces</strong></p>
                                        <button type="button" class="btn btn-primary btn-xs w-100 mb-3 mt-3 modalPredioBtn" data-toggle="modal" data-target="#modalInmuebles" data_url="{{ route('inmuebles.getInmuebles', ['id' => $inmueble->id]) }}" data_imagenes="{{ asset('imagenes/inmuebles') }}">Ver detalles</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12">
                    <h5><strong>Sin Inmuebles Registrados</strong></h5>
                </div>
            @endif
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
