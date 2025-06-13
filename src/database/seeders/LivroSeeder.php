<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $livro1 = Livro::updateOrCreate([
            'Codl' => 1
        ],[
            'Titulo' => 'Expressões Regulares',
            'Editora' => 'Novatec',
            'Edicao' => 2,
            'AnoPublicacao' => '2018',
            'Valor' => '55.66',
        ]);

        $livro1->assuntos()->detach(1);
        $livro1->assuntos()->attach(1);
        $livro1->autores()->detach(1);
        $livro1->autores()->attach(1);

        $livro2 = Livro::updateOrCreate([
            'Codl' => 2
        ],[
            'Titulo' => 'O Cair da Noite',
            'Editora' => 'Hemus',
            'Edicao' => 2,
            'AnoPublicacao' => '1981',
            'Valor' => '24.85',
        ]);

        $livro2->assuntos()->detach(2);
        $livro2->assuntos()->attach(2);
        $livro2->autores()->detach(2);
        $livro2->autores()->attach(2);
    }
}
