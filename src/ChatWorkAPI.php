<?php
require_once __DIR__.'/ChatWorkAPI/Connection.php';

class ChatWorkAPI
{
	protected $connection;
	function __construct($chatWorkToken)
	{
		\ChatWorkAPI\Connection::set_token($chatWorkToken);
		$this->connection = new \ChatWorkAPI\Connection();
	}

	public function me()
	{
		require_once __DIR__.'/ChatWorkAPI/Me.php';
		return new \ChatWorkAPI\Me();
	}

	public function my()
	{
		require_once __DIR__.'/ChatWorkAPI/My.php';
		return new \ChatWorkAPI\My();
	}

	public function contacts()
	{
		require_once __DIR__.'/ChatWorkAPI/Contacts.php';
		return new \ChatWorkAPI\Contacts();
	}

	public function rooms()
	{
		require_once __DIR__.'/ChatWorkAPI/Rooms.php';
		return new \ChatWorkAPI\Rooms();
	}

	public function room($room_id)
	{
		require_once __DIR__.'/ChatWorkAPI/Room.php';
		return new \ChatWorkAPI\Room($room_id);
	}
}
