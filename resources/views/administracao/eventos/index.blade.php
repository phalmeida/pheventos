@extends('layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Eventos</h3>
    </div>
    <div class="title_right">
        <div   class="col-md-8 col-sm-8 col-xs-12 form-group pull-right top_search">
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
                <a href="{{url('administracao/evento/cadastrar')}}" class="btn btn-dark"><span class="fa fa-plus"></span> Cadastrar </a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $palestrante)
                            <tr>
                                <td>{{$palestrante->nome}}</td>
                                <td>{{$palestrante->email}}</td>
                                <td>{{$palestrante->telefone}}</td>
                                <td>
                                    <a href="{{url("administracao/palestrante/editar/$palestrante->id")}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
                    {{ $data->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection