
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
                        <span class="day"><span>14</span></span>
                        <span class="month">mar</span>
                        <span class="year">2015</span>
                    </span>
                    <span class="standard-author"><i class="fa fa-user"></i> <strong>{{ $evento->palestrante->nome }}</strong></span>
                    <img class="img-responsive" src="images/concert-5-blog.jpg" alt="photo by Martin Fisch">
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
                        <span class="star negative">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="star negative">
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                    </span>
                </a>
            </div>
            <div class="col-sm-8">
                <h3 class="standard-article-header"><a href="">{{ $evento->titulo }}</a></h3>
                <div class="list-toolbar">
                    <a href=""><i class="fa fa-comments"></i> 1 comment </a>
                    <i class="fa fa-tags"></i> <a href="#">rock</a>, <a href="#">progressive</a>, <a href="#">concert</a>, <a href="#">stage</a>, <a href="#">live</a>, <a href="#">heavy metal</a>, <a href="#">stage</a>
                </div>
                <p>{{ $evento->descricao }}</p>
                <a class="btn standard-hover-effect bg-red" href="">
                    <span class="text">More</span>
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

    <div class="text-center">
        <ul class="pagination">
            <li class="disabled"><a href="#"><small>«</small> First</a></li>
            <li class="disabled"><a href="#"><small>«</small> Previous</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">Next <small>»</small></a></li>
            <li><a href="#">Last <small>»</small></a></li>
        </ul>
    </div>
</div>
@endsection
