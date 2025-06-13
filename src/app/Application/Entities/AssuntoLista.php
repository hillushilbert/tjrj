<?php

namespace App\Application\Entities;

use Iterator;

class AssuntoLista implements Iterator
{
	private array $items = [];
	private int $position = 0;

	public function __construct(array $items = [])
	{
        foreach($items as $assunto)
        {
            if(!($assunto instanceof Assunto))
                throw new \Exception("Tipo de Objeto invalido para AssuntoLista");

    		$this->items[] = $items;

        }
		$this->position = 0;
	}

    public function push(Assunto $assunto)
    {
        $this->items[] = $assunto;
    }

    public function remove(Assunto $assunto)
    {
        $new = [];
        foreach($this->items as $item){
            if($item->getId() == $assunto->getId())
                continue;
            $new[] = $item;
        }
        $this->items = $new;
        $this->position = 0;
    }

	public function current() : Assunto
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