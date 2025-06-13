<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            'create or replace view vw_livros as SELECT  
                    l.`Codl`,
                    l.`AnoPublicacao`,
                    l.`Edicao`,
                    l.`Titulo`,
                    l.`Editora`,
                    l.`Valor`,
                    au.`Nome` AS Autor,
                    au.`CodAu`,
                    ass.`Descricao` AS Assunto,
                    ass.`codAs`
                FROM 
                    `Livro` l
                    LEFT JOIN `Livro_Autor` la ON l.`Codl` = la.`Livro_Codl`
                    LEFT JOIN `Autor` au ON au.`CodAu` = la.`Autor_CodAu`
                    LEFT JOIN `Livro_Assunto` al ON l.`Codl` = al.`Livro_Codl`
                    LEFT JOIN `Assunto` ass ON ass.`codAs` = al.`Assunto_codAs`
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view vw_livros');
    }
};
