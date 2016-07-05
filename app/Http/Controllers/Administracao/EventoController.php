<?php

namespace App\Http\Controllers\Administracao;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Evento;
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;

class EventoController extends StandardController
{
    protected $model;
    protected $nameView = 'administracao.eventos';
    protected $redirectCad = '/administracao/evento/cadastrar';
    protected $redirectEdit = '/administracao/evento/editar';
    protected $route = '/administracao/eventos';
    protected $request;

    public function __construct(Evento $evento, Request $request)
    {
        $this->model = $evento;
        $this->request = $request;
    }
    
    
}
