<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Member.php';

class Members implements \Iterator
{
	protected $room_id;
	protected $members = NULL;
	protected $connection;
	protected $key;
	protected $size;
	function __construct($room_id)
	{
		$this->room_id = $room_id;
		$this->connection = new Connection();
	}

	public function current()
	{
		return new Member($this->members[$this->key]);
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
		if ($this->members === NULL)
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
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/members'
		);
		$members = json_decode($response['body']);
		$this->members = $members ?: [];
		$this->size = count($this->members);
	}
}
