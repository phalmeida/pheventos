@extends('layouts.administrador')

@section('content')

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>

                        Anexar Materiais
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>

                    <form data-parsley-validate enctype="multipart/form-data" class="form-horizontal form-label-left"
                          method="POST" action="/administracao/evento/anexo/inserir">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Nome do Evento
                                <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled type="text" id="titulo" name="titulo" class="form-control"
                                       value="{{$evento->titulo}}">
                                <input type="hidden" name="id_evento" class="form-control" value="{{$evento->id}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Título do
                                material <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="titulo" name="titulo"
                                       class="form-control" value="{{$data->titulo or old('titulo')}}">
                                @if ($errors->has('titulo'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="descricao_material" name="descricao"
                                          placeholder="Insira a Descrição do evento"
                                          class="form-control"> {{$data->descricao or old('descricao')}} </textarea>
                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('descricao') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('arquivo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="arquivo">Anexar arquivos
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="arquivo" multiple="multiple" id="arquivo"
                                       class="form-control"/>
                                @if ($errors->has('arquivo'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('arquivo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    {{csrf_field()}} <!-- Campo CSRF contra XSS -->

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                <button type="submit" class="btn btn-success">
                                    Cadastrar
                                </button>
                                <a href="{{url('administracao/eventos/')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </form>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>link</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($arquivos as $arquivo)
                                    <tr>
                                        <td class="text-left">{{$arquivo->titulo}}</td>
                                        <td class="text-left">{{$arquivo->link}}</td>
                                        <td>
                                            <a href="{{url("administracao/evento/anexar/del/$arquivo->id")}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                Excluir </a>
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

                </div>
            </div>
        </div>
    </div>
@endsection
