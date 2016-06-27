<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

class Palestrante extends Model
{
    protected $fillable = ['nome','email','telefone'];
    public $roles = [
        'nome' => 'required|min:3|max:100',
        'email' => 'required|min:3|max:100|email|unique:palestrantes,email',
        'telefone' => 'required|min:10|max:11'
    ];
}
