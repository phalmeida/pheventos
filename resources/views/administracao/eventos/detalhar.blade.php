@extends('layouts.principal')

@section('content')
    <div class="standard-box">
        <h2 class="standard-header">
        </h2>
            <div class="standard-article-item news">
                <div class="row">
                    <div class="col-sm-12 text-center">
                            <img class="img-responsive " src='{{ url("uploads/imagens/eventos/{$evento->imagem}")}}' alt="{{ $evento->titulo }}">
                    <span class="rating">
                        <span class="star positive">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="star positive">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="star positive">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="star positive">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="star negative">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                    </span>
                        </a>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="standard-article-header"><a href="">{{ $evento->titulo }}</a></h3>
                        <div class="list-toolbar">
                            <a href=""><i class="fa fa-comments"></i> 1 comentário </a>
                            <i class="fa fa-tags"></i> <a href="#">TI</a>, <a href="#">php</a>, <a href="#">tecnologia</a>, <a href="#">rede </a>
                        </div>
                        <p>{!! $evento->descricao !!} </p>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="standard-article-header">Palestrante/instrutor: {{ $evento->palestrante->nome }}</h3>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="standard-article-header">Data/horário de início: {{ $evento->dt_inicio->format('d/m/Y H:m') }} </h3>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="standard-article-header">Número de vagas restantes: {{ ($evento->numero_vagas - $evento->usuarios()->count()) }} </h3>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="standard-article-header">
                            @if($evento->valor_entrada == '0.00')
                                Evento Gratuito
                            @else
                                Evento Pago
                            @endif
                        </h3>
                    </div>
                    <div class="col-sm-12">
                        <a class="btn standard-hover-effect bg-blue" href="{{url("usuario/evento/$evento->id")}}">
                            <span class="text">Inscrição</span>
                        </a>
                        <a class="btn standard-hover-effect bg-red" href="{{url("/")}}">
                            <span class="text">Voltar</span>
                        </a>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                </div>
            </div>
    </div>
@endsection
