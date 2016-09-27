@extends('layouts.administrador')

@section('content')

    @include('flash::message')

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
                <div class="x_title">Nome do evento: <b>{{$lista_usuario->titulo}}</b>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST"
                          action="/administracao/presenca/salvar">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($lista_usuario->usuarios as $usuario)
                                    <tr>
                                        <td>{{$usuario->name}}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="presentes[]"
                                                           value="{{$usuario->id}}"
                                                           @if($usuario->pivot->presenca)
                                                           checked="checked"
                                                            @endif
                                                    > Presente
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhum registro!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                    <input type="hidden" name="id_evento" value="{{$lista_usuario->id}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-success"> Salvar</button>
                                    <a href="{{url('administracao/presenca/')}}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection