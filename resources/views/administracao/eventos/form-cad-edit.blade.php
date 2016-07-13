@extends('layouts.administrador')

@section('content')

<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Cadastrar Evento</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                @if(isset($data))
                <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/administracao/evento/editar/{{$data->id}}">
                    @else
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/administracao/evento/cadastrar">
                        @endif
                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Título <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="titulo" name="titulo" placeholder="Insira o Título do evento" class="form-control" value="{{$data->titulo or old('titulo')}}">
                                @if ($errors->has('titulo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="descricao" name="descricao" placeholder="Insira a Descrição do evento" class="form-control" value="{{$data->descricao or old('descricao')}}">
                                @if ($errors->has('descricao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('descricao') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link_video') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link_video">Link do vídeo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="link_video" name="link_video" placeholder="URL do vídeo" class="form-control" value="{{$data->link_video or old('link_video')}}">
                                @if ($errors->has('link_video'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('link_video') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_palestrante') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_palestrante">Palestrante <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="id_palestrante" name="id_palestrante" class="form-control">
                                    <option value=""> Escolha o Palestrante</option>
                                    @foreach($palestrantes as $palestrante)
                                    <option value="{{$palestrante->id}}"
                                            @if(isset($data->id_palestrante) && $data->id_palestrante == $palestrante->id)
                                            selected
                                            @endif
                                            > {{$palestrante->nome}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_palestrante'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_palestrante') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dt_inicio') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dt_inicio">Data de início <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dt_inicio" name="dt_inicio" placeholder="Insira a Data de início" class="form-control" value="{{$data->dt_inicio or old('dt_inicio')}}">
                                @if ($errors->has('dt_inicio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dt_inicio') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dt_fim') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dt_fim">Data de finalização <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dt_fim" name="dt_fim" placeholder="Insira a Data de finalização" class="form-control" value="{{$data->dt_fim or old('dt_fim')}}">
                                @if ($errors->has('dt_fim'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dt_fim') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>

                        {{csrf_field()}} <!-- Campo CSRF contra XSS -->

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                <button type="submit" class="btn btn-success">
                                    @if(isset($data))
                                    Atualizar
                                    @else
                                    Cadastrar
                                    @endif    
                                </button>
                                <a href="{{url('administracao/eventos/')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
