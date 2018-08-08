<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Account.php';

class Message
{
	public $message_id;
	public $account;
	public $body;
	public $send_time;
	public $update_time;

	public function __construct($message)
	{
		$this->message_id  = $message->message_id;
		$this->account     = new Account($message->account);
		$this->body        = $message->body;
		$this->send_time   = $message->send_time;
		$this->update_time = $message->update_time;
	}

	public static function fetch($room_id, $message_id)
	{
		return new self(self::_fetch($room_id, $message_id));
	}

	protected static function _fetch($room_id, $message_id)
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$room_id.'/messages/'.sprintf('%.0f', $message_id)
		);
		return json_decode($response['body']);
	}
}
