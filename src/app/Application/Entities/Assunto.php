<?php

namespace App\Application\Entities;

use App\Application\Exceptions\EntitiyIdException;
use App\Application\Exceptions\EntitiyOverflowSizeException;

class Assunto
{
    private int $id;
    private string $descricao;

    public function __construct(array $data = [])
    {

        foreach($data as $field => $value)
        {
            if($field == 'id'){
                $this->setId($value);
            }

            if($field == 'descricao'){
                $this->setDescricao($value);
            }
            
        }
    }

    public function setId(int $id)
    {
        if($id <= 0)
            throw new EntitiyIdException("Id não pode ser menor ou igual a Zero"); 
        
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao)
    {
        if(strlen($descricao) > 20)
            throw new EntitiyOverflowSizeException("A Descrição deve ser menor ou igual a 20 caracteres");
        
        $this->descricao = $descricao;
    }
}