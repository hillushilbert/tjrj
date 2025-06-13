<?php

namespace App\Application\Entities;

use Iterator;

class LivroLista implements Iterator
{
	private array $items = [];
	private int $position = 0;

	public function __construct(array $items = [])
	{
        foreach($items as $livro)
        {
            if(!($livro instanceof Livro))
                throw new \Exception("Tipo de Objeto invalido para LivroLista");

    		$this->items[] = $items;

        }
		$this->position = 0;
	}

    public function push(Livro $livro)
    {
        $this->items[] = $livro;
    }

	public function update(Livro $livro, int $id)
    {
        $this->items[$id] = $livro;
    }

    public function remove(Livro $livro)
    {
        $new = [];
        foreach($this->items as $item){
            if($item->getId() == $livro->getId())
                continue;
            $new[] = $item;
        }
        $this->items = $new;
        $this->position = 0;
    }

	public function current() : Livro
	{
		return $this->items[$this->position] ?? null;
	}

	public function next(): void
	{
		++$this->position;
	}

	public function key(): int
	{
		return $this->position;
	}

	public function valid(): bool
	{
		return isset($this->items[$this->position]);
	}

	public function rewind(): void
	{
		$this->position = 0;
	}
}