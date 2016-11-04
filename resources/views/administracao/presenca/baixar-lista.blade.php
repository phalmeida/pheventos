<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2">
            Título do Evento:<br>
            <b>{{$lista_usuario->titulo}}</b>
        </td>
    </tr>
    <tr>
        <td>
            Instrutor:<br>
            <b>{{ $lista_usuario->palestrante->nome }}</b>
        </td>
        <td>
            Data de Realização:<br>
            <b>{{$lista_usuario->dt_inicio->format('d/m/Y')}}</b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">
            PARTICIPANTES
        </td>
    </tr>
    <tr>
        <td><b>Nome</b></td>
        <td><b>Assinatura</b></td>
    </tr>
    @foreach($lista_usuario->usuarios as $usuario)
        <tr>
            <td>{{$usuario->name}}</td>
            <td></td>
        </tr>
    @endforeach


</table>