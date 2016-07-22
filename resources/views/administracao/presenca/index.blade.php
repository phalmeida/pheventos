@extends('layouts.administrador')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Lista de presença!</h3>
        </div>
        <div class="title_right">
            <div class="col-md-8 col-sm-8 col-xs-12 form-group pull-right top_search">
                <form method="POST" action="/administracao/evento/pesquisar">
                    <div class="input-group">
                        <input name="pesquisar" type="text" class="form-control" placeholder="Pesquisar Por...">
                        {{csrf_field()}}
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Pesquisar!</button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Palestrante</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($eventos as $evento)
                                <tr>
                                    <td>{{$evento->titulo}}</td>
                                    <td>{{$evento->palestrante->nome}}</td>
                                    <td>
                                        <a href="{{url("administracao/presenca/lista/$evento->id")}}"
                                           class="btn btn-primary btn-xs"><i class="fa fa-list-ol"></i> Lista de usuários </a>
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
                    <nav>
                        {{ $eventos->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection