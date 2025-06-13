<?php

namespace App\Application\Entities;

use App\Application\Exceptions\EntitiyIdException;
use App\Application\Exceptions\EntitiyOverflowSizeException;

class Livro
{
    private ?int $id;
    private string $titulo;
    private string $editora;
    private int $edicao;
    private int $ano_publicacao;
    private float $valor;
    private ?AssuntoLista $assuntoLista;
    private ?AutorLista $autorLista;

    public function __construct(array $data = [])
    {
        $this->assuntoLista = new AssuntoLista();
        $this->autorLista = new AutorLista();
        $this->id = null;
        foreach($data as $field => $value)
        {
            if($field == 'id'){
                $this->setId($value);
            }

            if($field == 'titulo'){
                $this->setTitulo($value);
            }

            if($field == 'editora'){
                $this->setEditora($value);
            }

            if($field == 'edicao'){
                $this->setEdicao($value);
            }

            if($field == 'ano_publicacao'){
                $this->setAnoPulicacao($value);
            }

            if($field == 'valor'){
                $this->setValor($value);
            }
        }
    }

    public function setId(int $id)
    {
        if($id <= 0)
            throw new EntitiyIdException("Id não pode ser menor ou igual a Zero"); 
        
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo)
    {
        if(strlen($titulo) > 40)
            throw new EntitiyOverflowSizeException("O Título deve ser menor ou igual a 40 caracteres");
        
        $this->titulo = $titulo;
    }

    public function getEditora(): string
    {
        return $this->editora;
    }

    public function setEditora(string $editora)
    {
        if(strlen($editora) > 40)
            throw new EntitiyOverflowSizeException("A Editora deve ser menor ou igual a 40 caracteres");

        $this->editora = $editora;
    }

    public function setEdicao(int $edicao)
    {
        if($edicao <= 0)
            throw new EntitiyOverflowSizeException("A Edição deve ser superior a 0, {$edicao}");

        $this->edicao = $edicao;
    }

    public function getEdicao(): int
    {
        return $this->edicao;
    }

    public function setAnoPulicacao(int $ano_publicacao)
    {
        if($ano_publicacao > (date('Y')+1))
            throw new EntitiyOverflowSizeException("O Ano de Publicação não pode ser superiro ao ano atual mais um");

        $this->ano_publicacao = $ano_publicacao;
    }

    public function getAnoPublicacao(): int
    {
        return $this->ano_publicacao;
    }

    public function setValor(float $valor)
    {
        if($valor <= 0)
            throw new EntitiyOverflowSizeException("O Valor do Livro deve ser superior a 0");

        $this->valor = $valor;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setAutorLista(AutorLista $autorLista)
    {
        $this->autorLista = $autorLista;
    }

    public function getAutorLista(): AutorLista
    {
        return $this->autorLista;
    }

    public function setAssuntoLista(AssuntoLista $assuntoLista)
    {
        $this->assuntoLista = $assuntoLista;
    }

    public function getAssuntoLista(): AssuntoLista
    {
        return $this->assuntoLista;
    }

    public function addAssunto(Assunto $assunto)
    {
        $this->assuntoLista->push($assunto);
    }

    public function addAutor(Autor $autor)
    {
        $this->autorLista->push($autor);
    }


}