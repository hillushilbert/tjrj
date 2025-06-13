<?php

namespace App\Application\Adapters;

use App\Application\Entities\Assunto;
use App\Application\Entities\Autor;
use App\Application\Entities\Livro;
use App\Models\Livro as ModelsLivro;

class EloquentModelAdapter
{

    public function convert(ModelsLivro $requestData): Livro
    {
        $data = [
            'id' => $requestData->Codl ?? null,
            'titulo' => $requestData->Titulo ?? null,
            'editora' => $requestData->Editora ?? null,
            'edicao' => $requestData->Edicao ?? null,
            'ano_publicacao' => $requestData->AnoPublicacao ?? null,
            'valor' => $requestData->Valor ?? null,
        ];

        $livro = new Livro($data);
        
        if(!empty($requestData->assuntos)){
            foreach($requestData->assuntos as $assunto){
                $livro->addAssunto(new Assunto([
                    'id' => $assunto->codAs,
                    'descricao' => $assunto->Descricao,
                ]));
            }
        }

        if(!empty($requestData->autores)){
            foreach($requestData->autores as $autor){
                $livro->addAutor(new Autor([
                    'id' => $autor->CodAu,
                    'nome' => $autor->Nome
                ]));
            }
        }

        return $livro;
    }

    public function revert(Livro $data): ModelsLivro
    {
        $eloquent = new ModelsLivro([
            'Codl' => $data->getId() ?? null,
            'Titulo' => $data->getTitulo() ?? null,
            'Editora' => $data->getEditora() ?? null,
            'Edicao' => $data->getEdicao() ?? null,
            'AnoPublicacao' => $data->getAnoPublicacao() ?? null,
            'Valor' => $data->getValor() ?? null,
        ]);

        return $eloquent;
    }
}