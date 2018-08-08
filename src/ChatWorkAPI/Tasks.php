<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Task.php';

class Tasks implements \Iterator
{
	protected $fetcher;
	protected $tasks = NULL;
	protected $connection;
	protected $index;
	protected $size;

	public function __construct($fetcher)
	{
		$this->fetcher = $fetcher;
	}

	public function current()
	{
		return $this->tasks[$this->index];
	}

	public function key()
	{
		return $this->tasks[$this->index]->task_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if (is_null($this->tasks))
		{
			$this->tasks = [];
			foreach($this->fetcher->fetch() as $task)
			{
				$this->tasks[] = new Task($task);
			}
			$this->size = count($this->tasks);
		}
		$this->index = 0;
	}

	public function valid()
	{
		return $this->index < $this->size;
	}
}
