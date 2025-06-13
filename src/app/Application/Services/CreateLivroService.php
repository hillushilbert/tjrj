<?php

namespace App\Application\Services;

use App\Application\Entities\Livro;
use App\Application\Interfaces\ILivroModel;

class CreateLivroService
{
    protected ILivroModel $model;

    public function __construct(ILivroModel $model)
    {
        $this->model = $model;
    }

    public function execute(Livro $livro): Livro
    {
        return $this->model->save($livro);
    }
}