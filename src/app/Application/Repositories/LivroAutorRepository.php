<?php

namespace App\Application\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LivroAutorRepository
{

    public function getLivroPorAutor() : Collection
    {

        $dadosView = DB::select("
                SELECT
                    Codl,
                    AnoPublicacao,
                    Edicao,
                    Titulo,
                    Editora,
                    Valor,
                    Autor,
                    CodAu,
                    Assunto,
                    codAs
                FROM 
                    vw_livros    
        ");


        $data = [];
        foreach($dadosView as $record)
        {
            if(empty($data[$record->CodAu])){
                $data[$record->CodAu] = (object)[
                    'id' => $record->CodAu,
                    'nome' => $record->Autor,
                    'livros' => [
                        $record->Codl => (object)[
                            'id' => $record->Codl,
                            'titulo' => $record->Titulo,
                            'editora' => $record->Editora,
                            'edicao' => $record->Edicao,
                            'valor' => $this->formatFloatToReal($record->Valor),
                            'assuntos' => [
                                $record->codAs => $record->Assunto
                            ],
                        ]
                    ]
                ];
            }else{
                $autor = $data[$record->CodAu];
                if(empty($autor->livros[$record->Codl]))
                {
                    $autor->livros[$record->Codl] = (object)[
                        'id' => $record->Codl,
                        'titulo' => $record->Titulo,
                        'editora' => $record->Editora,
                        'edicao' => $record->Edicao,
                        'valor' => $this->formatFloatToReal($record->Valor),
                        'assuntos' => [
                            $record->codAs => $record->Assunto
                        ],
                    ];
                }else{
                    $livro = $autor->livros[$record->Codl];
                    $livro->assuntos[$record->codAs] = $record->Assunto;
                }
            }            
        }

        return collect($data);
    }

    private function formatFloatToReal(float $value): string
    {
        return number_format($value ?? 0.0,2,',','.');
    }
}