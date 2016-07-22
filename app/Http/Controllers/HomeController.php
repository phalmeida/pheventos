<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Administracao\Evento;

class HomeController extends Controller
{

    protected $evento;

    /**
     * Create a new controller instance.
     * Realização do injeção de dependência
     *
     * @return void
     */
    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //Lista de todos os eventos
        $eventos = $this->evento->get();
        
        return view('home', compact('eventos'));
    }

    public function template()
    {
        return view('template');
    }

}
