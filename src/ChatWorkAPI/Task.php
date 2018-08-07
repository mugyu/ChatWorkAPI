<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';
require_once __DIR__.'/Account.php';

class Task
{
	public $task_id;
	public $account;
	public $assigned_by_account;
	public $message_id;
	public $body;
	public $limit_time;
	public $status;

	public function __construct($task)
	{
		$this->task_id             = $task->task_id;
		$this->account             = new Account($task->account);
		$this->assigned_by_account = new Account($task->assigned_by_account);
		$this->message_id          = $task->message_id;
		$this->body                = $task->body;
		$this->limit_time          = $task->limit_time;
		$this->status              = $task->status;
	}

	public static function fetch($room_id, $task_id) {
		$task = self::_fetch($room_id, $task_id);
		return new self($task);
	}

	protected static function _fetch($room_id, $task_id)
	{
		$connection = new Connection();
		$response = $connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$room_id.'/tasks/'.$task_id
		);
		return json_decode($response['body']);
	}
}
