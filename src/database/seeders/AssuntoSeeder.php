<?php

namespace Database\Seeders;

use App\Models\Assunto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Assunto::updateOrCreate([
            'codAs' => 1
        ],[
            'Descricao' => 'Programação'
        ]);
        
        Assunto::updateOrCreate([
            'codAs' => 2
        ],[
            'Descricao' => 'Ficção Cientifica'
        ]);
    }
}
