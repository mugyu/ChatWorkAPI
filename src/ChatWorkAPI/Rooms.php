<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Room.php';

class Rooms implements \IteratorAggregate
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

	protected function fetch()
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms'
		);
		$rooms = [];
		foreach(json_decode($response['body']) ?: [] as $room)
		{
			$rooms[$room->room_id] = Room::inject($room);
		}
		return $rooms;
	}
}
