<?php

namespace App\Application\Entities;

use Countable;
use Iterator;
class AutorLista implements Iterator, Countable
{
	private array $items = [];
	private int $position = 0;

	public function __construct(array $items = [])
	{
        foreach($items as $autor)
        {
            if(!($autor instanceof Autor))
                throw new \Exception("Tipo de Objeto invalido para AutorLista");

    		$this->items[] = $items;

        }
		$this->position = 0;
	}

    public function push(Autor $autor)
    {
        $this->items[] = $autor;
    }

    public function remove(Autor $autor)
    {
        $new = [];
        foreach($this->items as $item){
            if($item->getId() == $autor->getId())
                continue;
            $new[] = $item;
        }
        $this->items = $new;
        $this->position = 0;
    }

	public function current() : Autor
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

	public function count(): int
	{
		return count($this->items);
	}
}