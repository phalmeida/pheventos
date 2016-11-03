@extends('layouts.principal')

@section('content')

    <h1>Meus certificados!</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
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
                                        <th class="text-center" >Data do evento</th>
                                        <th>Título</th>
                                        <th>Palestrante</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($eventos as $evento)
                                        <tr>
                                            <td class="text-center" >{{$evento->dt_inicio->format('d/m/Y')}}</td>
                                            <td>{{$evento->titulo}}</td>
                                            <td>{{$evento->palestrante->nome}}</td>
                                            <td class="text-center">
                                                <a href="{{url("usuario/certificado/baixar/$evento->id/".Auth::user()->id)}}"
                                                   class="btn btn-primary btn-xs"><i class="fa fa-download"></i>
                                                    Baixar Certificado
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
                    </div>
                </div>
            </div>

@endsection
