<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $fillable = [
        'slug', 'titulo', 'categoria', 'resumo',
        'conteudo', 'imagem', 'autor', 'publicado', 'publicado_em',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'publicado_em' => 'datetime',
    ];
}
