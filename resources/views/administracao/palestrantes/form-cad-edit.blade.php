@extends('layouts.administrador')

@section('content')

<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    @if(isset($data))
                        Editar
                    @else
                        Cadastrar
                    @endif
                    Palestrante
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                @if(isset($data))
                <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/administracao/palestrante/editar/{{$data->id}}">
                    @else
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/administracao/palestrante/cadastrar">
                        @endif
                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nome" name="nome" placeholder="Insira o Nome do palestrante" class="form-control" value="{{$data->nome or old('nome')}}">
                                @if ($errors->has('nome'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="email" name="email" placeholder="Insira o E-mail do palestrante" class="form-control" value="{{$data->email or old('email')}}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefone">Telefone <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telefone" name="telefone"  class="form-control" value="{{$data->telefone or old('telefone')}}">
                                @if ($errors->has('telefone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefone') }}</strong>
                                </span>
                                @endif                           
                            </div>
                        </div>                            
                        {{csrf_field()}}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                <button type="submit" class="btn btn-success">
                                    @if(isset($data))
                                        Editar
                                    @else
                                        Cadastrar
                                    @endif    
                                </button>
                                <a href="{{url('administracao/palestrantes/')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        /**
         * Máscaras dos campos em Jquery 
         */
        if ($('#telefone').val().length === 11) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $('#telefone').mask('(00) 00000-0009');
        } else {
            $('#telefone').mask('(00) 0000-00009');
        }

        $('#telefone').keyup(function (event) {
            if ($(this).val().length === 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#telefone').mask('(00) 00000-0009');
            } else {
                $('#telefone').mask('(00) 0000-00009');
            }
        });
        //Fim - Máscaras
    });
</script>  
@endsection
