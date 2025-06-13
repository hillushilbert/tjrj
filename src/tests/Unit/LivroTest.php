<?php

namespace Tests\Unit;

use App\Application\Entities\Livro;
use App\Application\Exceptions\EntitiyOverflowSizeException;
use PHPUnit\Framework\TestCase;

class LivroTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_setando_titulo_maior_que_limite_permitido(): void
    {
        try
        {
            $livro = new Livro();

            $livro->setTitulo('Expressões Regulares - Uma abordagem divertida');
        }
        catch(\Exception $e){
            $this->assertInstanceOf(EntitiyOverflowSizeException::class,$e);
            $this->assertEquals($e->getMessage(),"O Título deve ser menor ou igual a 40 caracteres"); 
        }
    }

    /**
     * A basic feature test example.
     */
    public function test_setando_titulo_maior_que_limite_permitido_construtor(): void
    {
        try
        {
            $livro = new Livro([
                'id' => 1,
                'titulo' => 'Expressões Regulares - Uma abordagem divertida'
            ]);

        }
        catch(\Exception $e){
            $this->assertInstanceOf(EntitiyOverflowSizeException::class,$e);
            $this->assertEquals($e->getMessage(),"O Título deve ser menor ou igual a 40 caracteres"); 
        }
    }
}
