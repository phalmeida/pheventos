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
        'titulo'        => 'required|min:3|max:100',
        'descricao'     => 'required',
        'link_video'    => 'required|min:3|max:200',
        'id_palestrante'=> 'required|integer',
        'dt_inicio'     => 'required|date|date_format:"d/m/Y"',
        'dt_fim'        => 'required|date|date_format:"d/m/Y"'
    ];
    

    /**
     * Get dos eventos com seu palestrante
     */
    public function palestrante()
    {
        return $this->belongsTo('App\Models\Administracao\Palestrante', 'id_palestrante' ,'id');
    }    
    
}
