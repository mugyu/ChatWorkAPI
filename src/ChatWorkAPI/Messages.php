<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Message.php';

class Messages implements \IteratorAggregate
{
	protected $room_id;
	protected $force;

	function __construct($room_id, $force = FALSE)
	{
		$this->room_id = $room_id;
		$this->force   = $force;
	}

	public function getIterator()
	{
		static $iterator = NULL;
		if ( ! $iterator)
		{
			$iterator =  new \ArrayIterator($this->fetch());
		}
		return $iterator;
	}

	protected function fetch()
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/messages?force='.($this->force ? '1' : '0')
		);
		$messages = [];
		foreach(json_decode($response['body']) ?: [] as $message)
		{
			$messages[$message->message_id] = new Message($message);
		}
		return $messages;
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
}
