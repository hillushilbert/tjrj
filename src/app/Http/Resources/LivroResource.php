<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Codl' => $this->Codl,
            'Titulo' => $this->Titulo,
            'Editora' => $this->Editora,
            'Edicao' => $this->Edicao,
            'AnoPublicacao' => $this->AnoPublicacao,
            'Valor' => $this->Valor,
            'autores' => $this->autores()->pluck('Autor_CodAu'),
            'assuntos' => $this->assuntos()->pluck('Assunto_codAs')
        ];
    }
}
