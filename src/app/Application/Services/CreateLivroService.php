<?php

namespace App\Application\Services;

use App\Application\Adapters\RequestModelAdapter;
use App\Application\Entities\Livro;
use App\Application\Interfaces\ILivroModel;

class CreateLivroService
{
    protected ILivroModel $model;

    public function __construct(ILivroModel $model)
    {
        $this->model = $model;
    }

    public function execute(array $data): Livro
    {
        $adapter = new RequestModelAdapter();
        $livro = $adapter->convert($data);
        return $this->model->save($livro);
    }
}