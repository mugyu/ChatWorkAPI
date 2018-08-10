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
	protected $index;
	protected $size;

	function __construct($room_id, $force = FALSE)
	{
		$this->room_id = $room_id;
		$this->force   = $force;
		$this->connection = new Connection();
	}

	public function post($content, $self_unread = FALSE)
	{
		$postfields = [
			'body' => $content,
			'self_unread' => $self_unread ? '1' : '0'
		];
		$connection = new Connection();
		$response = $connection->execute(
			'POST',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/messages',
			$postfields
		);
		return json_decode($response['body'])->message_id;
	}

	public function current()
	{
		return $this->messages[$this->index];
	}

	public function key()
	{
		return $this->messages[$this->index]->message_id;
	}

	public function next()
	{
		++$this->index;
	}

	public function rewind()
	{
		if ($this->messages === NULL)
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
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/messages?force='.($this->force ? '1' : '0')
		);
		$messages = json_decode($response['body']);
		$this->messages = [];
		foreach($messages ?: [] as $message)
		{
			$this->messages[] = new Message($message);
		}
		$this->size = count($this->messages);
	}
}
