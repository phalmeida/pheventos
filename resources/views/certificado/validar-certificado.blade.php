@extends('layouts.principal')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Validador de Certificados Emitidos.</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/certificado/validar') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('codigo_verificacao') ? ' has-error' : '' }}">
                                <label for="codigo_verificacao" class="col-md-4 control-label"> Código do
                                    Certificado</label>

                                <div class="col-md-6">
                                    <input id="codigo_verificacao" type="codigo_verificacao" class="form-control"
                                           name="codigo_verificacao"
                                           value="{{old('codigo_verificacao')}}@if(isset($codigo_verificacao)){{$codigo_verificacao}}@endif">
                                    @if ($errors->has('codigo_verificacao'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('codigo_verificacao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Consultar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        @if(isset($dadosCertificado))
                            @forelse($dadosCertificado as $certificado)
                                <div class="col-xs-12">
                                    <p class="lead text-center">Certificado válido!</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">Nome do Participante:</th>
                                                <td>{{$certificado->usuario->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nome do evento:</th>
                                                <td>{{$certificado->evento->titulo}}</td>
                                            </tr>
                                            <tr>
                                                <th>Data da geração do certificado:</th>
                                                <td>{{$certificado->dt_geracao->format('d/m/Y H:i:s')}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="col-xs-12">
                                    <p class="lead text-center">Certificado não encontrado!</p>
                                    <p class="text-center">O sistema não reconheceu o código do certificado
                                        informado.<br>

                                        Verifique cuidadosamente o código, diferenciando letras maiúsculas e minúsculas.
                                    </p>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
