<?php

namespace App\Http\Controllers\Administracao;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Evento;
use App\Models\Administracao\Palestrante;
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
    protected $palestrante;

    public function __construct(Evento $evento, Request $request, Palestrante $palestrante)
    {
        $this->model = $evento;
        $this->request = $request;
        $this->palestrante = $palestrante;
    }

     /**
     * Lista dos intens
     * 
     * @return typeos 
     */
    public function index()
    {
        //Recupera todos os dados.
        $data = $this->model->paginate($this->totalPorPagina);
        return view("{$this->nameView}.index", compact('data'));
    }   
    /**
     * Exibe o formulário de cadastro
     * 
     * @return type
     */
    public function formCadastro() 
    {
        $palestrantes = $this->palestrante->get();
        
        return view("{$this->nameView}.form-cad-edit" , compact('palestrantes'));
    }
    
    /** 
     * Exibe o formulário de cadastro
     * 
     * @return type
     */
    public function formEditar($id) 
    {
        $palestrantes = $this->palestrante->get();
        
        //Recupera o estilo pelo ID
        $data = $this->model->find($id);
        return view("{$this->nameView}.form-cad-edit", compact('data') , compact('palestrantes'));
    }    

    
}
