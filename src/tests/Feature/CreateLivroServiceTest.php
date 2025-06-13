<?php

namespace Tests\Feature;

use App\Application\Entities\Livro;
use App\Application\Services\CreateLivroService;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateLivroServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_new_book(): void
    {
        $mock = $this->createMock(CreateLivroService::class);

        $assunto = Assunto::create([
            'Descricao' => 'Programação'
        ]);

        $autor = Autor::create([
            'Nome' => ' Aurelio'
        ]);

        $service = app()->make('App\Application\Services\CreateLivroService');

        $this->assertInstanceOf(CreateLivroService::class,$service);

        

        $requestData = [
            'Codl' => 1,
            'Titulo' => 'Expressões Regulares',
            'Editora' => 'Novatec',
            'Edicao' => '2',
            'AnoPublicacao' => '2018',
            'Valor' => '77.88',
            'assuntos' => [$assunto->codAs],
            'autores' => [$autor->CodAu],
        ];

        $livro = $service->execute($requestData);

        $this->assertInstanceOf(Livro::class,$livro);
    }
}
