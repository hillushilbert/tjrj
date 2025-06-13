<?php

namespace Tests\Feature;

use App\Application\Entities\Livro;
use App\Application\Services\CreateLivroService;
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

        $service = app()->make('App\Application\Services\CreateLivroService');

        $this->assertInstanceOf(CreateLivroService::class,$service);

        $livro = new Livro([
            'id' => 1,
            'titulo' => 'Titulo'
        ]);

        $res = $service->execute($livro);

        $this->assertInstanceOf(Livro::class,$res);
    }
}
