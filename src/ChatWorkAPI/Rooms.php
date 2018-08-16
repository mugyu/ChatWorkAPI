<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Room.php';

class Rooms implements \IteratorAggregate
{
	public function getIterator()
	{
		return new \ArrayIterator($this->fetch());
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
