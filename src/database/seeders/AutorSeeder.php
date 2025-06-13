<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Autor::updateOrCreate([
            'CodAu' => 1
        ],[
            'Nome' => 'Aurelio Marinho Jargas'
        ]);
        
        Autor::updateOrCreate([
            'CodAu' => 2
        ],[
            'Nome' => 'Issac Asimov'
        ]);
        
    }
}
