<?php

namespace App\Application\Interfaces;

use App\Application\Entities\Livro;
use App\Application\Entities\LivroLista;

interface ILivroModel
{
    public function getById(int $id): Livro;
    public function getAll(): LivroLista;
    public function save(Livro $livro): Livro;
    public function delete(Livro $livro): void;
}