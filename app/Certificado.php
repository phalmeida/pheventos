<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $dates = ['dt_geracao'];

    protected $fillable = [
        'id_user',
        'id_evento',
        'codigo_verificacao',
        'dt_geracao'
    ];

    public function evento()
    {
        return $this->belongsTo('App\Models\Administracao\Evento', 'id_evento', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

}



