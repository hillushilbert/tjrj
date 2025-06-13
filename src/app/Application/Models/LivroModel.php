<?php

namespace App\Application\Models;

use App\Application\Adapters\EloquentModelAdapter;
use App\Application\Entities\Livro;
use App\Application\Entities\LivroLista;
use App\Application\Interfaces\ILivroModel;
use App\Models\Livro as ModelsLivro;

class LivroModel implements ILivroModel
{
	public function getById($id): Livro
	{
		// TODO: Implement getById() method.
		$eloquentLivro = ModelsLivro::find($id);
		$adapter = new EloquentModelAdapter();
		$livro = $adapter->convert($eloquentLivro);
		return $livro;
	}

	public function getAll(): LivroLista
	{
		$lista = new LivroLista();
		$livrosEloquent = ModelsLivro::get();
		foreach($livrosEloquent as $livroEloquent)
		{
			$livro = $this->getById($livroEloquent->Cold);
			$lista->push($livro);
		}
		return $lista;
	}

	public function save(Livro $data) : Livro
	{
		$adapter = new EloquentModelAdapter();
		$eloquent = $adapter->revert($data);
		$eloquent->save();
		if(!$data->getId()){
			$data->setId($eloquent->Codl);
		}

		if(count($data->getAssuntoLista()) > 0){
			$eloquent->assuntos()->detach();
			foreach($data->getAssuntoLista() as $assunto)
			{
				$eloquent->assuntos()->attach($assunto->getId());
			}
		}
		
		if(count($data->getAutorLista()) > 0){
			$eloquent->autores()->detach();
			foreach($data->getAutorLista() as $autor)
			{
				$eloquent->autores()->attach($autor->getId());
			}
		}

		return $data;
	}

	public function delete($id): void
	{
		// TODO: Implement delete() method.
		ModelsLivro::destroy($id);
	}
}