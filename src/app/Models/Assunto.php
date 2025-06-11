<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    //
    protected $table = 'Assunto';

    protected $fillable = [
        'codAs',
        'Descricao',
    ];
}
