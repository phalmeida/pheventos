<?php

namespace App\Http\Controllers\Usuario;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Administracao\Evento;
use App\Models\Administracao\Anexo;
use App\User;
use Illuminate\Support\Facades\Auth;
use TCPDF as PDF;

class InscricaoController extends Controller
{
    protected $evento;
    protected $usuario;
    protected $anexo;
    protected $pdf;

    /**
     * InscricaoController constructor.
     * Realiza a injeção de dependência
     *
     * @param Evento $evento
     * @param User $usuario
     *
     */
    public function __construct(Evento $evento, User $usuario, Anexo $anexo, PDF $pdf)
    {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->anexo = $anexo;
        $this->pdf = $pdf;

    }

    /**
     * Recebe as requisições referentes as inscrições
     *
     * @param $id_evento
     * @return string
     */
    public function inscricao($id_evento)
    {

        //Evento selecionado
        $evento = $this->evento->find($id_evento);

        $dados = $evento->usuarios()->where('id_user', Auth::user()->id)->get();

        if (count($dados) >= 1) {

            return redirect('usuario/eventos')->with('status', 'Usuário já está cadastrado para esse evento!');

        }

        //Vincula o usuário ao evento selecionado
        $evento->usuarios()->sync([Auth::user()->id], false);

        return redirect('usuario/eventos')->with('status', 'Inserido com sucesso!');

    }

    /**
     * Realiza o cancelamento da inscrição
     *
     * @param $id_evento
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cancelarInscricao($id_evento)
    {

        $evento = $this->evento->find($id_evento);

        $evento->usuarios()->detach(Auth::user()->id);


        return redirect('usuario/eventos')->with('status', 'Inscrição concelada com sucesso!');

    }

    /**
     * Lista dos eventos inscritos
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function eventos()
    {

        //Pesquisa pelo usuário
        $usuario = $this->usuario->find(Auth::user()->id);

        //Captura os eventos do usuário
        $eventos = $usuario->eventos()->get();

        return view('usuario.index', compact('eventos'));

    }


    /**
     * Detalhar evento
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detalharEvento($id_evento)
    {

        $evento = $this->evento->find($id_evento);

        return view('administracao.eventos.detalhar', compact('evento'));

    }

    /**
     * Detalhar evento
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listarCertificados()
    {

        //Pesquisa pelo usuário
        $usuario = $this->usuario->find(Auth::user()->id);

        //Captura os eventos do usuário
        $eventos = $usuario->eventos()->get();

        return view('usuario.certificados', compact('eventos'));

    }

    /**
     * Materiais do evento
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function materiaisEvento($id_evento)
    {

        $evento = $this->evento->find($id_evento);

        $arquivos = $this->anexo->where('id_evento', $id_evento)->get();

        return view('usuario.materiais', compact('evento', 'arquivos'));

    }

    public function baixarMaterial($id)
    {

        $anexo = $this->anexo->find($id);

        //Caminho da pasta onde as imagens irão ficar
        $path_arquivo = public_path('uploads/materiais/');

        $link = $path_arquivo . $anexo->link;

        return response()->download($link, str_slug($anexo->titulo, "_") . "_" . $anexo->link);

    }

    public function baixarCertificado($id_evento, $id_usuario)
    {

        $html = view('certificado.certificate')->render();

        $pdf = new PDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Philipe Allan Almeida');
        $pdf->SetTitle('Certificado');

        // disable auto-page-break
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set margins
        $pdf->SetMargins(25, 0, 25);
        $pdf->SetHeaderMargin(false);
        $pdf->SetFooterMargin(false);

        $pdf->AddPage();

        $img_file = public_path('certificado/fundo-certificado3.png');

        $pdf->Image($img_file, 0, 0, 298, 210, '', '', '', false, 300, '', false, false, 0);


// define some HTML content with style
        $html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	h1 {
		font-family: times;
		font-size: 50   pt;
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

	
	.codigo{

		text-align: center;
		
	}
	
	.codigo-verificar{

		text-align: center;
		
	}
	
	.recuo { text-indent:8em }

	.certificado { 
  width: 772px;
  margin: 0 auto;
}
</style>
<div class="certificado">
<br>
<h1 class="title">Certificado</h1>

<p class="conteudo recuo">
Certifico que <b> Nome Completo do Participante</b>, participou da palestra “<b>Nome Da Palestra</b>” realizada no dia  DD  de MM de AAAA.
</p>
</br>
</br>
</br>
<p>
<div>
Data da geração do certificado:  dd/mm/yyyy hh:mm:ss
</div>
</br>
<p>
</br>
<p>
</br>
<p>
</br>

 <div class="codigo">
Código do Certificado: <b>GSDF5SD1452DF</b>
 </div>

 <div class="codigo-verificar">
Confira a autenticidade deste certificado em /certificado/validar.
 </div>
</br>
</div>
EOF;

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->Output('certificado.pdf', 'D');


    }

}
