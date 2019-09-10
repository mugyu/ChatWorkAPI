<?php
namespace ChatWorkAPI;
abstract class IteratorAggregate implements \IteratorAggregate
{
	protected $iterator = NULL;

	public function getIterator()
	{
		if ($this->iterator === NULL)
		{
			$this->iterator =  new \ArrayIterator($this->fetch());
		}
		return $this->iterator;
	}

	abstract protected function fetch();
}
