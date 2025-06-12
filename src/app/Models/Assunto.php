<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    //
    protected $table = 'Assunto';

    protected $primaryKey = 'codAs';

    protected $fillable = [
        'codAs',
        'Descricao',
    ];

    public function scopePorTexto($q, $nome)
    {
        if(!empty($nome)){
            $q->where('Descricao','LIKE',"%{$nome}%");
        }
    }
}
