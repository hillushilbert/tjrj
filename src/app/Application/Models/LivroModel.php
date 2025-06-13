<?php

namespace App\Application\Models;

use App\Application\Entities\Livro;
use App\Application\Interfaces\ILivroModel;

class LivroModel implements ILivroModel
{
	public function getById($id): Livro
	{
		// TODO: Implement getById() method.
	}

	public function getAll(): array
	{
		// TODO: Implement getAll() method.
	}

	public function save($data) : Livro
	{
		// TODO: Implement save() method.
	}

	public function delete($id): void
	{
		// TODO: Implement delete() method.
	}
}