<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Administracao\Evento;
use App\User;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    protected $evento;
    protected $usuario;

    /**
     * InscricaoController constructor.
     * Realiza a injeção de dependência
     *
     * @param Evento $evento
     * @param User $usuario
     *
     */
    public function __construct(Evento $evento, User $usuario)
    {
        $this->evento = $evento;
        $this->usuario = $usuario;

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


}
