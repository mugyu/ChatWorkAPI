<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Room.php';

class Rooms implements \Iterator
{
	protected $rooms = NULL;
	protected $connection;
	protected $key;
	protected $size;
	function __construct()
	{
		$this->connection = new Connection();
	}

	public function current()
	{
		return Room::inject($this->rooms[$this->key]);
	}

	public function key()
	{
		return $this->key;
	}

	public function next()
	{
		++$this->key;
	}

	public function rewind()
	{
		if ($this->rooms === NULL)
		{
			$this->fetch();
		}
		$this->key = 0;
	}

	public function valid()
	{
		return $this->key < $this->size;
	}

	protected function fetch()
	{
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms'
		);
		$rooms = json_decode($response['body']);
		$this->rooms = $rooms ?: [];
		$this->size = count($this->rooms);
	}
}
