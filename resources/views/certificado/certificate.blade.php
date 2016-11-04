<style>
    h1 {
        font-family: times;
        font-size: 50pt;
        text-align: center;
    }

    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: helvetica;
        font-size: 16pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: green #FF00FF blue red;
        text-align: center;
    }

    .conteudo {
        font-family: helvetica;
        font-size: 16pt;
        text-align: center;

    }

    .conteudo-justify {

        text-align: justify;

    }

    .codigo {

        text-align: center;

    }

    .codigo-verificar {

        text-align: center;

    }

    .recuo {
        text-indent: 8em
    }

    .certificado {
        width: 772px;
        margin: 0 auto;
    }
</style>
<div class="certificado">
    <br>
    <h1 class="title">Certificado</h1>

    <p class="conteudo recuo">
        Certifico que <b>{{$nome}}</b>, participou da palestra “<b>{{ $evento->titulo }}</b>”
        realizada
        no dia {{$evento->dt_inicio->format('d')}} de {{strftime( '%B', strtotime( $evento->dt_inicio->format( 'Y-m-d' ) ) )}} de {{$evento->dt_inicio->format('Y')}}.
    </p>
    </br>
    </br>
    </br>
    <p>
    <div>
        Data da geração do certificado: {{$dt_geracao->format('d/m/Y H:i:s')}}
    </div>
    </br>
    <p>
        </br>
    <p>
        </br>
    <p>
        </br>

    <div class="codigo">
        Código do Certificado: <b>{{ $codigo_verificacao }}</b>
    </div>

    <div class="codigo-verificar">
        Confira a autenticidade deste certificado em {{url('certificado/validar')}}.
    </div>
    </br>
</div>