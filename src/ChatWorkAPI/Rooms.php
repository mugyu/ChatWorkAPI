<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Room.php';

class Rooms implements \Iterator
{
	protected $rooms = NULL;
	protected $connection;
	protected $index;
	protected $size;
	function __construct()
	{
		$this->connection = new Connection();
	}

	public function current()
	{
		return $this->rooms[$this->index];
	}

	public function key()
	{
		return $this->rooms[$this->index]->room_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if ($this->rooms === NULL)
		{
			$this->fetch();
		}
		$this->index = 0;
	}

	public function valid()
	{
		return $this->index < $this->size;
	}

	protected function fetch()
	{
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms'
		);
		$rooms = json_decode($response['body']);
		$this->rooms = [];
		foreach($rooms ?: [] as $room)
		{
			$this->rooms[] = Room::inject($room);
		}
		$this->size = count($this->rooms);
	}
}
