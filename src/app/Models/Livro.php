<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    //
    protected $table = 'Livro';

    protected $primaryKey = 'Codl';

    protected $fillable = [
        'Codl',
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Valor',
    ];

    public function scopePorTexto($q, $nome)
    {
        if(!empty($nome)){
            $q->where('Titulo','LIKE',"%{$nome}%")
              ->orWhere('Editora','LIKE',"%{$nome}%")
              ->orWhere('Edicao','LIKE',"%{$nome}%")
              ->orWhere('AnoPublicacao',$nome)
              ->orWhere('Valor',round(floatval($nome),2))
              ;
        }
    }
}
