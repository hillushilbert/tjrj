<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroTest extends TestCase
{
    use RefreshDatabase;

    public function test_livro_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/livros');

        $response->assertOk();
    }

    public function test_livro_information_can_be_stored(): void
    {
        $assunto = Assunto::create([
            'Descricao' => 'Programação'
        ]);

        $autor = Autor::create([
            'Nome' => ' Aurelio'
        ]);

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/livros', [
                'Titulo' => 'Expressões Regulares',
                'Editora' => 'Novatec',
                'Edicao' => 8,
                'AnoPublicacao' => '2018',
                'Valor' => '77.88',
                'autores' => [$autor->CodAu],
                'assuntos' => [$assunto->codAs],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/livros');

        $livro = Livro::latest()->first();

        $this->assertSame('Expressões Regulares', $livro->Titulo);
        $this->assertSame('77.88', $livro->Valor);
    }

    public function test_livro_information_can_be_updated(): void
    {
        $assunto = Assunto::create([
            'Descricao' => 'Programação'
        ]);

        $autor = Autor::create([
            'Nome' => ' Aurelio'
        ]);

        $livro = Livro::create([
            'Titulo' => 'Expressões Regulares',
            'Editora' => 'Novatec',
            'Edicao' => 8,
            'AnoPublicacao' => '2017',
            'Valor' => '80.00',          
        ]);

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/livros/'.$livro->Codl, [
                'Titulo' => 'Expressões Regulares',
                'Editora' => 'Novatec',
                'Edicao' => 8,
                'AnoPublicacao' => '2018',
                'Valor' => '77.88',
                'autores' => [$autor->CodAu],
                'assuntos' => [$assunto->codAs],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/livros');

        $livro->refresh();

        $this->assertSame('Expressões Regulares', $livro->Titulo);
        $this->assertSame('77.88', $livro->Valor);
        $this->assertSame('2018', $livro->AnoPublicacao);
    }

    
}
