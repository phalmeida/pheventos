<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [ 'titulo', 
                            'descricao', 
                            'link_video', 
                            'id_palestrante', 
                            'dt_inicio', 
                            'dt_fim'];
    public $roles = [
        'titulo' => 'required|min:3|max:100',
        'descricao' => 'required',
        'link_video' => 'required|min:10|max:11',
        'id_palestrante' => 'required|integer'
    ];
}
