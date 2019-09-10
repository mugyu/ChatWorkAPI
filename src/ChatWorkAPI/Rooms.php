<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/IteratorAggregate.php';
require_once __DIR__.'/Room.php';

class Rooms extends IteratorAggregate
{
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
