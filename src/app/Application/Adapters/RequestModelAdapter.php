<?php

namespace App\Application\Adapters;

use App\Application\Entities\Assunto;
use App\Application\Entities\Autor;
use App\Application\Entities\Livro;

class RequestModelAdapter
{

    public function convert(array $requestData): Livro
    {
        $data = [
            'titulo' => $requestData['Titulo'] ?? null,
            'editora' => $requestData['Editora'] ?? null,
            'edicao' => $requestData['Edicao'] ?? null,
            'ano_publicacao' => $requestData['AnoPublicacao'] ?? null,
            'valor' => $requestData['Valor'] ?? null,
        ];

        $livro = new Livro($data);
        
        if(!empty($requestData['assuntos'])){
            foreach($requestData['assuntos'] as $assunto){
                $livro->addAssunto(new Assunto([
                    'id' => $assunto
                ]));
            }
        }

        if(!empty($requestData['autores'])){
            foreach($requestData['autores'] as $autor){
                $livro->addAutor(new Autor([
                    'id' => $autor
                ]));
            }
        }

        return $livro;
    }
}