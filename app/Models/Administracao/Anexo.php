<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'link',
        'id_evento'
    ];
}
