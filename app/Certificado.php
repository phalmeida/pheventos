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
}
