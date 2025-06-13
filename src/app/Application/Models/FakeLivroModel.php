<?php

namespace App\Application\Models;

use App\Application\Entities\Livro;
use App\Application\Entities\LivroLista;
use App\Application\Interfaces\ILivroModel;

class FakeLivroModel implements ILivroModel
{

	static LivroLista $livroLista;

	public function getById($id): Livro
	{
		$livro = null;
		foreach(self::getList() as $livroItem){
			if($livroItem->getId() == $id){
				$livro = $livroItem;
			}
		}
		return $livro;
	}

	public function getAll(): LivroLista
	{
		return self::getList();
	}

	public function save(Livro $data) : Livro
	{
		$exists = false;
		
		if(count(self::getList()) > 0)
		foreach(self::getList() as $position => $livroItem){
			if(is_object($livroItem) && $livroItem->getId() == $data->getId()){
				$exists = true;
				self::getList()->update($data,$position);
			}
		}

		if(!$exists){
			self::getList()->push($data);
		}

		return $data;
	}

	public function delete(Livro $data): void
	{
		self::getList()->remove($data);
	}

	protected static function getList(): LivroLista
	{
		if(empty(self::$livroLista)){
			self::$livroLista = new LivroLista();
		}

		return self::$livroLista;
	}
}