<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    //
    protected $table = 'Autor';
    
    protected $primaryKey = 'CodAu';

    protected $fillable = [
        'CodAu',
        'Nome',
    ];

    public function scopePorNome($q, $nome)
    {
        if(!empty($nome)){
            $q->where('Nome','LIKE',"%{$nome}%");
        }
    }
}
