<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Evento;
use App\User;
use App\Models\Administracao\Presenca;
use Illuminate\Http\Request;
use TCPDF as PDF;


class PresencaController extends StandardController
{
    protected $evento;
    protected $request;
    protected $user;
    protected $presenca;

    /**
     * PresencaController constructor.
     * @param Evento $evento
     * @param User $user
     * @param Request $request
     * @param Presenca $presenca
     */
    public function __construct(Evento $evento, User $user, Request $request, Presenca $presenca)
    {
        $this->evento = $evento;
        $this->request = $request;
        $this->user = $user;
        $this->presenca = $presenca;
    }

    /**
     * Página principal para realizar presença
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $eventos = $this->evento->paginate(10);

        return view('administracao.presenca.index', compact('eventos'));

    }

    /**
     * Retorna a lista de usuários para realização da presença
     *
     * @param $id_evento
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listaUsuarios($id_evento)
    {


        $lista_usuario = $this->evento->find($id_evento);

        return view('administracao.presenca.lista', compact('lista_usuario'));


    }

    public function baixarListaUsuarios($id_evento)
    {


        $pdf = new PDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Philipe Allan Almeida');
        $pdf->SetTitle('Certificado');
// set default header data
        $pdf->SetHeaderData(false, '', 'PHeventos', "Philipe - TCC PUC MINAS\nwww.philipealmeida.com.br");
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->AddPage();

        $lista_usuario = $this->evento->find($id_evento);
        $html = view('administracao.presenca.baixar-lista', compact('lista_usuario'))->render();

        $titulo = str_slug($lista_usuario->titulo, '_');

        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->Output('lista_'.$titulo.'.pdf', 'D');


    }

    /**
     * Responsável por salvar as presença
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salvarPresenca()
    {
        //Dados do fomulário -> lista de presença
        $dados_form = $this->request->all();

        $id_evento = $dados_form['id_evento'];

        $this->presenca
            ->where('id_evento', '=', $id_evento)
            ->update(['presenca' => 0]);

        if (isset($dados_form['presentes'])) {

            //Realiza a atualização dos presentes
            $this->presenca
                ->where('id_evento', '=', $id_evento)
                ->whereIn('id_user', $dados_form['presentes'])
                ->update(['presenca' => 1]);
        }

        //Retorna a mensagem para o modal
        flash()->overlay('<h4 class="text-center">Lista salva com sucesso!</h4>', '' ,'success');

        return redirect("administracao/presenca/lista/{$id_evento}");

    }


}
