<?php
namespace ChatWorkAPI;
require_once __DIR__.'/Connection.php';

class RoomTasks
{
	protected $room_id;
	protected $params = [];
	protected $connection;

	public function __construct($room_id, $options = [])
	{
		$this->room_id = $room_id;
		if (isset($options['account_id']))
		{
			$this->params['account_id'] = $options['account_id'];
		}
		if (isset($options['assigned_by_account_id']))
		{
			$this->params['assigned_by_account_id'] = $options['assigned_by_account_id'];
		}
		if (isset($options['status']))
		{
			$this->params['status'] = $options['status'];
		}
		$this->connection = new Connection();
	}

	public function fetch()
	{
		$param_string = '';
		$params = [];
		foreach($this->params as $name => $value)
		{
			$params[] = $name.'='.$value;
		}
		if ($params) {
			$param_string = '?'.implode('&', $params);
		}
		$response = $this->connection->execute(
			'GET',
			'https://api.chatwork.com/v2/rooms/'.$this->room_id.'/tasks'.$param_string
		);
		$tasks = json_decode($response['body']);
		return $tasks ?: [];
	}
}
