<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $dates = ['dt_inicio' , 'dt_fim'];

    protected $fillable = [
        'titulo',
        'descricao',
        'link_video',
        'imagem',
        'numero_vagas',
        'valor_entrada',
        'id_palestrante',
        'dt_inicio',
        'dt_fim'
    ];
    public $roles = [
        'titulo' => 'required|min:3|max:100',
        'descricao' => 'required',
        'link_video' => 'required|min:3|max:200',
        //'imagem' => 'required|image|max:3000|mimes:jpg,png,jpeg',
        'id_palestrante' => 'required|integer',
        'dt_inicio' => 'required|date|date_format:"d/m/Y"',
        'dt_fim' => 'required|date|date_format:"d/m/Y"'
    ];

    public $rolesEdit = [
        'titulo' => 'required|min:3|max:100',
        'descricao' => 'required',
        'link_video' => 'required|min:3|max:200',
        //'imagem' => 'image|max:3000|mimes:jpg,png,jpeg',
        'id_palestrante' => 'required|integer',
        'dt_inicio' => 'required|date|date_format:"d/m/Y"',
        'dt_fim' => 'required|date|date_format:"d/m/Y"'
    ];


    /**
     * Get dos eventos com seu palestrante
     */
    public function palestrante()
    {
        return $this->belongsTo('App\Models\Administracao\Palestrante', 'id_palestrante', 'id');
    }

    public function usuarios()
    {

        return $this->belongsToMany('App\User', 'users_eventos', 'id_evento', 'id_user')->withPivot('presenca');

    }

    /**
     * @return $this
     */
    public function anexos()
    {

        return $this->hasMany('App\Models\Administracao\Anexo', 'id_evento', 'id_evento');

    }

}
