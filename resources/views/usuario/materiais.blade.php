@extends('layouts.principal')

@section('content')

    <h1>Materiais disponíveis para Download</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="standard-article-item news">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="standard-article-header"><a href="">{{ $evento->titulo }}</a></h3>
                <div class="list-toolbar">
                    <a href=""><i class="fa fa-comments"></i> 1 comentário </a>
                    <i class="fa fa-tags"></i> <a href="#">TI</a>, <a href="#">php</a>, <a href="#">tecnologia</a>, <a
                            href="#">rede </a>
                </div>
                <p>{!! $evento->descricao !!} </p>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Título do arquivo</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($arquivos as $arquivo)
                            <tr>
                                <td class="text-left">{{$arquivo->titulo}}</td>
                                <td>
                                    <a href="{{url("usuario/evento/materiais/baixar/$arquivo->id")}}"
                                       class="btn btn-primary btn-xs"><i class="fa fa-download"></i>
                                        Baixar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Nenhum registro!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
    </div>

@endsection
