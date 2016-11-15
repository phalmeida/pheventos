
@extends('layouts.principal')

@section('content')

<div class="standard-box">
    <h2 class="standard-header">
        <span class="text">Eventos Disponíveis</span>
    </h2>
    @forelse($eventos as $evento)
    <div class="standard-article-item news">
        <div class="row">
            <div class="col-sm-4">
                <a class="standard-article-image" href="">
                    <span class="standard-article-date date-full">
                        <span class="day"><span>{{$evento->dt_inicio->format('d')}}</span></span>
                        <span class="month">{{$evento->dt_inicio->format('M')}}</span>
                        <span class="year">{{$evento->dt_inicio->format('Y')}}</span>
                    </span>
                    <span class="standard-author"><i class="fa fa-user"></i> <strong>{{ $evento->palestrante->nome }}</strong></span>
                    <img class="img-responsive" src='{{ url("uploads/imagens/eventos/{$evento->imagem}")}}' alt="{{ $evento->titulo }}">
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
                        <span class="star positive">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                    </span>
                </a>
            </div>
            <div class="col-sm-8">
                <h3 class="standard-article-header"><a href="">{{ $evento->titulo }}</a></h3>
                <div class="list-toolbar">
                    <a href=""><i class="fa fa-comments"></i> 1 comentário </a>
                    <i class="fa fa-tags"></i> <a href="#">TI</a>, <a href="#">php</a>, <a href="#">tecnologia</a>, <a href="#">rede </a>
                </div>
                <p>{!! $evento->descricao !!} </p>
                <p>Número de vagas restantes: {{ ($evento->numero_vagas - $evento->usuarios()->count()) }}</p>
                @if(($evento->numero_vagas - $evento->usuarios()->count()) != '0')
                    <a class="btn standard-hover-effect bg-blue" href="{{url("usuario/evento/$evento->id")}}">
                        <span class="text">Inscrição</span>
                    </a>
                @else
                    <a class="btn standard-hover-effect bg-red" >
                        <span class="text">Vagas esgotadas</span>
                    </a>
                @endif

                <a class="btn standard-hover-effect bg-green" href="{{url("usuario/evento/detalhar/$evento->id")}}">
                    <span class="text">Mais detalhes</span>
                </a>
            </div>
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
    </div>
    @empty
    
    Nenhum evento cadastrado!!
    
    @endforelse

</div>
@endsection
