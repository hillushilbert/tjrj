<?php

namespace App\Application\Entities;

use App\Application\Exceptions\EntitiyIdException;
use App\Application\Exceptions\EntitiyOverflowSizeException;

class Autor
{
    private int $id;
    private string $nome;

    public function __construct(array $data = [])
    {

        foreach($data as $field => $value)
        {
            if($field == 'id'){
                $this->setId($value);
            }

            if($field == 'nome'){
                $this->setNome($value);
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

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        if(strlen($nome) > 40)
            throw new EntitiyOverflowSizeException("O Nome deve ser menor ou igual a 40 caracteres");
        
        $this->nome = $nome;
    }

    
}