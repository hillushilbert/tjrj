<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class,'Livro_Autor','Livro_Codl','Autor_CodAu');
    }

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class,'Livro_Assunto','Livro_Codl','Assunto_codAs');
    }
}
