@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Seja bem vindo admin</div>

                <div class="panel-body">
                    Página inicial!!!
                    {{auth()->guard('admin')->user()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection