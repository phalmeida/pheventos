<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Evento;
use App\User;
use Illuminate\Http\Request;


class PresencaController extends StandardController
{
    protected $evento;
    protected $request;
    protected $user;


    public function __construct(Evento $evento, User $user, Request $request)
    {
        $this->evento = $evento;
        $this->request = $request;
        $this->user = $user;
    }

    public function index()
    {

        $eventos = $this->evento->paginate(10);

        return view('administracao.presenca.index', compact('eventos'));

    }

    public function listaUsuarios($id_evento)
    {


        $lista_usuario = $this->evento->find($id_evento);

        return view('administracao.presenca.lista', compact('lista_usuario'));


    }

    public function salvarPresenca()
    {

        $dadosForm = $this->request->all();

        foreach ($dadosForm['presentes']  as $chave => $valor){

        echo $chave . ' - ' . $valor.  '<br>';

    }

        $values = array_values($dadosForm);

        dd($values);

        // $affectedRows = User::where('votes', '>', 100)->update(array('status' => 2));

        return 'teste';

    }


}
