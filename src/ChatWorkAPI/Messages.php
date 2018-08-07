<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Message.php';

class Messages implements \Iterator
{
	protected $room_id;
	protected $force;
	protected $messages = NULL;
	protected $connection;
	protected $key;
	protected $size;

	function __construct($room_id, $force = FALSE)
	{
		$this->room_id = $room_id;
		$this->force   = $force;
		$this->connection = new Connection();
	}

	public function current()
	{
		return new Message($this->messages[$this->key]);
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
		if ($this->messages === NULL)
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
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/messages?force='.($this->force ? '1' : '0')
		);
		$messages = json_decode($response['body']);
		$this->messages = $messages ?: [];
		$this->size = count($this->messages);
	}
}
